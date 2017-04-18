@extends('layouts.app')

@section('main-content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        @section('contentheader_title')
        <div class="pull-left">
            Editar CID 10
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
{!! Form::model($cid, ['method' => 'PATCH','route' => ['cid10.update', $cid->id]]) !!}
<div class="box box-primary" style="margin-left: 2%; margin-right: 2%; width: 96%;">
    <div class="row">
        <div class="box-body">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Código:</strong>
                    {!! Form::text('codigo', null, array('placeholder' => 'Digite o código','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Descrição:</strong>
                    {!! Form::textarea('descricao', null, array('placeholder' => 'Descrição','class' => 'form-control','style'=>'height:100px')) !!}
                </div>
            </div>
            <div class="pull-right" style="margin-right: 1%;">
                <br>
                <a class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Voltar" href="{{ route('cid10.index') }}"><i class="fa fa-mail-reply"></i></a>
                <button type="submit" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Salvar"><i class="fa fa-save"></i></button>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
@endsection