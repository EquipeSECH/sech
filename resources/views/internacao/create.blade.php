@extends('layouts.app')

@section('main-content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        @section('contentheader_title')
        <div class="pull-left">
            <h2>Internação</h2>
        </div>
        @endsection 
        <div class="pull-right" style="margin-right: 2%;">
            <a class="btn btn-primary" href="{{ route('internacao.index') }}"> Voltar</a>
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
{!! Form::open(array('route' => 'internacao.store','method'=>'POST')) !!}
<br>
<div class="box box-danger" style="margin-left: 2%; margin-right: 2%; width: 96%;">
    <div class="row">
        <div class="box-body">
            <div class="col-xs-11 col-sm-11 col-md-11">
                <div class="form-group">
                    <strong>Paciente:</strong>
                    {!! Form::select('idpaciente', $pacientes, null, array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-1 col-sm-1 col-md-1">
                <div class="form-group">
                    <br>
                    <a class="btn btn-default" data-toggle="modal" data-target="#paciente"><i class="fa fa-plus"></i></a>
                </div>
            </div>
            <div class="col-xs-8 col-sm-8 col-md-8">
                <div class="form-group">
                    <strong>Clínica:</strong>
                    {!! Form::select('idclinica', $clinicas, null, array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Leito:</strong>
                    {!! Form::select('idleito', [] , null, array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-11 col-sm-11 col-md-11">
                <div class="form-group">
                    <strong>Diagnóstico:</strong>
                    {!! Form::select('idcid10', $cid10s , null, array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
<div class="modal fade" id="paciente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {!! Form::open(array('route' => 'paciente.store','method'=>'POST')) !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Cadastrar paciente</h4>
            </div>
            <div class="modal-body">
                <div class="box box-danger" style="margin-left: 2%; margin-right: 2%; width: 96%;">
                    <div class="row">
                        <div class="box-body">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Nome completo:</strong>
                                    {!! Form::text('nomecompleto', null, array('placeholder' => 'Digite o nome completo do paciente','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Data de nascimento:</strong>
                                    {!! Form::date('nascimento', null, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Sexo:</strong>
                                    {!!Form::radio('sexo', 'm', true)  !!}M
                                    {!!Form::radio('sexo', 'f') !!}F
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>RG:</strong>
                                     {!! Form::text('rg', null, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>CPF:</strong>
                                     {!! Form::text('cpf', null, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                             <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Cartão SUS:</strong>
                                     {!! Form::text('cartaosus', null, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection