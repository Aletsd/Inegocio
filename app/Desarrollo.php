<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Desarrollo extends Model
{

  use SoftDeletes;

  protected $table = 'desarrollos';

  protected $dates = ['deleted_at'];

   protected $fillable = [
       'nombre', 'descripcion','avance',
   ];

   protected $visible = [
       'id', 'nombre', 'descripcion','avance',
   ];

   public function proyectos()
   {
       return $this->belongsToMany(Proyecto::class);
   }

   public function comun()
   {
       return $this->belongsTo(DesarrolloProyecto::class, 'id', 'desarrollo_id');
   }

}
