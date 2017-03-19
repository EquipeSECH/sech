<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Farmacia extends Model
{
    public $fillable = ['idClinica', 'nome', 'codigo', 'central'];
    
      public function clinica() {
        return $this->belongsTo(Clinica::class, 'idclinica');
    }
}
