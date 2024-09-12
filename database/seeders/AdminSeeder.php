<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'school_id'=> 1,
            'name' => 'mohammed',
            'last_name'=>'aljaoor',
            'father_name'=>'tawfeek',
            'email' => 'mohammed@gmail.com',
            'UserName' => 'aljaoor',
            'phone' => '+963932174371',
            'password' => bcrypt(123456),
            'role_id' => '6',

        ]);

        $role = Role::whereName('admin')->first();
        $admin->assignRole([$role->id]);

//        $admin2 = User::create([
//            'school_id'=> 2,
//            'name' => 'ss',
//            'last_name'=>'ss',
//            'father_name'=>'ss',
//            'email' => 'ss@ss.ss',
//            'UserName' => 'ss',
//            'phone' => '+9639321743712',
//            'password' => bcrypt(123456),
//            'role_id' => '6',
//
//        ]);
//
//        $role2 = Role::whereName('admin')->first();
//        $admin2->assignRole([$role2->id]);


        $user = User::create([
            'school_id'=> 1,
            'name' => 'mohammed1',
            'last_name'=>'aljaoor',
            'email' => 'mohammed1@gmail.com',
            'UserName' => 'aljaoor1',
            'phone' => '0932174371',
            'password' => bcrypt(123456),
            'role_id' => '4',

        ]);
        $role = Role::whereName('parent')->first();
        $user->assignRole([$role->id]);


        $user = User::create([
            'school_id'=> 1,
            'name' => 'mohammed2',
            'last_name'=>'aljaoor',
            'parent' => 2,
            'gender' => 1,
            'email' => 'mohammed2@gmail.com',
            'UserName' => 'aljaoor2',
            'phone' => '0932174371',
            'password' => bcrypt(123456),
            'role_id' => '1',

        ]);
        $role = Role::whereName('student')->first();
        $user->assignRole([$role->id]);


        $user = User::create([
            'school_id'=> 1,
            'name' => 'mohammed3',
            'last_name'=>'aljaoor',
            'gender' => 1,
            'teacher_section' => 'math',
            'email' => 'mohammed3@gmail.com',
            'UserName' => 'aljaoor3',
            'phone' => '0932174371',
            'password' => bcrypt(123456),
            'role_id' => '2',
        ]);
        $role = Role::whereName('teacher')->first();
        $user->assignRole([$role->id]);

        $user = User::create([
            'school_id' => 1,
            'name' => 'super admin',
            'last_name' => '1',
            'email' => 'super-admin@trkolej.com',
            'UserName' => 'super admin',
            'phone' => '0932174371',
            'password' => bcrypt(123456),
            'role_id' => '10',
        ]);
        $role = Role::whereName('super admin')->first();
        $user->assignRole([$role->id]);

    }
}
