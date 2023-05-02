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
        "image"
    ];
}
