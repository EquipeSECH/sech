@extends('layouts.app')

<link href="{{ asset('js/jquery-ui-themes-1.12.0/themes/base/jquery-ui.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/iziToast.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">

@section('main-content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        @section('contentheader_title')
        <div class="pull-left">
            Internações
        </div>
        @endsection
        <div class="pull-right" style="margin-right: 2%;">
            @permission('internacao-create')
            <a class="btn btn-default"  href="{{ route('internacao.create') }}">Internar paciente</a>
            @endpermission
        </div>
    </div>
</div>
<br>
<div class="box box-primary" style="margin-left: 2%; margin-right: 2%; width: 96%;">
    <div class="box-body">
        <div class="table-responsive col-lg-12 col-md-12 col-sm-12">
            <table id="table" class="table table-bordered table-hover dataTable" role="grid">
                <thead>
                    <tr>
                        <th class="text-center" width="4%">Nº</th>
                        <th class="text-center">Paciente</th>
                        <th class="text-center">Clínica</th>
                        <th class="text-center">Leito</th>
                        <th class="text-center">Diagnóstico</th>
                        <th class="text-center">Situação</th>
                        <th class="text-center no-sort" width="14%">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($internacoes as $key => $internacao)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $internacao->paciente->nomecompleto }}</td>
                        <td>{{ $internacao->leito->clinica->nome}}</td>
                        <td>{{ $internacao->leito->leito }}</td>
                        <td>{{ $internacao->cid10->descricao}}</td>
                        @if(empty($internacao->saida))
                        <td><span class="label label-warning">Internado</span></td>
                        @else
                        <td><span class="label label-success">Liberado</span></td>
                        @endif
                        <td width="14.5%">
                            <a class="btn btn-default" data-target="#{{$internacao->id}}" data-toggle="modal" title="Visualizar">
                                <i class="fa fa-eye"> </i>
                            </a>
                            @permission('internacao-edit')
                            @if(empty($internacao->saida))                 
                            <a class="btn btn-default" data-toggle="modal" data-target="#a{{$internacao->id}}" title="Alta">
                                <i class="fa  fa-check"> </i>
                            </a>
                            @else
                            <a class="btn btn-default" data-toggle="modal" data-target="#a{{$internacao->id}}" title="Alta" disabled>
                                <i class="fa  fa-check"> </i>
                            </a>
                            @endif
                            @endpermission
                            @permission('internacao-delete')
                            <a class="btn btn-default" data-toggle="modal" data-target="#e{{$internacao->id}}" title="Excluir">
                                <i class="fa fa-trash"> </i>
                            </a>
                            @endpermission

                            @if(!empty($internacao))
                            <div class="modal fade" id="e{{$internacao->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                                            {!! Form::open(['method' => 'DELETE','route' => ['internacao.destroy', $internacao->id],'style'=>'display:inline']) !!}
                                            {!! Form::submit('OK', ['class' => 'btn btn-primary']) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="a{{$internacao->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Alta</h4>
                                        </div>
                                        <div class="modal-body">
                                            Liberar paciente?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                            {!! Form::open(['method' => 'PATCH','route' => ['internacao.update', $internacao->id],'style'=>'display:inline']) !!}
                                            {!! Form::submit('OK', ['class' => 'btn btn-primary']) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif 

                            <div class="modal fade" id="{{$internacao->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel"><strong>Dados da clínica do paciente: {{$internacao->paciente->nomecompleto}}</strong></h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <strong>Diagnóstico:</strong>
                                                    {{$internacao->cid10->descricao}}
                                                    <br><br>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <strong>Clínica:</strong>
                                                    {{$internacao->clinica->nome}}
                                                    <br><br>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <strong>Leito:</strong>
                                                    {{$internacao->leito->leito}}
                                                    <br><br>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <strong>Admissão:</strong>
                                                    {{$internacao->dataadmissao}}
                                                    <br><br>
                                                </div>
                                                @if(!empty($internacao->saida))
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <strong>Saída:</strong>
                                                    {{$internacao->saida}}
                                                    <br><br>
                                                </div>
                                                @endif
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
                swal({
                    title: '',
                    text: msg,
                    confirmButtonColor: "#66BB6A",
                    type: "success",
                    html: true
                });
            });
            @endif
</script>

