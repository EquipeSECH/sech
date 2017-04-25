<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    public $fillable = ['idformafarmaceutica', 'nomeconteudo', 'quantidadeconteudo', 
                        'unidadeconteudo', 'codigosimpas', 'nomecomercial'];
    
    public function medicamentosubstancias() {
        return $this->hasMany(Medicamentosubstancia::class, 'idmedicamento');
    }
     public function formafarmaceuticas() {
        return $this->belongsTo(Formafarmaceutica::class, 'idformafarmaceutica');
    }
}
