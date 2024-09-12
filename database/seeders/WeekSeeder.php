<?php

namespace Database\Seeders;

use App\Models\Week;
use App\Models\Year;
use Illuminate\Database\Seeder;

class WeekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $active_year = Year::whereActivated(true)->first()->id;
        Week::create([
            'year_id'=>$active_year,
            'school_id'=>1,
            'start_at'=>'2023-06-19 02:14:00',
            'end_at'=>'2023-06-23 02:14:00',
            'start_upload_plans'=>'2023-06-21 03:14:00',
            'end_upload_plans'=>'2023-06-22 01:14:00',
        ]);
    }
}
