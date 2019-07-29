<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OperacionProyecto extends Model
{

  protected $table = 'operacion_proyecto';


  protected $fillable = [
      'proyecto_id', 'operacion_id', 'estatus',
  ];

  protected $visible = [
      'id', 'proyecto_id', 'operacion_id', 'estatus',
  ];

  public function proyecto(){
      return $this->belongsTo(Proyecto::class, 'id', 'proyecto_id');
  }
  public function operacion(){
      return $this->belongsTo(Desarrollo::class);
  }

}
