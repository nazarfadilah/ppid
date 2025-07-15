<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObjectionController;
use App\Http\Controllers\PublicInformationController;
use App\Http\Controllers\GalleriesController;
use App\Http\Controllers\WhistleController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PublicInformationRequestController;
// use App\Http\Controllers\Auth\AuthController;
// use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailController;
use App\Http\Middleware\AuthLogin;
use App\Http\Controllers\Api\AuthController as ApiAuthController;


// Route::get('/user', fn(Request $request) => $request->user())->middleware('AuthLogin');
Route::middleware([AuthLogin::class])->group(function () {
Route::apiResource('public-information-requests', PublicInformationRequestController::class);
Route::apiResource('objections', ObjectionController::class);
Route::apiResource('galleries', GalleriesController::class);
Route::apiResource('whistles', WhistleController::class);
});

