<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescricao extends Model {
    
    public $fillable = ['idusuario', 'idinternacao', 'dataprescricao', 'dataaprovacao', 'historicoatual', 'evolucao', 'observacoesmedicas', 'status'];

}
