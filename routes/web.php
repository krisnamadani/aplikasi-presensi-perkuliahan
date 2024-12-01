<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
})->name('login');

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
});

Route::get('/presensi', function () {
    return view('presensi.index');
});
Route::get('/presensi', [App\Http\Controllers\PresensiController::class, 'index']);
Route::get('/presensi_masuk', [App\Http\Controllers\PresensiController::class, 'presensi_masuk'])->name('presensi_masuk')->middleware('check.presensi');
Route::get('/presensi_pulang', [App\Http\Controllers\PresensiController::class, 'presensi_pulang'])->name('presensi_pulang')->middleware('check.presensi');
