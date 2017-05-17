<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrescricaoMedicamento extends Model {

        public $fillable = ['idprescricao', 'idmedicamento', 'qtdpedida', 'qtdatendida', 'posologia', 'outros'];

}
