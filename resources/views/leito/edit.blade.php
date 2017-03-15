@extends('layouts.app')

@section('main-content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        @section('contentheader_title')
        <div class="pull-left">
            <h2>Editar leito</h2>
        </div>
        @endsection 
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
{!! Form::model($leito, ['method' => 'PATCH','route' => ['leito.update', $leito->id]]) !!}
<br>
<div class="box box-danger" style="margin-left: 2%; margin-right: 2%; width: 96%;">
    <div class="row">
        <div class="box-body">
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Leito:</strong>
                    {!! Form::text('leito', null, array('placeholder' => 'Digite o código','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-9 col-sm-9 col-md-9">
                <div class="form-group">
                    <strong>Clínica:</strong>
                    {!! Form::select('idclinica', $clinicas, null, array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Observação:</strong>
                    {!! Form::textarea('observacao', null, array('placeholder' => 'Descrição','class' => 'form-control','style'=>'height:100px')) !!}
                </div>
            </div>
            <div class="pull-right" style="margin-right: 1%;">
                <a class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Voltar" href="{{ route('leito.index') }}"><i class="fa fa-mail-reply"></i></a>
                <button type="submit" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Salvar"><i class="fa fa-save"></i></button>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
@endsection