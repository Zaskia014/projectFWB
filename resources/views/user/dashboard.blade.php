<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pengguna - BookNest</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Inter', sans-serif;
        }
        .navbar {
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .product-card {
            transition: all 0.3s ease;
            border-radius: 16px;
            overflow: hidden;
            background-color: #fff;
        }
        .product-card:hover {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            transform: translateY(-4px);
        }
        .card-img-top {
            height: 220px;
            object-fit: cover;
        }
        .card-title {
            font-size: 1rem;
            font-weight: 600;
        }
        .card-text {
            font-size: 0.875rem;
            color: #6c757d;
        }
        .btn-primary {
            border-radius: 30px;
        }
        footer {
            background: #343a40;
            color: #fff;
            padding: 1rem 0;
            text-align: center;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">📚 BookNest</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarUser">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarUser">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('user.books.index') }}"><i class="bi bi-house-door"></i> Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('user.favorites.index') }}"><i class="bi bi-heart"></i> Favorit</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('user.user.transactions.index') }}"><i class="bi bi-clock-history"></i> Riwayat</a></li>
                <li class="nav-item ms-2">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-box-arrow-right"></i> Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Konten -->
<div class="container my-5">
    <div class="text-center mb-4">
        <h2>👋 Selamat Datang, <strong>{{ auth()->user()->name }}</strong>!</h2>
        <p class="text-muted">Jelajahi buku-buku terbaik pilihan untukmu</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <h4 class="mb-3">📌 Rekomendasi Buku</h4>

    @if($books->count())
        <div class="row g-4">
            @foreach ($books as $book)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card product-card border-0 shadow-sm h-100">
                        <img src="{{ asset('storage/' . $book->cover_image) }}" class="card-img-top" alt="{{ $book->title }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text">{{ $book->author->name ?? 'Tanpa Penulis' }}</p>
                            <a href="{{ route('user.books.show', $book->id) }}" class="btn btn-sm btn-primary mt-auto">
                                <i class="bi bi-eye"></i> Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center">Belum ada buku yang tersedia saat ini.</div>
    @endif
</div>

<!-- Footer -->
{{-- <footer>
    &copy; {{ date('Y') }} <strong>BookNest</strong> – Teman Setia Baca Buku Digitalmu.
</footer> --}}

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
