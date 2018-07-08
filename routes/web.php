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
  Route::get('hospede/{codigo}/busca','\App\Http\Controllers\HospedeController@busca');
  Route::get('leito/{leito_id}/hospede/{hospede_codigo}/create','\App\Http\Controllers\HospedeController@create_aloque');
  Route::post('leito/{leito_id}/hospede/{hospede_codigo}/alocar','\App\Http\Controllers\HospedeController@alocar');
  Route::resource('hospede','\App\Http\Controllers\HospedeController');
});

//leito Routes
Route::group(['middleware'=> 'web'],function(){
  Route::get('leito/remove','\App\Http\Controllers\LeitoController@remove');
  Route::post('leito/{leito_id}/hospede/{hospede_id}/hospedar','\App\Http\Controllers\LeitoController@hospedar');
  Route::post('leito/{leito_id}/hospede/{hospede_id}/liberar','\App\Http\Controllers\LeitoController@liberar');
  Route::get('leito/{leito_id}/hospede/{hospede_id}','\App\Http\Controllers\LeitoController@alocar');
  Route::resource('leito','\App\Http\Controllers\LeitoController');
//  Route::post('leito/{id}/update','\App\Http\Controllers\LeitoController@update');  
//  Route::get('leito/{id}/deleteMsg','\App\Http\Controllers\LeitoController@DeleteMsg');
});

//movimentacao Routes
Route::group(['middleware'=> 'web'],function(){
  Route::resource('movimentacao','\App\Http\Controllers\MovimentacaoController');
});

Route::group(['middleware'=> 'web'],function(){
  Route::get('reserva/create','\App\Http\Controllers\PreCadastroController@create');
});
