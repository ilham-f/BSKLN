<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NegaraController;
use App\Http\Controllers\KawasanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DirektoratController;

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

Route::get('/', [DashboardController::class, 'index']);

Route::get('/tabel-negara', [NegaraController::class, 'index']);
Route::get('/tabel-direktorat', [DirektoratController::class, 'index']);
Route::get('/tabel-kawasan', [KawasanController::class, 'index']);

Route::post('/tambahnegara', [NegaraController::class, 'store']);
Route::post('/tambahdirektorat', [DirektoratController::class, 'store']);
Route::post('/tambahkawasan', [KawasanController::class, 'store']);

Route::post('/deletenegara', [NegaraController::class, 'destroy']);
Route::post('/deletedirektorat', [DirektoratController::class, 'destroy']);
Route::post('/deletekawasan', [KawasanController::class, 'destroy']);


Route::get('/get-kawasan/{direktorat_id}', [KawasanController::class, 'getKawasan']);

// JSON Response API

// Negara
Route::get('/negaras', [NegaraController::class, 'allNegara']);
Route::get('/negaras/{id}', [NegaraController::class, 'showNegara']);

Route::post('/negara', [NegaraController::class, 'create']);
Route::post('/negara/{id}', [NegaraController::class, 'delete']);

// Geomap
Route::get('/negarabycode/{kode}', [NegaraController::class, 'showNegaraByCode']);
Route::get('/getDirektoratColors', [DirektoratController::class, 'getDirektoratColors']);
