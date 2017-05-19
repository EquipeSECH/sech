@extends('layouts.app')

@section('main-content')
<div class="row">
    <div class="col-lg-12 margin-tb">  
        <div class="pull-left">
             @section('contentheader_title')
            Registrar entrada
             @endsection 
        </div>
    </div>
</div>
@if (count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
{!! Form::open(array('route' => 'entrada.store','method'=>'POST')) !!}
<br>
<div class="box box-primary" style="margin-left: 2%; margin-right: 2%; width: 96%;">
    <div class="row">
        <div class="box-body">
            <div class="col-xs-11 col-sm-11 col-md-11">
                <div class="form-group">
                    <strong>Medicamento:</strong>
                    <select id="idmedicamentocomercial" name="idmedicamentocomercial" class="form-control">
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
                    </select>
                </div>
            </div>
            <div class="col-xs-1 col-sm-1 col-md-1">
                <div class="form-group">
                    <strong>Qtd:</strong>
                    {!! Form::text('quantidadeatual', null, array('placeholder' => '','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Fornecedor:</strong>
                    {!! Form::select('idfornecedor', $fornecedors , null, array('class' => 'form-control')) !!}
                </div>
            </div>            
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Lote:</strong>
                    {!! Form::text('lote', null, array('placeholder' => 'Informe o Lote','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Fabricação:</strong>
                    {!! Form::date('fabricacao', null, array('class' => 'form-control')) !!}
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Validade:</strong>
                    {!! Form::date('validade', null, array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="pull-right" style="margin-right: 1%;">
                <button type="submit" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Salvar" @click="adicionar"><i class="fa fa-save"></i></button>
            </div>
            <div class="pull-right" style="margin-right: 1%;">
                <a class="btn btn-default" href="{{ route('estoque.index') }}"> 
                    <i class="fa  fa-mail-reply"></i>
                </a>
            </div>
            
        </div>
    </div>
</div>
{!! Form::close() !!}
@endsection