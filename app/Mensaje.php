<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class mensaje extends Model
{
  use SoftDeletes;

  protected $table = 'mensajes';

  protected $dates = ['deleted_at'];

   protected $fillable = [
       'proyecto_id', 'emisor_id', 'receptor_id','tipo','mensaje'
   ];

   protected $visible = [
       'id', 'proyecto_id', 'emisor_id', 'receptor_id','tipo','mensaje', 'created_at', 'mensajes'
   ];

   public function proyecto(){
       return $this->belongsTo(Proyecto::class);
   }
   public function emisor(){
       return $this->belongsTo(User::class, 'emisor_id', 'id');
   }
   public function receptor(){
       return $this->belongsTo(User::class, 'receptor_id', 'id');
   }
}
