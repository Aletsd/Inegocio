<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class DesarrolloProyecto extends Model
{

  protected $table = 'desarrollo_proyecto';


  protected $fillable = [
      'proyecto_id', 'desarrollo_id', 'estatus',
  ];

  protected $visible = [
      'id', 'proyecto_id', 'desarrollo_id', 'estatus',
  ];

  public function proyecto(){
      return $this->belongsTo(Proyecto::class, 'id', 'proyecto_id');
  }
  public function desarrollo(){
      return $this->belongsTo(Desarrollo::class);
  }



}
