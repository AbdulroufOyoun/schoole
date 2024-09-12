<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ImageTrait;
use App\Http\Requests\UserRequest\UpdateAcountRequest;
use App\Http\Requests\UserRequest\UpdateProfileRequest;
use App\Models\Classroom;
use App\Models\Post;
use App\Models\Section;
use App\Models\Student;
use App\Models\User;
use App\Models\YearlyPlan;
use Arr;
use DataTables;
use Hash;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    use ImageTrait;

    public function create()
    {

        return view('admin_panel.user.create');
    }

    public function index()
    {
        $classrooms = Classroom::get();
        return view('admin_panel.user.index')->with(['classrooms' => $classrooms]);
    }

    public function getUser(Request $request)
    {
        if ($request->ajax()) {
            if ($request->account_type) {
                if ($request->classroom_id) {
                    if ($request->section_id != "all") {
                        $data = User::where('school_id',auth()->user()->school_id)->where('role_id', $request->account_type)
                            ->whereHas('classroom', function ($query) use ($request) {
                                $query->where('section_id', $request->section_id);
                            })
                            ->latest()
                            ->get();
                    } else {
                        $data = User::where('school_id',auth()->user()->school_id)->where('role_id', $request->account_type)
                            ->whereHas('classroom', function ($query) use ($request) {
                                $query->where('classroom_id', $request->classroom_id);
                            })
                            ->latest()
                            ->get();
                    }
                } else
                    $data = User::where('school_id',auth()->user()->school_id)->whereRoleId($request->account_type)->latest()->get();
            } else {
                if (auth()->user()->account_type == 'admin'){
                    $data = User::where('school_id',auth()->user()->school_id)->whereNotIn('role_id',[10,6])->latest()->get();
                }else{
                    $data = User::where('school_id',auth()->user()->school_id)->whereNotIn('role_id',[10,6,5])->latest()->get();
                }
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('type', function (User $user) {
                    return $user->AccountType;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('user.edit', $row->id) . '" class="edit btn btn-primary " title="';
                    $actionBtn .= __('button.edit').'"><i class="fa fa-pencil" ></i></a>';
                    $actionBtn .= '<button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" title="'.__('button.delete_account');
                    $actionBtn .= '"id="deleteButton" data-id="' . $row->id . '">';
                    $actionBtn .= '<i class="fa fa-trash" data-toggle="tooltip"></i></button>';
                    $actionBtn .= '<button class="btn btn-gray" data-toggle="modal" data-target="#deleteSocialMediaModal" title="'.__('button.delete_social_media');
                    $actionBtn .= '"id="deleteSocialMediaButton" data-id="' . $row->id . '">';
                    $actionBtn .= '<i class="fa fa-instagram" data-toggle="tooltip"></i></button>';

                    return $actionBtn;
                })
                ->rawColumns(['action', 'type'])
                ->make(true);
        }
    }

    public function delete(Request $request)
    {
        $request->validate(['id' => ['required', 'integer', 'exists:users,id']]);
        $user = User::find($request->id);
        #delete user image
        if ($user->image)
            $this->deleteImage($user->image);
        #delete user social media
        $posts = Post::whereUserId($user->id)->get();
        foreach ($posts as $post) {
            foreach ($post->attachments as $attachment) {
                $this->deleteImage($attachment->image);
                $attachment->delete();
            }
            $post->delete();
        }
        #delete sons
        if ($user->account_type === 'Parent') {
            $sons = User::where('school_id',auth()->user()->school_id)->whereParent($user->id)->get();
            foreach ($sons as $son) {
                if ($son->image)
                    $this->deleteImage($son->image);
                #delete user social media
                $posts = Post::whereUserId($son->id)->get();
                foreach ($posts as $post) {
                    foreach ($post->attachments as $attachment) {
                        $this->deleteImage($attachment->image);
                        $attachment->delete();
                    }
                    $post->delete();
                }
                $son->delete();
            }
        }
        if ($user->account_type === 'teacher'){
            $plans = YearlyPlan::where('teacher_id',$user->id)->get();
            foreach ($plans as $plan){
                $this->deleteImage($plan->file);
                $plan->delete();
            }
        }
        $user->delete();
        session()->flash('success', __('alert.alert_delete'));
        return redirect()->back();

    }

    public function edit(int $id)
    {
        $user = User::find($id);
        $roles = Role::whereIn('name', ['editor','accountant',$user->getRoleNames()[0]])->get(['name', 'id']);
        if ($user->account_type == 'student') {
            $parents = User::where('school_id',auth()->user()->school_id)->whereRoleId(4)->get(['id', 'UserName']);
            $classrooms = Classroom::get();
            $sections = Section::where('classroom_id', $user->classroom->id)->get();
            return view('admin_panel.user.edit')->with([
                'user' => $user,
                'roles' => $roles,
                'parents' => $parents,
                'sections' => $sections,
                'classrooms' => $classrooms,
            ]);
        }
        if ($user->account_type == 'academic' || $user->account_type == 'admin') {
            $roles = Role::whereIn('name', ['editor','accountant',$user->getRoleNames()[0]])->get(['name', 'id']);
            return view('admin_panel.user.edit')->with([
                'user' => $user,
                'roles' => $roles,
            ]);
        }
        return view('admin_panel.user.edit')->with([
            'user' => $user,
            'roles' => $roles,
        ]);

    }

    public function update(UpdateAcountRequest $request)
    {
        $data = $request->validated();
        $user = User::find($data['id']);
        if ($data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            $data = Arr::except($data, ['password']);
        }
        if ($request->hasFile('image')) {
            $this->deleteImage($user->image);
            $data['image'] = $this->uploadImage($data['image']);
        } else {
            $data['image'] = $user->image;
        }
        $user->syncRoles([]);
        $user->assignRole($data['roles']);

        if (isset($data['classroom'])) {
            Student::whereUserId($data['id'])->update([
                'classroom_id' => $data['classroom'],
                'section_id' => $data['section'],
            ]);
        }
        $user->update($data);
        session()->flash('success', __('alert.alert_update'));
        return redirect()->back();
    }

    public function profile()
    {
        $user = User::find(auth()->id());
        return view('admin_panel.user.profile')->with([
            'user' => $user,
        ]);

    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $data = $request->validated();
        $user = User::find($data['id']);
        if ($data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            $data = Arr::except($data, ['password']);
        }
        if ($request->hasFile('image')) {
            $this->deleteImage($user->image);
            $data['image'] = $this->uploadImage($data['image']);
        } else {
            $data['image'] = $user->image;
        }
        $user->update($data);
        session()->flash('success', __('alert.alert_update'));
        return redirect()->back();
    }

    public function deleteSocialMedia(Request $request)
    {
        $request->validate(['id' => ['required', 'integer', 'exists:users,id']]);
        $user_id = $request->id;
        $posts = Post::whereUserId($user_id)->get();
        foreach ($posts as $post) {
            foreach ($post->attachments as $attachment) {
                $this->deleteImage($attachment->image);
                $attachment->delete();
            }
            $post->delete();
        }
        session()->flash('success', __('alert.delete_social_media'));
        return redirect()->back();

    }


}
