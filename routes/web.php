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
    return view('welcome');
});

Route::get('/master/user', [\App\Http\Controllers\UserController::class,'index']);
Route::get('/master/jenis_produk', [\App\Http\Controllers\JenisProdukController::class,'all_jenis_produk']);
Route::get('master/jenis_produk/create',[\App\Http\Controllers\JenisProdukController::class],'create');
Route::post('master/jenis_produk/store',[\App\Http\Controllers\JenisProdukController::class,'store']);
