<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('jenis_produk',[\App\Http\Controllers\JenisProdukController::class,'get_jenis_produk']);
Route::post('jenis_produk',[\App\Http\Controllers\JenisProdukController::class,'add_jenis_produk']);
Route::delete('jenis_produk',[\App\Http\Controllers\JenisProdukController::class,'delete']);
Route::post('jenis_produk/detail',[\App\Http\Controllers\JenisProdukController::class,'detail']);
Route::put('jenis_produk',[\App\Http\Controllers\JenisProdukController::class,'update']);

Route::get('satuan',[\App\Http\Controllers\SatuanController::class,'all']);

Route::get('produk',[\App\Http\Controllers\ProdukController::class,'all']);
Route::post('produk/detail', [\App\Http\Controllers\ProdukController::class,'detail']);
Route::post('produk',[\App\Http\Controllers\ProdukController::class,'add']);
Route::post('produk/edit',[\App\Http\Controllers\ProdukController::class,'edit']);
Route::delete('produk',[\App\Http\Controllers\ProdukController::class,'delete']);