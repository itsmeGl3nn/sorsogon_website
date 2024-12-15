<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeBannerCMSController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\MunicipalOfficerController;
use App\Http\Controllers\TourismController; // Import TourismController

/*
|----------------------------------------------------------------------
| API Routes
|----------------------------------------------------------------------
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
Route::post('/users', [UserController::class, 'store']);
Route::post('/home-banners', [HomeBannerCMSController::class, 'store']);
Route::post('/news', [NewsController::class, 'store']);
Route::post('/municipal-officers', [MunicipalOfficerController::class, 'store']);
Route::post('/tourism', [TourismController::class, 'store']); // Create tourism route

// PUT METHOD
Route::put('/home-banners/{id}', [HomeBannerCMSController::class, 'update']);
Route::put('/news/{id}', [NewsController::class, 'update']);
Route::put('/municipal-officers/{id}', [MunicipalOfficerController::class, 'update']);
Route::put('/tourism/{id}', [TourismController::class, 'update']); // Update tourism route

// DELETE METHOD
Route::delete('/complaints/{id}', [ComplaintController::class, 'delete']);
Route::delete('/users/{id}', [UserController::class, 'delete']);
Route::delete('/book-appointment/{id}', [AppointmentController::class, 'delete']);
Route::delete('/home-banners/{id}', [HomeBannerCMSController::class, 'delete']);
Route::delete('/news/{id}', [NewsController::class, 'destroy']);
Route::delete('/municipal-officers/{id}', [MunicipalOfficerController::class, 'destroy']);
Route::delete('/tourism/{id}', [TourismController::class, 'destroy']); // Delete tourism route

// GET METHOD
Route::get('/complaints-list', [ComplaintController::class, 'getcomplaint']);
Route::get('/booked-appointment', [AppointmentController::class, 'getappointment']);
Route::get('/users', [UserController::class, 'index']);
Route::get('/home-banners', [HomeBannerCMSController::class, 'index']);
Route::get('/news', [NewsController::class, 'index']);
Route::get('/news/{title}', [NewsController::class, 'show']);
Route::get('/municipal-officers', [MunicipalOfficerController::class, 'index']);
Route::get('/municipal-officers/{id}', [MunicipalOfficerController::class, 'show']);
Route::get('/tourism', [TourismController::class, 'index']); // List tourism route
Route::get('/tourism/{title}', [TourismController::class, 'show']); // Get tourism by title route

Route::get('/trashed-complaints', [ComplaintController::class, 'trashedComplaints']);
Route::post('/complaints/restore/{id}', [ComplaintController::class, 'restore']);

Route::get('/trashed-banners', [HomeBannerCMSController::class, 'trashedBanner']);
Route::post('/banners/restore/{id}', [HomeBannerCMSController::class, 'restore']);
