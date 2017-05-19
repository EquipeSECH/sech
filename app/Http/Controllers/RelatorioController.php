<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use App\Prescricao;

/**
 * Description of RelatorioController
 *
 * @author Lucas
 */
class RelatorioController extends Controller {
    
    
    public function prescricao($id){
        
        $prescricao = Prescricao::find($id);
        //dd($prescricao);
        //dd($usuarios);
        $pdf = \PDF::loadView('relatorios.prescricao', ['prescricao' => $prescricao])->setPaper('a4', 'landscape');
        
        return $pdf->stream();
        
    }
}
