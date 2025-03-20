<?php

use App\Http\Controllers\Api\AuditController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
  Route::post('/logout', [UserController::class, 'logout']);

  // audit routes only super admin can access
  Route::get('audit', [AuditController::class, 'index']);

  // user routes
  Route::get('generate-password', [UserController::class, 'generatePassword']);
  Route::post('staffs', [UserController::class, 'addStaff']); // only super admin and admin can access
  Route::get('staffs', [UserController::class, 'getStaffs']); // only super admin and admin can access
});
