@extends('layouts.app')
 
@section('main-content')
	<div class="row">
	    <div class="col-lg-12 margin-tb">
            @section('contentheader_title')
	        <div class="pull-left">
	            <h2> Exibir substância ativa</h2>
	        </div>
            @endsection 
	        <div class="pull-right">
	            <a class="btn btn-primary" href="{{ route('substanciaativa.index') }}"> Voltar</a>
	        </div>
	    </div>
	</div>
	<div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Substancia ativa: </strong>
                    
                    {{ $substanciaativa->nome }}
                </div>
            </div>
	</div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Classificação: </strong>
                    <?php
                        $nomeclassificacao = ''; 
                        switch ($substanciaativa->classificacao) {
                        case 0:
                            $nomeclassificacao = 'Controlado da portaria 344/98';
                            echo"<td style='color: red;'>$nomeclassificacao</td>";
                            break;
                        case 1:
                            $nomeclassificacao = 'Potencialmente perigosos';
                            echo"<td style='color: yellow;'>$nomeclassificacao</td>";
                            break;
                        case 2:
                            $nomeclassificacao = 'Antibiótico de uso restrito';
                            echo"<td style='color: green;'>$nomeclassificacao</td>";
                            break;
                        case 3:
                            $nomeclassificacao = 'Antibiótico';
                            echo"<td style='color: blue;'>$nomeclassificacao</td>";
                            break;
                        case 4:
                            $nomeclassificacao = 'Outros';
                            echo"<td>$nomeclassificacao</td>";
                            break;
                        }
                    ?>
                </div>
            </div>
	</div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Contraindicação: </strong>
                    {{ $substanciaativa->contraindicacao }}
                </div>
            </div>
	</div>
@endsection