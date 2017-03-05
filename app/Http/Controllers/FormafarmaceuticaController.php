<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Formafarmaceutica;

class FormafarmaceuticaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $formafarmaceuticas = Formafarmaceutica::orderBy('id','desc')->paginate(15);
        return view('formafarmaceutica.index', compact('formafarmaceuticas'))
            ->with('i', ($request->input('page', 1) - 1) * 15);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('formafarmaceutica.create');
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
            'unidade' => 'required',
        ]);

        Formafarmaceutica::create($request->all());

        return redirect()->route('formafarmaceutica.index')
                        ->with('success','Forma farmacêutica cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $formafarmaceutica = formafarmaceutica::find($id);
        return view('formafarmaceutica.show',compact('formafarmaceutica'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $formafarmaceutica = Formafarmaceutica::find($id);
        return view('formafarmaceutica.edit',compact('formafarmaceutica'));
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
            'unidade' => 'required',
        ]);

        Formafarmaceutica::find($id)->update($request->all());

        return redirect()->route('formafarmaceutica.index')
                        ->with('success','Forma farmacêutica atualizada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        Formafarmaceutica::find($id)->delete();
        return redirect()->route('formafarmaceutica.index')
                        ->with('success','Forma farmacêutica apagada com sucesso!');
    }
}