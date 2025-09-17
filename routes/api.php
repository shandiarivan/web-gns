<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ChatbotController;
use App\Http\Controllers\DashboardController;

Route::get('/test', function () {
    return ['status' => 'API Berhasil diakses!'];
});

Route::post('/chatbot', [ChatbotController::class, 'getResponse']);

// Route::get('/dashboard-data', [DashboardController::class, 'getRealtimeData']);
Route::get('/dashboard-data', [DashboardController::class, 'getRealtimeData'])->name('api.dashboard.data');