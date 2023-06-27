<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha_inicio',
        'fecha_fin',
        'descuento',
        'multa',
        'monto_mes',
        'monto_multa',
        'monto_descuento',
        'monto_anual',
        'cantidad_espacios',
        'image',
        'file_announcement'
    ];
}
