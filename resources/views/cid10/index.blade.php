@extends('layouts.app')

@section('main-content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        @section('contentheader_title')
        <div class="pull-left">
            <h2>Classificação Internacional de Doenças</h2>
        </div>
        @endsection
        <div class="pull-right">
            @permission('cid-create')
            <a class="btn btn-success" href="{{ route('cid10.create') }}"> Cadastrar CID10</a>
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
        <th>Código</th>
        <th>Descrição</th>
        <th width="280px">Ação</th>
    </tr>
    @foreach ($cids as $key => $cid)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $cid->codigo }}</td>
        <td>{{ $cid->descricao }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('cid10.show',$clinica->id) }}">Visualizar</a>
            @permission('cid-edit')
            <a class="btn btn-primary" href="{{ route('cid10.edit',$clinica->id) }}">Editar</a>
            @endpermission
            @permission('cid-delete')
            {!! Form::open(['method' => 'DELETE','route' => ['cid10.destroy', $cid->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Excluir', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
            @endpermission
        </td>
    </tr>
    @endforeach
</table>
{!! $cids->render() !!}
@endsection