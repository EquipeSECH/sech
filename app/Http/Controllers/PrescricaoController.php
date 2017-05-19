<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Prescricao;
use App\PrescricaoMedicamento;
use App\User;

class PrescricaoController extends Controller {

    public function index(Request $request) {
        $idusuario = Auth::user()->id;
        $prescricoesNatendidas = Prescricao::where('prescricaos.status', 0)
                ->orderBy('id', 'DESC')
                ->where('prescricaos.idusuario', $idusuario)
                ->get();
        $prescricoesAtendidas = Prescricao::where('prescricaos.status', 1)
                ->orderBy('id', 'DESC')
                ->where('prescricaos.idusuario', $idusuario)
                ->get();
        //dd($prescricoesNatendidas[0]->medicamentos[0]->medicamento);
        return view('prescricao.index', compact('prescricoesNatendidas', 'prescricoesAtendidas'))
                        ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create() {
        $dataprescricao = date("d/m/Y H:i:s");
        $id = Auth::user()->id;
        $medico = User::find($id)->name;
        return view('prescricao.create', compact('dataprescricao', 'medico'));
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
                $prescricaomedicamento->qtdpedida = 0;
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
        $prescricao = Prescricao::find($id);
        $medicamentos = PrescricaoMedicamento::where('idprescricao', $prescricao->id)
                ->join('medicamentos', 'medicamentos.id', '=', 'prescricao_medicamentos.idmedicamento')
                ->where('idmedicamento', '!=', null)
                ->select('medicamentos.id', 'medicamentos.idformafarmaceutica', 'medicamentos.nomeconteudo', 'medicamentos.quantidadeconteudo', 'medicamentos.unidadeconteudo', 'medicamentos.codigosimpas', 'prescricao_medicamentos.id as idprescmed', 'prescricao_medicamentos.idprescricao', 'prescricao_medicamentos.idmedicamento', 'prescricao_medicamentos.qtdpedida', 'prescricao_medicamentos.qtdatendida', 'prescricao_medicamentos.posologia')
                ->where('prescricao_medicamentos.qtdatendida', 0)
                ->get();

        //dd($medicamentos);
        return view('prescricao.edit', compact('prescricao', 'medicamentos'));
    }

    public function update(Request $request, $id) {
        //dd($id) and die();
//        $this->validate($request, [
//            'nome' => 'required',
//            'descricao' => 'required',
//        ]);
        
        $prescricao = Prescricao::find($id);
        $prescricao->status = 1;
        $prescricao->save();

        return redirect()->route('prescricao.index')
                        ->with('success', 'Prescrição resolvida com sucesso!');
    }


}
