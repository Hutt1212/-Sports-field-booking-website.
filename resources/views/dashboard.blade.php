<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảng điều khiển - StormSport</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --primary: #10b981;
            --secondary: #0ea5e9;
            --warning: #f59e0b;
            --danger: #ef4444;
            --gray-100: #f9fafb;
            --gray-200: #f3f4f6;
            --gray-300: #e5e7eb;
            --gray-500: #6b7280;
            --gray-700: #374151;
            --white: #ffffff;
        }

        body {
            background-color: var(--gray-100);
            font-family: 'Be Vietnam Pro', sans-serif;
            color: var(--gray-700);
        }

        /* Navbar */
        .navbar {
            background-color: var(--white);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.4rem;
            color: var(--gray-700);
        }

        .navbar-brand i {
            color: var(--primary);
            font-size: 1.6rem;
        }

        .dropdown-menu {
            border-radius: 12px;
            border: none;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
        }

        /* Header */
        .dashboard-header {
            margin-bottom: 2.5rem;
        }

        .dashboard-header h2 {
            font-weight: 800;
            font-size: 2rem;
        }

        .gradient-text {
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Stat cards */
        .stat-card {
            background-color: var(--white);
            border-radius: 16px;
            padding: 1.25rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.03);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 1.5rem;
        }

        .stat-content p {
            color: var(--gray-500);
            margin: 0;
        }

        .stat-number {
            font-size: 1.75rem;
            font-weight: 800;
        }

        /* Field cards */
        .discover-field-link {
            text-decoration: none;
            color: inherit;
        }

        .discover-card {
            background-color: var(--white);
            border-radius: 16px;
            overflow: hidden;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .discover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        .discover-card img {
            height: 180px;
            width: 100%;
            object-fit: cover;
        }

        .discover-card .card-body {
            padding: 1rem;
        }

        .price {
            font-size: 1.2rem;
            font-weight: 800;
            color: var(--primary);
        }

        /* Table */
        .table {
            border-radius: 12px;
            overflow: hidden;
        }

        .table thead {
            background-color: var(--gray-200);
        }

        .table tbody tr:hover {
            background-color: var(--gray-100);
        }

        .badge {
            font-weight: 600;
            border-radius: 6px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .dashboard-header h2 {
                font-size: 1.6rem;
            }

            .stat-card {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <i class="fas fa-futbol me-2"></i>StormSport
            </a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle me-1"></i>{{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('booking.search') }}"><i class="fas fa-search me-2"></i>Tìm sân</a></li>
                        <li><a class="dropdown-item" href="{{ route('booking.my-bookings') }}"><i class="fas fa-calendar-alt me-2"></i>Lịch đặt của tôi</a></li>
                        <li><a class="dropdown-item" href="{{ route('favorites.index') }}"><i class="fas fa-heart me-2"></i>Sân yêu thích</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="fas fa-sign-out-alt me-2"></i>Đăng xuất
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <main class="container py-5">
        <div class="dashboard-header">
            <h2>Xin chào, <span class="gradient-text">{{ Auth::user()->name }}</span> 👋</h2>
            <p class="text-muted fs-6">Chào mừng trở lại! Hãy xem nhanh hoạt động của bạn nhé.</p>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background: var(--primary);"><i class="fas fa-calendar-check"></i></div>
                    <div class="stat-content">
                        <p>Lịch đang hoạt động</p>
                        <div class="stat-number">{{ $activeBookings }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background: var(--secondary);"><i class="fas fa-history"></i></div>
                    <div class="stat-content">
                        <p>Tổng lượt đặt</p>
                        <div class="stat-number">{{ $totalBookings }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background: var(--warning);"><i class="fas fa-heart"></i></div>
                    <div class="stat-content">
                        <p>Sân yêu thích</p>
                        <div class="stat-number">{{ $favoriteFields }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background: var(--danger);"><i class="fas fa-bell"></i></div>
                    <div class="stat-content">
                        <p>Thông báo mới</p>
                        <div class="stat-number">{{ $unreadNotifications }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-5">
            <h3 class="fw-bold mb-4">Khám phá sân mới</h3>
            <div class="row g-4">
                @forelse($sportsFields as $field)
                <div class="col-md-6 col-lg-3">
                    <a href="{{ route('booking.field-details', $field->id) }}" class="discover-field-link">
                        <div class="discover-card">
                            <img src="{{ $field->image }}" alt="{{ $field->name }}">
                            <div class="card-body">
                                <span class="badge bg-primary-subtle text-primary-emphasis border mb-2">{{ $field->sport_type }}</span>
                                <h5 class="fw-bold">{{ $field->name }}</h5>
                                <p class="text-muted small"><i class="fas fa-map-marker-alt me-2"></i>{{ $field->location }}</p>
                                <div class="text-end mt-2">
                                    <span class="price">{{ number_format($field->price_per_90min, 0, ',', '.') }}đ</span>
                                    <small class="text-muted">/90p</small>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @empty
                <p class="text-center text-muted">Hiện tại chưa có sân nào.</p>
                @endforelse
            </div>
            <div class="mt-4 d-flex justify-content-center">
                {{ $sportsFields->links() }}
            </div>
        </div>

        <div class="card card-custom border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0"><i class="fas fa-list-alt text-primary me-2"></i>Lượt đặt gần đây</h5>
                    <a href="{{ route('booking.my-bookings') }}" class="btn btn-outline-primary btn-sm fw-semibold">Xem tất cả</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless align-middle">
                        <thead>
                            <tr>
                                <th>Sân</th>
                                <th>Ngày đặt</th>
                                <th>Thời gian</th>
                                <th class="text-end">Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentBookings as $booking)
                            <tr>
                                <td>
                                    <strong>{{ $booking->sportsField->name }}</strong><br>
                                    <small class="text-muted">{{ $booking->sportsField->sport_type }}</small>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d/m/Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }}</td>
                                <td class="text-end">
                                    @if($booking->status == 'confirmed')
                                    <span class="badge bg-success-subtle text-success-emphasis border">Đã xác nhận</span>
                                    @elseif($booking->status == 'cancelled')
                                    <span class="badge bg-danger-subtle text-danger-emphasis border">Đã hủy</span>
                                    @else
                                    <span class="badge bg-warning-subtle text-warning-emphasis border">Đang chờ</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    Bạn chưa có lượt đặt sân nào gần đây.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
