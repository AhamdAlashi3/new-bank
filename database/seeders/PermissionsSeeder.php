<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Permission::create(['name'=>'Create-Customers','guard_name'=>'admin']);
        Permission::create(['name'=>'Read-Customers','guard_name'=>'admin']);
        Permission::create(['name'=>'Updata-Customers','guard_name'=>'admin']);
        Permission::create(['name'=>'Delete-Customers','guard_name'=>'admin']);

        Permission::create(['name'=>'Create-Car','guard_name'=>'admin']);
        Permission::create(['name'=>'Read-Car','guard_name'=>'admin']);
        Permission::create(['name'=>'Updata-Car','guard_name'=>'admin']);
        Permission::create(['name'=>'Delete-Car','guard_name'=>'admin']);

        Permission::create(['name'=>'Create-Merchants','guard_name'=>'admin']);
        Permission::create(['name'=>'Read-Merchants','guard_name'=>'admin']);
        Permission::create(['name'=>'Updata-Merchants','guard_name'=>'admin']);
        Permission::create(['name'=>'Delete-Merchants','guard_name'=>'admin']);

    }
}
