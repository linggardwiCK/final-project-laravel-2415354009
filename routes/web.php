<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

Route::get('/customers', [CustomerController::class, 'index'])
    ->name('customers.index');

Route::post('/customers', [CustomerController::class, 'store'])
    ->name('customers.store');

Route::patch('/customers/{id}', [CustomerController::class, 'update'])
    ->name('customers.update');

Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])
    ->name('customers.destroy');

use App\Http\Controllers\ServiceController;

Route::get('/services', [ServiceController::class, 'index'])
    ->name('services.index');

Route::post('/services', [ServiceController::class, 'store'])
    ->name('services.store');

Route::patch('/services/{id}', [ServiceController::class, 'update'])
    ->name('services.update');

Route::delete('/services/{id}', [ServiceController::class, 'destroy'])
    ->name('services.destroy');


    use App\Http\Controllers\SubscriptionController;

Route::get(
    '/subscriptions',
    [SubscriptionController::class, 'index']
)->name('subscriptions.index');

Route::post(
    '/subscriptions',
    [SubscriptionController::class, 'store']
)->name('subscriptions.store');

Route::patch(
    '/subscriptions/{id}/status',
    [SubscriptionController::class, 'changeStatus']
)->name('subscriptions.status');