<?php

use App\Http\Controllers\ApprovalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\VehicleOrderController;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
    Route::post('/me', [AuthController::class, 'me'])->middleware('auth:api')->name('me');
});

Route::middleware('auth:api')->group(function () {
    Route::post('/orders', [VehicleOrderController::class, 'store']);
});

Route::middleware('auth:api')->group(function () {
    Route::post('/approvals/{id}/approve', [ApprovalController::class, 'approve']);
    Route::post('/approvals/{id}/reject', [ApprovalController::class, 'reject']);
    Route::get('/approvals/pending', [ApprovalController::class, 'pending']);
});

Route::middleware('auth:api')->get('/reports/export', [ReportController::class, 'export']);

Route::middleware('auth:api')->group(function () {
    Route::put('/orders/{id}', [VehicleOrderController::class, 'update']);
    Route::delete('/orders/{id}', [VehicleOrderController::class, 'destroy']);
});