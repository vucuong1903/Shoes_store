<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'MyShop')</title>
    <!-- Bao gồm Bootstrap CSS hoặc các file CSS khác -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
   <!-- Thanh điều hướng -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ url('/') }}">MyShop</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/') }}">Home</a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.products.index') }}">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.categories.index') }}">Categories</a>
            </li> -->
            <!-- Thêm mục Lịch sử đơn hàng vào đây -->
            
        </ul>
        <ul class="navbar-nav ml-auto">
        @auth
            <li class="nav-item">
                <a class="nav-link" href="{{ route('order.store') }}">
                    <!-- Biểu tượng lịch sử đơn hàng -->
                    <i class="fas fa-history"></i>
                </a>
            </li>
        @endauth
            <!-- Biểu tượng giỏ hàng -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('cart.index') }}">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="badge badge-danger">
                        {{ session('cart') ? count(session('cart')) : 0 }}
                    </span>
                </a>
            </li>
            @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">Register</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>
            @else
            <li class="nav-item">
                <span class="nav-link">Hello {{ Auth::user()->name }}</span>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Đăng xuất
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
            @endguest
        </ul>
    </div>
</nav>

    <div class="container mt-4">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <span class="close" onclick="this.parentElement.style.display='none';">&times;</span>
            <p>{{ $message }}</p>
        </div>

        @elseif ($message = Session::get('error'))
        <div class="alert alert-error">
            <span class="close" onclick="this.parentElement.style.display='none';">&times;</span>
            <p>{{ $message }}</p>
        </div>
        @endif
        @yield('content')
    </div>



    <!-- Bao gồm các file JS cần thiết -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>