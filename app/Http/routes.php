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
//Entrust::routeNeedsRole('admin*', 'admin');

Route::group(['prefix' => 'admin'], function () {
    Route::resource('usuarios', 'UsuarioController');
    Route::resource('setores', 'SetorController');
    Route::resource('coordenacoes', 'CoordenacaoController');
    Route::resource('unidades', 'UnidadeController');
    Route::resource('fornecedores', 'FornecedorController');
    Route::resource('empenhos', 'EmpenhoController');
    Route::resource('empenhos.entradas', 'EntradaController');
    Route::resource('saidas', 'SaidaController');
    Route::get('/entradas', ['as' => 'admin.entradas', 'uses' => 'EntradaController@index']);
    Route::resource('materiais', 'MaterialController');
    Route::resource('subitens', 'SubItemController');
    Route::get('/home', 'HomeController@index');
    Route::get('/', 'AdminController@index');
});

Route::get('/', 'HomeController@index');

Route::group(['prefix' => 'pedidos'], function () {
    Route::get('/', 'PedidoController@index');
    Route::get('/busca-materiais', ['as' => 'pedidos.busca-materiais', 'uses' => 'PedidoController@search']);
    Route::get('/pedido-atual', ['as' => 'pedidos.pedido-atual', 'uses' => 'PedidoController@getPedidoAtual']);
    Route::post('/add-material', ['as'=>'pedidos.add-material', 'uses' => 'PedidoController@addMaterial']);
    Route::delete('/remover-material/{rowid}', ['as'=>'pedidos.remover-material', 'uses' => 'PedidoController@removeMaterial']);
});

Route::get('form-material', ['uses' => 'EmpenhoController@getFormMaterial']);
Route::get('add-material-saida/{material}/{qtd}', ['uses' => 'SaidaController@addMaterial']);
