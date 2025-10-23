<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm kiếm Sân - StomSport</title>
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
            --danger-hover: #dc2626;
            --gray-color: #6b7280;
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

        .form-label {
            font-weight: 600;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            transition: all 0.2s ease-in-out;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(16, 185, 129, 0.3);
        }

        /* NEW Field Card Style */
        .field-card {
            border: 1px solid var(--border-color);
            border-radius: 1rem;
            transition: all 0.2s ease-in-out;
            background-color: var(--bg-white);
            position: relative;
        }

        .field-card:hover {
            transform: translateY(-5px);
            border-color: rgba(16, 185, 129, 0.5);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.07);
        }

        .favorite-btn {
            background: transparent;
            border: 1px solid var(--border-color);
            color: var(--gray-color);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            z-index: 10;
        }

        .favorite-btn:hover,
        .favorite-btn.favorited {
            background-color: var(--danger-color);
            color: white;
            border-color: var(--danger-color);
        }

        .favorite-btn.loading {
            cursor: default;
            pointer-events: none;
        }

        .loading,
        .no-results {
            text-align: center;
            padding: 40px;
            color: var(--text-light);
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
        <div class="text-center mb-5">
            <h1 class="page-title mb-2">Tìm & Đặt Sân <span class="gradient-text">Hoàn Hảo</span> Của Bạn</h1>
            <p class="text-muted fs-5">Sử dụng bộ lọc để tìm sân phù hợp nhất cho trận đấu sắp tới.</p>
        </div>

        <div class="card-custom mb-5">
            <div class="card-body p-4 p-md-5">
                <form id="search-filter-form" autocomplete="off">
                    @csrf
                    <div class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label for="sport" class="form-label">Môn thể thao</label>
                            <select class="form-select form-select-lg" id="sport" name="sport" required>
                                <option value="" selected disabled>Chọn môn thể thao</option>
                                <option value="Bóng đá">Bóng đá</option>
                                <option value="Bóng rổ">Bóng rổ</option>
                                <option value="Bóng bàn">Bóng bàn</option>
                                <option value="cricket">Cricket</option>
                                <option value="Cầu lông">Cầu lông</option>
                                <option value="paddle">Paddle</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="size" class="form-label">Loại sân</label>
                            <select class="form-select form-select-lg" id="size" name="size">
                                <option value="" selected>Tất cả loại sân</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="surface" class="form-label">Mặt sân</label>
                            <select class="form-select form-select-lg" id="surface" name="surface">
                                <option value="all" selected>Tất cả mặt sân</option>
                            </select>
                        </div>
                        <div class="col-md-2 d-grid">
                            <button type="submit" class="btn btn-primary btn-lg fw-bold" id="search-button">
                                <i class="fas fa-search me-2"></i>Tìm
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div id="search-results" style="display: none;">
            <h3 class="fw-bold mb-4">Kết quả tìm kiếm</h3>
            <div id="results-container" class="row g-4">
            </div>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sizeOptions = {
            'Bóng đá': [{
                    value: 'Sân 11',
                    label: 'Sân 11'
                },
                {
                    value: 'Sân 7',
                    label: 'Sân 7'
                },
                {
                    value: 'Sân 5',
                    label: 'Sân 5'
                }
            ],
            // ... (other sports have a 'Full Size' option)
            'Bóng rổ': [{
                value: 'Kích thước chuẩn',
                label: 'Kích thước chuẩn'
            }],
            'Bóng bàn': [{
                value: 'Kích thước chuẩn',
                label: 'Kích thước chuẩn'
            }],
            'cricket': [{
                value: 'Kích thước chuẩn',
                label: 'Kích thước chuẩn'
            }],
            'Cầu lông': [{
                value: 'Kích thước chuẩn',
                label: 'Kích thước chuẩn'
            }],
            'paddle': [{
                value: 'Kích thước chuẩn',
                label: 'Kích thước chuẩn'
            }]
        };
        const surfaceOptions = {
            'Bóng đá': [{
                    value: 'all',
                    label: 'Tất cả'
                },
                {
                    value: 'Cỏ tự nhiên',
                    label: 'Cỏ tự nhiên'
                },
                {
                    value: 'Cỏ nhân tạo',
                    label: 'Cỏ nhân tạo'
                }
            ],
            // ... (other sports options)
            'Bóng rổ': [{
                value: 'all',
                label: 'Tất cả'
            }, {
                value: 'Sân ngoài trời',
                label: 'Sân ngoài trời'
            }, {
                value: 'Sân trong nhà',
                label: 'Sân trong nhà'
            }],
            'Bóng bàn': [{
                value: 'all',
                label: 'Tất cả'
            }, {
                value: 'Sân ngoài trời',
                label: 'Sân ngoài trời'
            }, {
                value: 'Sân trong nhà',
                label: 'Sân trong nhà'
            }],
            'cricket': [{
                value: 'all',
                label: 'Tất cả'
            }, {
                value: 'Cỏ nhân tạo',
                label: 'Cỏ nhân tạo'
            }, {
                value: 'Sân trong nhà',
                label: 'Sân trong nhà'
            }],
            'Cầu lông': [{
                value: 'all',
                label: 'Tất cả'
            }, {
                value: 'Sân ngoài trời',
                label: 'Sân ngoài trời'
            }, {
                value: 'Sân ngoài trời',
                label: 'Sân trong nhà'
            }],
            'paddle': [{
                value: 'all',
                label: 'Tất cả'
            }, {
                value: 'Sân ngoài trời',
                label: 'Sân ngoài trời'
            }, {
                value: 'Sân trong nhà',
                label: 'Sân trong nhà'
            }]
        };

        document.getElementById('sport').addEventListener('change', function() {
            const sport = this.value;

            const sizeSelect = document.getElementById('size');
            sizeSelect.innerHTML = '<option value="" selected>Tất cả loại sân</option>';
            if (sizeOptions[sport]) {
                sizeOptions[sport].forEach(opt => {
                    sizeSelect.innerHTML += `<option value="${opt.value}">${opt.label}</option>`;
                });
            }

            const surfaceSelect = document.getElementById('surface');
            surfaceSelect.innerHTML = '<option value="all" selected>Tất cả mặt sân</option>';
            if (surfaceOptions[sport]) {
                surfaceOptions[sport].forEach(opt => {
                    surfaceSelect.innerHTML += `<option value="${opt.value}">${opt.label}</option>`;
                });
            }
        });

        document.getElementById('search-filter-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const sport = document.getElementById('sport').value;
            if (!sport) {
                alert('Vui lòng chọn một môn thể thao để tìm kiếm.');
                return;
            }

            const formData = new FormData(this);
            const resultsContainer = document.getElementById('results-container');
            const searchResults = document.getElementById('search-results');

            searchResults.style.display = 'block';
            resultsContainer.innerHTML = `
                <div class="col-12">
                    <div class="loading">
                        <i class="fas fa-spinner fa-spin fa-2x mb-3"></i>
                        <p>Đang tìm sân phù hợp...</p>
                    </div>
                </div>`;

            fetch('{{ route("booking.search-fields") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        displayResults(data.fields);
                    } else {
                        resultsContainer.innerHTML = `
                        <div class="col-12">
                            <div class="no-results">
                                <i class="fas fa-exclamation-triangle fa-2x mb-3"></i>
                                <p>Không tìm thấy sân nào phù hợp với lựa chọn của bạn.</p>
                            </div>
                        </div>`;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    resultsContainer.innerHTML = `
                    <div class="col-12">
                        <div class="no-results">
                            <i class="fas fa-server fa-2x mb-3"></i>
                            <p>Đã có lỗi xảy ra. Vui lòng thử lại sau.</p>
                        </div>
                    </div>`;
                });
        });

        function displayResults(fields) {
            const resultsContainer = document.getElementById('results-container');
            if (fields.length === 0) {
                resultsContainer.innerHTML = `
                    <div class="col-12">
                        <div class="no-results">
                            <i class="fas fa-search-minus fa-2x mb-3"></i>
                            <p>Không tìm thấy sân nào phù hợp. Hãy thử thay đổi bộ lọc.</p>
                        </div>
                    </div>`;
                return;
            }

            let html = '';
            fields.forEach(field => {
                const isFavoritedClass = field.is_favorited ? 'favorited' : '';
                const priceFormatted = new Intl.NumberFormat('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                }).format(field.price_per_90min);

                html += `
                    <div class="col-md-6 col-lg-4">
                        <div class="card field-card h-100">
                             <a href="/booking/field/${field.id}" class="text-decoration-none text-dark d-block p-3">
                                <h5 class="fw-bold mb-1">${field.name}</h5>
                                <p class="text-muted small mb-3">
                                    <i class="fas fa-map-marker-alt me-1"></i>${field.location}
                                </p>
                                <div class="d-flex gap-2 mb-3">
                                    <span class="badge bg-light text-dark border me-1">${field.sport_type}</span>
                                    <span class="badge bg-light text-dark border me-1">${field.size}</span>
                                    <span class="badge bg-light text-dark border me-1">${field.surface}</span>
                                </div>
                                <div>
                                    <span class="fs-5 fw-bolder gradient-text">${priceFormatted}</span>
                                    <span class="text-muted small">/ 90 phút</span>
                                </div>
                            </a>
                            <button 
                                class="favorite-btn position-absolute top-0 end-0 m-3 ${isFavoritedClass}" 
                                onclick="toggleFavorite(event, ${field.id}, this)" 
                                title="Thêm vào yêu thích">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                    </div>`;
            });
            resultsContainer.innerHTML = html;
        }

        function toggleFavorite(event, fieldId, button) {
            // Ngăn chặn sự kiện click lan tới thẻ <a> cha
            event.stopPropagation();
            event.preventDefault();

            button.classList.add('loading');

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
                    if (data.success) {
                        button.classList.toggle('favorited', data.isFavorited);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Đã có lỗi xảy ra khi cập nhật yêu thích.');
                })
                .finally(() => {
                    button.classList.remove('loading');
                });
        }
    </script>
</body>

</html>