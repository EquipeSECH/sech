<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Clinica;
use App\Leito;

class ClinicaController extends Controller
{
    public function index(Request $request)
    {
        $clinicas = Clinica::orderBy('id','DESC')->get();
        $leitos = Leito::orderBy('id','DESC')->get();
        return view('clinica.index',compact('clinicas', 'leitos'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    public function create()
    {
        return view('clinica.create');
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'nome' => 'required',
            'descricao' => 'required',
        ]);
        
        //clinica
        $clinica = new Clinica();
        $clinica->nome = $request->get('nome');
        $clinica->descricao = $request->get('descricao');
        $clinica->save();
        $fk_clinica = $clinica->id;
        //leitos
        $leitos = $request->get('leitos');
        for($i=0; $i<sizeof($leitos); $i++){
            $novoLeito = new Leito();
            $novoLeito->leito = $leitos[$i]['leito'];
            $novoLeito->observacao = $leitos[$i]['obs'];
            $novoLeito->idclinica = $fk_clinica;
            $novoLeito->save();
        }       
        
//        return redirect()->route('clinica.index')
//                        ->with('success','Clínica cadastrada com sucesso!');
    }
    
    public function edit($id)
    {
        $clinica = Clinica::find($id);
        $leitos = Leito::where('idclinica', '=', $id)->get();
        $qtdleitos = count($clinica->leitos);
        return view('clinica.edit',compact('clinica', 'leitos', 'qtdleitos'));
    }
    
    public function update(Request $request, $id)
    {
       //dd($request->all()) and die();
        $this->validate($request, [
            'nome' => 'required',
            'descricao' => 'required',
        ]);
        
        //atualizando a clínica
        $clinica = Clinica::find($id);
        $clinica->nome = $request->get('nome');
        $clinica->descricao = $request->get('descricao');
        $clinica->save();
        
        //atualizando os leitos
        Leito::where('idclinica', '=', $id)->delete();
        $leitos = $request->get('leitos');
        for($i=0; $i<sizeof($leitos); $i++){
            $leito = new Leito();
            $leito->leito = $leitos[$i]['leito'];
            $leito->observacao = $leitos[$i]['observacao'];
            $leito->idclinica = $id;
            $leito->save();
        }
//        return redirect()->route('clinica.index')
//                        ->with('success','Clínica atualizada com sucesso!');
    }
    
    public function destroy($id)
    {
        Clinica::find($id)->delete();
        return redirect()->route('clinica.index')
                        ->with('success','Clínica excluída com sucesso!');
    }
    
    public function show($id)
    {
        $clinica = Clinica::find($id);
        return view('clinica.show',compact('clinica'));
    }
}
