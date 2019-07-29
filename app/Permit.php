<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permit extends Model
{
  protected $table = 'permits';


   protected $fillable = [
       'proyecto_id', 'user_id', 'diseño', 'desarrollo','operacion','gestion',
   ];

   protected $visible = [
       'id', 'proyecto_id', 'user_id', 'diseño', 'desarrollo','operacion','gestion',
   ];

   public function proyecto()
   {
       return $this->belongsTo(Proyecto::class);
   }

   public function user()
   {
       return $this->belongsTo(User::class);
   }
}
