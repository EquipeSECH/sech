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
                    {{ $formafarmaceutica->unidade }}
                </div>
            </div>
	</div>
@endsection