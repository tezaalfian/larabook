<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::post('order/notification', [OrderController::class, 'notification'])
    ->name('order.notification');
