<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        School::create([
            'name'=>"Berneshti",
            'logo'=>'/admin_panel/assets/images/berneshti.png',
            "welcome_screen"=>'Welcome to the Berneshti School',
        ]);

//        School::create([
//            'name'=>"Second",
//            'logo'=>'/admin_panel/assets/images/berneshti.png',
//            "welcome_screen"=>'Welcome to the Second School',
//        ]);
    }
}
