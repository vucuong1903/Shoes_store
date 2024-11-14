<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('https://media.istockphoto.com/id/1206659376/vi/vec-to/h%C3%ACnh-minh-h%E1%BB%8Da-vector-c%E1%BB%A7a-m%E1%BB%99t-%C4%91%C3%B4i-gi%C3%A0y-th%E1%BB%83-thao-tr%C3%AAn-n%E1%BB%81n-phong-c%C3%A1ch-retro-n%C4%83ng-%C4%91%E1%BB%99ng.jpg?s=612x612&w=0&k=20&c=zjIBGJB2jWeD8OwE4vSjq6bhMxtHUvBw8BBBE4lv0Vs=');
            /* Hình nền giày */
            background-size: cover;
            /* Làm cho hình nền phủ kín toàn bộ */
            background-position: center;
            /* Căn giữa hình nền */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.8);
            /* Nền trắng với độ trong suốt */
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            /* Hiệu ứng bóng đổ */
            padding: 40px;
            width: 350px;
            text-align: center;
            transition: transform 0.3s;
            /* Hiệu ứng chuyển động */
        }

        .login-container:hover {
            transform: translateY(-5px);
            /* Hiệu ứng nhấc lên khi hover */
        }

        .login-container h2 {
            margin-bottom: 10px;
            /* Giảm khoảng cách giữa tiêu đề và biểu tượng giày */
            color: transparent;
            /* Làm cho màu chữ trong suốt */
            background: linear-gradient(to right, #00aaff, #004d99);
            /* Gradient cho tiêu đề */
            -webkit-background-clip: text;
            /* Cắt nền thành chữ */
            background-clip: text;
            /* Cắt nền thành chữ */
            font-size: 24px;
            /* Kích thước chữ */
        }

        .icon-shoe {
            font-size: 50px;
            /* Kích thước biểu tượng giày */
            color: #007acc;
            /* Màu của biểu tượng */
            margin: 20px 0;
            /* Khoảng cách phía trên và dưới biểu tượng */
        }

        .form-group {
            position: relative;
            margin-bottom: 20px;
        }

        .form-group input {
            width: 80%;
            padding: 12px 40px;
            /* Thêm không gian cho biểu tượng */
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            outline: none;
            transition: border 0.3s;
        }

        .form-group input:focus {
            border-color: #007acc;
            /* Màu viền khi focus */
        }

        .form-group i {
            position: absolute;
            left: 10px;
            top: 12px;
            color: #999999;
            /* Màu biểu tượng */
            font-size: 18px;
            /* Kích thước biểu tượng */
        }

        .show-password {
            position: absolute;
            top: 12px;
            cursor: pointer;
            color: #999999;
            font-size: 18px;
            /* Kích thước biểu tượng */
            margin-left: 300px;
        }

        .login-btn {
            background: linear-gradient(to right, #00aaff, #004d99);
            /* Gradient cho nút */
            border: none;
            color: white;
            padding: 15px;
            /* Tăng padding cho nút */
            border-radius: 10px;
            width: 100%;
            cursor: pointer;
            font-size: 18px;
            /* Kích thước chữ lớn hơn */
            text-transform: uppercase;
            /* Chữ in hoa */
            box-shadow: 0 4px 20px rgba(0, 122, 204, 0.5);
            /* Bóng đổ cho nút */
            transition: background 0.3s, transform 0.3s;
            /* Thêm hiệu ứng chuyển động */
        }

        .login-btn:hover {
            transform: scale(1.05);
            /* Tăng kích thước nút khi hover */
        }

        .links {
            margin-top: 15px;
            font-size: 14px;
        }

        .links a {
            color: #007acc;
            text-decoration: none;
        }

        .links a:hover {
            text-decoration: underline;
        }

        .alert {
            border-radius: 10px;
            padding: 15px;
            margin: 20px 0;
            /* Khoảng cách giữa thông báo và các phần khác */
            position: relative;
            transition: all 0.3s ease;
            /* Hiệu ứng chuyển động */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            /* Bóng đổ */
        }

        .alert-success {
            background-color: rgba(76, 175, 80, 0.2);
            /* Nền xanh nhẹ */
            border: 1px solid #4CAF50;
            /* Viền xanh */
            color: #4CAF50;
            /* Màu chữ xanh */
        }

        .alert-error {
            background-color: rgba(244, 67, 54, 0.2);
            /* Nền đỏ nhẹ */
            border: 1px solid #F44336;
            /* Viền đỏ */
            color: #F44336;
            /* Màu chữ đỏ */
        }

        .alert p {
            margin: 0;
            /* Giảm khoảng cách giữa các thông báo */
        }

        .alert .close {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            font-size: 18px;
            color: inherit;
            /* Duy trì màu chữ của thông báo */
        }
    </style>
</head>

<body>

    <div class="login-container">
        <h2>Login Form</h2>
        <i class="fas fa-shoe-prints icon-shoe"></i> <!-- Biểu tượng giày -->
        <form action="{{ url('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <i class="fas fa-envelope"></i> <!-- Biểu tượng email -->
                <input type="email" name="email" placeholder="LikeLion@gmail.com" required>
            </div>
            <div class="form-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <i class="show-password fas fa-eye" id="togglePassword" onclick="togglePassword()"></i>
            </div>
            <button type="submit" class="login-btn">Log in</button>
        </form>
        <div class="container">
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

        <div class="links">
            <p>Forgot your password? <a href="#">Reset here</a></p>
            <p>Not a member? <a href="{{ route('register') }}">Sign up now</a></p>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('togglePassword');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>

</body>

</html>