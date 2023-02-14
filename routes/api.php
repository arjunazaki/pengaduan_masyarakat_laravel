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

Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('/ambilUser', [App\Http\Controllers\Api\ApiUser::class,'ambilUser']);
});

Route::post('/login', [App\Http\Controllers\Api\ApiUser::class, 'login']);
Route::get('/pengaduan', [App\Http\Controllers\Api\ApiPengaduan::class,'index']);
Route::post('/registerMas', [App\Http\Controllers\Api\ApiUser::class,'registerMas']);
Route::post('/tambahLaporan', [App\Http\Controllers\Api\ApiPengaduan::class,'tambahLaporan']);
