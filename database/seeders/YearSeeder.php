<?php

namespace Database\Seeders;

use App\Models\Year;
use Illuminate\Database\Seeder;

class YearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Year::create([
            "school_id" => 1,
            'name' => '2023-2024',
            'end_date' => '2024-5-12',
            'activated' => true,
        ]);
    }
}
