<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    public $fillable = ['nomecompleto', 'sexo', 'nascimento', 'rg', 'cpf', 'cartaosus'];
}
