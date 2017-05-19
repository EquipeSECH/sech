<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescricao extends Model {
    
    public $fillable = ['idusuario', 'idinternacao', 'dataprescricao', 'dataaprovacao', 'historicoatual', 'evolucao', 'observacoesmedicas', 'status'];

        
    public function internacao() {

        return $this->belongsTo(Internacao::class, 'idinternacao');
    }
    
    public function usuario(){
        return $this->belongsTo(User::class, 'idusuario');
    }
    
    public function medicamentos(){
        return $this->hasMany(PrescricaoMedicamento::class, 'idprescricao', 'idmedicamento');
    }
}
