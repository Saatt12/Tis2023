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
        "comprobante",
        "status",
        "announcement_id"
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id', 'id');
    }
    public function announcement()
    {
        return $this->belongsTo('App\Models\Announcement','announcement_id', 'id');
    }
}
