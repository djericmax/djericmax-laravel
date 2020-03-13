<?php

Route::get('/painel/produtos/testes', 'Painel\ProdutoController@testes');
Route::resource('/painel/produtos','Painel\ProdutoController');

Route::group(['namespace' => 'Site'], function(){
	Route::get('/categoria/{id}', 'SiteController@categoria');
	Route::get('/categoria2/{id?}', 'SiteController@categoriaOp');

	Route::get('/contato', 'SiteController@contato');
	Route::get('/', 'SiteController@index');
});

/* utilizando middleware para todas as rotas no grupo de rotas, restringindo o acesso às rotas do grupo - Eric 11/02/2020
Route::group(['namespace' => 'Site', 'middleware' => 'auth'], function(){
	Route::get('/categoria/{id}', 'SiteController@categoria');
	Route::get('/categoria2/{id?}', 'SiteController@categoriaOp');

	Route::get('/contato', 'SiteController@contato');
	Route::get('/', 'SiteController@index');
});*/

/* utilizando middleware para uma rota apenas, restringindo o acesso à uma rota por vez - Eric 11/02/2020
Route::group(['namespace' => 'Site'], function(){
	Route::get('/categoria/{id}', 'SiteController@categoria')->middleware('auth');
	Route::get('/categoria2/{id?}', 'SiteController@categoriaOp');

	Route::get('/contato', 'SiteController@contato');
	Route::get('/', 'SiteController@index');
});*/



/*
Route::get('/', function () {
    return view('welcome');
}); */


/* testes e exemplos de rotas para usar em projetos - Eric 07/02/2020

Route::group(['prefix' => 'painel', 'middleware' => 'auth'], function(){
	Route::get('/users', function(){
		return 'Controle de usuários';
	});
		Route::get('/financeiro', function(){
		return 'Financeiro Painel';
	});
		Route::get('/', function(){
		return 'Dashboard';
	});
});

Route::get('/login', function(){
	return 'Form login';
});

Route::get('/categoria2/{idcat?}', function($idcat=1){
	return "Posts da categoria {$idcat}";
});

Route::get('/categoria/{idcat}', function($idcat){
	return "Posts da categoria {$idcat}";
});

Route::get('a/b/z', function(){
	return 'Rota grande';
})->name('rota.nomeada');

Route::any('/any', function(){
	return 'Route any';
});

Route::match(['get', 'post'], '/match', function(){
	return 'Route match';
});

Route::post('/post', function(){
	return 'Route Post';
});

Route::get('/contato', function(){
	return 'Contato';
});

Route::get('/empresa', function(){
	return view('empresa');
});


Route::get('/', function () {
    return redirect()->route('rota.nomeada'); //view('welcome');
}); */


 

