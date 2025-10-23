<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StormSport - Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: #f4f6f9;
            font-family: "Segoe UI", sans-serif;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, #2ecc71 0%, #3498db 100%);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            color: #fff !important;
            font-weight: 700;
            font-size: 1.5rem;
        }

        .navbar .nav-link {
            color: #fff !important;
        }

        /* Main container */
        .main-content {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            padding: 30px;
            margin-top: 2rem;
        }

        /* Buttons */
        .btn-custom {
            background: linear-gradient(135deg, #2ecc71 0%, #3498db 100%);
            border: none;
            border-radius: 10px;
            color: white;
            padding: 10px 20px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
            color: white;
        }

        .btn-outline-primary {
            border-color: #3498db;
            color: #3498db;
            font-weight: 500;
        }

        .btn-outline-primary:hover {
            background-color: #3498db;
            color: #fff;
        }

        .btn-outline-danger {
            border-color: #e74c3c;
            color: #e74c3c;
        }

        .btn-outline-danger:hover {
            background-color: #e74c3c;
            color: #fff;
        }

        /* Badges */
        .badge.bg-admin {
            background: linear-gradient(135deg, #2ecc71 0%, #3498db 100%);
        }

        .table-hover tbody tr:hover {
            background-color: #f1f9f6;
        }

        /* Pagination */
        .pagination {
            justify-content: center;
            margin-top: 30px;
        }

        .pagination .page-link {
            color: #3498db;
            border: 1px solid #3498db;
            padding: 8px 12px;
            margin: 0 2px;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .pagination .page-link:hover {
            background-color: #3498db;
            color: white;
        }

        .pagination .page-item.active .page-link {
            background-color: #3498db;
            border-color: #3498db;
            color: white;
        }

        /* Table header gradient */
        .table thead {
            background: linear-gradient(135deg, #2ecc71 0%, #3498db 100%);
            color: white;
        }
    </style>
</head>

<body>
    <!-- Navigation -->
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

    <div class="container">
        <div class="main-content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-primary mb-0">
                    <i class="fas fa-users me-2"></i>Quản lý khách hàng
                </h2>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-custom">
                    <i class="fas fa-arrow-left me-2"></i>Trở về trang chủ
                </a>
            </div>

            @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Tên khách hàng</th>
                            <th>Email</th>
                            <th>Vai trò</th>
                            <th>Đã tạo</th>
                            <th class="text-end">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $u)
                        <tr>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td>
                                <span class="badge {{ $u->role === 'admin' ? 'bg-admin' : 'bg-secondary' }}">
                                    {{ ucfirst($u->role->name ?? $u->role) }}
                                </span>
                            </td>
                            <td>{{ $u->created_at->format('M d, Y') }}</td>
                            <td class="text-end">
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.bookings.index') }}?user={{ $u->id }}">
                                    <i class="fas fa-calendar-alt me-1"></i>Đặt sân
                                </a>
                                <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this user and all their data?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" {{ auth()->id() === $u->id ? 'disabled' : '' }}>
                                        <i class="fas fa-trash me-1"></i>Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
