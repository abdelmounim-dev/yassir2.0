<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TripController;
use App\Http\Controllers\LocationController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/register", [AuthController::class, 'register']);
Route::post("/login", [AuthController::class, 'login']);

Route::apiResource('trips', TripController::class);
Route::post('/trips', [TripController::class, 'store']);
Route::get('/trips/{trips}', [TripController::class, 'show']);
Route::post('/trips/{trips}/accept', [TripController::class, 'accept']);
Route::post('/trips/{trips}/start', [TripController::class, 'start']);
Route::post('/trips/{trips}/end', [TripController::class, 'end']);
Route::post('/trips/{trips}/location', [TripController::class, 'location']);

Route::apiResource('locations', LocationController::class);
Route::apiResource('reservations', ReservationController::class);

Route::get('/driver', [DriverController::class, 'show']);
Route::post('/driver', [DriverController::class, 'update']);
