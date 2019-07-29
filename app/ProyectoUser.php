<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProyectoUser extends Model
{

  protected $table = 'proyecto_user';

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

}
