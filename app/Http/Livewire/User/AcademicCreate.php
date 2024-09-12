<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AcademicCreate extends Component
{

    use WithFileUploads;


    public $role_id,$roles_selected;
    public $scrollToTop = false;


    public $name,$last_name, $phone, $email, $image, $UserName, $password, $image_name;

    public function mount()
    {
        $this->role_id = 5;
        $role = Role::whereName('academic')->first();
        $this->roles_selected = $role->id;

    }

    public function submit()
    {
        $data = $this->validate([
            'name' => 'required|string',
            'last_name' => 'required|string',
            'UserName' => 'required|string|unique:users,UserName',
            'password' => 'required|string|min:6',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string',
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

    }
    public function render()
    {
        $roles = Role::whereIn('name', ['academic','editor','accountant'])->get(['name', 'id']);
        return view('livewire.user.academic-create',['roles'=>$roles]);
    }

    public function resetForm()
    {

        $this->reset(['name','last_name', 'phone', 'email', 'image', 'UserName', 'password', 'image_name']);

    }
}
