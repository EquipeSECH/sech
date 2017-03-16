<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Farmacia;

class FarmaciaController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $farmacias = Farmacia::orderBy('id', 'desc')->paginate(15);
        return view('farmacia.index', compact('farmacias'))
                        ->with('i', ($request->input('page', 1) - 1) * 15);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('farmacia.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'idClinica' => 'required',
            'nome' => 'required',
            'codigo' => 'required',
            'central' => 'required'
        ]);

        Farmacia::create($request->all());

        return redirect()->route('farmacia.index')
                        ->with('success', 'Enrtada cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $farmacia = Farmacia::find($id);
        return view('farmacia.show', compact('farmacia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $farmacia = Fornecedor::find($id);
        return view('farmacia.edit', compact('farmacia'));
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
            'idClinica' => 'required',
            'nome' => 'required',
            'codigo' => 'required',
            'central' => 'required'
        ]);

        Farmacia::find($id)->update($request->all());

        return redirect()->route('farmacia.index')
                        ->with('success', 'Farmacia atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        Farmacia::find($id)->delete();
        return redirect()->route('farmacia.index')
                        ->with('success', 'Farmacia apagado com sucesso!');
    }

}
