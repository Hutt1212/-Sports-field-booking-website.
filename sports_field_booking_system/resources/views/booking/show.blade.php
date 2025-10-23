<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chi tiết đặt sân - {{ $booking->sportsField->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

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

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
        }

        .status-badge {
            font-size: 1rem;
            padding: 0.5rem 1rem;
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
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Header -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="page-title mb-1">Chi tiết <span class="gradient-text">đặt sân</span></h1>
                            <p class="text-muted fs-5">Thông tin chi tiết về lịch đặt sân của bạn</p>
                        </div>
                        <a href="{{ route('booking.my-bookings') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Quay lại
                        </a>
                    </div>
                </div>

                <!-- Booking Details -->
                <div class="card-custom p-4 mb-4">
                    <div class="row g-4">
                        <!-- Field Info -->
                        <div class="col-md-6">
                            <h4 class="fw-bold mb-3">
                                <i class="fas fa-futbol text-primary me-2"></i>Thông tin sân
                            </h4>
                            <div class="mb-3">
                                <h5 class="fw-bold">{{ $booking->sportsField->name }}</h5>
                                <p class="text-muted mb-2">
                                    <i class="fas fa-map-marker-alt me-2"></i>{{ $booking->sportsField->location }}
                                </p>
                                <span class="badge bg-primary">{{ $booking->sportsField->sport_type }}</span>
                            </div>
                        </div>

                        <!-- Booking Info -->
                        <div class="col-md-6">
                            <h4 class="fw-bold mb-3">
                                <i class="fas fa-calendar-check text-success me-2"></i>Thông tin đặt sân
                            </h4>
                            <div class="row g-3">
                                <div class="col-6">
                                    <strong>Ngày đặt:</strong>
                                    <p class="text-muted">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d/m/Y') }}</p>
                                </div>
                                <div class="col-6">
                                    <strong>Giờ đặt:</strong>
                                    <p class="text-muted">
                                        {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }} - 
                                        {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}
                                    </p>
                                </div>
                                <div class="col-6">
                                    <strong>Trạng thái:</strong>
                                    <div class="mt-1">
                                        @if($booking->status == 'confirmed')
                                            <span class="badge status-badge bg-success">Đã xác nhận</span>
                                        @elseif($booking->status == 'cancelled')
                                            <span class="badge status-badge bg-danger">Đã hủy</span>
                                        @elseif($booking->status == 'completed')
                                            <span class="badge status-badge bg-info">Đã hoàn thành</span>
                                        @else
                                            <span class="badge status-badge bg-warning">Đang chờ</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6">
                                    <strong>Giá:</strong>
                                    <p class="text-muted fw-bold">{{ number_format($booking->total_price, 0, ',', '.') }}đ</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Info -->
                <div class="card-custom p-4 mb-4">
                    <h4 class="fw-bold mb-3">
                        <i class="fas fa-credit-card text-info me-2"></i>Thông tin thanh toán
                    </h4>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <strong>Phương thức thanh toán:</strong>
                            @php
                                $paymentMethodLabels = [
                                    'cash' => 'Tiền mặt',
                                    'bank_transfer' => 'Chuyển khoản ngân hàng',
                                    'credit_card' => 'Thẻ tín dụng',
                                    'momo' => 'MoMo',
                                    'bkash' => 'bKash'
                                ];
                                $paymentMethod = $paymentMethodLabels[$booking->payment_method] ?? strtoupper($booking->payment_method ?? '-');
                            @endphp
                            <p class="text-muted">{{ $paymentMethod }}</p>
                        </div>
                        <div class="col-md-4">
                            <strong>Trạng thái thanh toán:</strong>
                            <div class="mt-1">
                                @if($booking->payment_status === 'paid')
                                    <span class="badge bg-success">Đã thanh toán</span>
                                @elseif($booking->payment_status === 'refunded')
                                    <span class="badge bg-info">Đã hoàn tiền</span>
                                @else
                                    <span class="badge bg-warning">Chờ thanh toán</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <strong>Thời gian đặt:</strong>
                            <p class="text-muted">{{ $booking->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>

                    @if($booking->payment_method === 'bank_transfer' && $booking->bank_name)
                        <hr class="my-3">
                        <h5 class="fw-bold mb-3">Thông tin chuyển khoản</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <strong>Ngân hàng:</strong>
                                <p class="text-muted">{{ $booking->bank_name }}</p>
                            </div>
                            <div class="col-md-6">
                                <strong>Số tài khoản:</strong>
                                <p class="text-muted">{{ $booking->bank_account }}</p>
                            </div>
                            @if($booking->transaction_id)
                                <div class="col-md-6">
                                    <strong>Mã giao dịch:</strong>
                                    <p class="text-muted">{{ $booking->transaction_id }}</p>
                                </div>
                            @endif
                            @if($booking->payment_notes)
                                <div class="col-12">
                                    <strong>Ghi chú:</strong>
                                    <p class="text-muted">{{ $booking->payment_notes }}</p>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Actions -->
                <div class="card-custom p-4">
                    <h4 class="fw-bold mb-3">
                        <i class="fas fa-cogs text-secondary me-2"></i>Thao tác
                    </h4>
                    
                    @php
                        $bookingDateTime = \Carbon\Carbon::parse($booking->booking_date->format('Y-m-d') . ' ' . $booking->start_time->format('H:i:s'));
                        $canCancel = $bookingDateTime->isAfter(now()->addHours(2));
                    @endphp

                    <div class="d-flex gap-3">
                        @if($booking->status == 'pending' || $booking->status == 'confirmed')
                            @if($canCancel)
                                <button class="btn btn-outline-danger" id="cancelBtn" data-booking-id="{{ $booking->id }}">
                                    <i class="fas fa-times-circle me-2"></i>Hủy đặt sân
                                </button>
                            @else
                                <button class="btn btn-secondary" disabled>
                                    <i class="fas fa-clock me-2"></i>Không thể hủy
                                </button>
                            @endif
                        @endif
                        
                        <a href="{{ route('booking.field-details', $booking->sportsField->id) }}" class="btn btn-outline-primary">
                            <i class="fas fa-eye me-2"></i>Xem sân
                        </a>
                    </div>

                    @if($booking->status == 'pending' || $booking->status == 'confirmed')
                        <div class="mt-3">
                            @if($canCancel)
                                <small class="text-muted">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Bạn có thể hủy đặt sân trước 2 giờ so với giờ đặt sân.
                                </small>
                            @else
                                <small class="text-warning">
                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                    Không thể hủy đặt sân vì quá gần giờ đặt sân (dưới 2 giờ).
                                </small>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cancelBtn = document.getElementById('cancelBtn');
            
            if (cancelBtn) {
                cancelBtn.addEventListener('click', function() {
                    if (this.disabled) return;
                    
                    const bookingId = this.getAttribute('data-booking-id');
                    
                    if (confirm('Bạn có chắc chắn muốn hủy lịch đặt sân này không?\n\nLưu ý: Bạn chỉ có thể hủy trước 2 giờ so với giờ đặt sân.')) {
                        // Disable button và hiển thị loading
                        this.disabled = true;
                        const originalText = this.innerHTML;
                        this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang hủy...';
                        
                        fetch(`/booking/${bookingId}/cancel`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    showNotification('success', 'Đã hủy lịch đặt sân thành công!');
                                    // Reload trang sau 1 giây
                                    setTimeout(() => location.reload(), 1000);
                                } else {
                                    showNotification('error', data.message || 'Không thể hủy lịch đặt này.');
                                    // Khôi phục button
                                    this.disabled = false;
                                    this.innerHTML = originalText;
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                showNotification('error', 'Lỗi mạng, vui lòng thử lại.');
                                // Khôi phục button
                                this.disabled = false;
                                this.innerHTML = originalText;
                            });
                    }
                });
            }
        });

        // Hàm hiển thị thông báo
        function showNotification(type, message) {
            const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
            const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
            
            const notification = document.createElement('div');
            notification.className = `alert ${alertClass} alert-dismissible fade show position-fixed`;
            notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
            notification.innerHTML = `
                <i class="fas ${icon} me-2"></i>${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            document.body.appendChild(notification);
            
            // Tự động ẩn sau 5 giây
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.remove();
                }
            }, 5000);
        }
    </script>
</body>

</html>
