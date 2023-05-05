<?php
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/pharmacies', [PharmacyController::class, 'index']);
Route::get('/pharmacies/{id}', [PharmacyController::class, 'show']);
Route::get('/pharmacies/search/{name}', [PharmacyController::class, 'search']);

Route::get('/medicines', [MedicineController::class, 'index']);
Route::get('/medicines/{id}', [MedicineController::class, 'show']);
Route::get('/medicines/search/{name}', [MedicineController::class, 'search']);

// Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/pharmacies', [PharmacyController::class, 'store']);
    Route::put('/pharmacies/{id}', [PharmacyController::class, 'update']);
    Route::delete('/pharmacies/{id}', [PharmacyController::class, 'destroy']);

    Route::post('/medicines', [MedicineController::class, 'store']);
    Route::put('/medicines/{id}', [MedicineController::class, 'update']);
    Route::delete('/medicines/{id}', [MedicineController::class, 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);
});



