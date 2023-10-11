<?php

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

// =========================== user ====================================
Route::get('home', [HomeController::class, 'home']);
