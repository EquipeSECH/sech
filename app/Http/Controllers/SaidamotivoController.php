<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Estoque;
use App\Medicamento;
use App\Fornecedor;
use App\Entrada;
use App\Saidamotivo;
use Auth;


class SaidamotivoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $entradas = Entrada::get();
        $saidamotivos = Saidamotivo::get();
        $estoques = Estoque::orderBy('id', 'desc')->paginate(15);
        return view('saidamotivo.index', compact('estoques', 'entradas', 'saidamotivos'))
                        ->with('i', ($request->input('page', 1) - 1) * 15);
        
        
        $estoques = Estoque::get();
        $saidamotivos = Entrada::orderBy('id', 'desc')->paginate(15);
        return view('saidamotivo.index', compact('saidamotivos', 'estoques'))
                        ->with('i', ($request->input('page', 1) - 1) * 15);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
      
     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        
        $estoque =  Estoque::find($request->id);
        $quantidadeatual = Estoque::find($request->id);
        $estoque->quantidadeatual = $quantidadeatual->quantidadeatual - $request->quantidade;
        $estoque->save();
        
        $saidamotivo = new Saidamotivo();
        $saidamotivo->quantidade = $request->quantidade;
        $saidamotivo->data = date('Y-m-d');
        $saidamotivo->motivo = $request->motivo;
        $saidamotivo->idusuario = Auth::user()->id;
        $saidamotivo->idestoque = $request->id;
        $saidamotivo->save();
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
