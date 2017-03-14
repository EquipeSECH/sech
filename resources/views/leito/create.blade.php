@extends('layouts.app')

@section('main-content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        @section('contentheader_title')
        <div class="pull-left">
            Cadastrar clínica > cadastrar leito
        </div>
        @endsection 
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('leito.index') }}"> Voltar</a>
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
{!! Form::open(array('route' => 'leito.store','method'=>'POST')) !!}
<br>
<div class="box box-danger">
    <div class="row">
        <div class="box-body">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <h4>Clínica: {{ $clinica[0]->nome }}</h4>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Leito:</strong>
                    {!! Form::text('leito', null, array('placeholder' => 'Digite o código','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Observação:</strong>
                    {!! Form::textarea('observacao', null, array('placeholder' => 'Descrição','class' => 'form-control','style'=>'height:100px')) !!}
                </div>
            </div>
            {!! Form::hidden('idclinica', $clinica[0]->id, array('class' => 'form-control')) !!}
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
@endsection