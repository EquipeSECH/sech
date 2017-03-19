<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entrada;

class EntradaController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $entradas = Entrada::orderBy('id', 'desc')->paginate(15);
        return view('entrada.index', compact('entradas'))
                        ->with('i', ($request->input('page', 1) - 1) * 15);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('entrada.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'quantidade' => 'required',
            'idusuario' => 'required',
            'idestoque' => 'required',
            'data' => 'required'
        ]);

        Entrada::create($request->all());

        return redirect()->route('entrada.index')
                        ->with('success', 'Enrtada cadastrada com sucesso!');
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
