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
            background-color: #f9f9f9;
            font-family: 'Inter', sans-serif;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .card {
            border-radius: 1rem;
        }
        .btn-link {
            text-decoration: none;
        }
        footer {
            font-size: 0.9rem;
        }
    </style>

    @stack('styles') <!-- Untuk custom CSS tambahan -->
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
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
                            <li class="nav-item"><a class="nav-link" href="{{ route('user.transactions.index') }}">Transaksi</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('user.favorites.index') }}">Favorit</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('user.cart.index') }}">Keranjang</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('user.profile.show') }}">Profil</a></li>
                        @endif

                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button class="nav-link btn btn-link text-white" type="submit">Logout</button>
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

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @yield('content')
    </div>

    <footer class="bg-light mt-5 py-3 text-center">
        <div class="container">
            <small>&copy; {{ date('Y') }} <strong>BookNest</strong> – Jelajahi, Baca, dan Dapatkan Buku Favoritmu</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts') <!-- Untuk custom JS tambahan -->
</body>
</html>
