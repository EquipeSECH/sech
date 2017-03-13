@extends('layouts.app')

<link href="{{ asset('js/jquery-ui-themes-1.12.0/themes/base/jquery-ui.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/iziToast.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">


@section('main-content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        @section('contentheader_title')
        <div class="pull-left">
            <h2>Leitos</h2>
        </div>
        @endsection
        <div class="pull-right" style="margin-right: 2%;">
            @permission('leito-create')
            <a class="btn btn-success" href="{{ route('leito.create') }}"> Cadastrar leito</a>
            @endpermission
        </div>
    </div>
</div>
<br>,
<div class="box box-danger" style="margin-left: 2%; margin-right: 2%; width: 96%;">
    <div class="box-body">
        <table  id="table" class="table table-bordered table-hover dataTable">
            <thead>
                <tr>
                    <th class="text-center" width="4%">Nº</th>
                    <th class="text-center">Leito</th>
                    <th class="text-center">Observação</th>
                    <th class="text-center">Clínica</th>
                    <th class="text-center no-sort" width="14%">Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($leitos as $key => $leito)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $leito->leito }}</td>
                    <td>{{ $leito->observacao }}</td>
                    <td>{{ $leito->clinica->nome }}</td>
                    <td width="14%">
                        <a class="btn btn-default" href="{{ route('leito.show',$leito->id) }}">
                            <i class="fa fa-eye"> </i>
                        </a>
                        @permission('leito-edit')
                        <a class="btn btn-default" href="{{ route('leito.edit',$leito->id) }}">
                            <i class="fa fa-edit"> </i>
                        </a>
                        @endpermission
                        @permission('leito-delete')
                        {!! Form::open(['method' => 'DELETE','route' => ['leito.destroy', $leito->id],'style'=>'display:inline']) !!}
                        {{ Form::button('<i class=" fa fa-trash"></i>', array('class' => 'btn btn-default', 'type' => 'submit')) }}
                        <!--                        {!! Form::submit('Excluir', ['class' => 'btn btn-danger']) !!}-->
                        {!! Form::close() !!}
                        @endpermission
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>
</div>
{!! $leitos->render() !!}
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