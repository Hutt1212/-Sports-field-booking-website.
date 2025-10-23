<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng ký - StomSport</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --primary-color: #10b981;
            /* Emerald 500 */
            --primary-hover: #059669;
            /* Emerald 600 */
            --secondary-color: #0ea5e9;
            /* Sky 500 */
            --text-dark: #1f2937;
            /* Gray 800 */
            --text-light: #4b5563;
            /* Gray 600 */
            --bg-light: #f9fafb;
            /* Gray 50 */
            --bg-white: #ffffff;
            --border-color: #e5e7eb;
            /* Gray 200 */
            --danger-color: #ef4444;
            /* Red 500 */
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Be Vietnam Pro', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 2rem;
        }

        .login-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            max-width: 1100px;
            width: 100%;
            background: var(--bg-white);
            border-radius: 1.5rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .login-art {
            background-image: linear-gradient(rgba(16, 185, 129, 0.8), rgba(14, 165, 233, 0.8)), url('https://images.unsplash.com/photo-1579952363873-27f3bade9f55?q=80&w=1935&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            padding: 4rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: white;
        }

        .login-art h1 {
            font-size: 3rem;
            font-weight: 900;
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }

        .login-art p {
            font-size: 1.125rem;
            opacity: 0.9;
            max-width: 400px;
        }

        .login-form {
            padding: 4rem;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            color: var(--text-dark);
            margin-bottom: 2.5rem;
        }

        .logo-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }

        .logo-text h1 {
            font-size: 1.5rem;
            font-weight: 800;
            line-height: 1;
        }

        .logo-text p {
            font-size: 0.8rem;
            color: var(--text-light);
            line-height: 1;
        }

        .form-header h2 {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        .gradient-text {
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .form-header p {
            color: var(--text-light);
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .form-control {
            width: 100%;
            padding: 0.875rem 1.25rem;
            border: 1px solid var(--border-color);
            border-radius: 0.75rem;
            transition: all 0.2s ease;
            font-size: 1rem;
            background-color: var(--bg-light);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
            background-color: var(--bg-white);
        }

        .btn {
            padding: 0.875rem 1.5rem;
            border-radius: 50px;
            font-weight: 700;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            font-size: 1rem;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-3px);
            box-shadow: 0 7px 14px rgba(0, 0, 0, 0.1);
        }

        .alert-danger {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--danger-color);
            border: 1px solid rgba(239, 68, 68, 0.2);
            border-radius: 0.75rem;
            padding: 1rem;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }

        .alert-danger ul {
            padding-left: 1.25rem;
            margin: 0;
        }

        .text-center {
            text-align: center;
        }

        .mt-4 {
            margin-top: 1.5rem;
        }

        .form-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }

        .form-link:hover {
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .login-container {
                grid-template-columns: 1fr;
                max-width: 500px;
            }

            .login-art {
                display: none;
            }

            .login-form {
                padding: 3rem;
            }
        }

        @media (max-width: 576px) {
            body {
                padding: 1rem;
            }

            .login-form {
                padding: 2rem;
            }

            .form-header h2 {
                font-size: 1.75rem;
            }
        }
    </style>
</head>

<body>

    <div class="login-container">
        <div class="login-art">
            <h1>Tạo tài khoản mới <br> Bắt đầu hành trình</h1>
            <p>Tìm kiếm, lựa chọn và đặt sân bóng đá, cầu lông, tennis... chỉ trong vài giây. Trải nghiệm thể thao
                chưa bao giờ dễ dàng hơn!</p>
        </div>
        <div class="login-form">
            <a href="/" class="logo">
                <div class="logo-icon"><i class="fa-solid fa-futbol"></i></div>
                <div class="logo-text">
                    <h1>StomSport</h1>
                    <p>Đặt đi chờ chi</p>
                </div>
            </a>
            <div class="form-header">
                <h2>Tạo tài khoản</h2>
                <p>Nhanh chóng tham gia cộng đồng <span class="gradient-text">StomSport</span>.</p>
            </div>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <label for="name" class="form-label">Họ và tên</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                        value="{{ old('name') }}" placeholder="Nhập họ và tên của bạn" required>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Địa chỉ Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                        value="{{ old('email') }}" placeholder="Nhập email của bạn" required>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password" placeholder="Nhập mật khẩu" required>
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                        placeholder="Nhập lại mật khẩu" required>
                </div>
                <input type="hidden" name="role" value="user">
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-user-plus"></i> &nbsp; Đăng ký
                </button>
            </form>

            <div class="text-center mt-4">
                <p>Đã có tài khoản? <a href="{{ route('login') }}" class="form-link">Đăng nhập ngay</a></p>
            </div>
        </div>
    </div>

</body>

</html>