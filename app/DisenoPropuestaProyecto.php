<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class DisenoPropuestaProyecto extends Model
{



  protected $table = 'diseno_propuesta_proyecto';



  protected $fillable = [
      'proyecto_id', 'diseno_propuesta_id', 'estatus',
  ];

  protected $visible = [
      'id', 'proyecto_id', 'diseno_propuesta_id', 'estatus',
  ];

  public function proyecto(){
      return $this->belongsTo(Proyecto::class, 'id', 'proyecto_id');
  }
  public function diseño(){
      return $this->belongsTo(DisenoPropuesta::class, 'diseno_propuesta_id', 'id');
  }



}
