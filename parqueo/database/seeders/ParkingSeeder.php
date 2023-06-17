<?php

namespace Database\Seeders;

use App\Models\Cargo;
use App\Models\Parking;
use App\Models\Permission;
use App\Models\Rol;
use App\Models\Unidad;
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
        $data_rol = [
            ['nom_unidad'=>'Ing. Sistemas'],
        ];
        Unidad::insert($data_rol);
        $data_cargo = [
            ['nom_cargo'=>'Administrativo'],
        ];
        Cargo::insert($data_cargo);
        Permission::insert([
            ['name'=>"Ver cargo",'key'=>'ver_cargo','type'=>'cargo'],
            ['name'=>"Crear cargo",'key'=>'crear_cargo','type'=>'cargo'],
            ['name'=>"Editar cargo",'key'=>'editar_cargo','type'=>'cargo'],
            ['name'=>"Eliminar cargo",'key'=>'eliminar_cargo','type'=>'cargo'],

            ['name'=>"Ver unidad",'key'=>'ver_unidad','type'=>'unidad'],
            ['name'=>"Crear unidad",'key'=>'crear_unidad','type'=>'unidad'],
            ['name'=>"Editar unidad",'key'=>'editar_unidad','type'=>'unidad'],
            ['name'=>"Eliminar unidad",'key'=>'eliminar_unidad','type'=>'unidad'],

            ['name'=>"Ver rol",'key'=>'ver_rol','type'=>'rol'],
            ['name'=>"Crear rol",'key'=>'crear_rol','type'=>'rol'],
            ['name'=>"Editar rol",'key'=>'editar_rol','type'=>'rol'],
            ['name'=>"Eliminar rol",'key'=>'eliminar_rol','type'=>'rol'],

            ['name'=>"Ver clientes",'key'=>'ver_clientes','type'=>'cliente'],

            ['name'=>"Ver solicitudes parqueo",'key'=>'ver_solicitudes_parqueo','type'=>'solicitud'],
            ['name'=>"Asignar Parqueo",'key'=>'asignar_parqueo','type'=>'solicitud'],
            ['name'=>"Rechazar Parqueo",'key'=>'rechazar_parqueo','type'=>'solicitud'],

            ['name'=>"Ver empleado",'key'=>'ver_empleado','type'=>'empleado'],
            ['name'=>"Crear empleado",'key'=>'crear_empleado','type'=>'empleado'],
            ['name'=>"Editar empleado",'key'=>'editar_empleado','type'=>'empleado'],
            ['name'=>"Eliminar empleado",'key'=>'eliminar_empleado','type'=>'empleado'],

            ['name'=>"Ver horario",'key'=>'ver_horario','type'=>'horario'],
            ['name'=>"Crear horario",'key'=>'crear_horario','type'=>'horario'],
            ['name'=>"Editar horario",'key'=>'editar_horario','type'=>'horario'],
            ['name'=>"Eliminar horario",'key'=>'eliminar_horario','type'=>'horario'],

            ['name'=>"Ver Reclamo",'key'=>'ver_reclamo','type'=>'reclamo'],
            ['name'=>"Responder Reclamo Multiple",'key'=>'responder_reclamo_multiple','type'=>'reclamo'],
            ['name'=>"Eliminar Reclamo",'key'=>'eliminar_reclamo','type'=>'reclamo'],
            ['name'=>"Responder Reclamo Individual",'key'=>'responder_reclamo_individual','type'=>'reclamo'],

            ['name'=>"Ver Parqueo",'key'=>'ver_parqueo','type'=>'parqueo'],
            ['name'=>"Crear Convocatoria",'key'=>'crear_convocatoria','type'=>'parqueo'],
            ['name'=>"Ver Convocatoria",'key'=>'ver_convocatoria','type'=>'parqueo'],
            ['name'=>"Ver Vehiculos",'key'=>'ver_vehiculos','type'=>'parqueo'],
            ['name'=>"Asignar horario Vehiculos",'key'=>'horario_vehiculo','type'=>'parqueo'],

            ['name'=>"Ver reporte",'key'=>'ver_reporte','type'=>'reporte'],
            ['name'=>"Ver reporte usuario",'key'=>'ver_reporte_usuario','type'=>'reporte'],
            ['name'=>"Ver reporte pagos",'key'=>'ver_reporte_pagos','type'=>'reporte'],
            ['name'=>"Ver reporte convocatoria",'key'=>'ver_reporte_convocatoria','type'=>'reporte'],

            ['name'=>"Ver mensaje",'key'=>'ver_mensaje','type'=>'mensaje'],
            ['name'=>"Enviar mensaje Multiple",'key'=>'enviar_mensaje_multiple','type'=>'mensaje'],
            ['name'=>"Enviar mensaje Individual",'key'=>'enviar_mensaje_individual','type'=>'mensaje'],
            ['name'=>"Eliminar mensaje",'key'=>'eliminar_mensaje','type'=>'mensaje'],
        ]);
    }
}
