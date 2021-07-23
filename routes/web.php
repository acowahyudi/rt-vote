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
Route::group(['middleware' => ['auth']], function (){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('changePassword',[App\Http\Controllers\PendudukController::class,'changePassword'])->name('changePassword');
    Route::post('storePassword',[App\Http\Controllers\PendudukController::class,'storePassword'])->name('storePassword');

    Route::resource('penduduks', App\Http\Controllers\PendudukController::class);

    Route::resource('periodes', App\Http\Controllers\PeriodeController::class);
    Route::get('periodeByRT', [App\Http\Controllers\PeriodeController::class, 'periodeByRT'])->name('periodeByRT');

    Route::resource('kandidats', App\Http\Controllers\KandidatController::class);

    Route::resource('hasilVotings', App\Http\Controllers\HasilVotingController::class);
    Route::get('hasilVoting', [App\Http\Controllers\HasilVotingController::class,'chooseRT'])->name('cekHasilVoting');
    Route::post('hasilVotingByRT', [App\Http\Controllers\HasilVotingController::class,'indexByRT'])->name('hasilVotingByRT');

    Route::resource('rukunTetanggas', App\Http\Controllers\RukunTetanggaController::class);
    Route::get('rtByKelurahan', [App\Http\Controllers\RukunTetanggaController::class, 'rtByKelurahan'])->name('rtByKelurahan');

    Route::resource('kelurahans', App\Http\Controllers\KelurahanController::class);

    Route::resource('kegiatanRTs', App\Http\Controllers\KegiatanRTController::class);

    Route::resource('roles', App\Http\Controllers\RolesController::class);
});