@extends('layouts.app')

@section('main-content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        @section('contentheader_title')
        <div class="pull-left">
            Registrar entrada
        </div>
        @endsection 
    </div>
</div>
<br>
@if (count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
{!! Form::open(array('route' => 'estoque.store','method'=>'POST')) !!}
<div class="box box-primary" style="margin-left: 2%; margin-right: 2%; width: 96%;">
    <div class="row">
        <div class="box-body">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Medicamento:</strong>      
                    <select id="idmedicamentos" class="form-control">
                        <option selected="selected">--Selecione--</option>
                        @foreach ($medicamentos as $key => $medicamento)
                            <?php $nomemedicamento = ''; ?>
                            @foreach ($medicamento->medicamentosubstancias as $key => $medicamentosubstancia)
                                <?php                                      
                                    $nomeunidade = ''; 
                                    switch ($medicamentosubstancia->unidadedose) {
                                        case 0: $nomeunidade = 'mcg'; break;
                                        case 1: $nomeunidade = 'mg'; break;
                                        case 2: $nomeunidade = 'g'; break;
                                        case 3: $nomeunidade = 'UI'; break;
                                        case 4: $nomeunidade = 'unidades'; break;
                                        case 5: $nomeunidade = 'mg/g'; break;
                                        case 6: $nomeunidade = 'UI/g';  break;
                                        case 7: $nomeunidade = 'mEq/mL'; break;
                                        case 8: $nomeunidade = 'mg/gota'; break;
                                        case 9: $nomeunidade = 'mcg/mL'; break;
                                        case 10: $nomeunidade = 'UI/mL'; break;
                                        case 11: $nomeunidade = 'mEq'; break;
                                    }
                                    
                                    $nomemedicamento = $nomemedicamento ." ". $medicamentosubstancia->substanciaativa->nome ." ". $medicamentosubstancia->quantidadedose . $nomeunidade. ", "; 
                                ?>
                            @endforeach            
                            <?php                                  
                                $conteudo = ''; 
                                switch ($medicamento->nomeconteudo) {
                                    case 0: $conteudo = 'Frasco'; break;
                                    case 1: $conteudo = 'FA (frasco ampola)'; break;
                                    case 2: $conteudo = 'AMP (ampola)'; break;
                                    case 3: $conteudo = 'Caixa';  break;
                                    case 4: $conteudo = 'Envelope'; break;
                                    case 5: $conteudo = 'Tubo'; break;
                                    case 6: $conteudo = 'Bolsa'; break;
                                    case 7: $conteudo = 'Pote'; break;
                                }                                    
                                $uc = ''; 
                                switch ($medicamento->unidadeconteudo) {
                                    case 0: $uc = 'mcg';break;
                                    case 1: $uc = 'mg'; break;
                                    case 2: $uc = 'g'; break;
                                    case 3: $uc = 'UI'; break;
                                    case 4: $uc = 'unidades'; break;
                                    case 5: $uc = 'mg/g'; break;
                                    case 6: $uc = 'UI/g'; break;
                                    case 7: $uc = 'mEq/mL'; break;
                                    case 8: $uc = 'mg/gota';  break;
                                    case 9: $uc = 'mcg/mL'; break;
                                    case 10: $uc = 'UI/mL'; break;
                                    case 11: $uc = 'mEq'; break;
                                }
                                $nomemedicamento = $nomemedicamento. $medicamento->formafarmaceuticas->nome . $conteudo . " com " . $medicamento->quantidadeconteudo . $uc . ", ";
                            ?>    
                            <?php
                                echo"<option value=".$medicamento->id .">".$nomemedicamento."</option>";
                            ?>
                        @endforeach
                    </selec>
                </div>
            </div>
            <div class="pull-right" style="margin-right: 1%;">
                <br>
                <a class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Voltar" href="{{ route('especialidade.index') }}"><i class="fa fa-mail-reply"></i></a>
                <button type="submit" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Salvar"><i class="fa fa-save"></i></button>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
@endsection