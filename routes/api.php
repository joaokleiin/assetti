<?php

use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\EquipmentController;
use App\Http\Controllers\Api\MaintenanceController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/equipments', [EquipmentController::class, 'index']);
Route::get('/equipments/{equipment}', [EquipmentController::class, 'show']);
Route::get('/maintenances', [MaintenanceController::class, 'index']);
Route::get('/maintenances/{maintenance}', [MaintenanceController::class, 'show']);
