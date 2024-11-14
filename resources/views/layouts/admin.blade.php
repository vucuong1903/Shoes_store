<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Unique Application')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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

        .navbar {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .navbar-brand,
        .nav-link {
            color: #ff7e5f !important;
            font-weight: bold;
        }

        .nav-link:hover {
            color: #feb47b !important;
            /* Màu chữ khi hover */
        }

        .container {
            margin-top: 30px;
        }

        .table {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 40px rgba(0, 0, 0, 0.2);
        }

        .table th {
            background: #ff7e5f;
            color: white;
            padding: 12px;
        }

        .table tr:hover {
            background-color: rgba(255, 126, 95, 0.2);
        }

        .btn {
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0069d9;
        }

        .footer {
            background: rgba(0, 0, 0, 0.7);
            color: white;
            text-align: center;
            padding: 20px 0;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        .footer p {
            margin: 0;
        }

        .alert {
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.9);
            border: 1px solid #ffc107;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">My Unique App</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.products.index') }}">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.categories.index') }}">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.orders.index') }}" >Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.reports.index') }}">Reports</a>
                </li>

                <!-- <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Welcome</a>
                </li> -->
            </ul>
            <ul class="navbar-nav ml-auto">
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="#">{{ Auth::user()->name }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
                @endauth
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li>
                @endguest
            </ul>
        </div>
    </nav>

    <div class="container">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif

        @yield('content')
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>