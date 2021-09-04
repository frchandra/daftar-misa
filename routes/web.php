<?php

use App\Http\Controllers\CekMisa;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index']);

Route::get('/misa-saya', [CekMisa::class, 'index']);

Route::delete('/misa-saya', [CekMisa::class, 'delete']);

Route::post('/validate', [HomeController::class, 'validatePendaftaran']);

Route::post('/daftar', [HomeController::class, 'storePendaftaran']);

