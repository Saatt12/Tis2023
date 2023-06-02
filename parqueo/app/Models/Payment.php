<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        "type",
        "number",
        "plan",
        "amount",
        "count",
        "is_active",
        "user_id",
        "comprobante"
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id', 'id');
    }
}
