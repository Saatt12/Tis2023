<?php

namespace Database\Seeders;

use App\Models\Cargo;
use App\Models\Parking;
use App\Models\Rol;
use Illuminate\Database\Seeder;

class ParkingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Parking::factory()->count(100)->create();
        $data_rol = [
            ['nom_role'=>'ADMINISTRADOR'],
            ['nom_role'=>'CLIENTE'],
            ['nom_role'=>'OPERADOR'],
            ['nom_role'=>'GUARDIA'],
        ];
        Rol::insert($data_rol);
        $data_cargo = [
            ['nom_cargo'=>'Administrativo'],
        ];
        Cargo::insert($data_cargo);
    }
}
