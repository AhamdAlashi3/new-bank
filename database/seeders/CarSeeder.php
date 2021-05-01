<?php

namespace Database\Seeders;

use App\Models\car;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        car::factory(20)->create();
    }
}