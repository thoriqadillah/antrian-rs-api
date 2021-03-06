<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\AuthController;

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

// Auth
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/refresh', [AuthController::class, 'refresh']);
Route::get('/user', [AuthController::class, 'getUser']);

// Poli
Route::get('/get-poli', [PoliController::class, 'getPoli']);

// Antrian
Route::get('/get-antrian', [AntrianController::class, 'getAntrian']);
Route::get('/get-antrian-user', [AntrianController::class, 'getAntrianUser']);
Route::post('/insert-antrian', [AntrianController::class, 'insertAntrian']);
Route::put('/update-antrian', [AntrianController::class, 'updateAntrian'])->name('next_pasien');
Route::delete('/delete-antrian', [AntrianController::class, 'deleteAntrian']);