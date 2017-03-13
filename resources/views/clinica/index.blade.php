@extends('layouts.app')

<script src = "{{ asset('js/jquery-3.1.0.js') }}"></script>
<script src = "{{ asset('js/jquery.maskedinput.js') }}" type = "text/javascript" ></script>
<script src = "{{ asset('js/jquery-ui-1.12.0/jquery-ui.js') }}" type = "text/javascript" ></script>
<link href="{{ asset('js/jquery-ui-themes-1.12.0/themes/base/jquery-ui.css') }}" rel="stylesheet">
<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}" type = "text/javascript"></script>
<script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">

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
<br>
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
<br>
@endif
<div class="box box-danger">
    <div class="box-body">
        <table id="table" class="table table-bordered table-hover dataTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th width="280px">Ação</th>
                </tr>
            </thead>
            <tbody>
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
            </tbody>
            @endforeach
        </table>
    </div>
</div>
@endsection

<script>
$(function ($) {
    $('#table').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]]
    });

});
</script>