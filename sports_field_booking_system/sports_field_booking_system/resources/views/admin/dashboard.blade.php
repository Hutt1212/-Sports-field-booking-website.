<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StomSport</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #e8f5e9, #e3f2fd);
            font-family: "Poppins", sans-serif;
            color: #2e2e2e;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, #43a047, #2196f3);
            box-shadow: 0 4px 20px rgba(67, 160, 71, 0.3);
        }

        .navbar-brand {
            color: #fff !important;
            font-weight: 700;
            font-size: 1.7rem;
            letter-spacing: 0.5px;
        }

        /* Sidebar */
        .sidebar {
            background: #ffffff;
            border-radius: 18px;
            padding: 22px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .sidebar:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 28px rgba(33, 150, 243, 0.15);
        }

        .sidebar h5 {
            color: #388e3c;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        .sidebar .nav-link {
            border-radius: 12px;
            margin-bottom: 10px;
            color: #388e3c;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 10px 12px;
        }

        .sidebar .nav-link i {
            color: #43a047;
            transition: 0.3s;
        }

        .sidebar .nav-link:hover {
            background: linear-gradient(135deg, #43a047, #2196f3);
            color: white;
            transform: translateX(6px);
        }

        .sidebar .nav-link:hover i {
            color: white;
        }

        .sidebar .nav-link.active {
            background: linear-gradient(135deg, #43a047, #2196f3);
            color: white;
            font-weight: 600;
        }

        /* Main content */
        .main-content {
            background: #ffffff;
            border-radius: 22px;
            padding: 35px;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.06);
            animation: fadeIn 0.4s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Stats cards */
        .stats-card {
            border-radius: 18px;
            background: linear-gradient(135deg, #43a047, #2196f3);
            color: white;
            padding: 25px;
            box-shadow: 0 6px 25px rgba(67, 160, 71, 0.25);
            transition: all 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 30px rgba(33, 150, 243, 0.35);
        }

        .stats-card h3 {
            font-size: 2.2rem;
            font-weight: 700;
        }

        /* Custom buttons */
        .btn-custom {
            background: linear-gradient(135deg, #43a047, #2196f3);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 10px 25px;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 18px rgba(33, 150, 243, 0.3);
            color: white;
        }

        .btn-outline-primary {
            border: 1.8px solid #43a047;
            color: #43a047;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background: linear-gradient(135deg, #43a047, #2196f3);
            color: white;
        }

        /* Tables */
        .table thead {
            background: #f1f8e9;
        }

        .table-hover tbody tr:hover {
            background: rgba(76, 175, 80, 0.08);
            transition: 0.3s;
        }

        /* Badges */
        .badge.bg-info {
            background: #64b5f6 !important;
        }

        .badge.bg-success {
            background: #66bb6a !important;
        }

        .badge.bg-warning {
            background: #fff176 !important;
            color: #333 !important;
        }

        .badge.bg-danger {
            background: #ef5350 !important;
        }

        /* Pagination */
        .pagination .page-link {
            color: #43a047;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .pagination .page-link:hover {
            background: #43a047;
            color: white;
        }

        .analytics-section .card {
            background: linear-gradient(135deg, #a8ff78, #78ffd6, #00c6ff);
            background-size: 200% 200%;
            animation: gradientFlow 6s ease infinite;
            border-radius: 20px;
            box-shadow: 0 6px 20px rgba(0, 180, 150, 0.25);
        }

        @keyframes gradientFlow {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .table td {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 180px;
            /* hoặc tùy kích thước */
        }
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-shield me-1"></i>{{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user-cog me-2"></i>Hồ sơ</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Cài đặt</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="d-inline">
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
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4">
                <div class="sidebar">
                    <h5 class="mb-3 fw-bold">Menu</h5>
                    <nav class="nav flex-column">
                        <a class="nav-link active" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt me-2"></i>Trang chủ
                        </a>
                        <a class="nav-link" href="{{ route('admin.fields.index') }}">
                            <i class="fas fa-futbol me-2"></i>Quản lý danh sách sân
                        </a>
                        <a class="nav-link" href="{{ route('admin.bookings.index') }}">
                            <i class="fas fa-calendar-alt me-2"></i>Đặt sân
                        </a>
                        <a class="nav-link" href="{{ route('admin.users.index') }}">
                            <i class="fas fa-users me-2"></i>Người dùng
                        </a>
                        <a class="nav-link" href="{{ route('admin.reports.index') }}">
                            <i class="fas fa-chart-bar me-2"></i>Báo cáo
                        </a>
                        <a class="nav-link" href="{{ route('admin.settings.pricing') }}">
                            <i class="fas fa-cog me-2"></i>Cài đặt
                        </a>
                    </nav>

                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                <div class="main-content">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="fw-bold text-primary">Trang chủ</h2>
                        <a href="{{ route('admin.fields.create') }}" class="btn btn-custom">
                            <i class="fas fa-plus me-2"></i>Thêm sân mới
                        </a>
                    </div>

                    <!-- Stats -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="stats-card">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h3>{{ $totalFields }}</h3>
                                        <p>Số lượng sân</p>
                                    </div>
                                    <i class="fas fa-futbol fa-2x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stats-card">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h3>{{ $totalBookings }}</h3>
                                        <p>Số lượng đặt sân</p>
                                    </div>
                                    <i class="fas fa-calendar-check fa-2x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stats-card">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h3>{{ $totalUsers }}</h3>
                                        <p>Số lượng người dùng</p>
                                    </div>
                                    <i class="fas fa-users fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Interactive Analytics Section -->
                    <div class="container mt-5">
                        <h4 class="text-success fw-bold mb-4 text-center">Bảng phân tích dữ liệu trực quan</h4>
                        <div class="row g-4">

                            <!-- Biểu đồ 1: Doanh thu theo tháng -->
                            <div class="col-md-6">
                                <div class="card shadow-sm p-3 rounded-4">
                                    <h6 class="text-primary fw-semibold mb-3">Doanh thu theo tháng</h6>
                                    <canvas id="revenueChart"></canvas>
                                </div>
                            </div>

                            <!-- Biểu đồ 2: Số lượng đơn đặt sân -->
                            <div class="col-md-6">
                                <div class="card shadow-sm p-3 rounded-4">
                                    <h6 class="text-primary fw-semibold mb-3">Số lượng đơn đặt sân</h6>
                                    <canvas id="bookingChart"></canvas>
                                </div>
                            </div>

                            <!-- Biểu đồ 3: Tỉ lệ người dùng mới / quay lại -->
                            <div class="col-md-6">
                                <div class="card shadow-sm p-3 rounded-4">
                                    <h6 class="text-primary fw-semibold mb-3">Tỉ lệ người dùng mới / quay lại</h6>
                                    <canvas id="userChart"></canvas>
                                </div>
                            </div>

                            <!-- Biểu đồ 4: Loại sân được thuê nhiều nhất -->
                            <div class="col-md-6">
                                <div class="card shadow-sm p-3 rounded-4">
                                    <h6 class="text-primary fw-semibold mb-3">Loại sân được thuê nhiều nhất</h6>
                                    <canvas id="fieldTypeChart"></canvas>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Chart.js -->
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script>
                        // Truyền dữ liệu từ Laravel sang JS
                        const chartData = @json($chartData);

                        // Biểu đồ 1: Doanh thu theo tháng
                        new Chart(document.getElementById('revenueChart'), {
                            type: 'line',
                            data: {
                                labels: chartData.revenue.months,
                                datasets: [{
                                    label: 'Doanh thu (VNĐ)',
                                    data: chartData.revenue.values,
                                    borderColor: '#2E7D32',
                                    backgroundColor: 'rgba(76, 175, 80, 0.3)',
                                    tension: 0.3,
                                    fill: true
                                }]
                            }
                        });

                        // Biểu đồ 2: Số lượng đơn đặt sân
                        new Chart(document.getElementById('bookingChart'), {
                            type: 'bar',
                            data: {
                                labels: chartData.bookings.months,
                                datasets: [{
                                    label: 'Đơn đặt sân',
                                    data: chartData.bookings.values,
                                    backgroundColor: 'rgba(33, 150, 243, 0.6)'
                                }]
                            }
                        });

                        // Biểu đồ 3: Người dùng mới / quay lại
                        new Chart(document.getElementById('userChart'), {
                            type: 'pie',
                            data: {
                                labels: ['Người dùng mới', 'Người dùng quay lại'],
                                datasets: [{
                                    data: [
                                        chartData.users.newThisMonth,
                                        chartData.users.returning
                                    ],
                                    backgroundColor: ['#66BB6A', '#42A5F5'],
                                    borderColor: '#fff',
                                    borderWidth: 2
                                }]
                            },
                            options: {
                                plugins: {
                                    title: {
                                        display: true,
                                        text: 'Tỉ lệ người dùng mới / quay lại',
                                        font: {
                                            size: 14
                                        }
                                    }
                                }
                            }
                        });


                        // Biểu đồ 4: Loại sân được thuê nhiều nhất
                        new Chart(document.getElementById('fieldTypeChart'), {
                            type: 'doughnut',
                            data: {
                                labels: chartData.fieldTypes.labels,
                                datasets: [{
                                    data: chartData.fieldTypes.values,
                                    backgroundColor: ['#4CAF50', '#2196F3', '#81C784', '#64B5F6']
                                }]
                            }
                        });
                    </script>

                    <!-- Recent Bookings -->
                    <div class="card mt-5 shadow-sm border-0 rounded-3">
                        <div class="card-header bg-white border-0 text-center">
                            <h4 class="fw-bold mb-0 text-success">
                                Các lượt đặt sân gần đây
                            </h4>
                            <p class="text-muted small mb-0">Tổng quan lượt đặt sân mới nhất</p>
                        </div>

                        <div class="card-body">
                            @if($recentBookings->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead style="background-color: #e8f5e9;">
                                        <tr class="text-success fw-semibold text-center">
                                            <th><i class="fas fa-user me-1"></i>Khách hàng</th>
                                            <th><i class="fas fa-futbol me-1"></i> Sân</th>
                                            <th><i class="fas fa-calendar-alt me-1"></i> Ngày</th>
                                            <th><i class="fas fa-clock me-1"></i> Giờ</th>
                                            <th><i class="fas fa-credit-card me-1"></i> Thanh toán</th>
                                            <th><i class="fas fa-check-circle me-1"></i> Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recentBookings as $booking)
                                        <tr class="text-center">
                                            <td>
                                                <i class="fas fa-user text-success me-2"></i>
                                                {{ $booking->user->name ?? 'Unknown' }}
                                            </td>
                                            <td>
                                                <i class="fas fa-futbol text-primary me-2"></i>
                                                {{ $booking->sportsField->name ?? 'Unknown' }}
                                            </td>
                                            <td class="text-secondary">
                                                {{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($booking->start_time)->format('g:i A') }}
                                                -
                                                {{ \Carbon\Carbon::parse($booking->end_time)->format('g:i A') }}
                                            </td>
                                            <td>
                                                <span class="badge bg-light text-dark border">
                                                    {{ strtoupper($booking->payment_method ?? '-') }}
                                                </span>
                                                <span class="badge bg-{{ $booking->payment_status === 'paid' ? 'success' : 'warning' }}">
                                                    {{ ucfirst($booking->payment_status ?? 'pending') }}
                                                </span>
                                            </td>
                                            <td>
                                                @switch($booking->status)
                                                @case('confirmed')
                                                <span class="badge bg-success">Đã xác nhận</span>
                                                @break
                                                @case('pending')
                                                <span class="badge bg-warning text-dark">Chờ xử lý</span>
                                                @break
                                                @default
                                                <span class="badge bg-danger">{{ ucfirst($booking->status) }}</span>
                                                @endswitch
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <div class="text-center py-5 text-muted">
                                <i class="fas fa-calendar-times fa-3x mb-3 text-success"></i>
                                <h5>Chưa có lượt đặt sân nào</h5>
                                <p class="text-secondary">Hiện chưa có lượt đặt sân.</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('analyticsChart').getContext('2d');
    const analyticsChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
            datasets: [{
                    label: 'Bookings',
                    data: [12, 19, 8, 25, 18, 22, 30, 28, 35, 40],
                    borderColor: '#007bff',
                    backgroundColor: 'rgba(0, 123, 255, 0.15)',
                    tension: 0.4,
                    fill: true,
                },
                {
                    label: 'Users',
                    data: [5, 9, 14, 18, 23, 25, 30, 35, 38, 42],
                    borderColor: '#00c853',
                    backgroundColor: 'rgba(0, 200, 83, 0.1)',
                    tension: 0.4,
                    fill: true,
                },
                {
                    label: 'Revenue ($)',
                    data: [200, 350, 300, 500, 450, 600, 700, 850, 900, 1000],
                    borderColor: '#00bcd4',
                    backgroundColor: 'rgba(0, 188, 212, 0.1)',
                    tension: 0.4,
                    fill: true,
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        color: '#033',
                        font: {
                            size: 13,
                            family: "Poppins"
                        }
                    }
                },
            },
            scales: {
                x: {
                    ticks: {
                        color: '#033',
                        font: {
                            weight: '500'
                        }
                    },
                    grid: {
                        color: 'rgba(255,255,255,0.2)'
                    },
                },
                y: {
                    ticks: {
                        color: '#033'
                    },
                    grid: {
                        color: 'rgba(255,255,255,0.2)'
                    },
                },
            },
        },
    });
</script>

</html>