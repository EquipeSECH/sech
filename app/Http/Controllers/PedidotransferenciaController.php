<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pedidotransferencia;

class PedidotransferenciaController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $pedidotransferencias = Pedidotransferencia::orderBy('id', 'desc')->paginate(15);
        return view('pedidotransferencia.index', compact('pedidotransferencias'))
                        ->with('i', ($request->input('page', 1) - 1) * 15);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('pedidotransferencia.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'motivotransferencia' => 'required',
            'datapedido' => 'required',
            'dataaprovacao' => 'required',
            'idusuariofarmaceutico' => 'required',
            'idmedicamento' => 'required',
            'farmaciadestino' => 'required',
            'idusuarioenfermeiro' => 'required'
        ]);

        Pedidotransferencia::create($request->all());

        return redirect()->route('pedidotransferencia.index')
                        ->with('success', 'Enrtada cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $pedidotransferencia = Pedidotransferencia::find($id);
        return view('pedidotransferencia.show', compact('pedidotransferencia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $pedidotransferencia = Fornecedor::find($id);
        return view('pedidotransferencia.edit', compact('pedidotransferencia'));
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
            'motivotransferencia' => 'required',
            'datapedido' => 'required',
            'dataaprovacao' => 'required',
            'idusuariofarmaceutico' => 'required',
            'idmedicamento' => 'required',
            'farmaciadestino' => 'required',
            'idusuarioenfermeiro' => 'required'
        ]);

        Pedidotransferencia::find($id)->update($request->all());

        return redirect()->route('pedidotransferencia.index')
                        ->with('success', 'Pedidotransferencia atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        Pedidotransferencia::find($id)->delete();
        return redirect()->route('pedidotransferencia.index')
                        ->with('success', 'Pedidotransferencia apagado com sucesso!');
    }

}
