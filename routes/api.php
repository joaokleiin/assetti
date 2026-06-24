<?php

use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\EquipmentController;
use App\Http\Controllers\Api\MaintenanceController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\SectorController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/equipments', [EquipmentController::class, 'index']);
Route::get('/equipments/{equipment}', [EquipmentController::class, 'show']);
Route::get('/maintenances', [MaintenanceController::class, 'index']);
Route::get('/maintenances/{maintenance}', [MaintenanceController::class, 'show']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/brands', [BrandController::class, 'index']);
Route::get('/sectors', [SectorController::class, 'index']);
