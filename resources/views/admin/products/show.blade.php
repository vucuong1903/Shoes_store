<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Product</title>
</head>

<body>
@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Product Details</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('admin.products.index') }}"> Back</a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text"><strong>Kiểu:</strong> {{ $product->category->type }}</p>
                <p class="card-text"><strong>Brand:</strong> {{ $product->category->brand }}</p>
                <p class="card-text"><strong>Size:</strong> {{ $product->size }}</p>
                <p class="card-text"><strong>Description:</strong> {{ $product->description }}</p>
                <p class="card-text"><strong>Price:</strong> {{ number_format($product->price, 0) }} VNĐ</p>
                <img src="{{ asset('storage/' . $product->image) }}" width="200" alt="Product Image">
            </div>
        </div>
    </div>
    @endsection
</body>

</html>
