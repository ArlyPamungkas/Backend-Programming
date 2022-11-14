<?php
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AuthController;
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
    // Get all resource student
    // Method get
    Route::get('/students', [StudentController::class, 'index']);

    // Menambahkan resource student
    // Method post
    Route::post('/students', [StudentController::class, 'store']);

    // Memperbarui resource student
    // Method put
    Route::put('/students/{id}', [StudentController::class, 'update']);

    // Menghapus resource student
    // Method delete
    Route::delete('/students/{id}', [StudentController::class, 'destroy']);

    // Mendapatkan detail resource student
    // Method get
    Route::get('/students/{id}', [StudentController::class, 'show']);
});

// Method get
Route::get('/animals', [AnimalController::class, 'index']);

// Method post
Route::post('/animals', [AnimalController::class, 'store']);

// Method put
Route::put('/animals/{id}', [AnimalController::class, 'update']);

// Method delete
Route::delete('/animals/{id}', [AnimalController::class, 'destroy']);

// Membuat route untuk register dan login
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);