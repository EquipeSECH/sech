<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Saida;

class SaidaController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $saidas = Saida::orderBy('id', 'desc')->paginate(15);
        return view('saida.index', compact('saidas'))
                        ->with('i', ($request->input('page', 1) - 1) * 15);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('saida.create');
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
            'data' => 'required',
            'idprescricao' => 'required'
        ]);

        Saida::create($request->all());

        return redirect()->route('saida.index')
                        ->with('success', 'Enrtada cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $saida = Saida::find($id);
        return view('saida.show', compact('saida'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $saida = Saida::find($id);
        return view('saida.edit', compact('saida'));
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
            'data' => 'required',
            'idprescricao' => 'required'
        ]);

        Saida::find($id)->update($request->all());

        return redirect()->route('saida.index')
                        ->with('success', 'Saida atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        Saida::find($id)->delete();
        return redirect()->route('saida.index')
                        ->with('success', 'Saida apagado com sucesso!');
    }

}
