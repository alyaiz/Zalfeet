<?php

use App\Http\Controllers\CartHomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutHomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FilepondController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductHomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::resource('product', ProductHomeController::class);
Route::resource('cart', CartHomeController::class);
Route::resource('checkout', CheckoutHomeController::class);

Route::name('dashboard.')->prefix('dashboard')->middleware(['auth'])->group(function(){
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::post('/upload-image', [FilepondController::class, 'uploadImage'])->name('upload-image');
    Route::delete('/cancel-image', [FilepondController::class, 'cancelImage'])->name('cancel-image');
    Route::post('/upload-image-multiple', [FilepondController::class, 'uploadImageMultiple'])->name('upload-image-multiple');
    Route::delete('/cancel-image-multiple', [FilepondController::class, 'cancelImageMultiple'])->name('cancel-image-multiple');

    Route::name('product.')->prefix('product')->group(function () {
        Route::get('/data', [ProductController::class, 'data'])->name('data');
        route::post('/image', [ProductController::class, 'uploadImage'])->name('image');
        Route::delete('/remove-image-multiple', [FilepondController::class, 'removeImageMultiple'])->name('remove-image-multiple');

        Route::name('category.')->prefix('category')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::get('/data', [CategoryController::class, 'data'])->name('data');
        });
        Route::resource('category', CategoryController::class);
    });
    Route::resource('product', ProductController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
