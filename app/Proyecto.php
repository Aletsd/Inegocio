<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proyecto extends Model
{

  use SoftDeletes;

  protected $table = 'proyectos';

  protected $dates = ['deleted_at'];

   protected $fillable = [
       'material_id', 'nombre', 'cliente','imagen','proyectoid', 'descripcion', 'estatus', 'porcentaje',
   ];

   protected $visible = [
       'id', 'material_id', 'nombre', 'cliente','imagen','proyectoid', 'descripcion', 'estatus', 'porcentaje', 'created_at'
   ];
   public function proyecto_user(){
     return $this->hasMany(ProyectoUser::class,'proyecto_id', 'id');
   }
  public function usuarios()
  {
      return $this->belongsToMany(User::class);
  }
  public function rol()
  {
      return $this->belongsToMany(Role::class);
  }
  public function mensajes()
  {
      return $this->hasMany(Mensaje::class);
  }
  public function documentos()
  {
      return $this->belongsToMany(Documento::class);
  }
  public function diseños()
  {
      return $this->belongsToMany(DisenoPropuesta::class);
  }
  public function operaciones()
  {
      return $this->belongsToMany(Operacion::class);
  }
  public function desarrollos()
  {
      return $this->belongsToMany(Desarrollo::class);
  }
  public function gestion()
  {
      return $this->belongsToMany(Gestion::class);
  }

}
