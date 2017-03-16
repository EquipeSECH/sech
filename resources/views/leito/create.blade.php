@extends('layouts.app')

@section('main-content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        @section('contentheader_title')
        <div class="pull-left">
            Cadastrar clínica > cadastrar leito
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
{!! Form::open(array('route' => ['leito.store', $clinica[0]->id ],'method'=>'POST')) !!}
<br>

<div class="box box-solid box-danger" style="margin-left: 2%; margin-right: 2%; width: 96%;">
    <div class="box-header">
        <h4>{{ $clinica[0]->nome }}</h4>
    </div>
    <div class="box-body">
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
        <div class="pull-right" style="margin-right: 1%;">
            <button type="submit" class="btn btn-default"><span class="fa fa-plus"></button>
            <a href="{{ route('clinica.index') }}" class="btn btn-default">Finalizar</a>
        </div>
    </div>
</div>
{!! Form::close() !!}

<div class="box box-solid box-danger" style="margin-left: 2%; margin-right: 2%; width: 96%;">
    <div class="box-header">
        <h4>Leitos</h4>
    </div>
    <div class="box-body">
        <div class="table-responsive col-lg-12 col-md-12 col-sm-12">
            <table class="table table-bordered table-hover dataTable" role="grid">
                <tbody>
                    @foreach ($leitos as $key => $leito)
                    <tr>
                        @if($leito->idclinica === $clinica[0]->id)
                        <td>{{$leito->leito}}</td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection