<?php

Route::get('/', function () {
    return view('welcome');
    // auth.login
});

Route::get('/sobre', function () {
    return view('ajuda.sobre');
})->middleware('verificaperfil:administrador,operador');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin','namespace' => 'Auth'],function(){
    // Authentication Routes...
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout')->name('logout');
});


/* controle de acesso */

Route::get('/config/users/export', 'ConfigUsersController@export')->name('config.users.export');
Route::get('/config/users/password', 'ConfigUsersController@password')->name('config.users.password');
Route::put('/config/users/password/update', 'ConfigUsersController@passwordUpdate')->name('config.users.password.update');
Route::resource('/config/users', 'ConfigUsersController');

/* configuração das equipes */

Route::resource('/distrito', 'DistritoController');
Route::get('/distrito/export/csv', 'DistritoController@export')->name('distrito.export');

Route::resource('/unidade', 'UnidadeController');
Route::get('/unidade/export/csv', 'UnidadeController@export')->name('unidade.export');

Route::resource('/equipe', 'EquipeController');
Route::get('/equipe/export/csv', 'EquipeController@export')->name('equipe.export');

/* configuração dos profissionais */

Route::resource('/cargo', 'CargoController');
Route::get('/cargo/export/csv', 'CargoController@export')->name('cargo.export');

Route::resource('/setor', 'SetorController');
Route::get('/setor/export/csv', 'SetorController@export')->name('setor.export');

Route::resource('/cargahoraria', 'CargaHorariaController');
Route::get('/cargahoraria/export/csv', 'CargaHorariaController@export')->name('cargahoraria.export');

Route::resource('/vinculo', 'VinculoController');
Route::get('/vinculo/export/csv', 'VinculoController@export')->name('vinculo.export');

Route::resource('/vinculotipo', 'VinculoTipoController');
Route::get('/vinculotipo/export/csv', 'VinculoTipoController@export')->name('vinculotipo.export');

Route::resource('/licencatipo', 'LicencaTipoController');
Route::get('/licencatipo/export/csv', 'LicencaTipoController@export')->name('licencatipo.export');


/* Profissionais de Saúde */

Route::resource('/profissional', 'ProfissionalController');
Route::get('/profissional/export/csv', 'ProfissionalController@export')->name('profissional.export');

Route::resource('/servidor', 'ServidorController');
Route::get('/servidor/export/csv', 'ServidorController@export')->name('servidor.export');

Route::resource('/destino', 'DestinoController');
Route::get('/destino/export/csv', 'DestinoController@export')->name('destino.export');

Route::resource('/transferir', 'TransferirController');

Route::resource('/online', 'OnLineController');