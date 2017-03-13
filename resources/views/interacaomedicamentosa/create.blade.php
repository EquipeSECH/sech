@extends('layouts.app')

@section('main-content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        @section('contentheader_title')
        <div class="pull-left">
            <h2>Cadastrar interação medicamnetosa</h2>
        </div>
        @endsection 
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('interacaomedicamentosa.index') }}"> Voltar</a>
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
{!! Form::open(array('route' => 'interacaomedicamentosa.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Substância 1:</strong>            
            {!! Form::select(' idsubstanciaativa1', $substanciaativas, null, array('class' => 'form-control')) !!}            
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Substância 2:</strong>            
            {!! Form::select(' idsubstanciaativa2', $substanciaativas, null, array('class' => 'form-control')) !!}            
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Gravidade:</strong>
            {!! Form::text('gravidade', null, array('placeholder' => '0: menor, 1: moderada, 2: maior, 3: contra indicado ','class' => 'form-control','style'=>'height:100px')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Consequencia:</strong>
            {!! Form::textarea('consequencia', null, array('placeholder' => '0: menor, 1: moderada, 2: maior, 3: contra indicado ','class' => 'form-control','style'=>'height:100px')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Salvar</button>
    </div>
</div>
{!! Form::close() !!}
@endsection