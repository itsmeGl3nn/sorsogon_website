<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeBannerCMSController;

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

// POST METHOD
Route::post('/login', [AuthController::class, 'login']);
Route::post('/refresh', [AuthController::class, 'refresh']);


Route::post('/book-appointment', [AppointmentController::class, 'create']);
Route::post('/complaints', [ComplaintController::class, 'create']);
Route::post('/users', [UserController::class, 'store']); // Create user route
Route::post('/home-banners', [HomeBannerCMSController::class, 'store']); // Create banner route

// PUT  METHOD
Route::put('/home-banners/{id}', [HomeBannerCMSController::class, 'update']); // Create banner route



// DELETE METHOD
Route::delete('/complaints/{id}', [ComplaintController::class, 'delete']);
Route::delete('/users/{id}', [UserController::class, 'delete']);
Route::delete('/book-appointment/{id}', [AppointmentController::class, 'delete']);
Route::delete('/home-banners/{id}', [HomeBannerCMSController::class, 'delete']); // Delete banner route

// GET METHOD
Route::get('/complaints-list', [ComplaintController::class, 'getcomplaint']);
Route::get('/booked-appointment', [AppointmentController::class, 'getappointment']);
Route::get('/users', [UserController::class, 'index']);
Route::get('/home-banners', [HomeBannerCMSController::class, 'index']); // List banners route
