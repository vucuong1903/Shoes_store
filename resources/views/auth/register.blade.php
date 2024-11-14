<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('https://media.istockphoto.com/id/1206659376/vi/vec-to/h%C3%ACnh-minh-h%E1%BB%8Da-vector-c%E1%BB%A7a-m%E1%BB%99t-%C4%91%C3%B4i-gi%C3%A0y-th%E1%BB%83-thao-tr%C3%AAn-n%E1%BB%81n-phong-c%C3%A1ch-retro-n%C4%83ng-%C4%91%E1%BB%99ng.jpg?s=612x612&w=0&k=20&c=zjIBGJB2jWeD8OwE4vSjq6bhMxtHUvBw8BBBE4lv0Vs='); /* Hình nền giày */
            background-size: cover; /* Làm cho hình nền phủ kín toàn bộ */
            background-position: center; /* Căn giữa hình nền */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        .register-container {
            background-color: rgba(255, 255, 255, 0.8); /* Nền trắng với độ trong suốt */
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2); /* Hiệu ứng bóng đổ */
            padding: 40px;
            width: 350px;
            text-align: center;
            transition: transform 0.3s; /* Hiệu ứng chuyển động */
        }

        .register-container:hover {
            transform: translateY(-5px); /* Hiệu ứng nhấc lên khi hover */
        }

        .register-container h2 {
            margin-bottom: 10px; /* Giảm khoảng cách giữa tiêu đề và biểu tượng giày */
            color: transparent; /* Làm cho màu chữ trong suốt */
            background: linear-gradient(to right, #00aaff, #004d99); /* Gradient cho tiêu đề */
            -webkit-background-clip: text; /* Cắt nền thành chữ */
            background-clip: text; /* Cắt nền thành chữ */
            font-size: 24px; /* Kích thước chữ */
        }

        .icon-shoe {
            font-size: 50px; /* Kích thước biểu tượng giày */
            color: #007acc; /* Màu của biểu tượng */
            margin: 20px 0; /* Khoảng cách phía trên và dưới biểu tượng */
        }

        .form-group {
            position: relative;
            margin-bottom: 20px;
        }

        .form-group input {
            width: 80%;
            padding: 12px 40px; /* Thêm không gian cho biểu tượng */
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            outline: none;
            transition: border 0.3s;
        }

        .form-group input:focus {
            border-color: #007acc; /* Màu viền khi focus */
        }

        .form-group i {
            position: absolute;
            left: 10px;
            top: 12px;
            color: #999999; /* Màu biểu tượng */
            font-size: 18px; /* Kích thước biểu tượng */
        }

        .show-password {
            position: absolute;
            top: 12px;
            cursor: pointer;
            color: #999999;
            font-size: 18px; /* Kích thước biểu tượng */
            margin-left: 300px;
        }

        .register-btn {
            background: linear-gradient(to right, #00aaff, #004d99); /* Gradient cho nút */
            border: none;
            color: white;
            padding: 15px; /* Tăng padding cho nút */
            border-radius: 10px;
            width: 100%;
            cursor: pointer;
            font-size: 18px; /* Kích thước chữ lớn hơn */
            text-transform: uppercase; /* Chữ in hoa */
            box-shadow: 0 4px 20px rgba(0, 122, 204, 0.5); /* Bóng đổ cho nút */
            transition: background 0.3s, transform 0.3s; /* Thêm hiệu ứng chuyển động */
        }

        .register-btn:hover {
            transform: scale(1.05); /* Tăng kích thước nút khi hover */
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
    </style>
</head>
<body>

<div class="register-container">
    <h2>Register Form</h2>
    <i class="fas fa-shoe-prints icon-shoe"></i> <!-- Biểu tượng giày -->
    
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ url('register') }}" method="POST">
        @csrf
        <div class="form-group">
            <i class="fas fa-user"></i>
            <input type="text" name="name" placeholder="Your Name" required>
        </div>
        <div class="form-group">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" placeholder="LikeLion@gmail.com" required>
        </div>
        <div class="form-group">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <i class="show-password fas fa-eye" id="togglePassword" onclick="togglePassword()"></i>
        </div>
        <div class="form-group">
            <i class="fas fa-lock"></i>
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" required>
            <i class="show-password fas fa-eye" id="toggleConfirmPassword" onclick="toggleConfirmPassword()"></i>
        </div>
        <button type="submit" class="register-btn">Register</button>
    </form>
    <div class="links">
        <p>Already a member? <a href="{{ route('login') }}">Log in here</a></p>
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

    function toggleConfirmPassword() {
        const confirmPasswordInput = document.getElementById('password_confirmation');
        const toggleIcon = document.getElementById('toggleConfirmPassword');
        if (confirmPasswordInput.type === 'password') {
            confirmPasswordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            confirmPasswordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }
</script>

</body>
</html>
