<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saida extends Model {

    public $fillable = ['quantidade', 'idusuario', 'idestoque', 'data', 'idprescricao'];

    public function estoque() {
        return $this->belongsTo(Estoque::class, 'idestoque');
    }

    public function usuario() {
        return $this->belongsTo(User::class, 'idusuario');
    }

    public function prescricao() {
        return $this->belongsTo(Prescricao::class, 'idprescricao');
    }

}
