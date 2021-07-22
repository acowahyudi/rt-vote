<?php

use App\Http\Controllers\API\AuthAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'api'], function ($router) {
    Route::post('login', [AuthAPIController::class,'login']);
    Route::post('logout', [AuthAPIController::class,'logout']);
    Route::post('refresh', [AuthAPIController::class,'refresh']);
    Route::post('me', [AuthAPIController::class,'me']);

});

Route::resource('penduduks', App\Http\Controllers\API\PendudukAPIController::class);

Route::resource('periodes', App\Http\Controllers\API\PeriodeAPIController::class);

Route::resource('kandidats', App\Http\Controllers\API\KandidatAPIController::class);

Route::resource('hasil_votings', App\Http\Controllers\API\HasilVotingAPIController::class);


Route::resource('rukun_tetanggas', App\Http\Controllers\API\RukunTetanggaAPIController::class);

Route::resource('kelurahans', App\Http\Controllers\API\KelurahanAPIController::class);

Route::resource('kegiatan_r_ts', App\Http\Controllers\API\KegiatanRTAPIController::class);

Route::resource('roles', App\Http\Controllers\API\RolesAPIController::class);