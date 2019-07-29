<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model
{
    use SoftDeletes;

    protected $table = 'materiales';

    protected $dates = ['deleted_at'];

     protected $fillable = [
         'usuario_id', 'nombre_archivo', 'descripcion'
     ];

     protected $visible = [
         'id', 'usuario_id', 'nombre_archivo', 'descripcion'
     ];
}
