<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Medicamento;
use App\Formafarmaceutica;
use App\Substanciaativa;
use App\Medicamentosubstancia;

class MedicamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $medicamentos = Medicamento::orderBy('id','desc')->paginate(15);
        return view('medicamento.index', compact('medicamentos'))
            ->with('i', ($request->input('page', 1) - 1) * 15);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $formafarmaceuticas = Formafarmaceutica::get();
        $substanciaativas = Substanciaativa::get();
        return view('medicamento.create', compact('formafarmaceuticas', 'substanciaativas'));
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
//        $this->validate($request, [
//            'idformafarmaceutica' => 'required',
//            'codigosimpas' => 'required',  
//        ]);
        
        //medicamento
        $medicamento = new Medicamento();
        $medicamento->idformafarmaceutica = $request->get('formafarmaceutica'); 
        $medicamento->nomeconteudo = $request->get('conteudo'); 
        $medicamento->quantidadeconteudo = $request->get('quantidade'); 
        $medicamento->unidadeconteudo = $request->get('unidade'); 
        $medicamento->codigosimpas = $request->get('simpas'); 
        $medicamento->nomecomercial = $request->get('nomecomercial'); 
        
        $medicamento->save();
        $fk_medicamento = $medicamento->id;
        //substancias
        $substancias = $request->get('substancias');
        for($i=0; $i<sizeof($substancias); $i++){
            $medicamentoSubstancia = new Medicamentosubstancia();
            $medicamentoSubstancia->idsubstanciaativa = $substancias[$i]['substancia'];
            $medicamentoSubstancia->quantidadedose = $substancias[$i]['quantidadedose'];
            $medicamentoSubstancia->unidadedose = $substancias[$i]['unidadedose'];
            $medicamentoSubstancia->idmedicamento = $fk_medicamento;
            $medicamentoSubstancia->save();
            echo "salvou";
        }          
               
//        return redirect()->route('medicamento.index')
//                        ->with('success','Medicamento cadastrado com sucesso!');
    }
	
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $medicamentos = Medicamento::find($id);
        $formafarmaceuticas = Formafarmaceutica::lists('nome', 'id'); 
        return view('medicamento.show',compact('medicamentos', 'formafarmaceuticas'));
    }
	

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $medicamento = Medicamento::find($id);        
        $medicamentosubstancias = Medicamentosubstancia::where('idmedicamento', '=', $id)->get();
        $formafarmaceuticas = Formafarmaceutica::get(); 
        $substanciaativas = Substanciaativa::get();

        return view('medicamento.edit',compact('medicamento',  'medicamentosubstancias', 'formafarmaceuticas', 'substanciaativas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {    
        $medicamento = Medicamento::find($id);
        $medicamento->idformafarmaceutica = $request->get('formafarmaceutica'); 
        $medicamento->nomeconteudo = $request->get('conteudo'); 
        $medicamento->quantidadeconteudo = $request->get('quantidade'); 
        $medicamento->unidadeconteudo = $request->get('unidade'); 
        $medicamento->codigosimpas = $request->get('simpas'); 
        $medicamento->nomecomercial = $request->get('nomecomercial'); 
        
        $medicamento->save();
        $fk_medicamento = $medicamento->id;
        //substancias
        $substancias = $request->get('substancias');
        for($i=0; $i<sizeof($substancias); $i++){
            $medicamentoSubstancia = new Medicamentosubstancia();
            $medicamentoSubstancia->idsubstanciaativa = $substancias[$i]['substancia'];
            $medicamentoSubstancia->quantidadedose = $substancias[$i]['quantidadedose'];
            $medicamentoSubstancia->unidadedose = $substancias[$i]['unidadedose'];
            $medicamentoSubstancia->idmedicamento = $id;
            $medicamentoSubstancia->save();
            echo "atualizou";
        }          
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        Medicamento::find($id)->delete();
        return redirect()->route('medicamento.index')
                        ->with('success','Medicamento excluído com sucesso!');
        
    }
}