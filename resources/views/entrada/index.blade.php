@extends('layouts.app')

<link href="{{ asset('js/jquery-ui-themes-1.12.0/themes/base/jquery-ui.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">

@section('main-content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        @section('contentheader_title')
        <div class="pull-left">
            <h2>Entradas</h2>
        </div>
        @endsection
        <div class="pull-right" style="margin-right: 2%;">
            @permission('entrada-create')
            <a class="btn btn-default"  href="{{ route('entrada.create') }}">Cadastrar</a>
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
                        <th class="text-center">Nº</th>
                        <th class="text-center">Lote</th>
                        <th class="text-center">Medicamento</th>
                        <th class="text-center">Quantidade</th>
                        <th class="text-center">Data</th>
                        <th class="text-center">Farmacêutico(a)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0 ?>
                    @foreach ($entradas as $key => $entrada)
                        <td>{{ ++$i }}</td>
                        <?php
                            echo('<td>'.$entrada->estoque->lote.'</td>');
                            $medicamento = $entrada->estoque->medicamentocomercial;
                        ?>
                <td>
                        @foreach ($medicamento->medicamentosubstancias as $key => $medicamentosubstancia)
                            {{$medicamentosubstancia->substanciaativa->nome}}
                            {{$medicamentosubstancia->quantidadedose}}
                            <?php
                                $nomeunidade = ''; 
                                switch ($medicamentosubstancia->unidadedose) {
                                    case 0:$nomeunidade = 'mcg'; break;
                                    case 1:$nomeunidade = 'mg';break;
                                    case 2:$nomeunidade = 'g';break;
                                    case 3:$nomeunidade = 'UI';break;
                                    case 4: $nomeunidade = 'unidades'; break;
                                    case 5: $nomeunidade = 'mg/g';break;
                                    case 6: $nomeunidade = 'UI/g';break;
                                    case 7:$nomeunidade = 'mEq/mL'; break;
                                    case 8:$nomeunidade = 'mg/gota'; break;
                                    case 9:$nomeunidade = 'mcg/mL';break;
                                    case 10:$nomeunidade = 'UI/mL';break;
                                    case 11: $nomeunidade = 'mEq';break;
                                }
                                echo"$nomeunidade, ";
                            ?>
                        @endforeach
                        {{ $medicamento->formafarmaceuticas->nome}}
                         <?php
                                $conteudo = ''; 
                                switch ($medicamento->nomeconteudo) {
                                    case 0:$conteudo = 'Frasco'; break;
                                    case 1:$conteudo = 'FA (frasco ampola)';break;
                                    case 2:$conteudo = 'AMP (ampola)'; break;
                                    case 3:$conteudo = 'Caixa';break;
                                    case 4:$conteudo = 'Envelope';break;
                                    case 5:$conteudo = 'Tubo'; break;
                                    case 6:$conteudo = 'Bolsa'; break;
                                    case 7:$conteudo = 'Pote'; break;
                                }
                                echo"$conteudo com $medicamento->quantidadeconteudo";
                           
                                $uc = ''; 
                                switch ($medicamento->unidadeconteudo) {
                                    case 0:$uc = 'mcg'; break;
                                    case 1:$uc = 'mg'; break;
                                    case 2:$uc = 'g'; break;
                                    case 3:$uc = 'UI';break;
                                    case 4:$uc = 'unidades';break;
                                    case 5:$uc = 'mg/g';break;
                                    case 6:$uc = 'UI/g';break;
                                    case 7:$uc = 'mEq/mL'; break;
                                    case 8:$uc = 'mg/gota';break;
                                    case 9:$uc = 'mcg/mL'; break;
                                    case 10:$uc = 'UI/mL'; break;
                                    case 11: $uc = 'mEq'; break;
                                }
                                echo"$uc, ";
                            ?> 
                        <?php
                            echo('<td>'.$entrada->quantidade.'</td>');
                            echo('<td>'.$entrada->created_at.'</td>');
                            echo('<td>'.$entrada->usuario->name.'</td>');
                       ?>      
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Saídas</h2>
        </div>    
        <br>
        <div class="pull-right" style="margin-right: 2%;">
           <!--<a class="btn btn-default" style=" margin-left: 2%;" data-toggle="modal" data-target="#substancia" title="Adicionar substância ativa">
                Cadastrar
            </a>-->  
           <div class="pull-right" style="margin-right: 2%;">
            <a class="btn btn-default"  href="{{ route('saidamotivo.index') }}">Cadastrar</a>
            </div>
        </div>
    </div>
</div>
<br>
<div class="box box-primary" style="margin-left: 2%; margin-right: 2%; width: 96%;">
    <div class="box-body">
        <div class="table-responsive col-lg-12 col-md-12 col-sm-12">
            <table  id="table2" class="table table-bordered table-hover dataTable">
               <thead>
                    <tr>
                        <th class="text-center">Nº</th>
                        <th class="text-center">Lote</th>
                        <th class="text-center">Medicamento</th>
                        <th class="text-center">Quantidade</th>
                        <th class="text-center">Motivo</th>
                        <th class="text-center">Data</th>
                        <th class="text-center">Farmacêutico(a)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0 ?>
                    @foreach ($saidamotivos as $key => $saidamotivo)
                        <td>{{ ++$i }}</td>
                        <?php
                            echo('<td>'.$saidamotivo->estoque->lote.'</td>');
                            $medicamento = $saidamotivo->estoque->medicamentocomercial;
                        ?>
                <td>
                        @foreach ($medicamento->medicamentosubstancias as $key => $medicamentosubstancia)
                            {{$medicamentosubstancia->substanciaativa->nome}}
                            {{$medicamentosubstancia->quantidadedose}}
                            <?php
                                $nomeunidade = ''; 
                                switch ($medicamentosubstancia->unidadedose) {
                                    case 0:$nomeunidade = 'mcg'; break;
                                    case 1:$nomeunidade = 'mg';break;
                                    case 2:$nomeunidade = 'g';break;
                                    case 3:$nomeunidade = 'UI';break;
                                    case 4: $nomeunidade = 'unidades'; break;
                                    case 5: $nomeunidade = 'mg/g';break;
                                    case 6: $nomeunidade = 'UI/g';break;
                                    case 7:$nomeunidade = 'mEq/mL'; break;
                                    case 8:$nomeunidade = 'mg/gota'; break;
                                    case 9:$nomeunidade = 'mcg/mL';break;
                                    case 10:$nomeunidade = 'UI/mL';break;
                                    case 11: $nomeunidade = 'mEq';break;
                                }
                                echo"$nomeunidade, ";
                            ?>
                        @endforeach
                        {{ $medicamento->formafarmaceuticas->nome}}
                         <?php
                                $conteudo = ''; 
                                switch ($medicamento->nomeconteudo) {
                                    case 0:$conteudo = 'Frasco'; break;
                                    case 1:$conteudo = 'FA (frasco ampola)';break;
                                    case 2:$conteudo = 'AMP (ampola)'; break;
                                    case 3:$conteudo = 'Caixa';break;
                                    case 4:$conteudo = 'Envelope';break;
                                    case 5:$conteudo = 'Tubo'; break;
                                    case 6:$conteudo = 'Bolsa'; break;
                                    case 7:$conteudo = 'Pote'; break;
                                }
                                echo"$conteudo com $medicamento->quantidadeconteudo";
                           
                                $uc = ''; 
                                switch ($medicamento->unidadeconteudo) {
                                    case 0:$uc = 'mcg'; break;
                                    case 1:$uc = 'mg'; break;
                                    case 2:$uc = 'g'; break;
                                    case 3:$uc = 'UI';break;
                                    case 4:$uc = 'unidades';break;
                                    case 5:$uc = 'mg/g';break;
                                    case 6:$uc = 'UI/g';break;
                                    case 7:$uc = 'mEq/mL'; break;
                                    case 8:$uc = 'mg/gota';break;
                                    case 9:$uc = 'mcg/mL'; break;
                                    case 10:$uc = 'UI/mL'; break;
                                    case 11: $uc = 'mEq'; break;
                                }
                                echo"$uc, ";
                            ?>  
                        <?php
                            echo('<td>'.$saidamotivo->quantidade.'</td>');                            
                            echo('<td>'.$saidamotivo->motivo.'</td>');
                            echo('<td>'.$saidamotivo->created_at.'</td>');
                            echo('<td>'.$saidamotivo->usuario->name.'</td>');
                       ?>      
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="modal fade" id="substancia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><strong>Registrar saída no estoque</strong></h4>
                    </div>
                    
                    <div class="modal-body">
                        <div class="box box-primary" style="margin-left: 2%; margin-right: 2%; width: 96%;">
                            <div class="row">
                                <div class="box-body">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Substância ativa:</strong>
                                            <div class="pull-right" style="margin-right: 2%;">
            <a class="btn btn-default" style=" margin-left: 2%;" data-toggle="modal" data-target="#substancia" title="Adicionar substância ativa">
                Cadastrar
            </a>  
        </div>
                                             
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong>Quantidade:</strong>
                                            <input id="quantidadedose" type="text" name="quantidadedose" class="form-control" v-model="quantidadedose">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong>Unidade de medida:</strong>
                                            <select id="unidadedose" name="unidadedose" class="form-control" placeholder = "--Selecione--" v-model="unidadedose">
                                                <option value="0">mcg</option>
                                                <option value="1">mg</option>
                                                <option value="2">g</option>
                                                <option value="3">UI</option>
                                                <option value="4">unidades</option>
                                                <option value="5">mg/g</option>
                                                <option value="6">UI/g</option>
                                                <option value="7">mEq/mL</option>
                                                <option value="8">mg/gota</option>
                                                <option value="9">mcg/mL</option>
                                                <option value="10">UI/mL</option>
                                                <option value="11">mEq</option>
                                            </select>
                                        </div>
                                    </div>    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary" @click="addSubstancia">Salvar</button>
                    </div>
                </div>
            </div>
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

