<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Artisan;

class PassportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Artisan::call('passport:install');
    }
}
