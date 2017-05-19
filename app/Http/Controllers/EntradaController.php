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


class EntradaController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $saidamotivos = SaidaMotivo::get();
        $entradas = Entrada::orderBy('id', 'desc')->paginate(15);
        return view('entrada.index', compact('entradas', 'saidamotivos'))
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
        return view('entrada.create', compact('medicamentos', 'fornecedors'));
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
        $estoque->save();
        
        $entrada = new Entrada();
        $entrada->idestoque = $estoque->id;
        $entrada->quantidade = $estoque->quantidadeatual;
        $entrada->data = $estoque->created_at;
        $entrada->idusuario = Auth::user()->id;
        $entrada->save();
        return redirect()->route('entrada.index');
         
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $entrada = Entrada::find($id);
        return view('entrada.show', compact('entrada'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $entrada = Entrada::find($id);
        return view('entrada.edit', compact('entrada'));
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
            'quantidade' => 'required',
            'idusuario' => 'required',
            'idestoque' => 'required',
            'data' => 'required'
        ]);

        Entrada::find($id)->update($request->all());

        return redirect()->route('entrada.index')
                        ->with('success', 'Entrada atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        Entrada::find($id)->delete();
        return redirect()->route('entrada.index')
                        ->with('success', 'Entrada apagado com sucesso!');
    }

}
