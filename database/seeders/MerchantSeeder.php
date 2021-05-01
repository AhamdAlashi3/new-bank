<?php

namespace Database\Seeders;

use App\Models\merchant;
use Illuminate\Database\Seeder;

class MerchantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        merchant::factory(20)->create();
    }
}
