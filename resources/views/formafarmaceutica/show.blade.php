@extends('layouts.app')
 
@section('main-content')
	<div class="row">
	    <div class="col-lg-12 margin-tb">
            @section('contentheader_title')
	        <div class="pull-left">
	            <h2> Exibir forma farmacêutica</h2>
	        </div>
            @endsection 
	        <div class="pull-right">
	            <a class="btn btn-primary" href="{{ route('formafarmaceutica.index') }}"> Voltar</a>
	        </div>
	    </div>
	</div>
	<div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Forma farmacêutica: </strong>
                    {{ $formafarmaceutica->nome }}
                </div>
            </div>
	</div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Unidade de medica: </strong>
                     <?php
                $nomeunidade = ''; 
                switch ($formafarmaceutica->unidade) {
                case 0:
                    $nomeunidade = 'mcg';
                    break;
                case 1:
                    $nomeunidade = 'mg';
                    break;
                case 2:
                    $nomeunidade = 'g';
                    break;
                case 3:
                    $nomeunidade = 'UI';
                    break;
                case 4:
                    $nomeunidade = 'unidades';
                    break;
                case 5:
                    $nomeunidade = 'mg/g';
                    break;
                case 6:
                    $nomeunidade = 'UI/g';
                    break;
                case 7:
                    $nomeunidade = 'mEq/mL';
                    break;
                case 8:
                    $nomeunidade = 'mg/gota';
                    break;
                case 9:
                    $nomeunidade = 'mcg/mL';
                    break;
                case 10:
                    $nomeunidade = 'UI/mL';
                    break;
                case 11:
                    $nomeunidade = 'mEq';
                    break;
                }
                echo"<td>$nomeunidade</td>";
            ?>
                </div>
            </div>
	</div>
@endsection