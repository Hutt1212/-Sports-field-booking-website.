<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông báo - StomSport</title>
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

        /* Notification Styles */
        .notification-item {
            display: flex;
            gap: 1rem;
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
            transition: background-color 0.2s ease-in-out;
        }

        .notification-item:last-child {
            border-bottom: none;
        }

        .notification-item.unread {
            background-color: var(--bg-light);
            position: relative;
        }

        .notification-item.unread::before {
            content: '';
            position: absolute;
            left: -1px;
            /* Adjust based on card padding */
            top: 50%;
            transform: translateY(-50%);
            width: 8px;
            height: 8px;
            background-color: var(--secondary-color);
            border-radius: 50%;
        }

        .notification-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 1.25rem;
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
                        <a class="nav-link" href="{{ route('booking.my-bookings') }}"><i class="fas fa-fw fa-calendar-check me-2"></i>Lịch đặt của tôi</a>
                        <a class="nav-link" href="{{ route('favorites.index') }}"><i class="fas fa-fw fa-heart me-2"></i>Sân yêu thích</a>
                        <a class="nav-link active" href="{{ route('notifications.index') }}">
                            <i class="fas fa-fw fa-bell me-2"></i>Thông báo
                        </a>
                    </nav>
                </div>
            </div>

            <div class="col-lg-9">
                <h1 class="page-title mb-4">Trung tâm <span class="gradient-text">thông báo</span></h1>
                <div class="card-custom">
                    <div class="card-body p-0">
                        @if($notifications->count() > 0)
                        @foreach($notifications as $notification)
                        <div class="notification-item {{ !$notification->is_read ? 'unread' : '' }}" data-notification-id="{{ $notification->id }}">
                            @php
                            $iconClass = 'fa-bell';
                            $colorClasses = 'bg-secondary-subtle text-secondary-emphasis';
                            if (str_contains($notification->type, 'booking_created')) {
                            $iconClass = 'fa-calendar-check';
                            $colorClasses = 'bg-success-subtle text-success-emphasis';
                            } elseif (str_contains($notification->type, 'booking_cancelled')) {
                            $iconClass = 'fa-calendar-times';
                            $colorClasses = 'bg-danger-subtle text-danger-emphasis';
                            }
                            @endphp
                            <div class="notification-icon {{ $colorClasses }}">
                                <i class="fas {{ $iconClass }}"></i>
                            </div>
                            <div class="flex-grow-1">
                                <p class="fw-bold mb-1">{{ $notification->title }}</p>
                                <p class="mb-2 text-muted">{{ $notification->message }}</p>
                                <small class="text-muted">
                                    <i class="fas fa-clock me-1"></i>{{ $notification->created_at->diffForHumans() }}
                                </small>
                            </div>
                            @if(!$notification->is_read)
                            <button class="btn btn-sm btn-outline-primary mark-read-btn" data-notification-id="{{ $notification->id }}">
                                Đánh dấu đã đọc
                            </button>
                            @endif
                        </div>
                        @endforeach
                        @else
                        <div class="text-center py-5">
                            <i class="fas fa-bell-slash fa-4x text-muted mb-4"></i>
                            <h4 class="text-muted">Không có thông báo nào</h4>
                            <p class="text-muted">Tất cả thông báo của bạn sẽ xuất hiện ở đây.</p>
                        </div>
                        @endif
                    </div>
                    @if($notifications->hasPages())
                    <div class="card-footer bg-white">
                        {{ $notifications->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.mark-read-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const notificationId = this.getAttribute('data-notification-id');
                    const button = this;

                    fetch(`/notifications/${notificationId}/mark-read`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                const card = document.querySelector(`.notification-item[data-notification-id="${notificationId}"]`);
                                card.classList.remove('unread');
                                button.innerHTML = '<i class="fas fa-check"></i> Đã đọc';
                                button.disabled = true;
                                button.classList.remove('btn-outline-primary');
                                button.classList.add('btn-light', 'text-muted');
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>