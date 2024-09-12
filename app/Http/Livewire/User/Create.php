<?php

namespace App\Http\Livewire\User;

use App\Models\Classroom;
use App\Models\Section;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use Session;
use Spatie\Permission\Models\Role;


class Create extends Component
{
    use WithFileUploads;

    public $role_id, $parents, $roles_selected, $sections, $languages;
    public $scrollToTop = false;

    public $name, $parent, $last_name, $father_name,$mother_name, $classroom, $section, $phone, $email, $date_of_birth, $gender, $image, $UserName, $password, $image_name;

    protected $listeners = [
        '$refresh' => 'refreshComponent',
    ];

    public function refreshComponent()
    {
        $this->parents = User::whereSchoolId(auth()->user()->school_id)->whereRoleId(4)->get(['id', 'UserName']);
    }

    public function mount()
    {
        $this->parents = User::whereSchoolId(auth()->user()->school_id)->whereRoleId(4)->get(['id', 'UserName']);
        $this->role_id = 1;
        $role = Role::whereName('student')->first();
        $this->roles_selected = $role->id;

    }

    public function submit()
    {
        $data = $this->validate([
            'name' => 'required|string',
            'last_name' => 'required|string',
            'father_name' => 'required|string',
            'mother_name' => 'required|string',
            'UserName' => 'required|string|unique:users,UserName',
            'password' => 'required|string|min:6',
            'classroom' => 'required|integer',
            'section' => 'required|integer',
            'email' => 'required|email|unique:users,email',
            'parent' => 'required|integer',
            'phone' => 'required|string',
            'date_of_birth' => 'required|date',
            'gender' => 'required|integer',
            'languages' => 'required|string',
            'image' => 'required|image|max:2048',
            'role_id' => 'required|integer',
        ]);

        if ($this->image) {
            $logo = time() + random_int(0, 999) . '.' . $this->image->extension();
            $this->image->storeAs('images' . '/' . date('d-m-Y'), $logo, 'public_upload');
            $data['image'] = '/images/' . date('d-m-Y') . '/' . $logo;
        }

        $data['password'] = Hash::make($data['password']);
        $data['school_id'] = auth()->user()->school_id;

        $item = User::create($data);
        Student::create([
            'user_id' => $item->id,
            'classroom_id'=>$data['classroom'],
            'section_id'=>$data['section'],
            'year_id'=>Session::get('year_id'),
        ]);
        $item->assignRole($this->roles_selected);

        $this->resetForm();
        session()->flash('message', __('alert.alert_saved'));
        $this->scrollToTop = true;


    }
    public function render()
    {

        $roles = Role::whereIn('name', ['student','editor'])->get(['name', 'id']);
        $classrooms = Classroom::get();
        return view('livewire.user.create')->with([
            'parents' => $this->parents,
            'roles' => $roles,
            'classrooms' => $classrooms
        ]);
    }

    public function updatedImage()
    {
        $this->image_name = $this->image->getClientOriginalName();
    }

    public function updatedClassroom()
    {
        $this->section = null;
        $this->sections = null;

        $this->sections = Section::where('classroom_id', $this->classroom)->get();

    }

    public function resetForm()
    {

        $this->reset(['name','last_name','father_name','mother_name', 'parent', 'phone', 'email', 'date_of_birth', 'gender', 'image', 'UserName', 'password', 'image_name', 'languages']);

    }

    public function hydrate()
    {


        $this->emit('data-change-event');

    }

}
