<!DOCTYPE html>
<html lang="id" data-bs-theme="light">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'BookNest')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />

    <style>
        body {
            font-family: 'Inter', sans-serif;
            padding-top: 70px; /* space for fixed navbar */
            background-color: var(--bs-body-bg);
            color: var(--bs-body-color);
            transition: background-color 0.3s, color 0.3s;
        }
        footer {
            background: #f8f9fa;
            padding: 1rem 0;
            text-align: center;
            margin-top: 4rem;
        }
        .navbar-dark .navbar-nav .nav-link.active {
            font-weight: 600;
            color: #ffc107;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ url('dashboard') }}">BookNest</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample07">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                <li class="nav-item me-3">
                    <button id="toggleThemeBtn" class="btn btn-outline-light btn-sm" title="Toggle Light/Dark Mode">
                        🌙
                    </button>
                </li>

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="btn btn-warning btn-sm px-3" href="{{ route('register') }}">Register</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="me-2">Halo, {{ auth()->user()->name }}</span>
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=ffc107&color=000" alt="Avatar" class="rounded-circle" width="30" height="30" />
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('user.profile.show') }}">Profil Saya</a></li>
                            <li><hr class="dropdown-divider" /></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<main class="container">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @yield('content')
</main>

<footer>
    <div class="container">
        <small class="text-muted">&copy; {{ date('Y') }} BookNest. All rights reserved.</small>
    </div>
</footer>

<!-- Bootstrap JS Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Dark Mode Toggle Script -->
<script>
    const toggleBtn = document.getElementById('toggleThemeBtn');
    const htmlTag = document.documentElement;

    // Initialize theme from localStorage or default to light
    if(localStorage.getItem('theme') === 'dark') {
        htmlTag.setAttribute('data-bs-theme', 'dark');
        toggleBtn.textContent = '☀️';
    }

    toggleBtn.addEventListener('click', () => {
        if(htmlTag.getAttribute('data-bs-theme') === 'dark') {
            htmlTag.setAttribute('data-bs-theme', 'light');
            localStorage.setItem('theme', 'light');
            toggleBtn.textContent = '🌙';
        } else {
            htmlTag.setAttribute('data-bs-theme', 'dark');
            localStorage.setItem('theme', 'dark');
            toggleBtn.textContent = '☀️';
        }
    });
</script>

</body>
</html>
