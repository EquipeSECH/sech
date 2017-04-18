@extends('layouts.app')

@section('main-content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        @section('contentheader_title')
        <div class="pull-left">
            Editar usuário
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
{!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
<div class="box box-primary" style="margin-left: 2%; margin-right: 2%; width: 96%;">
    <div class="row">
        <div class="box-body">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Nome completo:</strong>
                    {!! Form::text('name', null, array('placeholder' => 'Digite seu nome completo','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Email:</strong>
                    {!! Form::text('email', null, array('placeholder' => 'Digite seu email','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Senha:</strong>
                    {!! Form::password('password', array('placeholder' => 'Digite sua senha','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Confirmar senha:</strong>
                    {!! Form::password('confirm-password', array('placeholder' => 'Confirmar senha','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>CPF:</strong>
                    {!! Form::text('cpf', null, array('placeholder' => 'Digite seu CPF','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>RG:</strong>
                    {!! Form::text('rg', null, array('placeholder' => 'Digite seu rg','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Nascimento:</strong>
                    {!! Form::date('nascimento', null, array('placeholder' => 'Digite sua data de nascimento','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Telefone:</strong>
                    {!! Form::text('telefone', null, array('placeholder' => 'Digite seu telefone','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-8 col-sm-8 col-md-8">
                <div class="form-group">
                    <strong>Endereço:</strong>
                    {!! Form::text('endereco', null, array('placeholder' => 'Digite seu endereço','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Papel:</strong>            
                    {!! Form::select('fk_role', $roles, null, array('placeholder'=>'--Selecione--', 'class' => 'form-control', 'id' => 'papel')) !!}
                </div>
            </div> 
            <!-------- dados de farmacêutico -------->
            <div id="far">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>CRF:</strong>
                        {!! Form::text('codigoprofissional', null, array('placeholder' => 'Digite seu CRF','class' => 'form-control')) !!}
                    </div>
                </div>
            </div>
            <!-------- dados de médico -------->
            <div id="med">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>CRM:</strong>
                        {!! Form::text('codigoprofissional', null, array('placeholder' => 'Digite seu CRM','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Especialidade:</strong>                    
                        {!! Form::select('idespecialidade', $especialidades, null, array('class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Assinatura:</strong>
                        {!! Form::file('assinatura', null, array('placeholder' => '','class' => 'form-control', 'style'=>'height:100px')) !!}
                    </div>
                </div>   
            </div>
            <!-------- dados de dentista -------->
            <div id="den">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>CRO:</strong>
                        {!! Form::text('codigoprofissional', null, array('placeholder' => 'Digite seu CRO','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Especialidade:</strong>                    
                        {!! Form::select('idespecialidade', $especialidades, null, array('class' => 'form-control')) !!}
                    </div>
                </div>
            </div>
            <!-------- dados de enfermeiro -------->
            <div id="enf">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>COREN:</strong>
                        {!! Form::text('codigoprofissional', null, array('placeholder' => 'Digite seu COREN','class' => 'form-control')) !!}
                    </div>
                </div>
            </div>
            <!------------------------------------->
            <div class="pull-right" style="margin-right: 1%;">
                <button type="submit" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Salvar" @click="adicionar"><i class="fa fa-save"></i></button>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}

<script type="text/javascript">
$(document).ready(function () {
    $("#med").hide();
    $("#den").hide();
    $("#far").hide();
    $("#enf").hide();
    $("#papel").change(function () {
        var funcao = document.getElementById('papel').value;
        if (funcao == '2') { //farmaceutico
            $("#med").hide();
            $("#den").hide();
            $("#far").show();
            $("#enf").hide();
        } else if (funcao == '3') { //médico
            $("#med").show();
            $("#den").hide();
            $("#far").hide();
            $("#enf").hide();
        } else if (funcao == '4') { //dentista
            $("#med").hide();
            $("#den").show();
            $("#far").hide();
            $("#enf").hide();
        } else if (funcao == '5') { //enfermeiro
            $("#med").hide();
            $("#den").hide();
            $("#far").hide();
            $("#enf").show();
        } else {
            $("#med").hide();
            $("#den").hide();
            $("#far").hide();
            $("#enf").hide();
        }
    });
});
</script>

@endsection