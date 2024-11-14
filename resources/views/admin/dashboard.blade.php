<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('https://png.pngtree.com/thumb_back/fw800/background/20221110/pngtree-sport-footwear-boots-black-and-white-seamless-pattern-image_1430473.jpg') no-repeat center center fixed;
            /* Hình nền giày */
            background-size: cover;
            /* Đảm bảo hình nền phủ toàn bộ */
            color: #333;
            font-family: 'Arial', sans-serif;
            overflow-x: hidden;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <h1>Welcome to Admin Dashboard</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Products</h5>
                        <p class="card-text">{{ $totalProducts }}</p>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Manage Products</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Categories</h5>
                        <p class="card-text">{{ $totalCategories }}</p>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">Manage Categories</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Orders</h5>
                        <p class="card-text">{{ $totalOrders }}</p>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">Manage Order</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Payment</h5>
                        <p class="card-text">{{ $totalPayments }}</p>
                        <a href="{{ route('admin.reports.index') }}" class="btn btn-info">Báo cáo</a> <!-- Nút xem báo cáo -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>