<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    @extends('layouts.app')

    @section('content')
    <h1>Danh sách đơn hàng của bạn</h1>

    @if(session('order'))
    <div class="alert alert-info">
        <h4>Đơn hàng của bạn đã được tạo thành công!</h4>
        <p><strong>Mã đơn hàng:</strong> {{ session('order')->id }}</p>
        <p><strong>Tổng tiền:</strong> {{ number_format(session('order')->total, 2) }} VND</p>
        <p><strong>Phương thức thanh toán:</strong> {{ session('order')->payment_method }}</p>

        <h5>Chi tiết sản phẩm trong đơn hàng:</h5>
        <ul>
            @foreach(session('order')->items as $item)
            <li>
                {{ $item->product->name }} -
                {{ $item->quantity }} x {{ number_format($item->price, 2) }} VND =
                {{ number_format($item->quantity * $item->price, 2) }} VND
            </li>
            @endforeach
        </ul>
    </div>

    <!-- Hiển thị SweetAlert2 popup khi đơn hàng được tạo thành công -->
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Đặt hàng thành công!',
            text: 'Mã đơn hàng của bạn là: {{ session("order")->id }}',
            showConfirmButton: false,
            timer: 3000
        });
    </script>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Mã đơn hàng</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Phương thức thanh toán</th>
                <th>Ngày tạo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#orderDetailsModal" data-order-id="{{ $order->id }}">
                <td>{{ $order->id }}</td>
                <td>{{ number_format($order->total, 2) }} VND</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->payment_method }}</td>
                <td>{{ $order->created_at->format('d-m-Y H:i:s') }}</td>
            </tr>

            @endforeach
        </tbody>
    </table>
    @endsection
    <!-- Modal chi tiết đơn hàng -->
    <div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderDetailsModalLabel">Chi tiết đơn hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="orderDetailsContent">
                    <!-- Nội dung chi tiết đơn hàng sẽ được tải qua Ajax -->
                </div>
            </div>
        </div>
    </div>
    <script>
    // Lắng nghe sự kiện khi modal được mở
    const orderDetailsModal = document.getElementById('orderDetailsModal');
    orderDetailsModal.addEventListener('show.bs.modal', function(event) {
        // Lấy ID đơn hàng từ thuộc tính data-order-id trong dòng bảng
        const orderId = event.relatedTarget.getAttribute('data-order-id');

        // Gửi yêu cầu Ajax để lấy chi tiết đơn hàng
        fetch(`/orders/${orderId}`)
            .then(response => response.json())
            .then(data => {
                let htmlContent = `<p><strong>Mã đơn hàng:</strong> ${data.id}</p>`;
                htmlContent += `<p><strong>Tổng tiền:</strong> ${data.total} VND</p>`;
                htmlContent += `<p><strong>Phương thức thanh toán:</strong> ${data.payment_method}</p>`;
                htmlContent += `<h5>Chi tiết sản phẩm:</h5><ul>`;

                // Duyệt qua các sản phẩm trong đơn hàng
                data.items.forEach(item => {
                    const quantity = item.quantity || 0; // Kiểm tra giá trị quantity
                    const price = item.price || 0; // Kiểm tra giá trị price
                    const totalPrice = quantity * price; // Tính tổng tiền cho sản phẩm
                    htmlContent += `<li>${item.product.name} - ${quantity} x ${price} VND = ${totalPrice} VND</li>`;
                });

                htmlContent += `</ul>`;
                document.getElementById('orderDetailsContent').innerHTML = htmlContent;
            })
            .catch(error => {
                console.error('Có lỗi xảy ra:', error);
            });
    });
</script>


</body>

</html>