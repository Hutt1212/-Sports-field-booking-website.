<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameOn Quản trị - Thêm Sân Mới</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: #f3f4f6;
            font-family: 'Poppins', sans-serif;
        }

        /* Thanh điều hướng */
        .navbar {
            background: linear-gradient(135deg, #43cea2, #185a9d);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            color: #ffffff !important;
            font-weight: 600;
            font-size: 1.5rem;
        }

        .navbar .nav-link, .dropdown-item {
            color: #ffffff !important;
        }

        .dropdown-menu {
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        /* Thân trang */
        .main-content {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            padding: 35px;
            margin-top: 2rem;
        }

        /* Nút chính */
        .btn-custom {
            background: linear-gradient(135deg, #43cea2, #185a9d);
            border: none;
            border-radius: 10px;
            color: white;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(24, 90, 157, 0.4);
            color: white;
        }

        /* Nút viền */
        .btn-outline-primary {
            border-color: #185a9d;
            color: #185a9d;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background-color: #185a9d;
            color: white;
        }

        /* Input focus */
        .form-control:focus,
        .form-select:focus {
            border-color: #43cea2;
            box-shadow: 0 0 0 0.25rem rgba(24, 90, 157, 0.25);
        }

        label.form-label {
            font-weight: 500;
            color: #1e3a8a;
        }
    </style>
</head>
<body>
    <!-- Thanh điều hướng -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('welcome') }}">
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
                            <li><a class="dropdown-item text-dark" href="#"><i class="fas fa-user-cog me-2"></i>Hồ sơ</a></li>
                            <li><a class="dropdown-item text-dark" href="#"><i class="fas fa-cog me-2"></i>Cài đặt</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-dark">
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

    <!-- Nội dung chính -->
    <div class="container">
        <div class="main-content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-dark"><i class="fas fa-plus-circle me-2 text-primary"></i>Thêm Sân Mới</h2>
                <a href="{{ route('admin.fields.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Quay lại danh sách sân
                </a>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.fields.store') }}">
                @csrf
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tên sân</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Loại thể thao</label>
                        <select class="form-select" name="sport_type" required>
                            <option value="">Chọn loại thể thao</option>
                            <option value="football">Bóng đá</option>
                            <option value="basketball">Bóng rổ</option>
                            <option value="tabletennis">Bóng bàn</option>
                            <option value="cricket">Cricket</option>
                            <option value="badminton">Cầu lông</option>
                            <option value="paddle">Paddle</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Loại sân</label>
                        <input type="text" class="form-control" name="type" value="{{ old('type') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kích thước</label>
                        <select class="form-select" name="size" required>
                            <option value="">Chọn kích thước</option>
                            <option value="Full Size">Kích thước chuẩn</option>
                            <option value="11-a-side">11 người</option>
                            <option value="7-a-side">7 người</option>
                            <option value="5-a-side">5 người</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Bề mặt sân</label>
                        <select class="form-select" name="surface" required>
                            <option value="">Chọn loại bề mặt</option>
                            <option value="Grass">Cỏ tự nhiên</option>
                            <option value="Artificial Turf">Cỏ nhân tạo</option>
                            <option value="Indoor Court">Sân trong nhà</option>
                            <option value="Outdoor Court">Sân ngoài trời</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Giá cơ bản (mỗi 90 phút)</label>
                        <input type="number" class="form-control" name="price_per_90min" min="0" step="1" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Vị trí</label>
                        <input type="text" class="form-control" name="location" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Trạng thái</label>
                        <select class="form-select" name="status" required>
                            <option value="active">Hoạt động</option>
                            <option value="maintenance">Bảo trì</option>
                            <option value="unavailable">Không khả dụng</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Địa chỉ chi tiết</label>
                    <textarea class="form-control" name="address" rows="2" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mô tả</label>
                    <textarea class="form-control" name="description" rows="3"></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Giờ mở cửa</label>
                        <input type="time" class="form-control" name="opening_time" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Giờ đóng cửa</label>
                        <input type="time" class="form-control" name="closing_time" required>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-custom">
                        <i class="fas fa-save me-2"></i>Lưu thông tin
                    </button>
                    <a href="{{ route('admin.fields.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-times me-2"></i>Hủy
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
