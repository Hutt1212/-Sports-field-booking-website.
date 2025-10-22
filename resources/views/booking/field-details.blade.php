<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sân - {{ $field->name }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
        }

        .time-slot-option.available {
            color: var(--primary-color);
            font-weight: 600;
        }

        .time-slot-option.booked {
            color: var(--danger-color);
            text-decoration: line-through;
        }

        .favorite-btn {
            width: 48px;
            height: 48px;
            border-radius: 50%;
        }

        .favorite-btn.favorited {
            background-color: var(--danger-color);
            color: white;
            border-color: var(--danger-color);
        }

        .field-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 1.25rem;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand fw-bolder" href="{{ route('welcome') }}"><i class="fas fa-futbol me-2"></i>StomSport</a>
            <a class="nav-link ms-auto" href="{{ route('booking.search') }}">
                <i class="fas fa-search me-1"></i> Tìm sân khác
            </a>
        </div>
    </nav>

    <main class="container py-5">
        <div class="row g-4 g-lg-5">
            <div class="col-lg-7">
                <img src="{{ $field->image }}" alt="{{ $field->name }}" class="field-image mb-4 shadow-sm">

                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h1 class="h2 fw-bolder mb-1">{{ $field->name }}</h1>
                        <p class="text-muted"><i class="fas fa-map-marker-alt fa-fw me-2"></i>{{ $field->address }}</p>
                    </div>
                    <button class="btn favorite-btn {{ $isFavorited ? 'favorited' : 'btn-outline-secondary' }}"
                        onclick="toggleFavorite('{{ $field->id }}', this)"
                        title="{{ $isFavorited ? 'Bỏ yêu thích' : 'Thêm vào yêu thích' }}">
                        <i class="fas fa-heart"></i>
                    </button>
                </div>

                <hr class="my-4">

                <h4 class="fw-bold mb-3">Thông số sân</h4>
                <div class="row g-3">
                    <div class="col-md-6"><i class="fas fa-futbol fa-fw text-primary me-2"></i> <strong>Môn:</strong> {{ $field->sport_type }}</div>
                    <div class="col-md-6"><i class="fas fa-users fa-fw text-primary me-2"></i> <strong>Loại sân:</strong> {{ $field->size }}</div>
                    <div class="col-md-6"><i class="fas fa-layer-group fa-fw text-primary me-2"></i> <strong>Bề mặt:</strong> {{ $field->surface }}</div>
                    <div class="col-md-6"><i class="fas fa-sun fa-fw text-primary me-2"></i> <strong>Vị trí:</strong> {{ $field->type }}</div>
                </div>

                @if($field->description)
                <hr class="my-4">
                <h4 class="fw-bold mb-3">Mô tả</h4>
                <p class="text-muted">{{ $field->description }}</p>
                @endif
            </div>

            <div class="col-lg-5">
                <div class="card-custom position-sticky" style="top: 2rem;">
                    <div class="card-body p-4">
                        <div class="text-center mb-3">
                            <h2 class="fw-bolder gradient-text mb-0" id="field-price" data-base-price="{{ $field->price_per_90min }}">
                                {{ number_format($field->price_per_90min, 0, ',', '.') }}đ
                            </h2>
                            <small class="text-muted">/ 90 phút</small>
                        </div>

                        <div id="booking-feedback" class="mb-3"></div>

                        <form id="booking-form" autocomplete="off">
                            <div class="mb-3">
                                <label for="booking_date" class="form-label fw-bold">Chọn ngày</label>
                                <input type="date" class="form-control form-control-lg" id="booking_date" required min="{{ date('Y-m-d') }}">
                            </div>
                            <div class="mb-3">
                                <label for="time_slot" class="form-label fw-bold">Chọn khung giờ</label>
                                <select class="form-select form-select-lg" id="time_slot" name="time_slot" required disabled>
                                    <option value="">Vui lòng chọn ngày trước</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Phương thức thanh toán</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="pay_cash" value="cash" checked>
                                    <label class="form-check-label" for="pay_cash">Thanh toán tại sân (Tiền mặt)</label>
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg fw-bold" id="book-button" disabled>
                                    <i class="fas fa-calendar-check me-2"></i>Đặt ngay
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bookingForm = document.getElementById('booking-form');
            const dateInput = document.getElementById('booking_date');
            const timeSlotSelect = document.getElementById('time_slot');
            const bookButton = document.getElementById('book-button');
            const feedbackDiv = document.getElementById('booking-feedback');
            const priceDisplay = document.getElementById('field-price');

            // Read the base price safely from the data attribute
            const basePrice = parseFloat(priceDisplay.dataset.basePrice) || 0;

            let selectedTimeSlot = null;

            dateInput.addEventListener('change', function() {
                loadTimeSlots(this.value);
                selectedTimeSlot = null;
                updateBookButtonState();
                priceDisplay.textContent = new Intl.NumberFormat('vi-VN').format(basePrice) + 'đ';
            });

            timeSlotSelect.addEventListener('change', function() {
                if (this.value && !this.options[this.selectedIndex].disabled) {
                    const parts = this.value.split('-');
                    selectedTimeSlot = {
                        start: parts[0],
                        end: parts[1],
                        price: parseInt(parts[2], 10)
                    };
                    priceDisplay.textContent = new Intl.NumberFormat('vi-VN').format(selectedTimeSlot.price) + 'đ';
                } else {
                    selectedTimeSlot = null;
                    priceDisplay.textContent = new Intl.NumberFormat('vi-VN').format(basePrice) + 'đ';
                }
                updateBookButtonState();
            });

            bookingForm.addEventListener('submit', function(event) {
                event.preventDefault();
                bookButton.disabled = true;
                bookButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang xử lý...';

                const payload = {
                    booking_date: dateInput.value,
                    start_time: selectedTimeSlot.start,
                    end_time: selectedTimeSlot.end,
                    price: selectedTimeSlot.price,
                    payment_method: document.querySelector('input[name="payment_method"]:checked').value
                };

                fetch('{{ route("booking.book", $field->id) }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify(payload)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            feedbackDiv.innerHTML = `<div class="alert alert-success"><strong>Thành công!</strong> Đã xác nhận đặt sân của bạn. Hẹn gặp bạn!</div>`;
                            loadTimeSlots(dateInput.value);
                            selectedTimeSlot = null;
                            timeSlotSelect.value = '';
                        } else {
                            feedbackDiv.innerHTML = `<div class="alert alert-danger">${data.message || 'Không thể hoàn tất đặt sân.'}</div>`;
                        }
                        feedbackDiv.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    })
                    .catch(err => {
                        console.error(err);
                        feedbackDiv.innerHTML = '<div class="alert alert-danger">Đã xảy ra lỗi khi kết nối đến máy chủ.</div>';
                    })
                    .finally(() => {
                        bookButton.innerHTML = '<i class="fas fa-calendar-check me-2"></i>Đặt ngay';
                        updateBookButtonState();
                    });
            });

            function loadTimeSlots(date) {
                if (!date) return;
                timeSlotSelect.innerHTML = '<option value="">Đang tải khung giờ...</option>';
                timeSlotSelect.disabled = true;

                fetch('{{ route("booking.check-availability", $field->id) }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            date: date
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        timeSlotSelect.innerHTML = '<option value="">Chọn một khung giờ</option>';
                        if (data.success && data.slots.length > 0) {
                            data.slots.forEach(slot => {
                                const startTime = slot.start_time.substring(0, 5);
                                const endTime = slot.end_time.substring(0, 5);
                                const priceText = new Intl.NumberFormat('vi-VN').format(slot.price) + 'đ';

                                const option = document.createElement('option');
                                option.value = `${slot.start_time}-${slot.end_time}-${slot.price}`;

                                if (slot.available) {
                                    option.textContent = `${startTime} - ${endTime} — ${priceText}`;
                                    option.classList.add('available');
                                } else {
                                    option.textContent = `${startTime} - ${endTime} (Đã đặt)`;
                                    option.classList.add('booked');
                                    option.disabled = true;
                                }
                                timeSlotSelect.appendChild(option);
                            });
                            timeSlotSelect.disabled = false;
                        } else {
                            timeSlotSelect.innerHTML = '<option value="">Không có khung giờ trống cho ngày này</option>';
                        }
                    })
                    .catch(error => {
                        console.error('Error loading time slots:', error);
                        timeSlotSelect.innerHTML = '<option value="">Lỗi khi tải khung giờ</option>';
                    });
            }

            function updateBookButtonState() {
                bookButton.disabled = selectedTimeSlot === null;
            }
        });

        function toggleFavorite(fieldId, buttonElement) {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch('/favorites/toggle', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({
                        sports_field_id: fieldId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        buttonElement.classList.toggle('favorited', data.isFavorited);
                        buttonElement.classList.toggle('btn-outline-secondary', !data.isFavorited);
                        buttonElement.title = data.isFavorited ? 'Bỏ yêu thích' : 'Thêm vào yêu thích';
                    } else {
                        alert('Đã có lỗi xảy ra. Vui lòng thử lại.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Không thể kết nối đến máy chủ.');
                });
        }
    </script>
</body>

</html>