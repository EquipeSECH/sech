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
            Editar internação
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
<br>
@endif
{!! Form::model($internacao, ['method' => 'PATCH','route' => ['internacao.update', $internacao->id]]) !!}
<div class="box box-primary" style="margin-left: 2%; margin-right: 2%; width: 96%;">
    <div class="row">
        <div class="box-body">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Paciente:</strong>
                    {{$internacao->paciente->nomecompleto}}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Data de nascimento:</strong>
                    {{$internacao->paciente->nascimento}}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>RG:</strong>
                    {{$internacao->paciente->rg}}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>CPF:</strong>
                    {{$internacao->paciente->cpf}}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Cartão do SUS:</strong>
                    {{$internacao->paciente->cartaosus}}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Diagnóstico:</strong>
                    {{$internacao->cid10->descricao}}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Clínica:</strong>
                    {{$internacao->cid10->descricao}}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Leito:</strong>
                    {{$internacao->leito->leito}}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Opções:</strong>
                    <input type="radio" name="opc" value="a"> Alta
                    <input type="radio" name="opc" value="t"> Transferência
                </div>
            </div>

            <div class="pull-right" style="margin-right: 1%;">
                <button type="submit" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Salvar"><i class="fa fa-save"></i></button>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
<script>
    $(document).ready(function () {
        $("input[name$='opc']").click(function () {
            var test = $(this).val();
            
            if(test == "a"){
               //mostrar div 
            }
            else{
                //mostrar div
            }
            
        });
    });
</script>
@endsection
