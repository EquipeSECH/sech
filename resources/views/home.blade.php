@extends('layouts.app')

@section('contentheader_title')
	
@endsection


@section('main-content')
	<div class="container spark-screen">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
<!--				<div class="panel panel-default">
					<div class="panel-heading">Home</div>

					<div class="panel-body">
						{{ trans('adminlte_lang::message.logged') }}
					</div>
				</div>-->
                             <div style="margin-top: 11%; margin-left: 30%;">
                                 <img src="{{asset('/img/logosech.png')}}"  alt="Logo" width="100%;" style="opacity: 0.3;" />
                            </div>
			</div>
		</div>
	</div>
@endsection
