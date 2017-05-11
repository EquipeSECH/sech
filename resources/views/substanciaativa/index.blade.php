@extends('layouts.app')

<link href="{{ asset('js/jquery-ui-themes-1.12.0/themes/base/jquery-ui.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">

@section('main-content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        @section('contentheader_title')
        <div class="pull-left">
            <h2>Substância Ativa</h2>
        </div>
        @endsection
        <div class="pull-right" style="margin-right: 2%;">
            @permission('substanciaativa-create')
            
            <div class="pull-right" style="margin-right: 1%;">
                <a class="btn btn-default" href="{{ route('substanciaativa.create') }}" title="Cadastrar" data-toggle="tooltip"> 
                    <i class="fa  fa-plus"></i>
                </a>
            </div>
            
            @endpermission
        </div>
    </div>
</div>
<br>
<div class="box box-primary " style="margin-left: 2%; margin-right: 2%; width: 96%;">
    <div class="box-body">
        <div class="table-responsive col-lg-12 col-md-12 col-sm-12">
            <table id="table" class="table table-bordered table-hover dataTable" role="grid">
                <thead>
                    <tr>
                        <th>Nº</th>
                        <th>Substância Ativa</th>                
                        <th>Classificação</th>
                        <th class="text-center no-sort">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($substanciaativas as $key => $substanciaativa)
                    <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $substanciaativa->nome}}</td> 
                            <td>
                            <?php 
                                    switch ($substanciaativa->classificacao) {
                                        case 0:
                                            echo "<span class='label label-danger'>Controlado da portaria 344/98</span>";
                                            break;
                                        case 1:
                                            echo"<span class='label label-warning'>Potencialmente perigosos</span>";
                                            break;
                                        case 2:
                                            echo"<span class='label label-success'>Antibiótico de uso restrito</span>";
                                            break;
                                        case 3:
                                            echo"<span class='label label-primary'>Antibiótico</span>";
                                            break;
                                        case 4:
                                            echo"<span class='label label-default'>Outros</span>";
                                            break;
                                    }
                                ?>
                            </td>
                            <td width="14.5%">
                            <a class="btn btn-default"  data-target="#{{$substanciaativa->id}}" data-toggle="modal" title="Visualizar">
                                <i class="fa fa-eye"> </i>
                            </a>
                            @permission('substanciaativa-edit')
                            <a class="btn btn-default" title="Editar" href="{{ route('substanciaativa.edit',$substanciaativa->id) }}">
                                <i class="fa fa-edit"> </i>
                            </a>
                            @endpermission
                            @permission('substanciaativa-delete')
                            <a class="btn btn-default" data-toggle="modal" data-target="#e{{$substanciaativa->id}}" title="Excluir">
                                <i class="fa fa-trash"> </i>
                            </a>
                            @endpermission

                            @if(!empty($substanciaativa))
                            <div class="modal fade" id="e{{$substanciaativa->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                                            {!! Form::open(['method' => 'DELETE','route' => ['substanciaativa.destroy', $substanciaativa->id],'style'=>'display:inline']) !!}
                                            {!! Form::submit('OK', ['class' => 'btn btn-primary']) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif 

                            <div class="modal fade" id="{{$substanciaativa->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel"><strong>Substancia ativa: {{ $substanciaativa->nome }}</strong></h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <strong>Classificação:</strong>
                                                <?php
							$nomeclassificacao = ''; 
							switch ($substanciaativa->classificacao) {
							case 0:
								$nomeclassificacao = 'Controlado da portaria 344/98';
								echo"$nomeclassificacao";
								break;
							case 1:
								$nomeclassificacao = 'Potencialmente perigosos';
								echo"$nomeclassificacao";
								break;
							case 2:
								$nomeclassificacao = 'Antibiótico de uso restrito';
								echo"$nomeclassificacao";
								break;
							case 3:
								$nomeclassificacao = 'Antibiótico';
								echo"$nomeclassificacao";
								break;
							case 4:
								$nomeclassificacao = 'Outros';
								echo"$nomeclassificacao";
								break;
							}
						?>                           
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <strong>Contraindicação: </strong>
                                                 {{ $substanciaativa->contraindicacao }}
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
    $('#table2').DataTable({
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

