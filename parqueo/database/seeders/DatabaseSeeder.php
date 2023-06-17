<?php

namespace Database\Seeders;

use App\Models\Parking;
use App\Models\Permission;
use App\Models\RolePermission;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        $this->call(ParkingSeeder::class);
        //user admin
        $user_admin = [
            "name"=>"Admin",
            "email"=>"admin@gmail.com",
            "password"=>'$2y$10$EJ10FGgkE344xmGJu3aqbuVC1nxA0W9726aeH/fYuyI2Iwoj17vtq',
            "rol_id"=>1
        ];
        $admin = User::create($user_admin);
        $permissions = Permission::get();
        $data_admin_permission = [];
        foreach ($permissions as $permission) {
            array_push($data_admin_permission,['rol_id'=>1,'permission_id'=>$permission->id]);
        }
        RolePermission::insert($data_admin_permission);
    }
}
