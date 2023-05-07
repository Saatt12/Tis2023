<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestForm extends Model
{
    use HasFactory;
    protected $table = "request_forms";
    protected $fillable= ['user_id','parking_id'];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
