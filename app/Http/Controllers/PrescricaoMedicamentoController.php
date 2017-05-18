<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PrescricaoMedicamento;

class PrescricaoMedicamentoController extends Controller {

    public function update(Request $request) {
        // dd($request->all()) and die();

        $medicamento = PrescricaoMedicamento::find($request->id);
        $medicamento->qtdatendida = $request->qtdatentida;
        $medicamento->save();

        return response()->json($medicamento);
    }

}
