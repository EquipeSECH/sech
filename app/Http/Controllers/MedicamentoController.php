<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Medicamento;
use App\Formafarmaceutica;
use App\Substanciaativa;

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
  
        $formafarmaceuticas = Formafarmaceutica::lists('nome', 'id'); 
        $substanciaativas = Substanciaativa::lists('nome', 'id');
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
        $this->validate($request, [
            'idformafarmaceutica' => 'required',
            'codigosimpas' => 'required',  
        ]);
		$input = $request->all();
		
		$medicamentos = Medicamento::create($input);
		
//		$medicamentos->attach($request->input('idsubstanciaativa'));;;


        return redirect()->route('medicamento.index')
                        ->with('success', 'Medicamento cadastrado com sucesso!');
    
       
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
        $medicamentos = Medicamento::find($id);        
        $formafarmaceuticas = Formafarmaceutica::lists('nome', 'id'); 
        $substanciaativas = Substanciaativa::lists('nome', 'id');
        $medicamentosubstancias = $medicamentos->substanciaativas->lists('id', 'id')->toArray();

        return view('medicamento.edit',compact('medicamentos', 'formafarmaceuticas', 'substanciaativas', 'medicamentosubstancias'));
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
        
        $this->validate($request, [
            'idformafarmaceutica' => 'required',
            'codigosimpas' => 'required',  
        ]);
		$input = $request->all();
		$medicamentos = Medicamento::find($id);
        $medicamentos->update($input);
        DB::table('medicamentosubstancias')->where('idmedicamento', $id)->delete();

//
//        $Medicamento->attach($request->input('idsubstanciaativa'));


        return redirect()->route('medicamento.index')
                        ->with('success', 'Medicamento atualizado com sucesso!');
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