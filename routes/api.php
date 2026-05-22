<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ServiceController;

Route::apiResource('services', ServiceController::class);

Route::patch('services/{id}/activate', [
    ServiceController::class,
    'activate'
]);

Route::patch('services/{id}/deactivate', [
    ServiceController::class,
    'deactivate'
]);