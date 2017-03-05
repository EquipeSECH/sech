@extends('layouts.app')
 
@section('main-content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            @section('contentheader_title')
            <div class="pull-left">
                <h2>Forma farmacêutica</h2>
            </div>
             @endsection
            <div class="pull-right">
                @permission('formafarmaceutica-create')
                    <a class="btn btn-success" href="{{ route('formafarmaceutica.create') }}"> Cadastrar forma farmacêutica</a>
                @endpermission
            </div>
            <br><br><br>
        </div>
    </div>
    @if ($message = Session::get('success'))
            <div class="alert alert-success">
                    <p>{{ $message }}</p>
            </div>
    @endif
    <table class="table table-bordered">
            <tr>
                <th>Nº</th>
                <th>Forma farmacêutica</th>                
                <th>Unidade</th>
                <th width="280px">Ação</th>
            </tr> 
           
    @foreach ($formafarmaceuticas as $key => $formafarmaceutica)
    <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $formafarmaceutica->nome}}</td>  
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
            <td>
                    <a class="btn btn-info" href="{{ route('formafarmaceutica.show',$formafarmaceutica->id) }}">Visualizar</a>
                    @permission('formafarmaceutica-edit')
                    <a class="btn btn-primary" href="{{ route('formafarmaceutica.edit',$formafarmaceutica->id) }}">Editar</a>
                    @endpermission
                    @permission('formafarmaceutica-delete')
                    {!! Form::open(['method' => 'DELETE','route' => ['formafarmaceutica.destroy', $formafarmaceutica->id],'style'=>'display:inline']) !!}
        {!! Form::submit('Excluir', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
            @endpermission
            </td>
    </tr>
    @endforeach
    </table>
    {!! $formafarmaceuticas->render() !!}
@endsection