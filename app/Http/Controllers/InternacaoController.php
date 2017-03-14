<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Internacao;
use App\Paciente; 
use App\Clinica;
use App\Cid10;

class InternacaoController extends Controller {

    public function index(Request $request) {
        $internacoes = Internacao::orderBy('id', 'DESC')->paginate(5);
        return view('internacao.index', compact('internacoes'))
                        ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create() {
        
        $pacientes = Paciente::orderBy('id', 'DESC')->lists('nomecompleto', 'id');  
        $clinicas = Clinica::lists('nome', 'id');
        $cid10s = Cid10::lists('descricao', 'id');
        return view('internacao.create', compact('pacientes', 'clinicas', 'cid10s'));
    }

    public function store(Request $request) {
        $this->validate($request, [
            'idpaciente' => 'required',
            'idclinica' => 'required',
            'idleito' => 'required',
            'idcid10' => 'required',
        ]);

        $campos = $request->all();
        
        Internacao::create($campos);

        return redirect()->route('internacao.index')
                        ->with('success', 'Paciente internado com sucesso!');
    }

    public function edit($id) {
        $cid = Cid10::find($id);
        return view('cid.edit', compact('cid'));
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'codigo' => 'required',
            'descricao' => 'required',
        ]);

        Cid10::find($id)->update($request->all());

        return redirect()->route('cid10.index')
                        ->with('success', 'Cid10 atualizado com sucesso!');
    }

    public function destroy($id) {
        Cid10::find($id)->delete();
        return redirect()->route('cid10.index')
                        ->with('success', 'Cid10 excluído com sucesso!');
    }

    public function show($id) {
        $cid = Cid10::find($id);
        return view('cid10.show', compact('cid'));
    }

}
