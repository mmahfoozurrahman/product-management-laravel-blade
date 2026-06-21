<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('categories')->name('categories.')->controller(CategoryController::class)->group(function () {
    Route::get('/create', 'create')->name('create');
    Route::post('/', 'store')->name('store');
    Route::get('/confirmation/{category}', 'confirmation')->whereNumber('category')->name('confirmation');
});

Route::prefix('products')->name('products.')->controller(ProductController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/', 'store')->name('store');
    Route::get('/summary', 'summary')->name('summary');
    Route::get('/json', 'json')->name('json');
    Route::get('/redirect', 'redirectToIndex')->name('redirect');
    Route::get('/confirmation/{product}', 'confirmation')->whereNumber('product')->name('confirmation');
    Route::get('/{product}', 'show')->whereNumber('product')->name('show');
});
