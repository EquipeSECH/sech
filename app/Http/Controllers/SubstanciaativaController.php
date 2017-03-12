<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Substanciaativa;

class SubstanciaativaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $substanciaativas = Substanciaativa::orderBy('id','desc')->paginate(15);
        return view('substanciaativa.index', compact('substanciaativas'))
            ->with('i', ($request->input('page', 1) - 1) * 15);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        return view('substanciaativa.create');
   
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
            'nome' => 'required',
            'classificacao' => 'required',
            'contraindicacao' => 'required',
        
        ]);

        Substanciaativa::create($request->all());

        return redirect()->route('substanciaativa.index')
                        ->with('success','Substância ativa cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $substanciaativa = substanciaativa::find($id);
        return view('substanciaativa.show',compact('substanciaativa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $substanciaativa = Substanciaativa::find($id);
        return view('substanciaativa.edit',compact('substanciaativa'));
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
            'nome' => 'required',
            'classificacao' => 'required',
            'contraindicacao' => 'required',
        
        ]);

        Substanciaativa::find($id)->update($request->all());

        return redirect()->route('substanciaativa.index')
                        ->with('success','Substância ativa atualizada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        Substanciaativa::find($id)->delete();
        return redirect()->route('substanciaativa.index')
                        ->with('success','Substância ativa apagada com sucesso!');
    }
}