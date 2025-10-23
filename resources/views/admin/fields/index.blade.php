<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StomSport - Manage Fields</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(120deg, #e8f5e9, #e3f2fd);
            font-family: "Poppins", sans-serif;
            color: #1a237e;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* === Navbar === */
        .navbar {
            background: linear-gradient(90deg, #43a047, #1e88e5);
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }
        .navbar-brand {
            color: #fff !important;
            font-weight: 700;
            font-size: 1.5rem;
        }
        .navbar-brand i { color: #e8f5e9; }

        /* === Sidebar === */
        .sidebar {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
            padding: 25px;
            position: sticky;
            top: 30px;
        }
        .sidebar h5 {
            color: #0d47a1;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .sidebar .nav-link {
            border-radius: 12px;
            padding: 10px 14px;
            margin-bottom: 6px;
            color: #1e88e5;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .sidebar .nav-link i { width: 22px; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background: linear-gradient(90deg, #43a047, #1e88e5);
            color: white;
            transform: translateX(4px);
        }

        /* === Main Content === */
        .main-content {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 5px 30px rgba(13, 71, 161, 0.1);
            padding: 40px;
            animation: fadeIn 0.6s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* === Field Card === */
        .field-card {
            border: none;
            border-radius: 18px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 8px 20px rgba(0,0,0,0.07);
            transition: all 0.3s ease;
            position: relative;
        }
        .field-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 30px rgba(30,136,229,0.2);
        }
        .field-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            transition: all 0.4s ease;
        }
        .field-card:hover img {
            filter: brightness(1.05) saturate(1.2);
        }
        .field-card-body {
            padding: 18px 20px;
        }

        .field-card h5 {
            font-weight: 600;
            color: #0d47a1;
        }

        .badge-status {
            font-size: 0.8rem;
            padding: 6px 10px;
            border-radius: 10px;
            font-weight: 600;
            letter-spacing: 0.4px;
        }
        .badge-status.active { background: linear-gradient(135deg,#43a047,#2e7d32); color:#fff; }
        .badge-status.maintenance { background: linear-gradient(135deg,#ffb300,#f57f17); color:#212121; }
        .badge-status.unavailable { background: linear-gradient(135deg,#d32f2f,#b71c1c); color:#fff; }

        /* === Buttons === */
        .btn-custom {
            background: linear-gradient(90deg,#43a047,#1e88e5);
            border: none;
            border-radius: 10px;
            color: white;
            font-weight: 500;
            transition: all 0.3s;
            box-shadow: 0 4px 10px rgba(30,136,229,0.3);
        }
        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(30,136,229,0.4);
        }

        .btn-outline-blue {
            border: 1.8px solid #1e88e5;
            color: #1e88e5;
            border-radius: 10px;
            transition: all 0.3s;
        }
        .btn-outline-blue:hover {
            background: linear-gradient(90deg,#43a047,#1e88e5);
            color: #fff;
        }

        /* === Empty State === */
        .empty-state {
            background: #f9fbff;
            border-radius: 18px;
            box-shadow: 0 4px 14px rgba(13,71,161,0.1);
            padding: 60px;
        }
        .empty-state i { color: #1e88e5; }

    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('welcome') }}">
                <i class="fas fa-futbol me-2"></i>
                <span class="site-name">StormSport</span>
            </a>
            <div class="ms-auto text-white">
                <i class="fas fa-user-shield me-1"></i>{{ Auth::user()->name }}
            </div>
        </div>
    </nav>

    <div class="container-fluid mt-4">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4">
                <div class="sidebar">
                    <h5 class="mb-3 fw-bold text-dark">Menu</h5>
                    <nav class="nav flex-column">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>Trang chủ</a>
                        <a class="nav-link active" href="{{ route('admin.fields.index') }}"><i class="fas fa-futbol me-2"></i>Quản lý sân</a>
                        <a class="nav-link" href="#"><i class="fas fa-calendar-alt me-2"></i>Đặt sân</a>
                        <a class="nav-link" href="#"><i class="fas fa-users me-2"></i>Người dùng</a>
                        <a class="nav-link" href="#"><i class="fas fa-chart-bar me-2"></i>Báo cáo</a>
                        <a class="nav-link" href="#"><i class="fas fa-cog me-2"></i>Cài đặt</a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                <div class="main-content">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="fw-bold text-dark"><i class="fas fa-futbol me-2"></i>Quản lý sân</h2>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.fields.create') }}" class="btn btn-custom">
                                <i class="fas fa-plus me-2"></i>Thêm sân mới
                            </a>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-blue">
                                <i class="fas fa-arrow-left me-2"></i>Về trang chủ
                            </a>
                        </div>
                    </div>

                    @if($fields->count() > 0)
                    <div class="row">
                        @foreach($fields as $field)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="field-card">
                                <img src="{{  strtolower($field->image) }}" alt="{{ $field->sport_type }}">
                                <div class="field-card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h5 class="mb-0">{{ $field->name }}</h5>
                                        <span class="badge-status {{ $field->status }}">{{ ucfirst($field->status) }}</span>
                                    </div>

                                    <p class="text-muted mb-2"><i class="fas fa-map-marker-alt me-1 text-primary"></i>{{ $field->location }}</p>

                                    <div class="mb-2">
                                        <span class="badge bg-light text-primary me-1">{{ ucfirst($field->sport_type) }}</span>
                                        <span class="badge bg-light text-success me-1">{{ $field->size }}</span>
                                        <span class="badge bg-light text-info">{{ ucfirst($field->surface) }}</span>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div>
                                            <strong class="text-danger">{{ (int) $field->price_per_90min }} đ </strong>
                                            <small class="text-muted">/ 90 min</small>
                                        </div>
                                        <small class="text-muted">
                                            {{ \Carbon\Carbon::parse($field->opening_time)->format('H:i') }}
                                            -
                                            {{ \Carbon\Carbon::parse($field->closing_time)->format('H:i') }}
                                        </small>
                                    </div>

                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.fields.show', $field) }}" class="btn btn-outline-blue btn-sm flex-fill">
                                            <i class="fas fa-eye me-1"></i>Xem
                                        </a>
                                        <a href="{{ route('admin.fields.edit', $field) }}" class="btn btn-outline-blue btn-sm flex-fill">
                                            <i class="fas fa-edit me-1"></i>Chỉnh sửa
                                        </a>
                                        <form method="POST" action="{{ route('admin.fields.destroy', $field) }}" class="flex-fill">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-blue btn-sm w-100" onclick="return confirm('Delete this field?')">
                                                <i class="fas fa-trash me-1"></i>Xóa
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $fields->links() }}
                    </div>
                    @else
                    <div class="text-center empty-state">
                        <i class="fas fa-futbol fa-4x mb-3"></i>
                        <h4 class="fw-semibold mb-2">Không tìm thấy sân nào</h4>
                        <p class="text-muted">Hãy bắt đầu bằng cách tạo sân thể thao đầu tiên của bạn trên StomSport nhé.</p>
                        <a href="{{ route('admin.fields.create') }}" class="btn btn-custom mt-2">
                            <i class="fas fa-plus me-2"></i>Thêm sân mới
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>
