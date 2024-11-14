<?php
// app/Http/Controllers/OrderController.php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\OrderItems;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Payment;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Orders::where('user_id', Auth::id())->get();
        return view('orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (count($cart) == 0) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn trống.');
        }

        // Tạo đơn hàng mới
        $order = Orders::create([
            'user_id' => Auth::id(),
            'total' => $request->total,
            'status' => 'processing',
            'payment_method' => $request->payment_method,
        ]);

        // Lưu các mặt hàng trong đơn hàng
        foreach ($cart as $id => $details) {
            OrderItems::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $details['quantity'],
                'price' => $details['price'],
            ]);
        }

        // Tạo bản ghi thanh toán
        Payment::create([
            'order_id' => $order->id,
            'amount' => $order->total,
            'payment_method' => $order->payment_method,
        ]);

        // Xóa giỏ hàng sau khi đặt hàng
        session()->forget('cart');

        // Chuyển hướng và hiển thị thông báo thành công với chi tiết đơn hàng
        return redirect()->route('order.index')->with('success', 'Đặt hàng thành công!')->with('order', $order);
    }
    // app/Http/Controllers/OrderController.php

    public function show($id)
    {
        // Lấy đơn hàng với các mặt hàng liên quan
        $order = Orders::with('items.product')->find($id);
    
        if (!$order) {
            return response()->json(['error' => 'Đơn hàng không tồn tại'], 404);
        }
    
        return response()->json($order);
    }
    
}
