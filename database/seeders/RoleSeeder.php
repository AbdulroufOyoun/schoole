<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'admin']);
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        Role::create(['name' => 'student']);
        Role::create(['name' => 'teacher']);
        Role::create(['name' => 'editor']);
        Role::create(['name' => 'academic']);
        Role::create(['name' => 'parent']);
        Role::create(['name' => 'accountant']);

        $role = Role::create(['name' => 'super admin']);
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);


    }
}
