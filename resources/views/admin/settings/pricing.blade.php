<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StormSport - Pricing Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        /* ==== GLOBAL THEME ==== */
        body {
            background-color: #f4f7fa;
            font-family: "Poppins", sans-serif;
            color: #333;
        }

        /* ==== NAVBAR ==== */
        .navbar {
            background: linear-gradient(135deg, #00b09b, #96c93d, #0083b0);
            padding: 12px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            color: white !important;
            font-weight: 600;
            font-size: 1.4rem;
        }

        .navbar .nav-link, .navbar .dropdown-toggle {
            color: white !important;
            font-weight: 500;
        }

        .navbar .nav-link:hover,
        .navbar .dropdown-toggle:hover {
            opacity: 0.85;
        }

        /* ==== MAIN CONTENT ==== */
        .main-content {
            background: white;
            border-radius: 20px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.07);
            padding: 35px;
            margin-top: 2rem;
        }

        h2 {
            color: #008e7e;
            font-weight: 600;
        }

        /* ==== BUTTONS ==== */
        .btn-custom {
            background: linear-gradient(135deg, #00b09b, #96c93d);
            border: none;
            color: white;
            font-weight: 500;
            border-radius: 10px;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background: linear-gradient(135deg, #00947f, #85b835);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 179, 120, 0.3);
        }

        .btn-outline-success {
            border-color: #00b09b;
            color: #00b09b;
        }

        .btn-outline-success:hover {
            background-color: #00b09b;
            color: white;
        }

        /* ==== FORMS ==== */
        label {
            font-weight: 500;
            color: #008e7e;
        }

        input.form-control {
            border-radius: 10px;
            border: 1px solid #ced4da;
            transition: 0.3s ease;
        }

        input.form-control:focus {
            border-color: #00b09b;
            box-shadow: 0 0 0 0.15rem rgba(0, 176, 155, 0.25);
        }

        /* ==== ALERT ==== */
        .alert-success {
            border-radius: 10px;
            background-color: #e8f9f1;
            color: #0d7a5f;
            border: 1px solid #b5eed7;
        }

        /* ==== FOOTER ==== */
        footer {
            text-align: center;
            padding: 20px;
            color: #777;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('welcome') }}">
                <i class="fas fa-futbol me-2"></i>
                <span class="site-name">StormSport</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-shield me-1"></i>{{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user-cog me-2"></i>Hồ sơ</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Cài đặt</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-2"></i>Đăng xuất
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <div class="container">
        <div class="main-content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2><i class="fas fa-coins me-2 text-success"></i>Giá giờ cao điểm</h2>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-custom">
                    <i class="fas fa-arrow-left me-2"></i>Trở về trang chủ
                </a>
            </div>

            @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('admin.settings.pricing.save') }}">
                @csrf
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Thời gian bắt đầu giờ cao điểm</label>
                        <input type="time" name="peak_start_time" class="form-control"
                            value="{{ old('peak_start_time', optional($settings)->peak_start_time ? \Carbon\Carbon::parse($settings->peak_start_time)->format('H:i') : '18:00') }}"
                            required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Phụ phí giờ cao điểm (đ)</label>
                        <input type="number" name="peak_surcharge" min="0" step="1" class="form-control"
                            value="{{ old('peak_surcharge', optional($settings)->peak_surcharge ?? 2000) }}" required>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-success">
                        <i class="fas fa-times me-2"></i>Hủy
                    </a>
                    <button class="btn btn-custom" type="submit">
                        <i class="fas fa-save me-2"></i>Lưu cài đặt
                    </button>
                </div>
            </form>
        </div>
    </div>

    <footer>
        &copy; {{ date('Y') }} StormSport Admin Dashboard • All rights reserved.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
