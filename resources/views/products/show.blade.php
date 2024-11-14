<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Product</title>
</head>

<body>
    @extends('layouts.app')

    @section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Chi tiết sản phẩm</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('welcome') }}">Quay lại</a>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text"><strong>Danh mục:</strong> {{ $product->category->type }}</p>
                <p class="card-text"><strong>Hãng:</strong> {{ $product->category->brand }}</p>
                <p class="card-text"><strong>Kích thước:</strong> {{ $product->size }}</p>
                <p class="card-text"><strong>Mô tả:</strong> {{ $product->description }}</p>
                <p class="card-text"><strong>Giá:</strong> {{ number_format($product->price, 0) }} VND</p>
                <img src="{{ asset('storage/' . $product->image) }}" width="200" alt="Hình ảnh sản phẩm" class="img-fluid">

                <!-- Form thêm vào giỏ hàng -->
                @auth
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-3">
                    @csrf
                    <button type="submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
                </form>
                @else
                <p class="mt-3">Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để thêm sản phẩm vào giỏ hàng.</p>
                @endauth
            </div>
        </div>
    </div>
    @endsection

</body>

</html>