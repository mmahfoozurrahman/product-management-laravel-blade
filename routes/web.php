<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('products')->name('products.')->controller(ProductController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/summary', 'summary')->name('summary');
    Route::get('/json', 'json')->name('json');
    Route::get('/redirect', 'redirectToIndex')->name('redirect');
    Route::get('/{product}', 'show')->whereNumber('product')->name('show');
});
