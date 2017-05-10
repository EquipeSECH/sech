<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Estoque;
use App\Medicamento;
use App\Formafarmaceutica;

class EstoqueController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $estoques = Estoque::orderBy('id', 'desc')->paginate(15);
        return view('estoque.index', compact('estoques'))
                        ->with('i', ($request->input('page', 1) - 1) * 15);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        
        $medicamentos = Medicamento::get();  
        return view('estoque.create', compact('medicamentos'));
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
            'quantidadereserva' => 'required',
            'fabricacao' => 'required',
            'validade' => 'required',
            'status' => 'required',
            'idmedicamentocomercial' => 'required',
            'idfornecedor' => 'required',
            'idfarmacia' => 'required'
        ]);

        Estoque::create($request->all());
        
        return redirect()->route('estoque.index')
                        ->with('success', 'Enrtada cadastrada com sucesso!');
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
            'lote' => 'required',
            'quantidadeatual' => 'required',
            'quantidadereserva' => 'required',
            'fabricacao' => 'required',
            'validade' => 'required',
            'status' => 'required',
            'idmedicamentocomercial' => 'required',
            'idfornecedor' => 'required',
            'idfarmacia' => 'required'
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
