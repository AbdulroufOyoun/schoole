<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(1000)->create();
        $this->call(SchoolSeeder::class);
        $this->call(PassportSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(YearSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(ClassroomSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(WeekSeeder::class);
        $this->call(TermsSeeder::class);

    }
}
