<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    @extends('layouts.admin')

    @section('content')
    <h1>Chi tiết đơn hàng #{{ $order->id }}</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên người mua</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Tổng tiền</th>
                <th>Ảnh</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $order->user->name }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->pivot->quantity }}</td>
                <td>{{ number_format($product->price, 0) }} VND</td>
                <td>{{ number_format($product->pivot->quantity * $product->price, 0) }} VND</td>
                <td>
                        @if($product->image)
                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" width="100">
                        @else
                        <span>Không có hình ảnh</span>
                        @endif
                    </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Tổng tiền: {{ number_format($order->total, 0) }} VND</h3>
    <h4>Trạng thái: {{ ucfirst($order->status) }}</h4>
    <h4>Phương thức thanh toán: {{ $order->payment_method }}</h4>

    <!-- Bạn có thể thêm các chi tiết khác hoặc hành động (ví dụ: hủy đơn, giao hàng) nếu cần -->
    @endsection

</body>

</html>