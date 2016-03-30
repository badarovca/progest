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
//Permissões ADMIN
Entrust::routeNeedsRole('admin/usuarios*', 'admin', Redirect::to('/auth/login'));
Entrust::routeNeedsRole('admin/setores*', 'admin', Redirect::to('/auth/login'));
Entrust::routeNeedsRole('admin/coordenacoes*', 'admin', Redirect::to('/auth/login'));
Entrust::routeNeedsRole('admin/fornecedores*', 'admin', Redirect::to('/auth/login'));
Entrust::routeNeedsRole('admin/subitens*', 'admin', Redirect::to('/auth/login'));
Entrust::routeNeedsRole('admin/unidades*', 'admin', Redirect::to('/auth/login'));
Entrust::routeNeedsRole('admin/materiais*', 'admin', Redirect::to('/auth/login'));
Entrust::routeNeedsRole('admin/submateriais*', 'admin', Redirect::to('/auth/login'));

//Permissões ADMIN e ALMOXARIFE
Entrust::routeNeedsRole('admin', array('admin','almoxarife'), Redirect::to('/auth/login'), false);
Entrust::routeNeedsRole('admin/empenhos*', array('admin','almoxarife'), Redirect::to('/auth/login'), false);
Entrust::routeNeedsRole('admin/entradas*', array('admin','almoxarife'), Redirect::to('/auth/login'), false);
Entrust::routeNeedsRole('admin/pedidos*', array('admin','almoxarife'), Redirect::to('/auth/login'), false);
Entrust::routeNeedsRole('admin/saidas*', array('admin','almoxarife'), Redirect::to('/auth/login'), false);

//Permissões SOLICITANTE
Entrust::routeNeedsRole('pedidos*', 'solicitante', Redirect::to('/auth/login'));

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::group(['prefix' => 'admin'], function () {
    Route::resource('usuarios', 'UsuarioController');
    Route::resource('setores', 'SetorController');
    Route::resource('coordenacoes', 'CoordenacaoController');
    Route::resource('unidades', 'UnidadeController');
    Route::resource('fornecedores', 'FornecedorController');
    Route::resource('empenhos', 'EmpenhoController');
    Route::resource('empenhos.entradas', 'EntradaController');
    Route::get('/entradas', ['as' => 'admin.entradas', 'uses' => 'EntradaController@index']);
    Route::resource('saidas', 'SaidaController');
    Route::resource('saidas.devolucoes', 'DevolucaoController');
    Route::get('/devolucoes', ['as' => 'admin.devolucoes', 'uses' => 'DevolucaoController@index']);
    Route::get('/pedidos', ['as' => 'admin.pedidos.index', 'uses' => 'PedidoController@index']);
    Route::get('/pedidos/{id}', ['as' => 'admin.pedidos.show', 'uses' => 'PedidoController@show']);
    Route::resource('materiais', 'MaterialController');
    Route::resource('subitens', 'SubItemController');
    Route::resource('submateriais', 'SubMaterialController');
    Route::get('/home', 'HomeController@index');
    Route::get('/', 'AdminController@index');
});

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'pedidos'], function () {
    Route::get('/', ['as' => 'pedidos', 'uses' => 'PedidoController@exibirMateriais']);
    Route::get('/busca-materiais', ['as' => 'pedidos.busca-materiais', 'uses' => 'PedidoController@search']);
    Route::get('/pedido-atual', ['as' => 'pedidos.pedido-atual', 'uses' => 'PedidoController@getPedidoAtual']);
    Route::get('/lista-pedidos', ['as' => 'pedidos.lista-pedidos', 'uses' => 'PedidoController@exibirPedidos']);
    Route::get('/{id}', ['as' => 'pedidos.show', 'uses' => 'PedidoController@show_solicitante']);
    Route::post('/add-material', ['as' => 'pedidos.add-material', 'uses' => 'PedidoController@addMaterial']);
    Route::post('/store', ['as' => 'pedidos.store', 'uses' => 'PedidoController@store']);
    Route::delete('/remover-material/{rowid}', ['as' => 'pedidos.remover-material', 'uses' => 'PedidoController@removeMaterial']);
});

Route::get('form-material', ['uses' => 'EmpenhoController@getFormMaterial']);
Route::get('add-material-saida/{material}/{qtd}', ['uses' => 'SaidaController@addMaterial']);
