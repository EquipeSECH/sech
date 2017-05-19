<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

Route::get('/', 'HomeController@index');

Route::auth();

Route::group(['middleware' => ['auth']], function() {

    Route::get('/home', 'HomeController@index');
    Route::post('/buscapaciente', 'InternacaoController@buscarPaciente');
    Route::get('/autocomplete', 'MedicamentoController@autocomplete');
    Route::post('/simpas', 'MedicamentoController@getCodigoSimpas');

    //rotas de users
    Route::group(['prefix' => 'users', 'where' => ['id' => '[0-9]+']], function() {
        Route::get('', ['as' => 'users.index', 'uses' => 'UserController@index', 'middleware' => ['permission:gestao_usuario-list|gestao_usuario-create|gestao_usuario-edit|gestao_usuario-delete']]);
        Route::get('/create', ['as' => 'users.create', 'uses' => 'UserController@create', 'middleware' => ['permission:gestao_usuario-create']]);
        Route::post('/create', ['as' => 'users.store', 'uses' => 'UserController@store', 'middleware' => ['permission:gestao_usuario-create']]);
        Route::get('/{id}', ['as' => 'users.show', 'uses' => 'UserController@show']);
        Route::get('/{id}/edit', ['as' => 'users.edit', 'uses' => 'UserController@edit', 'middleware' => ['permission:gestao_usuario-edit']]);
        Route::patch('/{id}', ['as' => 'users.update', 'uses' => 'UserController@update', 'middleware' => ['permission:gestao_usuario-edit']]);
        Route::delete('/{id}', ['as' => 'users.destroy', 'uses' => 'UserController@destroy', 'middleware' => ['permission:gestao_usuario-delete']]);
    });

    //rotas de roles
    Route::group(['prefix' => 'roles', 'where' => ['id' => '[0-9]+']], function() {
        Route::get('', ['as' => 'roles.index', 'uses' => 'RoleController@index', 'middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);
        Route::get('/create', ['as' => 'roles.create', 'uses' => 'RoleController@create', 'middleware' => ['permission:role-create']]);
        Route::post('/create', ['as' => 'roles.store', 'uses' => 'RoleController@store', 'middleware' => ['permission:role-create']]);
        Route::get('/{id}', ['as' => 'roles.show', 'uses' => 'RoleController@show']);
        Route::get('/{id}/edit', ['as' => 'roles.edit', 'uses' => 'RoleController@edit', 'middleware' => ['permission:role-edit']]);
        Route::patch('/{id}', ['as' => 'roles.update', 'uses' => 'RoleController@update', 'middleware' => ['permission:role-edit']]);
        Route::delete('/{id}', ['as' => 'roles.destroy', 'uses' => 'RoleController@destroy', 'middleware' => ['permission:role-delete']]);
    });

    //rotas para relatório
    Route::get('/relatorioUsuario', ['as' => 'relatorio.usuario', 'uses' => 'RelatorioController@relatorioUsuario', 'middleware' => ['permission:relatorioUsuario']]);

    //rotas de especialidade
    Route::group(['prefix' => 'especialidade', 'where' => ['id' => '[0-9]+']], function() {
        Route::get('', ['as' => 'especialidade.index', 'uses' => 'EspecialidadeController@index', 'middleware' => ['permission:especialidade-list|especialidade-create|especialidade-edit|especialidade-delete']]);
        Route::get('/create', ['as' => 'especialidade.create', 'uses' => 'EspecialidadeController@create', 'middleware' => ['permission:especialidade-create']]);
        Route::post('/create', ['as' => 'especialidade.store', 'uses' => 'EspecialidadeController@store', 'middleware' => ['permission:especialidade-create']]);
        Route::get('/{id}', ['as' => 'especialidade.show', 'uses' => 'EspecialidadeController@show']);
        Route::get('/{id}/edit', ['as' => 'especialidade.edit', 'uses' => 'EspecialidadeController@edit', 'middleware' => ['permission:especialidade-edit']]);
        Route::patch('/{id}', ['as' => 'especialidade.update', 'uses' => 'EspecialidadeController@update', 'middleware' => ['permission:especialidade-edit']]);
        Route::delete('/{id}', ['as' => 'especialidade.destroy', 'uses' => 'EspecialidadeController@destroy', 'middleware' => ['permission:especialidade-delete']]);
    });

    //rotas de clínica
    Route::group(['prefix' => 'clinica', 'where' => ['id' => '[0-9]+']], function() {
        Route::get('', ['as' => 'clinica.index', 'uses' => 'ClinicaController@index', 'middleware' => ['permission:clinica-list|clinica-create|clinica-edit|clinica-delete']]);
        Route::get('/create', ['as' => 'clinica.create', 'uses' => 'ClinicaController@create', 'middleware' => ['permission:clinica-create']]);
        Route::post('/create', ['as' => 'clinica.store', 'uses' => 'ClinicaController@store', 'middleware' => ['permission:clinica-create']]);
        Route::get('/{id}/edit', ['as' => 'clinica.edit', 'uses' => 'ClinicaController@edit', 'middleware' => ['permission:clinica-edit']]);
        Route::patch('/{id}', ['as' => 'clinica.update', 'uses' => 'ClinicaController@update', 'middleware' => ['permission:clinica-edit']]);
        Route::delete('/{id}', ['as' => 'clinica.destroy', 'uses' => 'ClinicaController@destroy', 'middleware' => ['permission:clinica-delete']]);
    });

//    //rotas de leito
//    Route::group(['prefix' => 'leito', 'where' => ['id' => '[0-9]+']], function() {
//        Route::get('', ['as' => 'leito.index', 'uses' => 'LeitoController@index', 'middleware' => ['permission:leito-list|leito-create|leito-edit|leito-delete']]);
//        Route::get('/create/', ['as' => 'leito.create', 'uses' => 'LeitoController@create', 'middleware' => ['permission:leito-create']]);
//        Route::post('/create/', ['as' => 'leito.store', 'uses' => 'LeitoController@store', 'middleware' => ['permission:leito-create']]);
//        Route::get('/{id}', ['as' => 'leito.show', 'uses' => 'LeitoController@show']);
//        Route::get('/{id}/edit', ['as' => 'leito.edit', 'uses' => 'LeitoController@edit', 'middleware' => ['permission:leito-edit']]);
//        Route::patch('/{id}', ['as' => 'leito.update', 'uses' => 'LeitoController@update', 'middleware' => ['permission:leito-edit']]);
//        Route::delete('/{id}', ['as' => 'leito.destroy', 'uses' => 'LeitoController@destroy', 'middleware' => ['permission:leito-delete']]);
//    });
    //rotas de cid10
    Route::group(['prefix' => 'cid10', 'where' => ['id' => '[0-9]+']], function() {
        Route::get('', ['as' => 'cid10.index', 'uses' => 'Cid10Controller@index', 'middleware' => ['permission:cid-list|cid-create|cid-edit|cid-delete']]);
        Route::get('/create', ['as' => 'cid10.create', 'uses' => 'Cid10Controller@create', 'middleware' => ['permission:cid-create']]);
        Route::post('/create', ['as' => 'cid10.store', 'uses' => 'Cid10Controller@store', 'middleware' => ['permission:cid-create']]);
        Route::get('/{id}/edit', ['as' => 'cid10.edit', 'uses' => 'Cid10Controller@edit', 'middleware' => ['permission:cid-edit']]);
        Route::patch('/{id}', ['as' => 'cid10.update', 'uses' => 'Cid10Controller@update', 'middleware' => ['permission:cid-edit']]);
        Route::delete('/{id}', ['as' => 'cid10.destroy', 'uses' => 'Cid10Controller@destroy', 'middleware' => ['permission:cid-delete']]);
    });

    //rotas de formafarmaceutica
    Route::group(['prefix' => 'formafarmaceutica', 'where' => ['id' => '[0-9]+']], function() {
        Route::get('', ['as' => 'formafarmaceutica.index', 'uses' => 'FormafarmaceuticaController@index', 'middleware' => ['permission:formafarmaceutica-list|formafarmaceutica-create|formafarmaceutica-edit|formafarmaceutica-delete']]);
        Route::get('/create', ['as' => 'formafarmaceutica.create', 'uses' => 'FormafarmaceuticaController@create', 'middleware' => ['permission:formafarmaceutica-create']]);
        Route::post('/create', ['as' => 'formafarmaceutica.store', 'uses' => 'FormafarmaceuticaController@store', 'middleware' => ['permission:formafarmaceutica-create']]);
        Route::get('/{id}', ['as' => 'formafarmaceutica.show', 'uses' => 'FormafarmaceuticaController@show']);
        Route::get('/{id}/edit', ['as' => 'formafarmaceutica.edit', 'uses' => 'FormafarmaceuticaController@edit', 'middleware' => ['permission:formafarmaceutica-edit']]);
        Route::patch('/{id}', ['as' => 'formafarmaceutica.update', 'uses' => 'FormafarmaceuticaController@update', 'middleware' => ['permission:formafarmaceutica-edit']]);
        Route::delete('/{id}', ['as' => 'formafarmaceutica.destroy', 'uses' => 'FormafarmaceuticaController@destroy', 'middleware' => ['permission:formafarmaceutica-delete']]);
    });

    //rotas de substancia ativa
    Route::group(['prefix' => 'substanciaativa', 'where' => ['id' => '[0-9]+']], function() {
        Route::get('', ['as' => 'substanciaativa.index', 'uses' => 'SubstanciaativaController@index', 'middleware' => ['permission:substanciaativa-list|substanciaativa-create|substanciaativa-edit|substanciaativa-delete']]);
        Route::get('/create', ['as' => 'substanciaativa.create', 'uses' => 'SubstanciaativaController@create', 'middleware' => ['permission:substanciaativa-create']]);
        Route::post('/create', ['as' => 'substanciaativa.store', 'uses' => 'SubstanciaativaController@store', 'middleware' => ['permission:substanciaativa-create']]);
        Route::get('/{id}', ['as' => 'substanciaativa.show', 'uses' => 'SubstanciaativaController@show']);
        Route::get('/{id}/edit', ['as' => 'substanciaativa.edit', 'uses' => 'SubstanciaativaController@edit', 'middleware' => ['permission:substanciaativa-edit']]);
        Route::patch('/{id}', ['as' => 'substanciaativa.update', 'uses' => 'SubstanciaativaController@update', 'middleware' => ['permission:substanciaativa-edit']]);
        Route::delete('/{id}', ['as' => 'substanciaativa.destroy', 'uses' => 'SubstanciaativaController@destroy', 'middleware' => ['permission:substanciaativa-delete']]);
    });
    //rotas de interacao medicamentosa
    Route::group(['prefix' => 'interacaomedicamentosa', 'where' => ['id' => '[0-9]+']], function() {
        Route::get('', ['as' => 'interacaomedicamentosa.index', 'uses' => 'InteracaomedicamentosaController@index', 'middleware' => ['permission:interacaomedicamentosa-list|interacaomedicamentosa-create|interacaomedicamentosa-edit|interacaomedicamentosa-delete']]);
        Route::get('/create', ['as' => 'interacaomedicamentosa.create', 'uses' => 'InteracaomedicamentosaController@create', 'middleware' => ['permission:interacaomedicamentosa-create']]);
        Route::post('/create', ['as' => 'interacaomedicamentosa.store', 'uses' => 'InteracaomedicamentosaController@store', 'middleware' => ['permission:interacaomedicamentosa-create']]);
        Route::get('/{id}', ['as' => 'interacaomedicamentosa.show', 'uses' => 'InteracaomedicamentosaController@show']);
        Route::get('/{id}/edit', ['as' => 'interacaomedicamentosa.edit', 'uses' => 'InteracaomedicamentosaController@edit', 'middleware' => ['permission:interacaomedicamentosa-edit']]);
        Route::patch('/{id}', ['as' => 'interacaomedicamentosa.update', 'uses' => 'InteracaomedicamentosaController@update', 'middleware' => ['permission:interacaomedicamentosa-edit']]);
        Route::delete('/{id}', ['as' => 'interacaomedicamentosa.destroy', 'uses' => 'InteracaomedicamentosaController@destroy', 'middleware' => ['permission:interacaomedicamentosa-delete']]);
    });

    //rotas de internação
    Route::group(['prefix' => 'internacao', 'where' => ['id' => '[0-9]+']], function() {
        Route::get('', ['as' => 'internacao.index', 'uses' => 'InternacaoController@index', 'middleware' => ['permission:internacao-list|internacao-create|internacao-edit|internacao-delete']]);
        Route::get('/create', ['as' => 'internacao.create', 'uses' => 'InternacaoController@create', 'middleware' => ['permission:internacao-create']]);
        Route::post('/create', ['as' => 'internacao.store', 'uses' => 'InternacaoController@store', 'middleware' => ['permission:internacao-create']]);
        Route::get('/{id}', ['as' => 'internacao.show', 'uses' => 'InternacaoController@show']);
        Route::get('/{id}/edit', ['as' => 'internacao.edit', 'uses' => 'InternacaoController@edit', 'middleware' => ['permission:internacao-edit']]);
        Route::patch('/{id}', ['as' => 'internacao.update', 'uses' => 'InternacaoController@update', 'middleware' => ['permission:internacao-edit']]);
        Route::delete('/{id}', ['as' => 'internacao.destroy', 'uses' => 'InternacaoController@destroy', 'middleware' => ['permission:internacao-delete']]);
    });

    //rotas de paciente
    Route::group(['prefix' => 'paciente', 'where' => ['id' => '[0-9]+']], function() {
        Route::get('', ['as' => 'paciente.index', 'uses' => 'PacienteController@index', 'middleware' => ['permission:internacao-list|internacao-create|internacao-edit|internacao-delete']]);
        Route::get('/create', ['as' => 'paciente.create', 'uses' => 'PacienteController@create', 'middleware' => ['permission:internacao-create']]);
        Route::post('/create', ['as' => 'paciente.store', 'uses' => 'PacienteController@store', 'middleware' => ['permission:internacao-create']]);
        Route::get('/{id}', ['as' => 'paciente.show', 'uses' => 'PacienteController@show']);
        Route::get('/{id}/edit', ['as' => 'paciente.edit', 'uses' => 'PacienteController@edit', 'middleware' => ['permission:internacao-edit']]);
        Route::patch('/{id}', ['as' => 'paciente.update', 'uses' => 'PacienteController@update', 'middleware' => ['permission:internacao-edit']]);
        Route::delete('/{id}', ['as' => 'paciente.destroy', 'uses' => 'PacienteController@destroy', 'middleware' => ['permission:internacao-delete']]);
    });

    //rotas de fornecedor
    Route::group(['prefix' => 'fornecedor', 'where' => ['id' => '[0-9]+']], function() {
        Route::get('', ['as' => 'fornecedor.index', 'uses' => 'FornecedorController@index', 'middleware' => ['permission:fornecedor-list|fornecedor-create|fornecedor-edit|fornecedor-delete']]);
        Route::get('/create', ['as' => 'fornecedor.create', 'uses' => 'FornecedorController@create', 'middleware' => ['permission:fornecedor-create']]);
        Route::post('/create', ['as' => 'fornecedor.store', 'uses' => 'FornecedorController@store', 'middleware' => ['permission:fornecedor-create']]);
        Route::get('/{id}', ['as' => 'fornecedor.show', 'uses' => 'FornecedorController@show']);
        Route::get('/{id}/edit', ['as' => 'fornecedor.edit', 'uses' => 'FornecedorController@edit', 'middleware' => ['permission:fornecedor-edit']]);
        Route::patch('/{id}', ['as' => 'fornecedor.update', 'uses' => 'FornecedorController@update', 'middleware' => ['permission:fornecedor-edit']]);
        Route::delete('/{id}', ['as' => 'fornecedor.destroy', 'uses' => 'FornecedorController@destroy', 'middleware' => ['permission:fornecedor-delete']]);
    });

    //rotas de medicamento
    Route::group(['prefix' => 'medicamento', 'where' => ['id' => '[0-9]+']], function() {
        Route::get('', ['as' => 'medicamento.index', 'uses' => 'MedicamentoController@index', 'middleware' => ['permission:medicamento-list|medicamento-create|medicamento-edit|medicamento-delete']]);
        Route::get('/create', ['as' => 'medicamento.create', 'uses' => 'MedicamentoController@create', 'middleware' => ['permission:medicamento-create']]);
        Route::post('/create', ['as' => 'medicamento.store', 'uses' => 'MedicamentoController@store', 'middleware' => ['permission:medicamento-create']]);
        Route::get('/{id}', ['as' => 'medicamento.show', 'uses' => 'MedicamentoController@show']);
        Route::get('/{id}/edit', ['as' => 'medicamento.edit', 'uses' => 'MedicamentoController@edit', 'middleware' => ['permission:medicamento-edit']]);
        Route::patch('/{id}', ['as' => 'medicamento.update', 'uses' => 'MedicamentoController@update', 'middleware' => ['permission:medicamento-edit']]);
        Route::delete('/{id}', ['as' => 'medicamento.destroy', 'uses' => 'MedicamentoController@destroy', 'middleware' => ['permission:medicamento-delete']]);
        Route::get('/contraindicacao', ['as' => 'medicamento.contraindicacao', 'uses' => 'MedicamentoController@getContraindicacao']);
    });
    //rotas de estoque
    Route::group(['prefix' => 'estoque', 'where' => ['id' => '[0-9]+']], function() {
        Route::get('', ['as' => 'estoque.index', 'uses' => 'EstoqueController@index', 'middleware' => ['permission:estoque-list|estoque-create|estoque-edit|estoque-delete']]);
        Route::get('/create', ['as' => 'estoque.create', 'uses' => 'EstoqueController@create', 'middleware' => ['permission:estoque-create']]);
        Route::post('/create', ['as' => 'estoque.store', 'uses' => 'EstoqueController@store', 'middleware' => ['permission:estoque-create']]);
        Route::get('/{id}', ['as' => 'estoque.show', 'uses' => 'EstoqueController@show']);
        Route::get('/{id}/edit', ['as' => 'estoque.edit', 'uses' => 'EstoqueController@edit', 'middleware' => ['permission:estoque-edit']]);
        Route::patch('/{id}', ['as' => 'estoque.update', 'uses' => 'EstoqueController@update', 'middleware' => ['permission:estoque-edit']]);
        Route::delete('/{id}', ['as' => 'estoque.destroy', 'uses' => 'EstoqueController@destroy', 'middleware' => ['permission:estoque-delete']]);
    });
    //rotas de entrada
    Route::group(['prefix' => 'entrada', 'where' => ['id' => '[0-9]+']], function() {
        Route::get('', ['as' => 'entrada.index', 'uses' => 'EntradaController@index', 'middleware' => ['permission:entrada-list|entrada-create|entrada-edit|entrada-delete']]);
        Route::get('/create', ['as' => 'entrada.create', 'uses' => 'EntradaController@create', 'middleware' => ['permission:entrada-create']]);
        Route::post('/create', ['as' => 'entrada.store', 'uses' => 'EntradaController@store', 'middleware' => ['permission:entrada-create']]);
        Route::get('/{id}', ['as' => 'entrada.show', 'uses' => 'EntradaController@show']);
        Route::get('/{id}/edit', ['as' => 'entrada.edit', 'uses' => 'EntradaController@edit', 'middleware' => ['permission:entrada-edit']]);
        Route::patch('/{id}', ['as' => 'entrada.update', 'uses' => 'EntradaController@update', 'middleware' => ['permission:entrada-edit']]);
        Route::delete('/{id}', ['as' => 'entrada.destroy', 'uses' => 'EntradaController@destroy', 'middleware' => ['permission:entrada-delete']]);
    });
    
     //rotas saidamotivo
    Route::group(['prefix' => 'saidamotivo', 'where' => ['id' => '[0-9]+']], function() {
        Route::get('', ['as' => 'saidamotivo.index', 'uses' => 'SaidamotivoController@index', 'middleware' => ['permission:saidamotivo-list|saidamotivo-create|saidamotivo-edit|saidamotivo-delete']]);
        Route::get('/create', ['as' => 'saidamotivo.create', 'uses' => 'SaidamotivoController@create', 'middleware' => ['permission:saidamotivo-create']]);
        Route::post('/create', ['as' => 'saidamotivo.store', 'uses' => 'SaidamotivoController@store', 'middleware' => ['permission:saidamotivo-create']]);
        Route::get('/{id}', ['as' => 'saidamotivo.show', 'uses' => 'SaidamotivoController@show']);
        Route::get('/{id}/edit', ['as' => 'saidamotivo.edit', 'uses' => 'SaidamotivoController@edit', 'middleware' => ['permission:saidamotivo-edit']]);
        Route::patch('/{id}', ['as' => 'saidamotivo.update', 'uses' => 'SaidamotivoController@update', 'middleware' => ['permission:saidamotivo-edit']]);
        Route::delete('/{id}', ['as' => 'saidamotivo.destroy', 'uses' => 'SaidamotivoController@destroy', 'middleware' => ['permission:saidamotivo-delete']]);
    });

    //rotas de prescrição
    Route::group(['prefix' => 'prescricao', 'where' => ['id' => '[0-9]+']], function() {
        Route::get('', ['as' => 'prescricao.index', 'uses' => 'PrescricaoController@index', 'middleware' => ['permission:prescricao-list|prescricao-create|prescricao-edit|prescricao-delete']]);
        Route::get('/create', ['as' => 'prescricao.create', 'uses' => 'PrescricaoController@create', 'middleware' => ['permission:prescricao-create']]);
        Route::post('/create', ['as' => 'prescricao.store', 'uses' => 'PrescricaoController@store', 'middleware' => ['permission:prescricao-create']]);
        Route::get('/{id}', ['as' => 'prescricao.show', 'uses' => 'PrescricaoController@show']);
        Route::get('/{id}/edit', ['as' => 'prescricao.edit', 'uses' => 'PrescricaoController@edit', 'middleware' => ['permission:prescricao-edit']]);
        Route::patch('/{id}', ['as' => 'prescricao.update', 'uses' => 'PrescricaoController@update', 'middleware' => ['permission:prescricao-edit']]);
        Route::delete('/{id}', ['as' => 'prescricao.destroy', 'uses' => 'PrescricaoController@destroy', 'middleware' => ['permission:prescricao-delete']]);
    });

    //rotas de prescriçãomedicamento
    Route::group(['prefix' => 'prescricaomedicamento', 'where' => ['id' => '[0-9]+']], function() {
        Route::patch('/', ['as' => 'prescricaomedicamento.update', 'uses' => 'PrescricaoMedicamentoController@update', 'middleware' => ['permission:prescricao-edit']]);
    });
    
    //rotas para relatorios
     Route::group(['prefix' => 'relatorio', 'where' => ['id' => '[0-9]+']], function() {
        Route::get('/{id}/prescricao', ['as' => 'relatorio.prescricao', 'uses' => 'RelatorioController@prescricao', 'middleware' => ['permission:prescricao-list']]);
       
    });
    
});

