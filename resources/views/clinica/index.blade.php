@extends('layouts.app')

@section('main-content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        @section('contentheader_title')
        <div class="pull-left">
            <h2>Clínicas</h2>
        </div>
        @endsection
        <div class="pull-right">
            @permission('clinica-create')
            <a class="btn btn-success" href="{{ route('clinica.create') }}"> Cadastrar clínica</a>
            @endpermission
        </div>
    </div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Nome</th>
        <th>Descrição</th>
        <th width="280px">Ação</th>
    </tr>
    @foreach ($clinicas as $key => $clinica)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $clinica->nome }}</td>
        <td>{{ $clinica->descricao }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('clinica.show',$clinica->id) }}">Visualizar</a>
            @permission('clinica-edit')
            <a class="btn btn-primary" href="{{ route('clinica.edit',$clinica->id) }}">Editar</a>
            @endpermission
            @permission('clinica-delete')
            {!! Form::open(['method' => 'DELETE','route' => ['clinica.destroy', $clinica->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Excluir', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
            @endpermission
        </td>
    </tr>
    @endforeach
</table>
{!! $clinicas->render() !!}
@endsection