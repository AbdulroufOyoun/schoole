<?php

namespace Database\Seeders;

use App\Models\Semester;
use App\Models\Term;
use Illuminate\Database\Seeder;

class TermsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Semester::create([
            'school_id'=>1,
            'year_id'=>1,
            'name'=>'Semester 1',
            'end_at'=>'2023-12-20',
        ]);

        Term::create([
            'school_id'=>1,
            'year_id'=>1,
            'semester_id'=>1,
            'name'=>'Term 1',
            'end_at'=>'2023-10-20',
        ]);
    }
}
