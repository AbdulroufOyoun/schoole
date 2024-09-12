<?php

namespace Database\Seeders;

use App\Models\Section;
use App\Models\Student;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <5 ; $i++) {
            for ($j=1; $j <3 ; $j++) {
                Section::create([
                    'name' => "Section ".$j,
                    'classroom_id' => $i,
                    'school_id'=>1,
                ]);
            }
        }

        Student::create([
            'school_id' => 1,
            'user_id' => 3,
            'classroom_id' => 1,
            'section_id' =>1,
            'year_id'=>1
        ]);
    }
}
