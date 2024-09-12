<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [

            'settings management',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'create-accounts',
            'create admins acounts',
            'delete post',
            'procesing posts',
            'edit post',
            'delete comment',
            'Classroom management',
            'subjects management',
            'advance student',
            'social media management',
            'calendar management',
            'plans management',
            'messages',
            'admins messages',
            'payment management',
            'marks management',


        ];



        foreach ($permissions as $permission) {

            Permission::create(['name' => $permission]);

        }
    }
}
