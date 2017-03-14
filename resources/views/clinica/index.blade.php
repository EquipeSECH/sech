@extends('layouts.app')

<link href="{{ asset('js/jquery-ui-themes-1.12.0/themes/base/jquery-ui.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/iziToast.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">

@section('main-content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        @section('contentheader_title')
        <div class="pull-left">
            <h2>Clínicas</h2>
        </div>
        @endsection
        <div class="pull-right" style="margin-right: 2%;">
            @permission('clinica-create')
            <a class="btn btn-default"  href="{{ route('clinica.create') }}">Cadastrar</a>
            @endpermission
        </div>
    </div>
</div>
<br>
<div class="box box-danger" style="margin-left: 2%; margin-right: 2%; width: 96%;">
    <div class="box-body">
        <div class="table-responsive">
            <table id="table" class="table table-bordered table-hover dataTable" role="grid">
                <thead>
                    <tr>
                        <th class="text-center" width="4%">Nº</th>
                        <th class="text-center">Nome</th>
                        <th class="text-center">Descrição</th>
                        <th class="text-center no-sort" width="14%">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clinicas as $key => $clinica)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $clinica->nome }}</td>
                        <td>{{ $clinica->descricao }}</td>
                        <td width="14%">
                            <a class="btn btn-default" href="{{ route('clinica.show',$clinica->id) }}">
                                <i class="fa fa-eye"> </i>
                            </a>
                            @permission('clinica-edit')
                            <a class="btn btn-default" href="{{ route('clinica.edit',$clinica->id) }}">
                                <i class="fa fa-edit"> </i>
                            </a>
                            @endpermission
                            @permission('clinica-delete')
                            {!! Form::open(['method' => 'DELETE','route' => ['clinica.destroy', $clinica->id],'style'=>'display:inline']) !!}
                            {{ Form::button('<i class=" fa fa-trash"></i>', array('class' => 'btn btn-default', 'type' => 'submit')) }}
                            <!--{!! Form::submit('Excluir', ['class' => 'btn btn-danger']) !!}-->
                            {!! Form::close() !!}
                            @endpermission
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
<script src = "{{ asset('js/jquery-3.1.0.js') }}"></script>
<script src = "{{ asset('js/jquery.maskedinput.js') }}" type = "text/javascript" ></script>
<script src = "{{ asset('js/jquery-ui-1.12.0/jquery-ui.js') }}" type = "text/javascript" ></script>
<script src="{{ asset('js/iziToast.min.js')}}" type="text/javascript"></script>
<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}" type = "text/javascript"></script>
<script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>

<script>
$(function ($) {
    $('#table').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "lengthMenu": [[10, 30, 50, -1], [10, 30, 50, "Todos"]],
        "columnDefs": [{
                "targets": 'no-sort',
                "orderable": false,
            }]
    });
});
</script>
<script>
    @if (Session::get('success'))
            $(function () {
                var msg = "{{Session::get('success')}}"
                iziToast.success({
                    title: 'OK',
                    message: msg,
                });
            });
            @endif
</script>

