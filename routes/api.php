<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// POST METHOD
Route::post('/login', [AuthController::class, 'login']);
Route::post('/refresh', [AuthController::class, 'refresh']);


Route::post('/book-appointment', [AppointmentController::class, 'create']);
Route::post('/complaints', [ComplaintController::class, 'create']);

Route::delete('/complaints/{id}', [ComplaintController::class, 'delete']);

Route::delete('/book-appointment/{id}', [ComplaintController::class, 'delete']);






// GET METHOD
Route::get('/complaints-list', [ComplaintController::class, 'getcomplaint']);
Route::get('/booked-appointment', [AppointmentController::class, 'getappointment']);
Route::get('/users', [UserController::class, 'index']);
