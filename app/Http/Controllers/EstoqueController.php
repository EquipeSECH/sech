<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Estoque;
use App\Medicamento;
use App\Fornecedor;
use App\Formafarmaceutica;
use App\Entrada;
use App\Saidamotivo;
use Auth;

class EstoqueController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $entradas = Entrada::get();
        $saidamotivos = Saidamotivo::get();
        $estoques = Estoque::orderBy('id', 'desc')->paginate(15);
        return view('estoque.index', compact('estoques', 'entradas', 'saidamotivos'))
                        ->with('i', ($request->input('page', 1) - 1) * 15);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {        
        $fornecedors = Fornecedor::orderBy('id', 'DESC')->lists('razaosocial', 'id');
        $medicamentos = Medicamento::get();  
        return view('estoque.create', compact('medicamentos', 'fornecedors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        
        $this->validate($request, [
            'lote' => 'required',
            'quantidadeatual' => 'required',
            'fabricacao' => 'required',
            'validade' => 'required',
            'idmedicamentocomercial' => 'required',
            'idfornecedor' => 'required'
        ]);
        
        $estoque = new Estoque();
        $estoque->lote = $request->get('lote');
        $estoque->quantidadeatual = $request->get('quantidadeatual'); 
        $estoque->quantidadereserva = 0;
        $estoque->fabricacao = $request->get('fabricacao');        
        $estoque->validade = $request->get('validade');                
        $estoque->status = 0;        
        $estoque->idmedicamentocomercial = $request->get('idmedicamentocomercial'); 
        $estoque->idfornecedor = $request->get('idfornecedor');
        $estoque->idfarmacia = 1; 
//        $estoque->save();
        
        $entrada = new Entrada();
        $entrada->idestoque = $estoque->id;
        $entrada->quantidade = $estoque->quantidadeatual;
        $entrada->data = $estoque->created_at;
        $entrada->idusuario = Auth::user()->id;
//        $entrada->save();
        
//        return redirect()->route('estoque.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $medicamentos = Medicamento::find($id);
        $formafarmaceuticas = Formafarmaceutica::lists('nome', 'id'); 
        $estoque = Estoque::find($id);
        return view('estoque.show', compact('estoque', 'medicamentos', 'formafarmaceuticas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $estoque = Estoque::find($id);
        return view('estoque.edit', compact('estoque'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $this->validate($request, [
            'quantidadeatual' => '',
            'quantidadereserva' => 'requered',
            'fabricacao' => '',
            'validade' => '',
            'status' => '',
            'idmedicamentocomercial' => '',
            'idfornecedor' => '',
            'idfarmacia' => ''
        ]);

        Estoque::find($id)->update($request->all());

        return redirect()->route('estoque.index')
                        ->with('success', 'Estoque atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        Estoque::find($id)->delete();
        return redirect()->route('estoque.index')
                        ->with('success', 'Estoque apagado com sucesso!');
    }

}
