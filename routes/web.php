<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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

Route::controller(AuthController::class)->group(function(){
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');
});

Route::middleware('auth.dosen')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('dashboard', 'index')->name('dashboard');
    });
});

// Route::get('/dashboard', function () {
//     return view('dashboard.index');
// });

Route::get('/presensi', function () {
    return view('presensi.index');
});
