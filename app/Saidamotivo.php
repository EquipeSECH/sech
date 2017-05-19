<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class saidamotivo extends Model
{
    public $fillable = ['quantidade', 'idusuario', 'idestoque', 'data', 'motivo'];

    public function estoque() {
        return $this->belongsTo(Estoque::class, 'idestoque');
    }

    public function usuario() {
        return $this->belongsTo(User::class, 'idusuario');
    }

}
