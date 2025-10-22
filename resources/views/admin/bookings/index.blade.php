<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StomSport - Bookings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f8fb;
            font-family: 'Segoe UI', sans-serif;
        }

        /*  Navbar Gradient */
        .navbar {
            background: linear-gradient(135deg, #3CA55C 0%, #2B9ACF 100%);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            color: #ffffff !important;
            font-weight: bold;
            font-size: 1.5rem;
        }

        .navbar .nav-link,
        .navbar .dropdown-item {
            color: #ffffff !important;
            transition: all 0.3s ease;
        }

        .navbar .nav-link:hover,
        .navbar .dropdown-item:hover {
            color: #d4f5ff !important;
            background: transparent;
        }

        /* 🌿 Main Card Layout */
        .main-content {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            padding: 30px;
            margin-top: 2rem;
        }

        /* 🌊 Buttons */
        .btn-custom {
            background: linear-gradient(135deg, #3CA55C 0%, #2B9ACF 100%);
            border: none;
            border-radius: 10px;
            color: white;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(43, 154, 207, 0.4);
            color: white;
        }

        .btn-outline-gradient {
            border: 2px solid #3CA55C;
            color: #3CA55C;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .btn-outline-gradient:hover {
            background: linear-gradient(135deg, #3CA55C 0%, #2B9ACF 100%);
            color: white;
        }

        /* 🌼 Badges */
        .badge.bg-danger {
            background-color: #dc3545 !important;
        }

        .badge.bg-warning {
            background-color: #ffc107 !important;
        }

        .badge.bg-success {
            background-color: #28a745 !important;
        }

        .badge.bg-info {
            background: linear-gradient(135deg, #2B9ACF 0%, #6dd5fa 100%);
        }

        /* 📖 Pagination */
        .pagination {
            justify-content: center;
            margin-top: 30px;
        }

        .pagination .page-link {
            color: #2B9ACF;
            border: 1px solid #2B9ACF;
            padding: 8px 12px;
            margin: 0 2px;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .pagination .page-link:hover {
            background-color: #2B9ACF;
            color: white;
            border-color: #2B9ACF;
        }

        .pagination .page-item.active .page-link {
            background-color: #2B9ACF;
            border-color: #2B9ACF;
            color: white;
        }

        .pagination .page-item.disabled .page-link {
            color: #6c757d;
            border-color: #dee2e6;
            background-color: #fff;
        }

        /* 🌟 Titles */
        h2,
        h5 {
            color: #1d3557;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f9ff;
        }
    </style>
</head>

<body>
    <!--  Navigation -->
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
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user-cog me-2"></i>Hồ sơ</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Cài đặt</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
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

    <!--  Main Content -->
    <div class="container">
        <div class="main-content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-dark">Danh sách đặt sân</h2>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-custom">
                    <i class="fas fa-arrow-left me-2"></i>Trở về trang chủ
                </a>
            </div>

            <!-- Filter Section -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="fas fa-filter me-2 text-primary"></i>Lọc danh sách</h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.bookings.index') }}" class="row g-3">
                        <div class="col-md-2">
                            <label class="form-label">Loại sân thể thao</label>
                            <select name="sport" class="form-select">
                                <option value="">Tất cả sân thể thao</option>
                                @foreach($sports as $sport)
                                <option value="{{ $sport }}" {{ request('sport') == $sport ? 'selected' : '' }}>
                                    {{ ucfirst($sport) }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Tên sân</label>
                            <input type="text" name="field" class="form-control" placeholder="Search field..." value="{{ request('field') }}">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Từ ngày</label>
                            <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Đến ngày</label>
                            <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Tên khách hàng</label>
                            <input type="text" name="user" class="form-control" placeholder="Search username..." value="{{ request('user') }}">
                        </div>
                        <div class="col-md-2 d-flex align-items-end gap-2">
                            <button type="submit" class="btn btn-custom w-100">
                                <i class="fas fa-search"></i>
                            </button>
                            <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-gradient">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <!-- Bookings Table -->
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Khách hàng</th>
                            <th>Sân</th>
                            <th>Ngày</th>
                            <th>Giờ</th>
                            <th>Tổng tiền</th>
                            <th>Thanh toán</th>
                            <th>Trạng thái</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $b)
                        <tr>
                            <td>{{ $b->user->name ?? 'User' }}</td>
                            <td>{{ $b->sportsField->name ?? 'Field' }}</td>
                            <td>{{ \Carbon\Carbon::parse($b->booking_date)->format('M d, Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($b->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($b->end_time)->format('g:i A') }}</td>
                            <td>৳{{ (int) $b->total_price }}</td>
                            <td>
                                <span class="badge bg-info text-dark">{{ strtoupper($b->payment_method ?? '-') }}</span>
                                <span class="badge bg-{{ ($b->payment_status === 'paid') ? 'success' : 'warning' }} ms-1">{{ ucfirst($b->payment_status ?? 'pending') }}</span>
                            </td>
                            <td>{{ ucfirst($b->status) }}</td>
                            <td class="text-end">
                                <form action="{{ route('admin.bookings.destroy', $b->id) }}" method="POST" onsubmit="return confirm('Delete this booking?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-gradient">Xóa</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $bookings->links() }}
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>