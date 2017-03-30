<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Leito;
use App\Clinica;
use DB;

class LeitoController extends Controller {

    public function index(Request $request) {
        $leitos = Leito::orderBy('id', 'DESC')->paginate(5);
        return view('leito.index', compact('leitos'))
                        ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create($id) {
        
        $clinica = Clinica::select('nome', 'id', 'descricao')->where('clinicas.id', '=', $id)->get();
       // dd($clinica[0]);
        return view('leito.create', compact('clinica'));
    }

    public function store(Request $request, $id) {
        
        $leitos = $request->all();
        for($i=0; $i<sizeof($leitos['leitos']); $i++){
            $novoLeito = new Leito();
            $novoLeito->leito = $leitos['leitos'][$i]['leito'];
            $novoLeito->observacao = $leitos['leitos'][$i]['obs'];
            $novoLeito->idclinica = $id;
            $novoLeito->save();
        }
//        return redirect()->route('clinica.index')
//                        ->with('success','Leito cadastrado com sucesso!');
    }

    public function edit($id) {
        $leito = Leito::find($id);
        $clinicas = Clinica::lists('nome', 'id');
        return view('leito.edit', compact('leito', 'clinicas'));
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'leito' => 'required',
            'observacao' => 'required',
            'idclinica' => 'required'
        ]);
        $leito = Leito::find($id)->update($request->all());


        return redirect()->route('clinica.edit')
                        ->with('success', 'Leito atualizado com sucesso!');
    }

    public function destroy(Request $request, $id) {
        $leito = Leito::find($id);
        $campos = $request->all();
        Leito::find($id)->delete();

        if ($campos['flag'] == "cadastrar") {
            return redirect()->route('leito.create', $leito->clinica->id)
                            ->with('success', 'Leito excluído com sucesso!');
        } else if ($campos['flag'] == "editar"){
            return redirect()->route('clinica.edit', $leito->clinica->id)
                            ->with('success', 'Leito excluído com sucesso!');
        }else{
            return redirect()->route('leito.index')
                            ->with('success', 'Leito cadastrado com sucesso!');
        }
    }

    public function show($id) {
        $leito = Leito::find($id);
        return view('leito.show', compact('leito'));
    }

}
