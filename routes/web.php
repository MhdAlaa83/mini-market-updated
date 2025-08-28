<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;

Route::get('/', fn () => redirect()->route('products.index'));

/**
 * Auth
 */
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

/**
 * Products
 */
Route::resource('products', ProductController::class)
    ->only(['index','create','store','show','edit','update'])
    ->names([
        'index'  => 'products.index',
        'create' => 'products.create',
        'store'  => 'products.store',
        'show'   => 'products.show',
        'edit'   => 'products.edit',
        'update' => 'products.update',
    ]);

/**
 * Cart (optional, session-based)
 */
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('add/{product}', [CartController::class, 'add'])->name('add');
    Route::patch('update/{product}', [CartController::class, 'update'])->name('update');
    Route::delete('remove/{product}', [CartController::class, 'remove'])->name('remove');
    Route::post('clear', [CartController::class, 'clear'])->name('clear');
});
