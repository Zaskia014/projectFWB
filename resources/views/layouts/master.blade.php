<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | BookNest</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }

        main {
            min-height: 80vh;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.4rem;
        }

        .nav-link {
            transition: color 0.2s ease, background-color 0.2s ease;
        }

        .nav-link:hover {
            color: #ffc107 !important;
        }

        .btn-logout {
            background-color: transparent;
            border: 1px solid #ffffff;
            color: #ffffff;
            transition: all 0.3s ease;
        }

        .btn-logout:hover {
            background-color: #ffc107;
            color: #000;
            border-color: #ffc107;
        }

        footer {
            background-color: #343a40;
            color: #ffffff;
        }
    </style>
</head>
<body>
    
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/"><i class="bi bi-book-half me-1"></i>BookNest</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-1">
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                    <i class="bi bi-speedometer2"></i> Admin
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.categories.index') }}">
                                    <i class="bi bi-tags"></i> Kategori
                                </a>
                            </li>
                        @elseif(Auth::user()->role === 'author')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('author.dashboard') }}">
                                    <i class="bi bi-house-door"></i> Penulis
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('author.books.index') }}">
                                    <i class="bi bi-journal-bookmark"></i> Buku Saya
                                </a>
                            </li>
                        @elseif(Auth::user()->role === 'user')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.dashboard') }}">
                                    <i class="bi bi-person-circle"></i> Pengguna
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('favorites.index') }}">
                                    <i class="bi bi-heart-fill text-danger"></i> Favorit
                                </a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-logout ms-lg-2">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right"></i> Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="bi bi-person-plus-fill"></i> Register
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container py-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="text-center py-3">
        &copy; {{ date('Y') }} <strong>BookNest</strong>. All rights reserved.
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
