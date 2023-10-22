<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QrController;
use App\Http\Controllers\TableController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Login
Route::match(['GET', 'POST'], '/login', [App\Http\Controllers\Login\LoginController::class, 'login'])->name('login');
Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');
//products

Route::get('product', [ProductController::class, 'index'])->name('product.index');
Route::match(['GET', 'POST'], '/add', [App\Http\Controllers\ProductController::class, 'add'])->name('create');
Route::match(['get', 'post'], '/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
Route::get('delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
Route::get('/', [TableController::class, 'restaurant_manager'])->name('/');

// =========================== admin ==================================
Route::get('restaurant-manager', [TableController::class, 'restaurant_manager'])->name('restaurant-manager');
Route::get('qr-builder', [QrController::class, 'qr_builder'])->name('qr-builder');

// table
Route::resource('table', TableController::class);

//category
Route::prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('category.index');
    Route::match(['get'], 'create', [CategoryController::class, 'create'])->name('category.create');
    Route::match(['post'], 'store', [CategoryController::class, 'store'])->name('category.store');
    Route::match(['get', 'post'], 'edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
});

// =========================== user ====================================
Route::get('home', [HomeController::class, 'home'])->name('home');
