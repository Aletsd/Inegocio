<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DisenoPropuesta extends Model
{

  use SoftDeletes;

  protected $table = 'diseno_propuestas';

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
      return $this->belongsTo(DisenoPropuestaProyecto::class, 'id', 'diseno_propuesta_id');
  }

}
