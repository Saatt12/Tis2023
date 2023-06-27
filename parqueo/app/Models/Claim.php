<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    use HasFactory;
    protected $table = "claims";
    protected $fillable= ['client_id'];
    public function user()
    {
        return $this->belongsTo('App\Models\User','client_id', 'id');
    }
}
