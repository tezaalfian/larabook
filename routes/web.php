<?php

use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('e-book/{book}', [HomeController::class, 'book'])->name('home.book')->whereNumber('book');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware('role:admin')->group(function () {
        Route::resource('kategori', CategoryController::class)->except('show')
            ->names('category')
            ->parameter('kategori', 'category');
        Route::resource('buku', BookController::class)->except('show')
            ->names('book')
            ->parameter('buku', 'book');
        Route::get('order', [OrderController::class, 'index'])->name('order.index');
    });

    Route::middleware('role:client')->group(function () {
        Route::post('e-book/{book}/order', [OrderController::class, 'store'])
            ->name('order.store')
            ->whereNumber('book');
        Route::get('home/order', [HomeController::class, 'order'])
            ->name('home.order');
        Route::get('home/my-book', [HomeController::class, 'myBook'])
            ->name('home.mybook');
    });

    Route::middleware('role:admin,client')->group(function () {
        Route::get('file/book/{id}', [FileController::class, 'book'])
            ->name('file.book')
            ->whereNumber('id');
        Route::get('profil', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profil', [ProfileController::class, 'update'])->name('profile.update');
    });
});

require __DIR__ . '/auth.php';
