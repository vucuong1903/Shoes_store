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
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Edit Category</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('admin.categories.index') }}"> Back</a>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Type:</strong>
                        <input type="text" name="type" value="{{ $category->type }}" class="form-control" placeholder="type">
                        <strong>Brand:</strong>
                        <input type="text" name="brand" value="{{ $category->brand }}" class="form-control" placeholder="brand">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div> 
    @endsection

</body>

</html>