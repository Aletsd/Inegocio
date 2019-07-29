<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GestionProyecto extends Model
{

  protected $table = 'gestion_proyecto';


  protected $fillable = [
      'proyecto_id', 'gestion_id', 'estatus',
  ];

  protected $visible = [
      'id', 'proyecto_id', 'gestion_id', 'estatus',
  ];

  public function proyecto(){
      return $this->belongsTo(Proyecto::class, 'id', 'proyecto_id');
  }
  public function gestion(){
      return $this->belongsTo(Gestion::class);
  }


}
