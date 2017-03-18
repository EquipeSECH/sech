@extends('layouts.app')
 
@section('main-content')
	<div class="row">
	    <div class="col-lg-12 margin-tb">
	    	@section('contentheader_title')
	        <div class="pull-left">
	            <h2> Visualizar interação medicmentosa</h2>
	        </div>
	         @endsection
	        <div class="pull-right">
	            <a class="btn btn-primary" href="{{ route('interacaomedicamentosa.index') }}"> Back</a>
	        </div>
	    </div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Medicamentos:</strong>
                {{ $interacaomedicamentosa->substanciaativa1->nome}} e {{ $interacaomedicamentosa->substanciaativa2->nome }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">                
                <strong>Gravidade da interação:</strong>
         <?php
            $nomegravidade = ''; 
            switch ($interacaomedicamentosa->gravidade) {
                case 0:
                    $nomegravidade = '<span class="label label-default">Menor</span>';
                    break;
                case 1:
                    $nomegravidade = '<span class="label label-primary">Moderada</span>';
                    break;
                case 2:
                    $nomegravidade = '<span class="label label-warning">Maior</span>';
                    break;
                case 3:
                    $nomegravidade = '<span class="label label-danger">Contraindiado</span>';
                    break;  
            }
            echo"$nomegravidade";
          
            ?>
            </div>
        </div>
        <div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Consequencia:</strong>
                {{ $interacaomedicamentosa->consequencia }}
            </div>
        </div>
	</div>
@endsection