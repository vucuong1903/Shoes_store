<?php

// app/Http/Controllers/Admin/ReportController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        // Thống kê tổng doanh thu theo từng danh mục
        $categoryRevenue = DB::table('order_items')
            ->select('products.category_id', DB::raw('SUM(order_items.price * order_items.quantity) as total_revenue'))
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', 'paid')
            ->groupBy('products.category_id')
            ->get();

        // Tổng số đơn hàng
        $totalOrders = Orders::count();

        // Tổng số khách hàng
        $totalCustomers = DB::table('users')->where('role', 'customer')->count();

        // Doanh thu theo ngày, tháng, năm
        $revenueByDate = Orders::select(DB::raw('DATE(created_at) as date, SUM(total) as total_revenue'))
            ->where('status', 'paid')
            ->groupBy('date')
            ->get();

        $revenueByMonth = Orders::select(DB::raw('MONTH(created_at) as month, SUM(total) as total_revenue'))
            ->where('status', 'paid')
            ->groupBy('month')
            ->get();

        $revenueByYear = Orders::select(DB::raw('YEAR(created_at) as year, SUM(total) as total_revenue'))
            ->where('status', 'paid')
            ->groupBy('year')
            ->get();
        // Doanh thu theo ngày từ bảng payments
        $revenueByDate = DB::table('payments')
            ->select(DB::raw('DATE(payment_date) as date, SUM(amount) as total_revenue'))
            ->groupBy('date')
            ->get();

        // Doanh thu theo tháng từ bảng payments
        $revenueByMonth = DB::table('payments')
            ->select(DB::raw('MONTH(payment_date) as month, SUM(amount) as total_revenue'))
            ->groupBy('month')
            ->get();

        // Doanh thu theo năm từ bảng payments
        $revenueByYear = DB::table('payments')
            ->select(DB::raw('YEAR(payment_date) as year, SUM(amount) as total_revenue'))
            ->groupBy('year')
            ->get();

        // Doanh thu theo phương thức thanh toán
        $revenueByPaymentMethod = DB::table('payments')
            ->select('payment_method', DB::raw('SUM(amount) as total_revenue'))
            ->groupBy('payment_method')
            ->get();
        return view('admin.reports.index', compact(
            'categoryRevenue',
            'totalOrders',
            'totalCustomers',
            'revenueByDate',
            'revenueByMonth',
            'revenueByYear',
            'revenueByPaymentMethod' // Thêm vào compact
        ));
    }
}
