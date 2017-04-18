@extends('layouts.app')

<script src = "{{ asset('js/jquery-3.1.0.js') }}" type = "text/javascript" ></script>
<script src = "{{ asset('js/jquery.maskedinput.js') }}" type = "text/javascript" ></script>
<script src = "{{ asset('js/jquery-ui-1.12.0/jquery-ui.js') }}" type = "text/javascript" ></script>
<link href="{{ asset('js/jquery-ui-themes-1.12.0/themes/base/jquery-ui.css') }}" rel="stylesheet">

@section('main-content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        @section('contentheader_title')
        <div class="pull-left">
            Internar paciente
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
{!! Form::open(array('route' => 'internacao.store','method'=>'POST')) !!}
<br>
<div class="box box-primary" style="margin-left: 2%; margin-right: 2%; width: 96%;">
    <div class="row">
        <div class="box-body">
            <div class="col-xs-11 col-sm-11 col-md-11">
                <div class="form-group">
                    <strong>Paciente:</strong>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="glyphicon glyphicon-user"></i>
                        </span>
                        {!! Form::select('idpaciente', $pacientes, null, array('class' => 'form-control')) !!}
                    </div>
                </div>
            </div>
            <div class="col-xs-1 col-sm-1 col-md-1">
                <div class="form-group">
                    <br>
                    <a class="btn btn-primary" data-toggle="modal" data-target="#paciente" title="Adicionar paciente"><i class="fa fa-plus" style="color: #fff;"></i></a>
                </div>
            </div>
            <div class="col-xs-9 col-sm-9 col-md-9">
                <div class="form-group">
                    <strong>Clínica:</strong>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-hospital-o"></i>
                        </span>
                        {!! Form::select('idclinica', $clinicas, null, array('class' => 'form-control')) !!}
                    </div>
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Leito:</strong>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-hotel"></i>
                        </span>
                        {!! Form::select('idleito', $leitos , null, array('class' => 'form-control')) !!}
                    </div>
                </div>
            </div>
            <div class="col-xs-8 col-sm-8 col-md-8">
                <div class="form-group">
                    <strong>Diagnóstico:</strong>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-paste"></i>
                        </span>
                        {!! Form::select('idcid10', $cid10s , null, array('class' => 'form-control')) !!}
                    </div>
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Data de admissão:</strong>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span>
                        {!! Form::text('dataadmissao', $dataadmissao, array('class' => 'form-control', 'id' => 'dataadmissao')) !!}
                    </div>
                </div>
            </div>
            <div class="pull-right" style="margin-right: 1%;">
                <br>
                <a class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Voltar" href="{{ route('internacao.index') }}"><i class="fa fa-mail-reply"></i></a>
                <button type="submit" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Salvar"><i class="fa fa-save"></i></button>
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
                <h4 class="modal-title" id="myModalLabel"><strong>Cadastrar paciente</strong></h4>
            </div>
            <div class="modal-body">
                <div class="box box-primary" style="margin-left: 2%; margin-right: 2%; width: 96%;">
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
                                    {!! Form::text('rg', null, array('class' => 'form-control', 'id' => 'rg')) !!}
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>CPF:</strong>
                                    {!! Form::text('cpf', null, array('class' => 'form-control', 'id' => 'cpf')) !!}
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


<script>
jQuery(function ($) {
    $("#rg").mask("99.999.999-99");
});

jQuery(function ($) {
    $("#cpf").mask("999.999.999-99");
});

jQuery(function ($) {
    $("#admissao").mask("99/99/9999");
});
</script>