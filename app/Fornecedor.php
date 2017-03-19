<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
   public $fillable = ['cnpj', 'razaosocial', 'nomefantasia', 'endereco','telefone', 'email', 'nomeresponsavel', 'telefoneresponsavel'];
}
