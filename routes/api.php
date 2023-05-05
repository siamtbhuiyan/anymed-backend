<?php
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\MedicineController;
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

Route::resource("pharmacies", PharmacyController::class);
Route::resource("medicines", MedicineController::class);

Route::get('/pharmacies/search/{name}', [PharmacyController::class, 'search']);
Route::get('/medicines/search/{name}', [MedicineController::class, 'search']);



// Route::get('/pharmacies', [PharmacyController::class, 'index']);
// Route::post('pharmacies', [PharmacyController::class, 'store']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
