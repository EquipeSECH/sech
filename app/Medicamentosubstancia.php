<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicamentosubstancia extends Model {

    public $fillable = ['idmedicamento', 'idsubstanciaativa', 'quantidadedose', 'unidadedose'];

    public function medicamento() {
        return $this->belongsTo(Medicamento::class, 'idmedicamento');
    }
    
    public function substanciaativa() {
        return $this->belongsTo(Substanciaativa::class, 'idsubstanciaativa');
    }

}
