<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

class TeacherCreate extends Component
{
    use WithFileUploads;

    public $languages, $role_id, $roles_selected;
    public $scrollToTop = false;


    public $name,$last_name, $phone, $email, $date_of_birth, $gender, $image, $UserName, $password,$teacher_section ,$image_name;

    public function mount()
    {
        $this->role_id = 2;
        $role = Role::whereName('teacher')->first();
        $this->roles_selected = $role->id;
    }


    public function submit()
    {

        $data = $this->validate([
            'name' => 'required|string',
            'last_name' => 'required|string',
            'teacher_section' => 'required|string',
            'UserName' => 'required|string|unique:users,UserName',
            'password' => 'required|string|min:6',
            'email' => 'required|email|unique:users,email',
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
        $item->assignRole($this->roles_selected);

        $this->resetForm();
        session()->flash('message', __('alert.alert_saved'));
        $this->scrollToTop = true;

    }
    public function render()
    {
        $roles = Role::whereIn('name', ['teacher','editor'])->get(['name', 'id']);
        return view('livewire.user.teacher-create', ['roles' => $roles]);
    }

    public function updatedImage()
    {

        $this->image_name = $this->image->getClientOriginalName();
    }

    public function resetForm()
    {

        $this->reset(['name','last_name', 'phone', 'email', 'date_of_birth', 'gender', 'image', 'UserName', 'password', 'image_name', 'languages']);

    }

}
