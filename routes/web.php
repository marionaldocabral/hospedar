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
  Route::resource('usuario','\App\Http\Controllers\UserController');
});

//colaborador Routes
Route::group(['middleware'=> 'web'],function(){
  Route::resource('colaborador','\App\Http\Controllers\ColaboradorController');
});

//hospede Routes
Route::group(['middleware'=> 'web'],function(){
  Route::get('leito/{leito_id}/hospede/{hospede_codigo}/create','\App\Http\Controllers\HospedeController@create_aloque');
  Route::post('leito/{leito_id}/hospede/{hospede_codigo}/alocar','\App\Http\Controllers\HospedeController@alocar');
  Route::resource('hospede','\App\Http\Controllers\HospedeController');
});


//leito Routes
Route::group(['middleware'=> 'web'],function(){
  Route::get('leito/remove','\App\Http\Controllers\LeitoController@remove');
  Route::post('leito/{leito_id}/hospede/{hospede_id}/hospedar','\App\Http\Controllers\LeitoController@hospedar');
  Route::post('leito/{leito_id}/hospede/{hospede_id}/reservar','\App\Http\Controllers\LeitoController@reservar');
  Route::post('leito/{leito_id}/hospede/{hospede_id}/liberar','\App\Http\Controllers\LeitoController@liberar');
  Route::post('leito/{leito_id}/hospede/{hospede_id}/confirmar','\App\Http\Controllers\LeitoController@confirmar');
  Route::get('leito/{leito_id}/hospede/{hospede_id}','\App\Http\Controllers\LeitoController@alocar');
  Route::resource('leito','\App\Http\Controllers\LeitoController');
});

//movimentacao Routes
Route::group(['middleware'=> 'web'],function(){
  Route::resource('movimentacao','\App\Http\Controllers\MovimentacaoController');
});

Route::group(['middleware'=> 'web'],function(){
  Route::get('hospede/{codigo}/busca','\App\Http\Controllers\PedidoReservaController@busca');
  Route::resource('pedido','\App\Http\Controllers\PedidoReservaController');

  Route::post('reserva/{id}/confirma','\App\Http\Controllers\ReservaController@confirmar');
  Route::resource('reserva','\App\Http\Controllers\ReservaController');
});
//restricao Routes
Route::group(['middleware'=> 'web'],function(){
  Route::resource('restricao','\App\Http\Controllers\RestricaoController');
  Route::post('restricao/{id}/update','\App\Http\Controllers\RestricaoController@update');
  Route::get('restricao/{id}/delete','\App\Http\Controllers\RestricaoController@destroy');
  Route::get('restricao/{id}/deleteMsg','\App\Http\Controllers\RestricaoController@DeleteMsg');
});
