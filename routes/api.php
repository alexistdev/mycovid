<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{AuthController as AuthApi,DeteksiController as DetApi};

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

Route::post('/login', [AuthApi::class, 'validasi_login']);
Route::get('/gejala', [DetApi::class, 'get_gejala']);
Route::post('/gejala', [DetApi::class, 'simpan_jawaban']);
Route::delete('/user/gejala', [DetApi::class, 'hapus_gejala'])->name('delete');
Route::get('/hasil', [DetApi::class, 'get_hasil']);
