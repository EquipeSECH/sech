<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrescricaoMedicamento extends Model {

    public $fillable = ['idprescricao', 'idmedicamento', 'qtdpedida', 'qtdatendida', 'posologia', 'outros'];

    public function prescricao() {
        return $this->belongsTo(Prescricao::class, 'idprescricao');
    }
    
    public function medicamento() {
        return $this->belongsTo(Medicamento::class, 'idmedicamento');
    }
}
