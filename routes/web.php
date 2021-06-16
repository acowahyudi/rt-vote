<?php

use Illuminate\Support\Facades\Route;

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
    return redirect(route('login'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('tingkatPendidikans', App\Http\Controllers\TingkatPendidikanController::class);

Route::resource('penduduks', App\Http\Controllers\PendudukController::class);

Route::resource('periodes', App\Http\Controllers\PeriodeController::class);

Route::resource('kandidats', App\Http\Controllers\KandidatController::class);

Route::resource('hasilVotings', App\Http\Controllers\HasilVotingController::class);

Route::resource('tingkatPendidikans', App\Http\Controllers\TingkatPendidikanController::class);

Route::resource('hasilVotings', App\Http\Controllers\HasilVotingController::class);
