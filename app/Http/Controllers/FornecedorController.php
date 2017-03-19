<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Fornecedor;

class FornecedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fornecedors = Fornecedor::orderBy('id','desc')->paginate(15);
        return view('fornecedor.index', compact('fornecedors'))
            ->with('i', ($request->input('page', 1) - 1) * 15);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fornecedor.create');
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
            'cnpj'=> 'required', 
            'nomefantasia' => 'required',
            'endereco' => 'required',
            'telefone' => 'required',
            'email' => 'required',
            'nomeresponsavel' => 'required',
            'telefoneresponsavel' => 'required'
           
        ]);

        Fornecedor::create($request->all());

        return redirect()->route('fornecedor.index')
                        ->with('success','Fornecedor cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fornecdor = Fornecedor::find($id);
        return view('fornecedor.show',compact('fornecedor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fornecedor = Fornecedor::find($id);
        return view('fornecedor.edit',compact('fornecedor'));
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
            'cnpj'=> 'required', 
            'nomefantasia' => 'required',
            'endereco' => 'required',
            'telefone' => 'required',
            'email' => 'required',
            'nomeresponsavel' => 'required',
            'telefoneresponsavel' => 'required'
           
        ]);

        Fornecedor::find($id)->update($request->all());

        return redirect()->route('fornecedor.index')
                        ->with('success','Fornecedor atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        Fornecedor::find($id)->delete();
        return redirect()->route('fornecedor.index')
                        ->with('success','Fornecedor apagado com sucesso!');
    }
}