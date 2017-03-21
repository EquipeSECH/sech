<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    public $fillable = ['idformafarmaceutica', 'nomeconteudo', 'quantidadeconteudo', 
                        'unidadeconteudo', 'codigosimpas', 'nomecomercial'];
}
