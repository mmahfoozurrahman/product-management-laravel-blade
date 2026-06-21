<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.view');

Route::prefix('categories')->name('categories.')->controller(CategoryController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/', 'store')->name('store');
    Route::get('/confirmation/{category}', 'confirmation')->whereNumber('category')->name('confirmation');
    Route::get('/{category}/edit', 'edit')->whereNumber('category')->name('edit');
    Route::match(['put', 'patch'], '/{category}', 'update')->whereNumber('category')->name('update');
    Route::delete('/{category}', 'destroy')->whereNumber('category')->name('destroy');
    Route::get('/{category}', 'show')->whereNumber('category')->name('show');
});

Route::prefix('products')->name('products.')->controller(ProductController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/', 'store')->name('store');
    Route::get('/summary', 'summary')->name('summary');
    Route::get('/json', 'json')->name('json');
    Route::get('/redirect', 'redirectToIndex')->name('redirect');
    Route::get('/confirmation/{product}', 'confirmation')->whereNumber('product')->name('confirmation');
    Route::get('/{product}/edit', 'edit')->whereNumber('product')->name('edit');
    Route::match(['put', 'patch'], '/{product}', 'update')->whereNumber('product')->name('update');
    Route::delete('/{product}', 'destroy')->whereNumber('product')->name('destroy');
    Route::get('/{product}', 'show')->whereNumber('product')->name('show');
});
