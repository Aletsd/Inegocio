<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

  public function usuarios()
  {
      return $this->hasMany(User::class,  'id', 'rol_id');
  }

  public function proyectos()
  {
      return $this->belongsToMany(Proyecto::class);
  }
}
