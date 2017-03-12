<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interacaomedicamentosa extends Model
{
    public $fillable = ['idsubstanciaativa1', 'idsubstanciaativa2', 'gravidade','consequencia'];
    
    public function substanciaativa1() {
        return $this->belongsTo(Substanciaativa::class, 'idsubstanciaativa1');
    }
    public function substanciaativa2() {
        return $this->belongsTo(Substanciaativa::class, 'idsubstanciaativa2');
    }
}
