<?php

use App\Http\Controllers\Api\AuditController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
  Route::post('/logout', [UserController::class, 'logout']);
  Route::get('audit', [AuditController::class, 'index']);
});
