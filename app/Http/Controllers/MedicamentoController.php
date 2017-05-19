<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Medicamento;
use App\Formafarmaceutica;
use App\Substanciaativa;
use App\Medicamentosubstancia;

class MedicamentoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $medicamentos = Medicamento::orderBy('id', 'desc')->paginate(15);
        return view('medicamento.index', compact('medicamentos'))
                        ->with('i', ($request->input('page', 1) - 1) * 15);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $formafarmaceuticas = Formafarmaceutica::get();
        $substanciaativas = Substanciaativa::get();
        return view('medicamento.create', compact('formafarmaceuticas', 'substanciaativas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //dd($request->all());
//        $this->validate($request, [
//            'idformafarmaceutica' => 'required',
//            'codigosimpas' => 'required',  
//        ]);
        //medicamento
        $medicamento = new Medicamento();
        $medicamento->idformafarmaceutica = $request->get('formafarmaceutica');
        $medicamento->nomeconteudo = $request->get('conteudo');
        $medicamento->quantidadeconteudo = $request->get('quantidade');
        $medicamento->unidadeconteudo = $request->get('unidade');
        $medicamento->codigosimpas = $request->get('simpas');
        $medicamento->nomecomercial = $request->get('nomecomercial');

        $medicamento->save();
        $fk_medicamento = $medicamento->id;
        //substancias
        $substancias = $request->get('substancias');
        for ($i = 0; $i < sizeof($substancias); $i++) {
            $medicamentoSubstancia = new Medicamentosubstancia();
            $medicamentoSubstancia->idsubstanciaativa = $substancias[$i]['substancia'];
            $medicamentoSubstancia->quantidadedose = $substancias[$i]['quantidadedose'];
            $medicamentoSubstancia->unidadedose = $substancias[$i]['unidadedose'];
            $medicamentoSubstancia->idmedicamento = $fk_medicamento;
            $medicamentoSubstancia->save();
        }

//        return redirect()->route('medicamento.index')
//                        ->with('success','Medicamento cadastrado com sucesso!');
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
        return view('medicamento.show', compact('medicamentos', 'formafarmaceuticas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $medicamento = Medicamento::find($id);
        $medicamentosubstancias = Medicamentosubstancia::where('idmedicamento', '=', $id)->get();
        $formafarmaceuticas = Formafarmaceutica::get();
        $substanciaativas = Substanciaativa::get();

        return view('medicamento.edit', compact('medicamento', 'medicamentosubstancias', 'formafarmaceuticas', 'substanciaativas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $medicamento = Medicamento::find($id);
        $medicamento->idformafarmaceutica = $request->get('formafarmaceutica');
        $medicamento->nomeconteudo = $request->get('conteudo');
        $medicamento->quantidadeconteudo = $request->get('quantidade');
        $medicamento->unidadeconteudo = $request->get('unidade');
        $medicamento->codigosimpas = $request->get('simpas');
        $medicamento->nomecomercial = $request->get('nomecomercial');

        $medicamento->save();
        $fk_medicamento = $medicamento->id;
        //substancias
        $substancias = $request->get('substancias');
        for ($i = 0; $i < sizeof($substancias); $i++) {
            $medicamentoSubstancia = new Medicamentosubstancia();
            $medicamentoSubstancia->idsubstanciaativa = $substancias[$i]['substancia'];
            $medicamentoSubstancia->quantidadedose = $substancias[$i]['quantidadedose'];
            $medicamentoSubstancia->unidadedose = $substancias[$i]['unidadedose'];
            $medicamentoSubstancia->idmedicamento = $id;
            $medicamentoSubstancia->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        Medicamento::find($id)->delete();
        return redirect()->route('medicamento.index')
                        ->with('success', 'Medicamento excluído com sucesso!');
    }

    public function autocomplete(Request $req) {
        $term = $req->get('term');

        $data = Medicamento::get();
        $results = array();

        $substancias = '';
        foreach ($data as $key => $medicamento) {
            foreach ($medicamento->medicamentosubstancias as $key => $medicamentosubstancia) {
                $nomeunidade = '';
                switch ($medicamentosubstancia->unidadedose) {
                    case 0:
                        $nomeunidade = 'mcg';
                        break;
                    case 1:
                        $nomeunidade = 'mg';
                        break;
                    case 2:
                        $nomeunidade = 'g';
                        break;
                    case 3:
                        $nomeunidade = 'UI';
                        break;
                    case 4:
                        $nomeunidade = 'unidades';
                        break;
                    case 5:
                        $nomeunidade = 'mg/g';
                        break;
                    case 6:
                        $nomeunidade = 'UI/g';
                        break;
                    case 7:
                        $nomeunidade = 'mEq/mL';
                        break;
                    case 8:
                        $nomeunidade = 'mg/gota';
                        break;
                    case 9:
                        $nomeunidade = 'mcg/mL';
                        break;
                    case 10:
                        $nomeunidade = 'UI/mL';
                        break;
                    case 11:
                        $nomeunidade = 'mEq';
                        break;
                }
                $substancias .= $medicamentosubstancia->substanciaativa->nome.' '. $medicamentosubstancia->quantidadedose. ' '. $nomeunidade . ', ';
            }
            $substancias .= $medicamento->formafarmaceuticas->nome . ' ';
            $conteudo = '';
            switch ($medicamento->nomeconteudo) {
                case 0:
                    $conteudo = 'Frasco';
                    break;
                case 1:
                    $conteudo = 'FA (frasco ampola)';
                    break;
                case 2:
                    $conteudo = 'AMP (ampola)';
                    break;
                case 3:
                    $conteudo = 'Caixa';
                    break;
                case 4:
                    $conteudo = 'Envelope';
                    break;
                case 5:
                    $conteudo = 'Tubo';
                    break;
                case 6:
                    $conteudo = 'Bolsa';
                    break;
                case 7:
                    $conteudo = 'Pote';
                    break;
            }
            
            switch ($medicamento->unidadeconteudo) {
                case 0:
                    $uc = 'mcg';
                    break;
                case 1:
                    $uc = 'mg';
                    break;
                case 2:
                    $uc = 'g';
                    break;
                case 3:
                    $uc = 'UI';
                    break;
                case 4:
                    $uc = 'unidades';
                    break;
                case 5:
                    $uc = 'mg/g';
                    break;
                case 6:
                    $uc = 'UI/g';
                    break;
                case 7:
                    $uc = 'mEq/mL';
                    break;
                case 8:
                    $uc = 'mg/gota';
                    break;
                case 9:
                    $uc = 'mcg/mL';
                    break;
                case 10:
                    $uc = 'UI/mL';
                    break;
                case 11:
                    $uc = 'mEq';
                    break;
            }
            $substancias .= '' . $conteudo . ' com ' . $medicamento->quantidadeconteudo . ' '. $uc;
            $results[] = ['id' => $medicamento->id,
                'value' => $substancias
            ];
        }
        return response()->json($results);
    }

    public function getCodigoSimpas(Request $req) {

        $id = $req->get('id');

        if ($id == null) {
            return response()->json("-");
        } else {
            $codsimpas = Medicamento::find($id)->select('medicamentos.codigosimpas')->get();
            return response()->json($codsimpas[0]->codigosimpas);
        }
    }

    public function getContraindicacao(Request $req) {

        $id = $req->id;

        $contraindicacoes = Medicamentosubstancia::join('substanciaativas', 'medicamentosubstancias.idsubstanciaativa', '=', 'substanciaativas.id')
                ->join('medicamentos', 'medicamentos.id', '=', 'medicamentosubstancias.idmedicamento')
                ->get();
        
        $texto = '';
        foreach ($contraindicacoes as $key => $contraindicacao) {
            $texto .= $contraindicacao->nome . ': ' . $contraindicacao->contraindicacao. '<br>';        
        }

        return response()->json($texto);
    }

}
