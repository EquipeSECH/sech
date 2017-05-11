<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Prescricao;

class PrescricaoController extends Controller
{
    public function index(Request $request)
    {
        $prescricoes = Prescricao::orderBy('id','DESC')->get();
        return view('prescricao.index',compact('prescricoes'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    public function create()
    {
        return view('prescricao.create');
    }
    
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'nome' => 'required',
            'descricao' => 'required',
        ]);
        
       
        
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
        
//        return redirect()->route('clinica.index')
//                        ->with('success','Clínica atualizada com sucesso!');
    }
    
    public function destroy($id)
    {
        Clinica::find($id)->delete();
        return redirect()->route('clinica.index')
                        ->with('success','Clínica excluída com sucesso!');
    }
}
