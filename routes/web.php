<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//usuario Routes
Route::group(['middleware'=> 'web'],function(){
  Route::resource('usuario','\App\Http\Controllers\UserController')->middleware('user');
});

//colaborador Routes
Route::group(['middleware'=> 'web'],function(){
  Route::resource('colaborador','\App\Http\Controllers\ColaboradorController')->middleware('user');
});

//hospede Routes
Route::group(['middleware'=> 'web'],function(){
  Route::get('hospede','\App\Http\Controllers\HospedeController@index')->middleware('user');
  Route::get('hospede/create','\App\Http\Controllers\HospedeController@create')->middleware('user');
  Route::post('hospede','\App\Http\Controllers\HospedeController@store')->middleware('user');
  Route::get('hospede/{id}/edit','\App\Http\Controllers\HospedeController@edit')->middleware('user');
  Route::patch('hospede/{id}','\App\Http\Controllers\HospedeController@update')->middleware('user');
  Route::delete('hospede/{id}','\App\Http\Controllers\HospedeController@destroy')->middleware('user');
  Route::get('hospede/create','\App\Http\Controllers\HospedeController@create')->middleware('user');
  Route::get('leito/{leito_id}/hospede/{hospede_codigo}/create','\App\Http\Controllers\HospedeController@create_aloque')->middleware('user');
  Route::post('leito/{leito_id}/hospede/{hospede_codigo}/alocar','\App\Http\Controllers\HospedeController@alocar')->middleware('user');
});


//leito Routes
Route::group(['middleware'=> 'web'],function(){
  Route::get('leito','\App\Http\Controllers\LeitoController@index');
  Route::get('leito/remove','\App\Http\Controllers\LeitoController@remove')->middleware('user');
  Route::post('leito/{leito_id}/hospede/{hospede_id}/hospedar','\App\Http\Controllers\LeitoController@hospedar')->middleware('user');
  Route::post('leito/{leito_id}/hospede/{hospede_id}/reservar','\App\Http\Controllers\LeitoController@reservar')->middleware('user');
  Route::post('leito/{leito_id}/hospede/{hospede_id}/liberar','\App\Http\Controllers\LeitoController@liberar')->middleware('user');
  Route::post('leito/{leito_id}/hospede/{hospede_id}/confirmar','\App\Http\Controllers\LeitoController@confirmar')->middleware('user');
  Route::get('leito/{leito_id}/hospede/{hospede_id}','\App\Http\Controllers\LeitoController@alocar')->middleware('user');
  Route::get('leito/{id}','\App\Http\Controllers\LeitoController@show')->middleware('user');
});

//movimentacao Routes
Route::group(['middleware'=> 'web'],function(){
  Route::resource('movimentacao','\App\Http\Controllers\MovimentacaoController');
});

Route::group(['middleware'=> 'web'],function(){
  //rotas acessadas por hospedes
  Route::get('hospede/{codigo}/busca','\App\Http\Controllers\PedidoReservaController@busca');
  Route::resource('pedido','\App\Http\Controllers\PedidoReservaController');
  //rotas restritas a usuarios logados
  Route::post('reserva/{id}/confirma','\App\Http\Controllers\ReservaController@confirmar')->middleware('user');
  Route::resource('reserva','\App\Http\Controllers\ReservaController')->middleware('user');
});

//restricao Routes
Route::group(['middleware'=> 'web'],function(){
  Route::resource('restricao','\App\Http\Controllers\RestricaoController')->middleware('user');
});

//peca Routes
Route::group(['middleware'=> 'web'],function(){
  Route::post('hospede/{hospede_id}/peca/{peca_id}/remove','\App\Http\Controllers\PecaController@remove')->middleware('lav');
  Route::get('hospede/{id}/peca','\App\Http\Controllers\PecaController@filter')->middleware('lav');
  Route::get('hospede/{id}/peca/create','\App\Http\Controllers\PecaController@create')->middleware('lav');
  Route::get('peca','\App\Http\Controllers\PecaController@index')->middleware('lav');
  Route::post('peca','\App\Http\Controllers\PecaController@store')->middleware('lav');
  Route::delete('peca/{id}','\App\Http\Controllers\PecaController@destroy')->middleware('lav');
});