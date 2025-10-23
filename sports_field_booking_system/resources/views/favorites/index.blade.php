<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sân yêu thích - StomSport</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --primary-color: #10b981;
            --primary-hover: #059669;
            --secondary-color: #0ea5e9;
            --text-dark: #1f2937;
            --text-light: #4b5563;
            --bg-light: #f9fafb;
            --bg-white: #ffffff;
            --border-color: #e5e7eb;
            --danger-color: #ef4444;
        }

        body {
            background-color: var(--bg-light);
            font-family: 'Be Vietnam Pro', sans-serif;
            color: var(--text-dark);
        }

        .navbar {
            background-color: var(--bg-white);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        .navbar-brand .fa-futbol {
            color: var(--primary-color);
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 800;
        }

        .gradient-text {
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .card-custom {
            background-color: var(--bg-white);
            border-radius: 1.25rem;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.03), 0 2px 4px -2px rgba(0, 0, 0, 0.03);
            transition: all 0.2s ease-in-out;
        }

        .sidebar .nav-link {
            color: var(--text-light);
            font-weight: 500;
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            transition: all 0.2s ease-in-out;
        }

        .sidebar .nav-link:hover {
            background-color: var(--bg-light);
            color: var(--primary-color);
        }

        .sidebar .nav-link.active {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
        }

        .sidebar .nav-link .fa-fw {
            width: 1.5em;
        }

        .field-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.07);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand fw-bolder" href="{{ route('welcome') }}">
                <i class="fas fa-futbol me-2"></i>StomSport
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i>{{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm">
                            <li><a class="dropdown-item" href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                            <li><a class="dropdown-item" href="{{ route('booking.search') }}"><i class="fas fa-search me-2"></i>Tìm sân</a></li>
                            <li><a class="dropdown-item" href="{{ route('booking.my-bookings') }}"><i class="fas fa-calendar-alt me-2"></i>Lịch đặt của tôi</a></li>
                            <li><a class="dropdown-item" href="{{ route('favorites.index') }}"><i class="fas fa-heart me-2"></i>Sân yêu thích</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
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
        </div>
    </nav>

    <main class="container py-5">
        <div class="row g-4">
            <div class="col-lg-3">
                <div class="card-custom sidebar p-3">
                    <nav class="nav flex-column">
                        <a class="nav-link" href="{{ route('dashboard') }}"><i
                                class="fas fa-fw fa-tachometer-alt me-2"></i>Dashboard</a>
                        <a class="nav-link" href="{{ route('booking.search') }}"><i
                                class="fas fa-fw fa-search me-2"></i>Tìm & Đặt sân</a>
                        <a class="nav-link" href="{{ route('booking.my-bookings') }}"><i
                                class="fas fa-fw fa-calendar-check me-2"></i>Lịch đặt của tôi</a>
                        <a class="nav-link active" href="{{ route('favorites.index') }}"><i
                                class="fas fa-fw fa-heart me-2"></i>Sân yêu thích</a>
                        <a class="nav-link" href="{{ route('notifications.index') }}">
                            <i class="fas fa-fw fa-bell me-2"></i>Thông báo
                        </a>
                    </nav>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="page-title mb-0">Danh sách <span class="gradient-text">sân yêu thích</span></h1>
                    <a href="{{ route('booking.search') }}" class="btn btn-primary fw-bold">
                        <i class="fas fa-search me-2"></i>Tìm thêm sân
                    </a>
                </div>

                @if($favorites->count() > 0)
                <div class="vstack gap-3">
                    @foreach($favorites as $field)
                    <div class="card-custom field-card p-3">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-7">
                                <h5 class="fw-bold mb-1">{{ $field->name }}</h5>
                                <p class="text-muted small mb-2"><i class="fas fa-map-marker-alt fa-fw me-1"></i>{{ $field->location }}</p>
                                <div class="d-flex flex-wrap gap-2">
                                    <span class="badge bg-light border text-dark">{{ $field->sport_type }}</span>
                                    <span class="badge bg-light border text-dark">{{ $field->size }}</span>
                                    <span class="badge bg-light border text-dark">{{ $field->surface }}</span>
                                </div>
                            </div>
                            <div class="col-md-5 d-flex justify-content-end align-items-center gap-3">
                                <div class="text-end">
                                    <h5 class="fw-bolder gradient-text mb-0">{{ number_format($field->price_per_90min, 0, ',', '.') }}đ</h5>
                                    <small class="text-muted">/ 90 phút</small>
                                </div>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('booking.field-details', $field->id) }}" class="btn btn-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button class="btn btn-outline-danger" onclick="toggleFavorite({{ $field->id }}, this)" title="Bỏ yêu thích">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="card-custom text-center py-5">
                    <div class="card-body">
                        <i class="fas fa-heart-crack fa-4x text-muted mb-4"></i>
                        <h4 class="text-muted">Bạn chưa có sân yêu thích nào</h4>
                        <p class="text-muted">Hãy bắt đầu tìm kiếm và thêm những sân bạn ưng ý vào danh sách nhé!</p>
                        <a href="{{ route('booking.search') }}" class="btn btn-primary fw-bold">
                            <i class="fas fa-search me-2"></i>Khám phá ngay
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </main>

    <script>
        function toggleFavorite(fieldId, button) {
            fetch('{{ route("favorites.toggle") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        sports_field_id: fieldId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success && !data.isFavorited) {
                        // Nếu hành động là bỏ thích thành công, xóa thẻ khỏi giao diện
                        const cardToRemove = button.closest('.card-custom');
                        cardToRemove.style.transition = 'opacity 0.3s ease';
                        cardToRemove.style.opacity = '0';
                        setTimeout(() => {
                            cardToRemove.remove();
                            // Kiểm tra xem còn sân nào không, nếu không thì tải lại trang để hiển thị thông báo "trống"
                            if (document.querySelectorAll('.field-card').length === 0) {
                                location.reload();
                            }
                        }, 300);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Đã có lỗi xảy ra. Vui lòng thử lại.');
                });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>