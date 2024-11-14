<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get(); // Lấy tất cả sản phẩm với thông tin category
        
        return view('admin.products.index', compact('products')); // Cập nhật đường dẫn view

        // Khởi tạo query cho sản phẩm và load thông tin category
        $query = Product::with('category');

        // Kiểm tra nếu có từ khóa tìm kiếm
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;

            // Tìm kiếm theo tên sản phẩm hoặc hãng (brand)
            $query->where('name', 'like', '%' . $searchTerm . '%')
                ->orWhereHas('category', function ($q) use ($searchTerm) {
                    $q->where('brand', 'like', '%' . $searchTerm . '%');
                });
        }

        // Lấy danh sách sản phẩm từ query
        $products = $query->get();
    }

    public function create()
    {
        $categories = Category::all(); // Lấy tất cả danh mục
        return view('admin.products.create', compact('categories')); // Cập nhật đường dẫn view
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048', // Kiểm tra ảnh
            'size' => 'required|string|max:50',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        // Lưu hình ảnh
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        // Tạo sản phẩm mới
        Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'image' => $imagePath ?? null,
            'size' => $request->size,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.'); // Cập nhật đường dẫn route
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product')); // Cập nhật đường dẫn view
    }
    public function show_auth(Product $product)
    {
        return view('products.show', compact('product')); // Cập nhật đường dẫn view
    }

    public function edit(Product $product)
    {
        $categories = Category::all(); // Lấy tất cả danh mục
        return view('admin.products.edit', compact('product', 'categories')); // Cập nhật đường dẫn view
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            'size' => 'required|string|max:50',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        // Cập nhật hình ảnh nếu có
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $product->image = $imagePath;
        }

        // Cập nhật thông tin sản phẩm
        $product->update($request->except('image')); // Cập nhật mọi trường ngoại trừ image
        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.'); // Cập nhật đường dẫn route
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.'); // Cập nhật đường dẫn route
    }
}
