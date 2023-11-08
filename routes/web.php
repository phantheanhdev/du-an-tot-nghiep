<?php

use App\Http\Controllers\BillController;
use App\Events\HelloPusherEvent;
use App\Http\Controllers\AdminDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QrController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Cookie;

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

// ========================================================= admin ====================================================

//Login
Route::match(['GET', 'POST'], '/login', [App\Http\Controllers\Login\LoginController::class, 'login'])->name('login');
Route::get('/logout', [App\Http\Controllers\Login\LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    // Dashboard admin
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('restaurant-manager', [TableController::class, 'restaurant_manager'])->name('restaurant-manager');
    Route::get('order-of-table/{id}', [TableController::class, 'order_of_table'])->name('order-of-table');
    Route::get('qr-builder', [QrController::class, 'qr_builder'])->name('qr-builder');

    // table
    Route::resource('table', TableController::class);
    //products
    Route::get('product', [ProductController::class, 'index'])->name('product.index');
    Route::match(['GET', 'POST'], '/add', [App\Http\Controllers\ProductController::class, 'add'])->name('create');
    Route::match(['get', 'post'], '/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::get('delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
    Route::get('/', [TableController::class, 'restaurant_manager'])->name('restaurant_manager');

    //staff
    Route::prefix('staff')->group(function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('employee.index');
        Route::match(['get', 'post'], 'create', [EmployeeController::class, 'create'])->name('employee.create');
        Route::match(['get', 'post'], 'edit/{id}', [EmployeeController::class, 'edit'])->name('employee.edit');
        Route::get('delete/{id}', [EmployeeController::class, 'delete'])->name('employee.delete');
    });

    //category
    Route::prefix('category')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('category.index');
        Route::match(['get'], 'create', [CategoryController::class, 'create'])->name('category.create');
        Route::match(['post'], 'store', [CategoryController::class, 'store'])->name('category.store');
        Route::match(['get', 'post'], 'edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
    });
});



// ======================================================= user ===============================================================


// order
Route::get('list-order', [OrderController::class, 'index']);
// view invoice order
Route::get('/invoice/{id}', [OrderController::class, 'viewInvoice'])->name('viewInvoice');
// download FDF order
Route::get('/invoice/{id}/generate', [OrderController::class, 'genarateInvoice'])->name('genarateInvoice');
// print order
Route::get('/print_order/{id}', [OrderController::class, 'print_order'])->name('print_order');
//

// order menu
// http://127.0.0.1:8000/order/menu?tableNo=15
//  bat dau quet , nhap ten http://127.0.0.1:8000/Foodie?tableNo=6
Route::group(['middleware' => 'custom'], function () {
    Route::get('order/menu',[MenuController::class, 'index'])->name('order.menu');
});
Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart']);
Route::delete('/remove-from-cart', [CartController::class, 'remove']);
Route::post('order', [CartController::class, 'order'])->name('order');

// bill
Route::resource('bill', BillController::class);

// form infor user
// http://127.0.0.1:8000/Foodie?tableNo=6
Route::get('/Foodie', [HomeController::class, 'form_infor_user'])->name('form_infor_user');

Route::post('/submit_form',[HomeController::class,'loginUser'])->name('login.user');
Route::get('home', [HomeController::class, 'home']);


// 3 route test pusher
Route::get('/test', function () {
    return view('showNotification');
});

Route::get('getPusher', function () {
    return view('form_pusher');
});

Route::get('/pusher', function (Illuminate\Http\Request $request) {
    event(new HelloPusherEvent($request));
    return redirect('getPusher');
});
//
