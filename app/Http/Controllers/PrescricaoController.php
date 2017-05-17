<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Prescricao;
use App\PrescricaoMedicamento;

class PrescricaoController extends Controller {

    public function index(Request $request) {
        $prescricoes = Prescricao::orderBy('id', 'DESC')->get();
        return view('prescricao.index', compact('prescricoes'))
                        ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create() {
        $dataprescricao = date("d/m/Y H:i:s");
        return view('prescricao.create', compact('dataprescricao'));
    }

    public function store(Request $request) {
        //dd($request->all());

        $prescricao = new Prescricao();
        $prescricao->idusuario = Auth::user()->id;
        $prescricao->idinternacao = $request->get('idinternacao');
        $prescricao->dataprescricao = $request->get('dataprescricao');
        $prescricao->historicoatual = $request->get('historicoatual');
        $prescricao->evolucao = $request->get('evolucao');
        $prescricao->observacoesmedicas = $request->get('observacoesmedicas');
        $prescricao->save();

        $idprescricao = $prescricao->id;

        $medicamentos = $request->get('prescricaomedicamento');
        for ($i = 0; $i < sizeof($medicamentos); $i++) {
            $prescricaomedicamento = new PrescricaoMedicamento();
            $prescricaomedicamento->idprescricao = $idprescricao;
            if ($medicamentos[$i]['idmedicamento'] == "") {
                $prescricaomedicamento->idmedicamento = $medicamentos[$i]['idmedicamento'];
                $prescricaomedicamento->posologia = $medicamentos[$i]['obs'];
                $prescricaomedicamento->outros = $medicamentos[$i]['med'];
            } else {
                $prescricaomedicamento->idmedicamento = $medicamentos[$i]['idmedicamento'];
                $prescricaomedicamento->qtdpedida = $medicamentos[$i]['qtd'];
                $prescricaomedicamento->posologia = $medicamentos[$i]['obs'];
            }
            $prescricaomedicamento->save();
        }

//        $this->validate($request, [
//            'nome' => 'required',
//            'descricao' => 'required',
//        ]);
//        return redirect()->route('clinica.index')
//                        ->with('success','Clínica cadastrada com sucesso!');
    }

    public function edit($id) {
        $clinica = Clinica::find($id);
        $leitos = Leito::where('idclinica', '=', $id)->get();
        $qtdleitos = count($clinica->leitos);
        return view('clinica.edit', compact('clinica', 'leitos', 'qtdleitos'));
    }

    public function update(Request $request, $id) {
        //dd($request->all()) and die();
        $this->validate($request, [
            'nome' => 'required',
            'descricao' => 'required',
        ]);

//        return redirect()->route('clinica.index')
//                        ->with('success','Clínica atualizada com sucesso!');
    }

    public function destroy($id) {
        Clinica::find($id)->delete();
        return redirect()->route('clinica.index')
                        ->with('success', 'Clínica excluída com sucesso!');
    }

}
