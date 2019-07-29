<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes_users';

    protected $fillable = [
        'user_id', 'cliente_id'
    ];

    protected $visible = [
        'id', 'user_id', 'cliente_id'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'cliente_id','id');
    }
}
