@extends('layouts.app')

@section('main-content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        @section('contentheader_title')
        <div class="pull-left">
            <h2>Editar fornecedor</h2>
        </div>
        @endsection 
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('fornecedor.index') }}"> Voltar</a>
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
{!! Form::model($fornecedor, ['method' => 'PATCH','route' => ['fornecedor.update', $fornecedor->id]]) !!}
<br>
<div class="box box-primary" style="margin-left: 2%; margin-right: 2%; width: 96%;">
    <div class="row">
        <div class="box-body">
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Razão Social:</strong>
                    {!! Form::text('razaosocial', null, array('placeholder' => 'Digite o nome fantasia','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Nome Fantasia:</strong>
                    {!! Form::text('nomefantasia', null, array('placeholder' => 'Digite o nome fantasia','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>CNPJ:</strong>
                    {!! Form::text('cnpj', null, array('placeholder' => '','class' => 'form-control')) !!}
                </div>
            </div>
              <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Telefone:</strong>
                    {!! Form::text('telefone', null, array('placeholder' => '','class' => 'form-control')) !!}
                </div>
            </div>
             <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Endereço:</strong>
                    {!! Form::text('endereco', null, array('placeholder' => '','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Email:</strong>
                    {!! Form::text('email', null, array('placeholder' => 'exemplo@exemplo.com','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Telefone:</strong>
                    {!! Form::text('telefone', null, array('placeholder' => '','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Nome do responsável:</strong>
                    {!! Form::text('nomeresponsavel', null, array('placeholder' => 'Nome do Fornecedor','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Telefone do responsável:</strong>
                    {!! Form::text('nomeresponsavel', null, array('placeholder' => 'Nome do Fornecedor','class' => 'form-control')) !!}
                </div>
            </div>
          
             <div class="col-xs-12 col-sm-12 col-md-12">
                 <div class="form-group">
                 <strong>Telefone do responsável:</strong>
                <div class="input-group">
                    <span class="input-group-phone">
                        <i class="fa fa-phone"></i>
                    </span>
                    {!! Form::text('telefoneresponsavel', null, array('placeholder' => 'Nome do Fornecedor','class' => 'form-control')) !!}
                </div>
                 </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
@endsection