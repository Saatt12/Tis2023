<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','cargo_id','unidad_id','celular','ci','rol_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function cargo()
    {
        return $this->belongsTo('App\Models\Cargo');
    }
    public function rol()
    {
        return $this->belongsTo('App\Models\Rol');
    }
    public function hasRole($role)
    {
        return User::where('id',$this->id)->where('rol_id', $role)->first();
    }
    public function hasRoleName($role)
    {
        $user = User::where('id',$this->id)->first();
        return Rol::where('id',$user->rol_id)->where('nom_role', $role)->first();
    }
}
