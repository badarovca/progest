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

Route::group(['prefix' => 'admin'], function () {
    Route::resource('usuarios', 'UsuarioController');
    Route::resource('setores', 'SetorController');
    Route::resource('coordenacoes', 'CoordenacaoController');
    Route::resource('fornecedores', 'FornecedorController');
    Route::resource('empenhos', 'EmpenhoController');
    Route::resource('materiais', 'MaterialController');
    Route::resource('subitens', 'SubItemController');
    Route::get('/home', 'HomeController@index');
    Route::get('/', 'HomeController@index');
});


Route::get('form-material', ['uses' => 'EmpenhoController@getFormMaterial']);
Route::get('busca-materiais/{param}', ['uses' => 'MaterialController@buscarMateriais']);
