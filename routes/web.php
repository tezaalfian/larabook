<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::middleware('auth')->group(function () {
    Route::resource('kategori', CategoryController::class)->except('show')
        ->names('category')
        ->parameter('kategori', 'category');
});

require __DIR__ . '/auth.php';
