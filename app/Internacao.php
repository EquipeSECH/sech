<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Internacao extends Model {

    public $fillable = ['idpaciente', 'idclinica', 'idleito', 'idci10', 'dataadmissao'];

    public function paciente() {

        return $this->belongsTo(Paciente::class, 'idpaciente');
    }

    public function leito() {
        return $this->belongsTo(Leito::class, 'idleito');
    }
    
    public function cid10() {
        return $this->belongsTo(Cid10::class, 'idcid10');
    }

}
