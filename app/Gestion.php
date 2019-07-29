<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gestion extends Model
{

  use SoftDeletes;

  protected $table = 'gestion_empresa';

  protected $dates = ['deleted_at'];

  protected $fillable = [
      'nombre', 'descripcion', 'avance',
  ];

  protected $visible = [
      'id', 'nombre', 'descripcion', 'avance',
  ];

  public function proyectos()
  {
      return $this->belongsToMany(Proyecto::class);
  }

  public function comun()
  {
      return $this->belongsTo(GestionProyecto::class, 'id', 'gestion_id');
  }


}
