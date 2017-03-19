<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedidotransferencia extends Model
{
     public $fillable = ['motivotransferencia', 'datapedido', 'dataaprovacao', 'idusuariofarmaceutico', 'idmedicamento', 
         'farmaciadestino', 'idusuarioenfermeiro'];
    
     public function usuarioFarmaceutico() {
        return $this->belongsTo(User::class, 'idusuariofarmaceutico');
    }
      public function usuarioEnfermeiro() {
        return $this->belongsTo(User::class, 'idusuarioenfermeiro');
    }
       public function farmacia() {
        return $this->belongsTo(Farmacia::class, 'farmaciadestino');
    }
          public function medicamento() {
        return $this->belongsTo(Medicamento::class, 'idmedicamento');
    }
}
