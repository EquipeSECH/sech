@extends('layouts.app')

<link href="{{ asset('js/jquery-ui-themes-1.12.0/themes/base/jquery-ui.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/iziToast.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">

@section('main-content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        @section('contentheader_title')
        <div class="pull-left">
            Cadastrar clínica > cadastrar leito
        </div>
        @endsection 
    </div>
</div>

@if (count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<br>
<div class="box box-danger" style="margin-left: 2%; margin-right: 2%; width: 96%;">
    <div class="row">
        <div class="box-body">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nome:</strong>
                    {{$clinica[0]->nome}}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Descrição:</strong>
                    {{$clinica[0]->descricao}}
                </div>
            </div>
            <div class="col-xs-11 col-sm-11 col-md-11">
                <div class="form-group">
                    <strong>Total de leitos:</strong>
                    @if(empty($clinica[0]->leitos))
                    {{"-"}}
                    @else
                    {{count($clinica[0]->leitos)}}
                    @endif
                    <a class="btn btn-default" style="border-radius: 45%; margin-left: 2%;" data-toggle="modal" data-target="#leito" title="Adicionar leito"><i class="fa fa-plus"></i></a>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="box box-danger" style="margin-left: 2%; margin-right: 2%; width: 96%;">
                    <h4><center><b>Leitos</b></center></h4>
                    <div class="box-body">
                        <div class="table-responsive col-lg-12 col-md-12 col-sm-12">
                            <table id="table" class="table table-condensed table-bordered table-hover dataTable" role="grid">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nome</th>
                                        <th class="text-center">Observação</th>
                                        <th class="text-center">Opções</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($clinica[0]->leitos))
                                    @foreach ($clinica[0]->leitos as $key => $leito)
                                    <tr>
                                        <td>{{$leito->leito}}</td>
                                        <td>{{$leito->observacao}}</td>
                                        <td width="10.5%">
                                            @permission('clinica-edit')
                                            <a class="btn btn-default" data-toggle="modal" data-target="#{{$leito->id}}">
                                                <i class="fa fa-edit"> </i>
                                            </a>
                                            @endpermission
                                            @permission('clinica-delete')
                                            {!! Form::open(['method' => 'DELETE','route' => ['leito.destroy', $leito->id],'style'=>'display:inline']) !!}
                                            {{ Form::button('<i class=" fa fa-trash"></i>', array('class' => 'btn btn-default', 'type' => 'submit')) }}
                                            <!--{!! Form::submit('Excluir', ['class' => 'btn btn-danger']) !!}-->
                                             {!! Form::hidden('flag', "cadastrar", array('class' => 'form-control')) !!}
                                            {!! Form::close() !!}
                                            @endpermission
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pull-right" style="margin-right: 1%;">
                <a href="{{route('clinica.index')}}"  class="btn btn-default">Finalizar</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="leito" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {!! Form::open(array('route' => ['leito.store', $clinica[0]->id],'method'=>'POST')) !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><strong>Cadastrar leito</strong></h4>
            </div>
            <div class="modal-body">
                <div class="box box-danger" style="margin-left: 2%; margin-right: 2%; width: 96%;">
                    <div class="row">
                        <div class="box-body">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Leito:</strong>
                                    {!! Form::text('leito', null, array('placeholder' => 'Digite o código','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Observação:</strong>
                                    {!! Form::textarea('observacao', null, array('placeholder' => 'Descrição','class' => 'form-control','style'=>'height:100px')) !!}
                                </div>
                            </div>
                            {!! Form::hidden('idclinica', $clinica[0]->id, array('class' => 'form-control')) !!}
                            {!! Form::hidden('flag', "cadastrar", array('class' => 'form-control')) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-danger">Salvar</button>
            </div>
            {!! Form::close() !!}
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