@extends('layouts.app')

@section('main-content')
<div class="row">
    <div class="col-lg-12 margin-tb">  
        <div class="pull-left">
             @section('contentheader_title')
             Substância Ativa
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
{!! Form::open(array('route' => 'substanciaativa.store','method'=>'POST')) !!}
<br>
<div class="box box-primary" style="margin-left: 2%; margin-right: 2%; width: 96%;">
    <div class="row">
        <div class="box-body">
            <div class="col-xs-8 col-sm-8 col-md-8">
                <div class="form-group">
                     <strong>Substância ativa:</strong>
                    {!! Form::text('nome', null, array('placeholder' => 'Ex.: Ambroxol ','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                   <strong>Classificação:</strong>
                {!!Form::select('classificacao', array(0 => 'Controlado da portaria 344/98', 
                                                        1 => 'Potencialmente perigosos', 
                                                        2 => 'Antibiótico de uso restrito', 
                                                        3 => 'Antibiótico', 
                                                        4 => 'Outros'
                                                        )
                ,null, array('placeholder'=>'--Selecione--','class' => 'form-control'))!!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Contraindicação:</strong>
                {!! Form::textarea('contraindicacao', null, array('placeholder' => '','class' => 'form-control', 'style'=>'height:60px', 'maxlength'=>'254')) !!}
                </div>
            </div>
            <!--<div class="col-xs-12 col-sm-12 col-md-12">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>-->
            <div class="pull-right" style="margin-right: 1%;">
                <button type="submit" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Salvar" @click="adicionar"><i class="fa fa-save"></i></button>
            </div>
            <div class="pull-right" style="margin-right: 1%;">
                <a class="btn btn-default" href="{{ route('substanciaativa.index') }}"> 
                    <i class="fa  fa-mail-reply"></i>
                </a>
            </div>
            
        </div>
    </div>
</div>
{!! Form::close() !!}
@endsection