<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ShortLinkController;
use \App\Http\Controllers\Api\V1\AuthController;

//Public routes
Route::post('/links', [ShortLinkController::class, 'store']);
Route::post('/register', [AuthController::class, 'register']);

//Protected routes using sanctum
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/links', [ShortLinkController::class, 'index']);
    Route::put('/links/{id}', [ShortLinkController::class, 'update']);
    Route::delete('/links/{id}', [ShortLinkController::class, 'destroy']);
    Route::get('/links/search/{name}', [ShortLinkController::class, 'search']);
    Route::get('/links/{id}', [ShortLinkController::class, 'show']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
