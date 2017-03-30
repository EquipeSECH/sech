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
    </div>
</div>
<br>
<div class="box box-danger" style="margin-left: 2%; margin-right: 2%; width: 96%;">
    <div class="box-body">
        <div class="table-responsive col-lg-12 col-md-12 col-sm-12">
            <table  id="table" class="table table-bordered table-hover dataTable">
                <thead>
                    <tr>
                        <th class="text-center" width="4%">Nº</th>
                        <th class="text-center">Leito</th>
                        <th class="text-center">Observação</th>
                        <th class="text-center">Clínica</th>
                        <th class="text-center no-sort" width="14%">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($leitos as $key => $leito)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $leito->leito }}</td>
                        <td>{{ $leito->observacao }}</td>
                        <td>{{ $leito->clinica->nome }}</td>
                        <td width="10%">
                            <a class="btn btn-default" data-target="#{{$leito->id}}" data-toggle="modal" href="{{ route('leito.show',$leito->id) }}">
                                <i class="fa fa-eye"> </i>
                            </a>
                            @permission('leito-delete')
                            {!! Form::open(['style'=>'display:inline']) !!}
                            {{ Form::button('<i class=" fa fa-trash"></i>', array('class' => 'btn btn-default', 'data-toggle' => 'modal', 'data-target' => '#excluir', 'title' => 'Excluir')) }}

                            <!--                        {!! Form::submit('Excluir', ['class' => 'btn btn-danger']) !!}-->
                            {!! Form::close() !!}
                            @endpermission
                            <div class="modal fade" id="{{$leito->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel"><strong>Leito: {{$leito->leito}}</strong></h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                        <strong>Clínica:</strong>
                                                        {{$leito->clinica->nome}}
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                        <strong>Observação:</strong>
                                                        {{$leito->observacao}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>
                    @endforeach
                </tbody>  
            </table>
        </div>          
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

@if(!empty($leito))
<div class="modal fade" id="excluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Excluir</h4>
            </div>
            <div class="modal-body">
                Tem certeza que deseja excluir?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                {!! Form::open(['method' => 'DELETE','route' => ['leito.destroy', $leito->id],'style'=>'display:inline']) !!}
                {!! Form::submit('OK', ['class' => 'btn btn-danger']) !!}
                {!! Form::hidden('flag', "index", array('class' => 'form-control')) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endif