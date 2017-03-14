<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Paciente;

class PacienteController extends Controller {

    public function index(Request $request) {
        $pacientes = Paciente::orderBy('id', 'DESC')->paginate(5);
        return view('paciente.index', compact('pacientes'))
                        ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'nomecompleto' => 'required',
            'sexo' => 'required',
            'nascimento' => 'required',
            'rg' => 'required',
            'cpf' => 'required',
            'cartaosus' => 'required',
        ]);       

        $campos = $request->all();
        
        Paciente::create($campos);

        $pacientes = Paciente::orderBy('id', 'DESC')->lists('nomecompleto', 'id');
        return redirect()->route('internacao.create', 'pacientes');
                        
    }

}
