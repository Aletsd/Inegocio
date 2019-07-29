<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'nombres', 'email', 'password', 'empresa', 'rol_id', 'img_perfil', 'apellidos', 'celular', 'status',
    ];

    protected $visible = [
        'id', 'nombres', 'email', 'password', 'empresa', 'rol_id', 'img_perfil', 'apellidos', 'celular', 'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function clientes()
    {
        return $this->hasMany(Cliente::class, 'user_id', 'id');
    }

    public function proyectos()
    {
        return $this->belongsToMany(Proyecto::class);
    }
    public function rol()
    {
        return $this->belongsTo(Role::class, 'rol_id', 'id');
    }

    public function publicaciones(){
        return $this->hasMany(BlogPost::class,'user_id','id');
    }

    public function permisos()
    {
        return $this->hasOne(Permit::class,'user_id','id');
    }

}
