<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Documento extends Model
{

  use SoftDeletes;

  protected $table = 'documentos';

  protected $dates = ['deleted_at'];

   protected $fillable = [
       'user_id', 'proyecto_id', 'nombre_archivo', 'peso_archivo','nombre_nube', 'etapa','tipo',
   ];

   protected $visible = [
       'id', 'user_id', 'proyecto_id', 'nombre_archivo', 'peso_archivo', 'nombre_nube', 'etapa','tipo', 'created_at',
   ];

   public function proyecto(){
       return $this->belongsTo(Proyecto::class);
   }

}
