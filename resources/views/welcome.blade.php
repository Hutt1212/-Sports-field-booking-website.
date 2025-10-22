<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>StormSport - Đặt đi chờ chi</title>

    <!-- Font & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #10b981;
            --secondary: #0ea5e9;
            --text-dark: #1f2937;
            --text-light: #6b7280;
            --bg-light: #f9fafb;
            --bg-dark: #111827;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Be Vietnam Pro', sans-serif;
            background: var(--bg-light);
            color: var(--text-dark);
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* Navbar */
        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-container {
            max-width: 1200px;
            margin: auto;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }


        .logo {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            text-decoration: none;
            color: var(--text-dark);
        }

        .logo-icon {
            width: 40px;
            /* ↓ nhỏ hơn 52px */
            height: 40px;
            border-radius: 10px;
            /* ↓ mềm hơn, ít bo */
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            /* ↓ nhỏ hơn 20px */
            color: #fff;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            box-shadow: 0 4px 10px rgba(16, 185, 129, 0.15);
            /* ↓ nhẹ hơn */
        }

        .logo-text {
            display: flex;
            flex-direction: column;
            line-height: 1.1;
        }

        .logo-text .site-name {
            font-size: 1.25rem;
            /* ~20px */
            font-weight: 800;
            color: var(--primary);
            margin: 0;
        }

        .logo-text .slogan {
            font-size: 0.8rem;
            color: var(--text-light);
            margin-top: 2px;
            font-weight: 600;
        }


        .nav-links {
            display: flex;
            gap: 1.25rem;
            align-items: center;
        }

        .nav-link {
            font-weight: 600;
            color: var(--text-dark);
            transition: 0.3s;
        }

        .nav-link:hover {
            color: var(--primary);
        }

        .auth-buttons {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .btn {
            background: var(--primary);
            color: white;
            padding: 0.5rem 1.25rem;
            border-radius: 50px;
            font-weight: 700;
            transition: 0.3s;
        }

        .btn-outline {
            border: 2px solid var(--primary);
            color: var(--primary);
            background: transparent;
        }

        .btn:hover {
            background: #059669;
            transform: translateY(-2px);
        }

        .btn-outline:hover {
            background: var(--primary);
            color: white;
        }

        /* Hero */
        .hero {
            background: linear-gradient(135deg, #ecfdf5, #e0f2fe);
            padding: 6rem 2rem;
        }

        .hero-grid {
            max-width: 1200px;
            margin: auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 3rem;
            align-items: center;
        }

        .hero-content h1 {
            font-size: clamp(2.5rem, 5vw, 3.5rem);
            font-weight: 900;
            margin-bottom: 1rem;
        }

        .gradient-text {
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-content p {
            color: var(--text-light);
            font-size: 1.1rem;
            margin-bottom: 2rem;
            max-width: 500px;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .hero-image-card {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border-radius: 1.5rem;
            padding: 3rem 2rem;
            text-align: center;
            box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
        }

        .hero-image-card i {
            font-size: 4rem;
            margin-bottom: 1rem;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        /* Section */
        .section {
            padding: 4rem 2rem;
            text-align: center;
        }

        .section h2 {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        .section p {
            color: var(--text-light);
            max-width: 650px;
            margin: auto;
            margin-bottom: 3rem;
        }

        /* Filter Tabs */
        .filter-tabs {
            display: flex;
            justify-content: center;
            gap: 1rem;
            background: #f3fdf7;
            border-radius: 12px;
            padding: 0.75rem 1.25rem;
            max-width: 800px;
            margin: 0 auto 3rem;
            flex-wrap: wrap;
        }

        .tab {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            color: #64748b;
            cursor: pointer;
            transition: 0.3s;
        }

        .tab.active {
            background: white;
            color: var(--primary);
            box-shadow: 0 0 0 1px #e2f7ec;
        }

        .tab:hover {
            color: var(--primary);
        }

        /* Features */
        .section {
            padding: 4rem 2rem;
            text-align: center;
        }

        .section h2 {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        .section p {
            color: var(--text-light);
            max-width: 650px;
            margin: auto;
            margin-bottom: 3rem;
        }

        .features-grid {
            max-width: 1100px;
            margin: auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        .feature-icon {
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        /* Courts */
        .courts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            max-width: 1100px;
            margin: auto;
        }

        .court-card {
            position: relative;
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .court-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        }

        .court-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .court-card-content {
            padding: 15px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex-grow: 1;
        }

        .court-card-content h3 {
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
        }

        .court-card h3 {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .court-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.95rem;
            color: #555;
            margin-bottom: 12px;
        }

        /* Nút Đặt ngay */
        .btn-book-now {
            display: inline-block;
            text-align: center;
            background: linear-gradient(90deg, #00aaff, #0077ff);
            color: white;
            padding: 10px 0;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .btn-book-now:hover {
            background: linear-gradient(90deg, #0077ff, #005fcc);
            transform: translateY(-2px);
        }

        .btn-book-now i {
            margin-right: 6px;
        }

        .need-login {
            background: linear-gradient(90deg, #0077ff, #005fcc);
        }

        .need-login:hover {
            background: linear-gradient(90deg, #0077ff, #005fcc);
        }

        /* About Section */
        #about {
            background: #f3fdf7;
        }

        .about-grid {
            max-width: 1100px;
            margin: auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 3rem;
            align-items: center;
        }

        .about-text {
            text-align: left;
        }

        .about-text h3 {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .about-text p {
            color: var(--text-light);
            line-height: 1.7;
            margin-bottom: 1.25rem;
        }

        .about-image {
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
        }

        .about-image img {
            width: 100%;
            height: auto;
            display: block;
        }

        /* Footer */
        footer {
            background: var(--bg-dark);
            color: #d1d5db;
            padding: 3rem 2rem;
            margin-top: 4rem;
        }

        .footer-container {
            max-width: 1200px;
            margin: auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 2rem;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.25rem;
            color: white;
            font-weight: 700;
        }

        .footer-section h3 {
            color: white;
            margin-bottom: 1rem;
            font-size: 1rem;
        }

        .footer-section a {
            display: block;
            color: #9ca3af;
            margin-bottom: 0.5rem;
            transition: 0.3s;
        }

        .footer-section a:hover {
            color: var(--primary);
        }

        .footer-bottom {
            text-align: center;
            border-top: 1px solid #374151;
            margin-top: 2rem;
            padding-top: 1rem;
            color: #9ca3af;
            font-size: 0.875rem;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="{{ url('/') }}" class="logo" aria-label="StomSport - Trang chủ">
                <div class="logo-icon" aria-hidden="true">
                    <i class="fa-solid fa-futbol"></i>
                </div>

                <div class="logo-text">
                    <span class="site-name">StormSport</span>
                    <span class="slogan">Đặt đi chờ chi!</span>
                </div>
            </a>


            <div class="nav-links">
                <a href="#features" class="nav-link">Tính năng</a>
                <a href="#courts" class="nav-link">Sân nổi bật</a>
                <a href="#about" class="nav-link">Về chúng tôi</a>
            </div>
            <!-- Auth Buttons -->
            <div class="auth-buttons">
                @auth
                @if(Auth::user()->role === \App\User\Role::Admin)
                <a href="{{ route('admin.dashboard') }}" class="btn-outline btn">
                    <i class="fa-solid fa-gauge"></i> Quản trị
                </a>
                @else
                <a href="{{ route('dashboard') }}" class="btn-outline btn">
                    <i class="fa-solid fa-calendar-check"></i> Đặt sân
                </a>
                @endif

                <span class="user-greeting">
                    <i class="fa-solid fa-user"></i> Chào, {{ Auth::user()->name }}
                </span>

                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-logout">
                        <i class="fa-solid fa-right-from-bracket"></i> Đăng xuất
                    </button>
                </form>
                @else
                <a href="{{ route('login') }}" class="btn-outline btn">Đăng nhập</a>
                <a href="{{ route('register') }}" class="btn">Đăng ký</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="hero">
        <div class="hero-grid">
            <div class="hero-content">
                <h1>Đặt sân thể thao <br><span class="gradient-text">Nhanh chóng & Tiện lợi</span></h1>
                <p>Tìm kiếm và đặt sân bóng đá, cầu lông, tennis chỉ trong vài giây. Trải nghiệm thể thao hiện đại, tiện ích và an toàn nhất!</p>
                <div class="hero-buttons">
                    <a href="#courts" class="btn">Đặt sân ngay</a>
                    <a href="#features" class="btn-outline btn">Tìm hiểu thêm</a>
                </div>
            </div>
            <div class="hero-image-card">
                <i class="fa-solid fa-calendar-check"></i>
                <h3>Đặt sân 24/7</h3>
                <p>Hệ thống tự động hoạt động liên tục, sẵn sàng phục vụ bạn mọi lúc.</p>
            </div>
        </div>
    </section>


    <!-- Features -->
    <section id="features" class="section">
        <h2>Tại sao chọn <span class="gradient-text">StomSport?</span></h2>
        <p>Chúng tôi mang đến trải nghiệm đặt sân tuyệt vời với các tính năng hiện đại và tiện lợi.</p>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon"><i class="fa-solid fa-calendar-days"></i></div>
                <h3>Đặt sân dễ dàng</h3>
                <p>Chọn sân và thời gian phù hợp chỉ với vài cú nhấp chuột.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fa-solid fa-bolt"></i></div>
                <h3>Xác nhận tức thì</h3>
                <p>Nhận xác nhận đặt sân ngay qua email hoặc thông báo.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fa-solid fa-shield-halved"></i></div>
                <h3>Thanh toán an toàn</h3>
                <p>Bảo mật tuyệt đối với nhiều phương thức thanh toán.</p>
            </div>
        </div>
    </section>

    <!-- Courts -->
    <section id="courts" class="section">
        <h2>Khám phá <span class="gradient-text">Sân nổi bật</span></h2>
        <p>Các sân được yêu thích nhất với cơ sở vật chất hiện đại và dịch vụ tốt nhất.</p>

        <div class="filter-tabs">
            <div class="tab active" data-filter="all">Tất cả</div>
            <div class="tab" data-filter="Bóng đá">Bóng đá</div>
            <div class="tab" data-filter="Tennis">Tennis</div>
            <div class="tab" data-filter="Cầu lông">Cầu lông</div>
            <div class="tab" data-filter="Bóng rổ">Bóng rổ</div>
            <div class="tab" data-filter="Bóng chuyền">Bóng chuyền</div>
        </div>

        <div class="courts-grid" id="courtsGrid">
            @foreach($courts->take(6) as $court)
            <div class="court-card" data-type="{{ $court->sport_type }}">
                <img src="{{ $court->image }}" alt="{{ $court->name }}">
                <div class="court-card-content">
                    <h3>{{ $court->name }}</h3>
                    <div class="court-info">
                        <span><i class="fa-solid fa-map-marker-alt"></i> {{ $court->location }}</span>
                        <span><strong>{{ number_format($court->price_per_90min) }}</strong> đ/90p</span>
                    </div>

                    <!-- Nút Đặt ngay -->
                    @auth
                    <a href="{{ route('login', ['id' => $court->id]) }}" class="btn-book-now">
                        <i class="fa-solid fa-calendar-check"></i> Đặt ngay
                    </a>
                    @else
                    <a href="{{ route('login', ['id' => $court->id]) }}" class="btn-book-now need-login">
                        <i class="fa-solid fa-user-lock"></i> Đặt ngay
                    </a>
                    @endauth
                </div>
            </div>
            @endforeach
        </div>

    </section>

    <!-- About -->
    <section id="about" class="section">
        <div class="about-grid">
            <div class="about-text">
                <h3>Về chúng tôi</h3>
                <p><strong>StomSport</strong> là nền tảng hàng đầu giúp người dùng đặt sân thể thao nhanh chóng, an toàn và thuận tiện. Với hệ thống liên kết hàng trăm sân thể thao trên toàn quốc, chúng tôi mang đến cho bạn trải nghiệm thể thao hiện đại và dễ dàng hơn bao giờ hết.</p>
                <p>Chúng tôi hướng đến việc xây dựng một cộng đồng thể thao năng động, kết nối người chơi và chủ sân trong cùng một nền tảng thông minh, hiệu quả và đáng tin cậy.</p>
                <a href="#courts" class="btn">Khám phá ngay</a>
            </div>
            <div class="about-image">
                <img src="https://images.unsplash.com/photo-1599058917212-d750089bc07e?auto=format&fit=crop&w=900&q=60" alt="About StomSport">
            </div>
        </div>
    </section>
    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div>
                <div class="footer-logo">
                    <div class="logo-icon"><i class="fa-solid fa-futbol"></i></div>
                    StomSport
                </div>
                <p style="margin-top:1rem;">Nền tảng đặt sân thể thao hàng đầu Việt Nam. Dễ dàng - Nhanh chóng - Tiện lợi.</p>
            </div>
            <div class="footer-section">
                <h3>Liên kết nhanh</h3>
                <a href="#features">Tính năng</a>
                <a href="#courts">Sân nổi bật</a>
                <a href="#about">Về chúng tôi</a>
            </div>
            <div class="footer-section">
                <h3>Hỗ trợ</h3>
                <a href="#">Chính sách bảo mật</a>
                <a href="#">Điều khoản dịch vụ</a>
                <a href="#">Liên hệ hỗ trợ</a>
            </div>
            <div class="footer-section">
                <h3>Kết nối</h3>
                <a href="#"><i class="fab fa-facebook"></i> Facebook</a>
                <a href="#"><i class="fab fa-instagram"></i> Instagram</a>
                <a href="#"><i class="fab fa-twitter"></i> Twitter</a>
            </div>
        </div>
        <div class="footer-bottom">
            © 2025 StomSport. All rights reserved.
        </div>
    </footer>

    <!-- Script lọc -->
    <script>
        const tabs = document.querySelectorAll('.tab');
        const cards = document.querySelectorAll('.court-card');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                const filter = tab.dataset.filter;

                cards.forEach(card => {
                    const type = card.dataset.type;
                    if (filter === 'all' || type === filter) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    </script>

</body>

</html>