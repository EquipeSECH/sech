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
                @permission('substanciaativa-create')
                    <a class="btn btn-success" href="{{ route('substanciaativa.create') }}"> Cadastrar substância ativa</a>
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
                <th>Substância Ativa</th>                
                <th>Classificação</th>
                <th width="280px">Ação</th>
            </tr> 
           
    @foreach ($substanciaativas as $key => $substanciaativa)
    <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $substanciaativa->nome}}</td>  
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
            <td>
                    <a class="btn btn-default" href="{{ route('substanciaativa.show',$substanciaativa->id) }}"> 
                        <i class="fa fa-eye"></i>
                    </a>
                    @permission('substanciaativa-edit')
                    <a class="btn btn-default" href="{{ route('substanciaativa.edit',$substanciaativa->id) }}">
                        <i class="fa fa-edit "></i>
                    </a>
                    @endpermission
                    @permission('substanciaativa-delete')
                    {!! Form::open(['method' => 'DELETE','route' => ['substanciaativa.destroy', $substanciaativa->id],'style'=>'display:inline']) !!}
                    <!--{!! Form::submit('Excluir', ['class' => 'btn btn-danger']) !!} ;-->
                    {{ Form::button('<i class="fa fa-trash"></i>', array('class'=>'btn btn-default', 'type'=>'submit')) }}
            {!! Form::close() !!}
            @endpermission
            </td>
    </tr>
    @endforeach
    </table>
    {!! $substanciaativas->render() !!}
@endsection