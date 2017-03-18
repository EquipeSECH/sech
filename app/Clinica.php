<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clinica extends Model
{
    public $fillable = ['nome', 'descricao'];
    
    public function leitos() {
        return $this->hasMany(Leito::class, 'idclinica');
    }
}
