<?php

namespace Database\Seeders;

use App\Models\customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        customer::factory(20)->create();
    }
}