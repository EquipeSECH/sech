<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interacaomedicamentosa;
use App\Substanciaativa;

class InteracaomedicamentosaController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $interacaomedicamentosas = Interacaomedicamentosa::orderBy('id','DESC')->paginate(15);
        return view('interacaomedicamentosa.index',compact('interacaomedicamentosas'))
            ->with('i', ($request->input('page', 1) - 1) * 15);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {        
        $substanciaativas = Substanciaativa::lists('nome', 'id'); 
        return view('interacaomedicamentosa.create', compact('substanciaativas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        
        $this->validate($request, [
            'idsubstanciaativa1' => 'required',
            'idsubstanciaativa2' => 'required',
            'gravidade' => 'required',
            'consequencia'=> 'required',
        ]);

        Interacaomedicamentosa::create($request->all());

        return redirect()->route('interacaomedicamentosa.index')
                        ->with('success','Interação medicamentosa cadastrads com sucesso!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $interacaomedicamentosa = Interacaomedicamentosa::find($id);
        return view('interacaomedicamentosa.edit',compact('interacaomedicamentosa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $interacaomedicamentosa = Interacaomedicamentosa::find($id);
        return view('intercaomedicamentosa.edit',compact('interacaomedicamentosa'));
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
            'idsubstanciaativa1' => 'required',
            'idsubstanciaativa2' => 'required',
            'gravidade' => 'required',
            'consequencia'=> 'required',
        ]);

        Interacaomedicamentosa::find($id)->update($request->all());

        return redirect()->route('interacaomedicamentosa.index')
                        ->with('success','Interação medicamentosa atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Interacaomedicamentosa::find($id)->delete();
        return redirect()->route('interacaomedicamentosa.index')
                        ->with('success','Interação medicamentosa excluída com sucesso!');
        
    }

}
