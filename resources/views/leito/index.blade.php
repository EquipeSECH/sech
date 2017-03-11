@extends('layouts.app')

@section('main-content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        @section('contentheader_title')
        <div class="pull-left">
            <h2>Leitos</h2>
        </div>
        @endsection
        <div class="pull-right">
            @permission('leito-create')
            <a class="btn btn-success" href="{{ route('leito.create') }}"> Cadastrar leito</a>
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
        <th>Leito</th>
        <th>Observação</th>
        <th>Clínica</th>
        <th width="280px">Ação</th>
    </tr>
    @foreach ($leitos as $key => $leito)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $leito->leito }}</td>
        <td>{{ $leito->observacao }}</td>
        <td>{{ $leito->clinica->nome }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('leito.show',$leito->id) }}">Visualizar</a>
            @permission('leito-edit')
            <a class="btn btn-primary" href="{{ route('leito.edit',$leito->id) }}">Editar</a>
            @endpermission
            @permission('leito-delete')
            {!! Form::open(['method' => 'DELETE','route' => ['leito.destroy', $leito->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Excluir', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
            @endpermission
        </td>
    </tr>
    @endforeach
</table>
{!! $leitos->render() !!}
@endsection