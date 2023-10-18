<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [TableController::class, 'restaurant_manager']);

// =========================== admin ==================================
Route::get('restaurant-manager', [TableController::class, 'restaurant_manager']);
Route::get('qr-builder', [QrController::class, 'qr_builder']);

// table
Route::resource('table', TableController::class);

//category
Route::prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('category.index');
    Route::match(['get'], 'create', [CategoryController::class, 'create'])->name('category.create');
    Route::match(['post'], 'store', [CategoryController::class, 'store'])->name('category.store');
    // Route::match(['get', 'post'], 'edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');

});

// =========================== user ====================================
Route::get('home', [HomeController::class, 'home']);
