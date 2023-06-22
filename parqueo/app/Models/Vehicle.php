<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $table = "vehicles";
    protected $fillable = [
        "user_id",
        "placa",
        "marca",
        "modelo",
        "plan_pago",
        "image",
        'hour_vehicle_id'
    ];
    public function hour_vehicle()
    {
        return $this->belongsTo('App\Models\IncomeVehicle','hour_vehicle_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id', 'id');
    }
}
