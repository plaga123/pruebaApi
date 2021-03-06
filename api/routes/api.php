<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('user','CaoUsuarioController');
Route::post('relatorio','CaoUsuarioController@ListarRelatorio'); 
Route::post('grafico','CaoUsuarioController@grafico');
Route::post('series','CaoUsuarioController@Series');
Route::post('total','CaoUsuarioController@Total');
Route::post('pizza','CaoUsuarioController@pizza');

