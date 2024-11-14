<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WelcomeController; // Đảm bảo sử dụng đúng tên controller
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\ReportController;

// Route cho trang chủ
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Đăng ký và đăng nhập người dùng
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Route dành cho admin (sử dụng middleware để kiểm tra quyền)
Route::middleware(['auth','admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Route quản lý sản phẩm
    Route::resource('admin/products', ProductController::class, [
        'as' => 'admin'
    ]);
    
    // Route quản lý danh mục
    Route::resource('admin/categories', CategoryController::class, [
        'as' => 'admin'
    ]);
    Route::get('/admin/orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.orders.index');
    Route::patch('/admin/orders/{order}', [App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    Route::get('/admin/reports', [ReportController::class, 'index'])->name('admin.reports.index');
    Route::get('admin/orders/{order}', [App\Http\Controllers\Admin\OrderController::class, 'show'])->name('admin.orders.show');
});


// Route cho người dùng bình thường
Route::middleware(['auth',])->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{product}', [ProductController::class, 'show_auth'])->name('products.show');
    Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
    Route::post('/orders', [OrderController::class, 'store'])->name('order.store');
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');


});

Route::get('/search-products', [WelcomeController::class, 'searchProducts'])->name('search.products');


// Route để thêm sản phẩm vào giỏ hàng
Route::middleware(['auth'])->post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');

// Route để hiển thị giỏ hàng
Route::middleware(['auth'])->get('/cart', [CartController::class, 'index'])->name('cart.index');

// Route để xóa sản phẩm khỏi giỏ hàng
Route::middleware(['auth'])->delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');

// Route để cập nhật số lượng sản phẩm trong giỏ hàng
Route::middleware(['auth'])->patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
