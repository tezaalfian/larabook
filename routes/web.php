<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('e-book/{book}', [HomeController::class, 'book'])->name('home.book')->whereNumber('book');

Route::middleware('auth')->group(function () {
    Route::resource('kategori', CategoryController::class)->except('show')
        ->names('category')
        ->parameter('kategori', 'category');
    Route::resource('buku', BookController::class)->except('show')
        ->names('book')
        ->parameter('buku', 'book');
    Route::get('file/book/{id}', [FileController::class, 'book'])
        ->name('file.book')
        ->whereNumber('id');
    Route::post('e-book/{book}/order', [OrderController::class, 'store'])
        ->name('order.store')
        ->whereNumber('book');
    Route::get('e-book/order', [HomeController::class, 'order'])
        ->name('home.order');
});

require __DIR__ . '/auth.php';
