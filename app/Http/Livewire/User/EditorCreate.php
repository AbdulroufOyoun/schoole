<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

class EditorCreate extends Component
{

    use WithFileUploads;

    public $role_id,$roles_selected;


    public  $phone,$name,$last_name, $email, $gender, $UserName, $password;

    public function mount()
    {

        $this->role_id = 3;
        $role = Role::whereName('editor')->first();
        $this->roles_selected = $role->id;


    }


    public function render()
    {
        $roles = Role::where('name', 'editor')->get(['name', 'id']);
        return view('livewire.user.editor-create',['roles'=>$roles]);
    }



    public function submit()
    {

        $data = $this->validate([

            'UserName' => 'required|string|unique:users,UserName',
            'password' => 'required|string|min:6',
            'email' => 'required|email|unique:users,email',
            'name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|string',
            'gender' => 'required|integer',
            'role_id' => 'required|integer',

        ]);

        $data['password'] = Hash::make($data['password']);
        $data['school_id'] = auth()->user()->school_id;
        $item = User::create($data);

        $item->assignRole($this->roles_selected);

        $this->resetForm();
        session()->flash('message', __('alert.alert_saved'));


    }


    public  function resetForm(){

        $this->reset(['phone','last_name','email','gender','UserName','password','name']);

    }



}
