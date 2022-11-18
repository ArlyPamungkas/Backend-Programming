<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientsController;
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

Route::middleware('auth:sanctum')->group(function() {
    // Get all resource patients
    // Method get
    Route::get('/patients', [PatientsController::class, 'index']);

    // Add resource
    // Method post
    Route::post('/patients', [PatientsController::class, 'store']);

    // Get detailed resource
    // Method get
    Route::get('/patients/{id}', [PatientsController::class, 'show']);

    // Edit resource
    // Method put
    Route::put('/patients/{id}', [PatientsController::class, 'update']);

    // Delete resource
    // Method delete
    Route::delete('/patients/{id}', [PatientsController::class, 'destroy']);

    // Search resource by name
    // Method get
    Route::get('/patients/search/{name}', [PatientsController::class, 'search']);

    // Get positive resource
    // Method get
    Route::get('/patients/status/positive', [PatientsController::class, 'positive']);

    // Get recovered resource
    // Method get
    Route::get('/patients/status/recovered', [PatientsController::class, 'recovered']);

    // Get dead resource
    // Method get
    Route::get('/patients/status/dead', [PatientsController::class, 'dead']);
});

// Membuat route untuk register dan login
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);