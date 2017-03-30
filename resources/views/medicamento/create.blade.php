@extends('layouts.app')

@section('main-content')
<div class="row">
    <div class="col-lg-12 margin-tb">  
        <div class="pull-left">
            @section('contentheader_title')
            Cadastrar clínica
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
{!! Form::open(array('route' => 'medicamento.store','method'=>'POST')) !!}
<br>
<div class="box box-danger" style="margin-left: 2%; margin-right: 2%; width: 96%;">
    <div class="row">
        <div class="box-body">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Código SIMPAS:</strong>
                    {!! Form::text('codigosimpas', null, array('placeholder' => 'Digite o código simpas','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nome Comercial:</strong>
                    {!! Form::text('nomecomercial', null, array('placeholder' => 'Digite o nome comercial','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Forma farmacêutica:</strong>                    
                    {!! Form::select('idformafarmaceutica', $formafarmaceuticas, null, array('class' => 'form-control')) !!}
                </div>
            </div> 
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Conteúdo:</strong>
                    {!!Form::select('nomeconteudo', array(0 => 'frasco', 
                                                     1 => 'FA (frasco ampola)', 
                                                     2 => 'AMP (ampola)', 
                                                     3 => 'Caixa', 
                                                     4 => 'Envelope', 
                                                     5 => 'Tubo', 
                                                     6 => 'Bolsa', 
                                                     7 => 'Pote', 
                                                     8 => 'Caixa'
                                                     )
                    ,null, array('placeholder'=>'--Selecione--','class' => 'form-control'))!!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Quantidade:</strong>
                    {!! Form::text('quantidadeconteudo', null, array('placeholder' => 'Digite a quantidade do medicamento','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Unidade de medida:</strong>
                    {!!Form::select('unidadeconteudo', array(0 => 'mcg', 
                                                     1 => 'mg', 
                                                     2 => 'g', 
                                                     3 => 'UI', 
                                                     4 => 'unidades', 
                                                     5 => 'mg/g', 
                                                     6 => 'UI/g', 
                                                     7 => 'mEq/mL', 
                                                     8 => 'mg/gota', 
                                                     9 => 'mcg/mL', 
                                                     10 => 'UI/mL', 
                                                     11 => 'mEq'
                                                     )
                    ,null, array('placeholder'=>'--Selecione--','class' => 'form-control'))!!}
                </div>
            </div>
            <div class="pull-right" style="margin-right: 1%;">
                <a class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Voltar" href="{{ route('medicamento.index') }}"><i class="fa fa-mail-reply"></i></a>
                <button type="submit" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Salvar"><i class="fa fa-save"></i></button>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
@endsection