<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookNest - @yield('title')</title>

    <!-- Bootstrap & Font -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #f5f7fa;
            font-family: 'Inter', sans-serif;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .nav-link {
            color: white !important;
        }
        .nav-link:hover {
            text-decoration: underline;
        }
        .card {
            border-radius: 0.75rem;
        }
        footer {
            font-size: 0.875rem;
            background-color: #f8f9fa;
        }
        .btn-link {
            color: white;
            text-decoration: none;
        }
        .btn-link:hover {
            text-decoration: underline;
        }
    </style>

    @stack('styles') <!-- Custom CSS tambahan -->
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('user.dashboard') }}">📚 BookNest</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        @php $role = auth()->user()->role; @endphp

                        @if($role === 'admin')
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard Admin</a></li>
                        @elseif($role === 'author')
                            <li class="nav-item"><a class="nav-link" href="{{ route('author.dashboard') }}">Dashboard Penulis</a></li>
                        @elseif($role === 'user')
                            <li class="nav-item"><a class="nav-link" href="{{ route('user.dashboard') }}">Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('user.books.index') }}">Daftar Buku</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('user.user.transactions.index') }}">Transaksi</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('user.favorites.index') }}">Favorit</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('user.cart.index') }}">Keranjang</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('user.profile.show') }}">Profil</a></li>
                        @endif

                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button class="nav-link btn btn-link" type="submit">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-4">
        {{-- Flash Message --}}
        @if (session('success'))
            <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="alert alert-danger shadow-sm">{{ session('error') }}</div>
        @endif

        {{-- Content --}}
        @yield('content')
    </div>

    <footer class="text-center py-3 border-top">
        <div class="container">
            <small class="text-muted">
                &copy; {{ date('Y') }} <strong>BookNest</strong> — Jelajahi, Baca, dan Dapatkan Buku Favoritmu
            </small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts') <!-- Custom JS tambahan -->
</body>
</html>
