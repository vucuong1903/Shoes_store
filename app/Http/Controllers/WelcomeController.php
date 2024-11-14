<?php

namespace App\Http\Controllers;

use App\Models\Product; // Model Product
use Illuminate\Http\Request; // Thêm lớp Request

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        // Khởi tạo query để lấy danh sách sản phẩm và thông tin category
        $query = Product::with('category');

        // Kiểm tra nếu có từ khóa tìm kiếm
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            // Tìm kiếm sản phẩm theo tên
            $query->where('name', 'like', '%' . $searchTerm . '%');
        }

        // Lấy danh sách sản phẩm với phân trang
        $products = $query->paginate(10);

        // Truyền biến $products tới view 'welcome'
        return view('welcome', compact('products'));
    }
}
