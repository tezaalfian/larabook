<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('e-book/{book}', [HomeController::class, 'book'])->name('home.book');

Route::middleware('auth')->group(function () {
    Route::resource('kategori', CategoryController::class)->except('show')
        ->names('category')
        ->parameter('kategori', 'category');
    Route::resource('buku', BookController::class)->except('show')
        ->names('book')
        ->parameter('buku', 'book');
    Route::get('file/book/{id}', [FileController::class, 'book'])
        ->name('file.book');
});

require __DIR__ . '/auth.php';
