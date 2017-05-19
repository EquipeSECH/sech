@extends('layouts.app')

<link href="{{ asset('js/jquery-ui-themes-1.12.0/themes/base/jquery-ui.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">

@section('main-content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        @section('contentheader_title')
        <div class="pull-left">
            <h2>Estoque atual</h2>
        </div>
        @endsection
    </div>
</div>
<br>
<div class="box box-primary " style="margin-left: 2%; margin-right: 2%; width: 96%;">
    <div class="box-body">
        <div class="table-responsive col-lg-12 col-md-12 col-sm-12">
            <table id="table" class="table table-bordered table-hover dataTable" role="grid">
                <thead>
                    <tr>
                        <th class="text-center" width="4%">Nº</th>
                        <th class="text-center">Lote</th>
                        <th class="text-center">Medicamento</th>
                        <th class="text-center">Quantidade</th>
                        <th class="text-center">Validade</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($estoques as $key => $estoque)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $estoque->lote }}</td>
                        <td>
                        <?php 
                            $medicamento = $estoque->medicamentocomercial;
                        ?>
                        @foreach ($medicamento->medicamentosubstancias as $key => $medicamentosubstancia)
                            {{$medicamentosubstancia->substanciaativa->nome}}
                            {{$medicamentosubstancia->quantidadedose}}
                            <?php
                                $nomeunidade = ''; 
                                switch ($medicamentosubstancia->unidadedose) {
                                    case 0:$nomeunidade = 'mcg'; break;
                                    case 1: $nomeunidade = 'mg'; break;
                                    case 2: $nomeunidade = 'g'; break;
                                    case 3: $nomeunidade = 'UI'; break;
                                    case 4: $nomeunidade = 'unidades';break;
                                    case 5:$nomeunidade = 'mg/g'; break;
                                    case 6:$nomeunidade = 'UI/g'; break;
                                    case 7: $nomeunidade = 'mEq/mL'; break;
                                    case 8: $nomeunidade = 'mg/gota'; break;
                                    case 9: $nomeunidade = 'mcg/mL'; break;
                                    case 10: $nomeunidade = 'UI/mL'; break;
                                    case 11: $nomeunidade = 'mEq'; break;
                                }
                                echo"$nomeunidade, ";
                            ?>
                        @endforeach
                        {{ $medicamento->formafarmaceuticas->nome}}
                         <?php
                                $conteudo = ''; 
                                switch ($medicamento->nomeconteudo) {
                                case 0: $conteudo = 'Frasco'; break;
                                case 1: $conteudo = 'FA (frasco ampola)'; break;
                                case 2: $conteudo = 'AMP (ampola)'; break;
                                case 3:$conteudo = 'Caixa'; break;
                                case 4: $conteudo = 'Envelope'; break;
                                case 5: $conteudo = 'Tubo'; break;
                                case 6: $conteudo = 'Bolsa'; break;
                                case 7: $conteudo = 'Pote'; break;
                                }
                                echo"$conteudo com $medicamento->quantidadeconteudo";
                           
                                $uc = ''; 
                                switch ($medicamento->unidadeconteudo) {
                                case 0: $uc = 'mcg'; break;
                                case 1: $uc = 'mg'; break;
                                case 2: $uc = 'g'; break;
                                case 3: $uc = 'UI'; break;
                                case 4: $uc = 'unidades'; break;
                                case 5: $uc = 'mg/g'; break;
                                case 6: $uc = 'UI/g'; break;
                                case 7: $uc = 'mEq/mL'; break;
                                case 8: $uc = 'mg/gota'; break;
                                case 9: $uc = 'mcg/mL'; break;
                                case 10: $uc = 'UI/mL'; break;
                                case 11: $uc = 'mEq'; break;
                                }
                                echo"$uc, ";
                            ?>    
                        </td>      
                        <td>{{ $estoque->quantidadeatual}}</td>
                        <td>{{ $estoque->validade }}</td>
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

