<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử Đặt sân - StomSport</title>
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

        .booking-card {
            transition: all 0.2s ease-in-out;
        }

        .booking-card:hover {
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
                        <a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-fw fa-tachometer-alt me-2"></i>Dashboard</a>
                        <a class="nav-link" href="{{ route('booking.search') }}"><i class="fas fa-fw fa-search me-2"></i>Tìm & Đặt sân</a>
                        <a class="nav-link active" href="{{ route('booking.my-bookings') }}"><i class="fas fa-fw fa-calendar-check me-2"></i>Lịch đặt của tôi</a>
                        <a class="nav-link" href="{{ route('favorites.index') }}"><i class="fas fa-fw fa-heart me-2"></i>Sân yêu thích</a>
                        <a class="nav-link" href="{{ route('notifications.index') }}">
                            <i class="fas fa-fw fa-bell me-2"></i>Thông báo
                            @if($unreadNotifications > 0)
                            <span class="badge bg-danger rounded-pill ms-auto">{{ $unreadNotifications }}</span>
                            @endif
                        </a>
                    </nav>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="mb-4">
                    <h1 class="page-title mb-1">Lịch sử <span class="gradient-text">đặt sân</span> của bạn</h1>
                    <p class="text-muted fs-5">Quản lý tất cả các lịch đã và sắp diễn ra của bạn tại đây.</p>
                </div>

                <div class="card-custom mb-4">
                    <div class="card-body p-4">
                        <form method="GET" action="{{ route('booking.my-bookings') }}" class="row g-3 align-items-end">
                            <div class="col-md-3">
                                <label class="form-label fw-bold">Môn thể thao</label>
                                <select name="sport" class="form-select">
                                    <option value="">Tất cả</option>
                                    @foreach($sports as $sport)
                                    <option value="{{ $sport }}" {{ request('sport') == $sport ? 'selected' : '' }}>
                                        {{ $sport }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Tên sân</label>
                                <input type="text" name="field" class="form-control" placeholder="Tìm theo tên sân..." value="{{ request('field') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold">Ngày đặt</label>
                                <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                            </div>
                            <div class="col-md-2">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-filter"></i></button>
                                    <a href="{{ route('booking.my-bookings') }}" class="btn btn-outline-secondary"><i class="fas fa-times"></i></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                @if($bookings->count() > 0)
                <div class="vstack gap-3">
                    @foreach($bookings as $booking)
                    <div class="card-custom booking-card p-3" data-booking-id="{{ $booking->id }}" data-created-at="{{ $booking->created_at->timestamp }}">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-6">
                                <h5 class="fw-bold mb-1">{{ $booking->sportsField->name }}</h5>
                                <p class="text-muted mb-2"><i class="fas fa-map-marker-alt fa-fw me-1"></i>{{ $booking->sportsField->location }}</p>
                                <div class="d-flex flex-wrap gap-2">
                                    <span class="badge bg-light border text-dark"><i class="fas fa-calendar-days me-1"></i>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d/m/Y') }}</span>
                                    <span class="badge bg-light border text-dark"><i class="fas fa-clock me-1"></i>{{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }}</span>
                                    <span class="badge bg-light border text-dark"><i class="fas fa-futbol me-1"></i>{{ $booking->sportsField->sport_type }}</span>
                                </div>
                            </div>
                            <div class="col-md-3 text-md-center">
                                @if($booking->status == 'confirmed')
                                <span class="badge fs-6 rounded-pill bg-success-subtle text-success-emphasis border border-success-subtle">Đã xác nhận</span>
                                @elseif($booking->status == 'cancelled')
                                <span class="badge fs-6 rounded-pill bg-danger-subtle text-danger-emphasis border border-danger-subtle">Đã hủy</span>
                                @elseif($booking->status == 'completed')
                                <span class="badge fs-6 rounded-pill bg-info-subtle text-info-emphasis border border-info-subtle">Đã hoàn thành</span>
                                @else
                                <span class="badge fs-6 rounded-pill bg-warning-subtle text-warning-emphasis border border-warning-subtle">Đang chờ</span>
                                @endif
                            </div>
                            <div class="col-md-3 text-md-end">
                                <h4 class="fw-bolder gradient-text mb-1">{{ number_format($booking->total_price, 0, ',', '.') }}đ</h4>
                                @if($booking->status == 'pending' || $booking->status == 'confirmed')
                                <button class="btn btn-sm btn-outline-danger" data-cancel data-disabled-text="Hết hạn hủy">
                                    <i class="fas fa-times-circle me-1"></i>Hủy (<span data-timer>60</span>s)
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="card-custom text-center py-5">
                    <div class="card-body">
                        <i class="fas fa-calendar-times fa-4x text-muted mb-4"></i>
                        <h4 class="text-muted">Không tìm thấy lịch đặt nào</h4>
                        <p class="text-muted">Bạn chưa có lịch đặt nào hoặc không có kết quả phù hợp với bộ lọc.</p>
                        <a href="{{ route('booking.search') }}" class="btn btn-primary fw-bold">
                            <i class="fas fa-plus me-2"></i>Đặt sân ngay
                        </a>
                    </div>
                </div>
                @endif

                <div class="mt-4">
                    {{ $bookings->links() }}
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('[data-booking-id]').forEach(card => {
                const bookingStatus = card.querySelector('.badge').textContent.trim();
                const cancelBtn = card.querySelector('[data-cancel]');

                // Chỉ chạy timer cho các booking chưa bị hủy hoặc hoàn thành
                if (!cancelBtn || (bookingStatus !== 'Đã xác nhận' && bookingStatus !== 'Đang chờ')) {
                    if (cancelBtn) cancelBtn.style.display = 'none';
                    return;
                }

                const createdAt = parseInt(card.getAttribute('data-created-at'), 10) * 1000;
                const timerSpan = card.querySelector('[data-timer]');
                const bookingId = card.getAttribute('data-booking-id');

                const intervalId = setInterval(function() {
                    const elapsed = Math.floor((Date.now() - createdAt) / 1000);
                    const remaining = Math.max(0, 60 - elapsed);
                    if (timerSpan) timerSpan.textContent = remaining;

                    if (remaining === 0) {
                        cancelBtn.classList.remove('btn-outline-danger');
                        cancelBtn.classList.add('btn-secondary');
                        cancelBtn.textContent = cancelBtn.getAttribute('data-disabled-text');
                        cancelBtn.disabled = true;
                        clearInterval(intervalId);
                    }
                }, 1000);

                cancelBtn.addEventListener('click', function() {
                    if (this.disabled) return;
                    if (!confirm('Bạn có chắc chắn muốn hủy lịch đặt sân này không?')) return;

                    fetch(`{{ url('/booking') }}/${bookingId}/cancel`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(r => r.json())
                        .then(data => {
                            if (data.success) {
                                location.reload(); // Tải lại trang để cập nhật trạng thái
                            } else {
                                alert(data.message || 'Không thể hủy lịch đặt này.');
                            }
                        })
                        .catch(() => alert('Lỗi mạng, vui lòng thử lại.'));
                });
            });
        });
    </script>
</body>

</html>