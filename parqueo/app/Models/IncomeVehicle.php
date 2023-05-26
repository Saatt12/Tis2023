<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeVehicle extends Model
{
    use HasFactory;
    protected $fillable =[
        'hora_entrada',
        'hora_salida',
        'vehicle_id',
        'user_id',
    ];
}
