<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Field - GameOn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 25%, #0d4d0d 50%, #1a1a1a 75%, #0a0a0a 100%);
            min-height: 100vh;
            color: #ffffff;
            overflow-x: hidden;
        }

        /* Animated Background */
        .bg-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .bg-animation::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                radial-gradient(circle at 20% 80%, rgba(0, 255, 65, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(0, 255, 65, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
            animation: float 8s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            33% {
                transform: translateY(-15px) rotate(0.5deg);
            }

            66% {
                transform: translateY(10px) rotate(-0.5deg);
            }
        }

        .navbar {
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 255, 65, 0.3);
            box-shadow: 0 2px 20px rgba(0, 255, 65, 0.1);
            z-index: 1000;
        }

        .navbar-brand {
            color: #00ff41 !important;
            font-weight: 800;
            text-shadow: 0 0 10px rgba(0, 255, 65, 0.5);
        }

        .main-content {
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 255, 65, 0.1);
            border: 1px solid rgba(0, 255, 65, 0.2);
            padding: 30px;
            position: relative;
            z-index: 1;
        }

        .search-section {
            background: rgba(0, 0, 0, 0.5);
            border-radius: 15px;
            padding: 30px;
            border: 1px solid rgba(0, 255, 65, 0.2);
            margin-bottom: 30px;
        }

        .form-control,
        .form-select {
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            padding: 12px 15px;
            transition: all 0.3s ease;
            color: white;
        }

        .form-control:focus,
        .form-select:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: #00ff41;
            box-shadow: 0 0 0 0.2rem rgba(0, 255, 65, 0.25);
            color: white;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .form-select option {
            background: #1a1a1a;
            color: white;
        }

        .btn-custom {
            background: linear-gradient(135deg, #00ff41, #00cc33);
            border: none;
            border-radius: 10px;
            color: #000000;
            padding: 12px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 255, 65, 0.4);
            color: #000000;
            background: linear-gradient(135deg, #00cc33, #00ff41);
        }

        .btn-outline-custom {
            background: transparent;
            border: 2px solid #00ff41;
            border-radius: 10px;
            color: #00ff41;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .btn-outline-custom:hover {
            background: #00ff41;
            color: #000000;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 255, 65, 0.3);
        }

        .form-label {
            color: #00ff41;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .dropdown-menu {
            background: rgba(0, 0, 0, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(0, 255, 65, 0.3);
            z-index: 9999 !important;
        }

        .dropdown-item {
            color: rgba(255, 255, 255, 0.8);
        }

        .dropdown-item:hover {
            background: rgba(0, 255, 65, 0.2);
            color: #00ff41;
        }

        .results-section {
            background: rgba(0, 0, 0, 0.5);
            border-radius: 15px;
            padding: 30px;
            border: 1px solid rgba(0, 255, 65, 0.2);
        }

        .field-card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid rgba(0, 255, 65, 0.2);
            transition: all 0.3s ease;
        }

        .field-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 255, 65, 0.2);
            border-color: #00ff41;
        }

        .field-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #00ff41, #00cc33);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: black;
            margin-right: 15px;
        }

        .text-muted {
            color: rgba(255, 255, 255, 0.6) !important;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeInUp 0.6s ease-out;
        }

        .animate-delay-1 {
            animation-delay: 0.1s;
        }

        .animate-delay-2 {
            animation-delay: 0.2s;
        }

        .animate-delay-3 {
            animation-delay: 0.3s;
        }
    </style>
</head>

<body>
    <!-- Animated Background -->
    <div class="bg-animation"></div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
                <i class="fas fa-futbol me-2"></i>GameOn
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-1"></i>{{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user-cog me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
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
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="main-content animate-fade-in">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="fw-bold text-white">
                            <i class="fas fa-search me-2 text-success"></i>Find Your Perfect Field
                        </h2>
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-custom">
                            <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                        </a>
                    </div>

                    <!-- Search Section -->
                    <div class="search-section animate-fade-in animate-delay-1">
                        <h4 class="text-white mb-4">
                            <i class="fas fa-filter me-2 text-success"></i>Search Filters
                        </h4>

                        <form id="searchForm">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="sport" class="form-label">Sport</label>
                                    <select class="form-select" id="sport" name="sport" required>
                                        <option value="">Select Sport</option>
                                        <option value="football">Football</option>
                                        <option value="basketball">Basketball</option>
                                        <option value="table-tennis">Table Tennis</option>
                                        <option value="cricket">Cricket</option>
                                        <option value="badminton">Badminton</option>
                                        <option value="paddle">Paddle</option>
                                    </select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="size" class="form-label">Size</label>
                                    <select class="form-select" id="size" name="size" required disabled>
                                        <option value="">Select Size</option>
                                    </select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="surface" class="form-label">Surface</label>
                                    <select class="form-select" id="surface" name="surface" required disabled>
                                        <option value="">Select Surface</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="date" class="form-label">Date</label>
                                    <input type="date" class="form-control" id="date" name="date" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="time" class="form-label">Time</label>
                                    <input type="time" class="form-control" id="time" name="time" required>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-custom btn-lg">
                                    <i class="fas fa-search me-2"></i>Search Fields
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Results Section -->
                    <div class="results-section animate-fade-in animate-delay-2" id="resultsSection" style="display: none;">
                        <h4 class="text-white mb-4">
                            <i class="fas fa-list me-2 text-success"></i>Available Fields
                        </h4>

                        <div id="resultsContainer">
                            <!-- Results will be populated here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sport options and their corresponding sizes and surfaces
        const sportOptions = {
            football: {
                sizes: ['All Size', 'Full Size', '7-a-side'],
                surfaces: ['Grass', 'Artificial Turf']
            },
            basketball: {
                sizes: ['Full Size'],
                surfaces: ['Indoor Court', 'Outdoor Court']
            },
            'table-tennis': {
                sizes: ['Full Size'],
                surfaces: ['Indoor Court', 'Outdoor Court']
            },
            cricket: {
                sizes: ['Full Size'],
                surfaces: ['Indoor Court', 'Outdoor Court']
            },
            badminton: {
                sizes: ['Full Size'],
                surfaces: ['Indoor Court', 'Outdoor Court']
            },
            paddle: {
                sizes: ['Full Size'],
                surfaces: ['Indoor Court', 'Outdoor Court']
            }
        };

        // Sport icons
        const sportIcons = {
            football: 'fas fa-futbol',
            basketball: 'fas fa-basketball-ball',
            'table-tennis': 'fas fa-table-tennis',
            cricket: 'fas fa-cricket',
            badminton: 'fas fa-shuttlecock',
            paddle: 'fas fa-table-tennis'
        };

        // Handle sport selection
        document.getElementById('sport').addEventListener('change', function() {
            const sport = this.value;
            const sizeSelect = document.getElementById('size');
            const surfaceSelect = document.getElementById('surface');

            // Reset and disable size and surface selects
            sizeSelect.innerHTML = '<option value="">Select Size</option>';
            surfaceSelect.innerHTML = '<option value="">Select Surface</option>';
            sizeSelect.disabled = true;
            surfaceSelect.disabled = true;

            if (sport && sportOptions[sport]) {
                // Populate size options
                sportOptions[sport].sizes.forEach(size => {
                    const option = document.createElement('option');
                    option.value = size.toLowerCase().replace(' ', '-');
                    option.textContent = size;
                    sizeSelect.appendChild(option);
                });
                sizeSelect.disabled = false;
            }
        });

        // Handle size selection
        document.getElementById('size').addEventListener('change', function() {
            const sport = document.getElementById('sport').value;
            const surfaceSelect = document.getElementById('surface');

            // Reset and disable surface select
            surfaceSelect.innerHTML = '<option value="">Select Surface</option>';
            surfaceSelect.disabled = true;

            if (sport && sportOptions[sport]) {
                // Populate surface options
                sportOptions[sport].surfaces.forEach(surface => {
                    const option = document.createElement('option');
                    option.value = surface.toLowerCase().replace(' ', '-');
                    option.textContent = surface;
                    surfaceSelect.appendChild(option);
                });
                surfaceSelect.disabled = false;
            }
        });

        // Handle form submission
        document.getElementById('searchForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const sport = formData.get('sport');
            const size = formData.get('size');
            const surface = formData.get('surface');
            const date = formData.get('date');
            const time = formData.get('time');

            // Show results section
            document.getElementById('resultsSection').style.display = 'block';

            // Generate sample results
            generateResults(sport, size, surface, date, time);
        });

        function generateResults(sport, size, surface, date, time) {
            const container = document.getElementById('resultsContainer');
            const sportName = sport.charAt(0).toUpperCase() + sport.slice(1);
            const icon = sportIcons[sport] || 'fas fa-futbol';

            // Sample field data
            const fields = [{
                    name: `${sportName} Field 1`,
                    location: 'Main Sports Complex',
                    price: '$25/hour',
                    rating: 4.8,
                    available: true
                },
                {
                    name: `${sportName} Field 2`,
                    location: 'Downtown Arena',
                    price: '$30/hour',
                    rating: 4.6,
                    available: true
                },
                {
                    name: `${sportName} Field 3`,
                    location: 'Community Center',
                    price: '$20/hour',
                    rating: 4.4,
                    available: false
                }
            ];

            let html = '';

            fields.forEach((field, index) => {
                html += `
                    <div class="field-card animate-fade-in animate-delay-${index + 1}">
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <div class="field-icon">
                                    <i class="${icon}"></i>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5 class="text-white mb-1">${field.name}</h5>
                                <p class="text-muted mb-1">
                                    <i class="fas fa-map-marker-alt me-1"></i>${field.location}
                                </p>
                                <p class="text-muted mb-0">
                                    <i class="fas fa-star text-warning me-1"></i>${field.rating} Rating
                                </p>
                            </div>
                            <div class="col-md-2 text-center">
                                <h6 class="text-success mb-0">${field.price}</h6>
                            </div>
                            <div class="col-md-2 text-center">
                                ${field.available ? 
                                    `<button class="btn btn-custom btn-sm">Book Now</button>` :
                                    `<span class="badge bg-secondary">Unavailable</span>`
                                }
                            </div>
                        </div>
                    </div>
                `;
            });

            container.innerHTML = html;
        }

        // Set minimum date to today
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('date').min = today;
    </script>
</body>

</html>