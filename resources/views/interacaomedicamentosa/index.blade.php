@extends('layouts.app')

@section('main-content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        @section('contentheader_title')
        <div class="pull-left">
            <h2>Interações Medicamentosas</h2>
        </div>
        @endsection
        <div class="pull-right">
            @permission('interacaomedicamentosa-create')
            <a class="btn btn-success" href="{{ route('interacaomedicamentosa.create') }}"> Cadastrar interação medicamnetosa</a>
            @endpermission
        </div>
        <br><br>
    </div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<br><br>
<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Substâncias</th>
        <th>Gravidade</th>
        <th>Consequência</th>
        <th width="280px">Ação</th>
    </tr>
    @foreach ($interacaomedicamentosas as $key => $interacaomedicamentosa)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $interacaomedicamentosa->substanciaativa1->nome}} e {{ $interacaomedicamentosa->substanciaativa2->nome }} </td>        
        <td>{{ $interacaomedicamentosa->gravidade}}</td>
        <td>{{ $interacaomedicamentosa->consequencia }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('interacaomedicamentosa.show',$interacaomedicamentosa->id) }}">Visualizar</a>
            @permission('interacaomedicamentosa-edit')
            <a class="btn btn-primary" href="{{ route('interacaomedicamentosa.edit',$interacaomedicamentosa->id) }}">Editar</a>
            @endpermission
            @permission('interacaomedicamentosa-delete')
            {!! Form::open(['method' => 'DELETE','route' => ['interacaomedicamentosa.destroy', $interacaomedicamentosa->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Excluir', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
            @endpermission
        </td>
    </tr>
    @endforeach
</table>
{!! $interacaomedicamentosas->render() !!}
@endsection