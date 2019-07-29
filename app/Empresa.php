<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    public function usuarios()
    {
        return $this->hasMany(User::class,  'id', 'empresa_id');
    }
}
