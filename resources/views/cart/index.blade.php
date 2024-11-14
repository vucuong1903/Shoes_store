<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng của bạn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @extends('layouts.app')

    @section('content')
    <h1>Giỏ hàng của bạn</h1>
    @if(count($cart) > 0)
    <table class="table">
        <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Thành tiền</th>
                <th>Danh mục</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach ($cart as $id => $details)
            @php $total += $details['price'] * $details['quantity']; @endphp
            <tr>
                <td>{{ $details['name'] }}</td>
                <td>
                    <form action="{{ route('cart.update', $id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PATCH')
                        <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" class="form-control" style="width: 60px; display: inline;">
                        <button type="submit" class="btn btn-sm btn-secondary">Cập nhật</button>
                    </form>
                </td>
                <td>{{ number_format($details['price'], 2) }}</td>
                <td>{{ number_format($details['price'] * $details['quantity'], 2) }}</td>
                <td>{{ $details['category'] }}</td>
                <td>
                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Xoá</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="text-right">
        <h3>Tổng tiền: {{ number_format($total, 2) }} VND</h3>
    </div>

    <!-- Form đặt hàng -->
    <form id="order-form" action="{{ route('order.store') }}" method="POST">
        @csrf
        <input type="hidden" name="total" value="{{ $total }}">
        <div class="form-group">
            <label for="payment_method">Phương thức thanh toán:</label>
            <select name="payment_method" id="payment_method" class="form-control">
                <option value="COD">Thanh toán khi nhận hàng (COD)</option>
                <option value="online">Thanh toán trực tuyến</option>
            </select>
        </div>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmationModal">
            Đặt hàng
        </button>
    </form>
    @else
    <p>Giỏ hàng của bạn trống.</p>
    @endif
    <a href="{{ route('welcome') }}" class="btn btn-primary">Tiếp tục mua sắm</a>

    <!-- Modal confirmation -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Xác nhận đơn hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn đặt hàng và thanh toán không?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary" form="order-form">Xác nhận</button>
                </div>
            </div>
        </div>
    </div>

    @endsection

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
