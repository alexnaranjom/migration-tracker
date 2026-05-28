<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\ModuleController;
use App\Http\Controllers\Api\MigrationNoteController;

// Dashboard stats
Route::get('/dashboard', [DashboardController::class, 'index']);

// Module CRUD
Route::apiResource('modules', ModuleController::class);

// Module status update (separate endpoint)
Route::patch('/modules/{module}/status', [ModuleController::class, 'updateStatus']);

// Module notes (nested resource)
Route::get('/modules/{module}/notes', [MigrationNoteController::class, 'index']);
Route::post('/modules/{module}/notes', [MigrationNoteController::class, 'store']);
