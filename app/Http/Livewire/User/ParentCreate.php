<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

class ParentCreate extends Component
{
    use WithFileUploads;


    public $role_id,$roles_selected;
    public $scrollToTop = false;


    public $name,$last_name, $phone, $email, $image, $UserName, $password, $image_name;

    public function mount()
    {

        $this->role_id = 4;
        $role = Role::whereName('parent')->first();
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

        $this->emitTo('user.create', '$refresh');
        $this->resetForm();
        session()->flash('message', __('alert.alert_saved'));

    }
    public function render()
    {
        $roles = Role::whereIn('name', ['parent','editor'])->get(['name', 'id']);
        return view('livewire.user.parent-create',['roles'=>$roles]);
    }

    public function resetForm()
    {

        $this->reset(['name','last_name', 'phone', 'email', 'image', 'UserName', 'password', 'image_name']);

    }

}
