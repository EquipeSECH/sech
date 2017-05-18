<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model {

    public $fillable = ['lote', 'quantidadeatual', 'quantidadereserva', 'fabricacao', 'validade', 'status',
        'idmedicamentocomercial', 'idfornecedor', 'idfarmacia'];
    
    public function medicamentocomercial() {
        return $this->belongsTo(Medicamento::class, 'idmedicamentocomercial');
    }
//    public function medicamentosubstancias() {
//        return $this->hasMany(Medicamentosubstancia::class, 'idmedicamento');
//    }
//     public function formafarmaceuticas() {
//        return $this->belongsTo(Formafarmaceutica::class, 'idformafarmaceutica');
//    }
    
    public function fornecedor() {
        return $this->belongsTo(Fornecedor::class, 'idfornecedor');
    }

    public function farmacia() {
        return $this->belongsTo(Farmacia::class, 'idfarmacia');
    }

}
