<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Models\Category;
use App\Models\Orders;
use App\Models\Payment;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalProducts = Product::count(); // Thay thế với mô hình sản phẩm thực tế của bạn
        $totalCategories = Category::count(); // Thay thế với mô hình danh mục thực tế của bạn
        $totalOrders = Orders::count(); // Thay thế với mô hình đơn hàng thực tế của bạn
        $totalPayments = Payment::count(); 
    
        return view('admin.dashboard', compact('totalProducts', 'totalCategories', 'totalOrders', 'totalPayments'));
    }

    public function products()
    {
        return app(ProductController::class)->index();
    }

    public function categories()
    {
        return app(CategoryController::class)->index();
    }
}
