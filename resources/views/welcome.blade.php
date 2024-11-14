<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Store</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            display: flex;
            flex-direction: column;
            height: 100%;
            border: 2px solid #007bff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s, box-shadow 0.2s;
            margin-bottom: 30px;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
        }

        .card-body {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card-title {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card-text {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            line-height: 1.2;
            margin-bottom: 5px;
            flex: 1;
        }

        img {
            max-height: 170px;
            margin-bottom: 10px;
        }

        .button-wrapper {
            display: flex;
            justify-content: center;
            margin-top: auto;
        }

        .btn {
            margin: 0 5px;
            flex: 1;
            max-width: 100px;
        }
    </style>
</head>

<body>
    @extends('layouts.app')

    @section('content')
    <div class="container">
        <h1>Welcome to Our Store</h1>
        <!-- Form tìm kiếm -->
        <form action="{{ route('welcome') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Tìm kiếm sản phẩm theo tên..." value="{{ request('search') }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Tìm kiếm</button>
                </div>
            </div>
        </form>


        <div class="row ">
            @foreach ($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <img src="{{ Storage::url($product->image) }}" alt="Product Image" class="img-fluid">

                        <div class="text-container">
                            <p class="card-text">{{ $product->category->brand }}</p>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text">{{ number_format($product->price, 0) }} VNĐ</p>
                        </div>

                        <div class="button-wrapper">
                            <a class="btn btn-info" href="{{ route('products.show', $product->id) }}">Show</a>
                            <!-- Nút "Thêm vào giỏ hàng" với biểu tượng giỏ hàng -->
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-shopping-cart"></i>Thêm vào
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Hiển thị phân trang -->
        <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    </div>
    @endsection

</body>

</html>