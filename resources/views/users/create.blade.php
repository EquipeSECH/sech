@extends('layouts.app')

@section('main-content')
<div class="row">
    <div class="col-lg-12 margin-tb">
         @section('contentheader_title')
        <div class="pull-left">
            <h2>Cadastrar usuário</h2>
        </div>
         @endsection  
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('users.index') }}"> Voltar</a>
        </div>
    </div>
</div>
@if (count($errors) > 0)
<div class="alert alert-danger"
     <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
{!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nome completo:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Digite seu nome completo','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:</strong>
            {!! Form::text('email', null, array('placeholder' => 'Digite seu email','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Senha:</strong>
            {!! Form::password('password', array('placeholder' => 'Digite sua senha','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Confirmar senha:</strong>
            {!! Form::password('confirm-password', array('placeholder' => 'Confirmar senha','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>CPF:</strong>
            {!! Form::text('cpf', null, array('placeholder' => 'Digite seu CPF','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>RG:</strong>
            {!! Form::text('rg', null, array('placeholder' => 'Digite seu rg','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nascimento:</strong>
            {!! Form::text('nascimento', null, array('placeholder' => 'Digite sua data de nascimento','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Telefone:</strong>
            {!! Form::text('telefone', null, array('placeholder' => 'Digite seu telefone','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Endereço:</strong>
            {!! Form::text('endereco', null, array('placeholder' => 'Digite seu endereço','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Papel:</strong>            
            {!! Form::select('fk_role', $roles, null, array('placeholder'=>'--Selecione--', 'class' => 'form-control', 'onchange' => 'papelAlerta()', 'id' => 'papel')) !!}
        </div>
    </div>           
    <div id="demo">
        
    </div>
    </div>   
    
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Salvar</button>
    </div>
</div>
{!! Form::close() !!}
@endsection

<script>
function papelAlerta() {
    var TextoCodigo1 = "";    
    var TextoCodigo2 = "";
    var papel = document.getElementById("papel").value;
    document.getElementById("demo").innerHTML = "You selected: " + papel;
    
    if (papel == 1){
        TextoCodigo = "<h1>texemplo</h1>";
    }
    else if (papel == 2){        
        TextoCodigo1 = "<div class='col-xs-12 col-sm-12 col-md-12'><div class='form-group'><strong>CRF:</strong>";
        TextoCodigo2 = "</div></div> <br><br>";
    }
    else if (papel == 3){
        alert("Médico");
    }s
    else if (papel == 4){
        alert("Dentista");
    } 
    else if (papel == 5){
        alert("Enfermeiro");
    }
       
    document.getElementById("demo").innerHTML = TextoCodigo1 + TextoCodigo2 ;

}
</script>
