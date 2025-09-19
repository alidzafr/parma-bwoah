<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/search', [FrontController::class, 'search'])->name('front.search');
Route::get('/detail/{product:slug}', [FrontController::class, 'detail'])->name('front.product.detail');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('product', ProductController::class)->middleware('role:owner');
        Route::resource('category', CategoryController::class)->middleware('role:owner');
    });

    // Route::resource('cart', CartController::class)->middleware('role:buyer');
    Route::get('/cart', [CartController::class, 'index'])->middleware(['auth', 'verified'])->name('cart.index');
    Route::post('/cart/{id}', [CartController::class, 'store'])->middleware(['auth', 'verified'])->name('cart.store');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->middleware(['auth', 'verified'])->name('cart.destroy');

    Route::resource('order', InvoiceController::class)->middleware('role:owner|buyer');
});

require __DIR__ . '/auth.php';
