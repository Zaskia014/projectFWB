<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pengguna - BookNest</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', sans-serif;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }

        .product-card {
            transition: all 0.3s ease-in-out;
            border-radius: 12px;
            overflow: hidden;
        }

        .product-card:hover {
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.12);
            transform: translateY(-5px);
        }

        .card-img-top {
            height: 250px;
            object-fit: cover;
        }

        .card-title {
            font-size: 1rem;
            font-weight: 600;
        }

        .card-text {
            font-size: 0.875rem;
        }

        .footer {
            background-color: #343a40;
            color: #fff;
        }

        .btn-primary {
            border-radius: 50px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">📚 BookNest</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarUser">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarUser">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                    <li class="nav-item"><a class="nav-link" href="{{ route('user.books.index') }}"><i class="bi bi-house-door"></i> Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('user.favorites.index') }}"><i class="bi bi-heart"></i> Favorit</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('user.transactions.index') }}"><i class="bi bi-clock-history"></i> Riwayat</a></li>
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
        <h2 class="mb-4">👋 Selamat Datang, <strong>{{ auth()->user()->name }}</strong>!</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <h4 class="mb-3">📌 Rekomendasi Buku untuk Kamu</h4>

        @if($books->count())
            <div class="row g-4">
                @foreach ($books as $book)
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card product-card border-0 shadow-sm h-100">
                            <img src="{{ asset('storage/' . $book->cover_image) }}" class="card-img-top" alt="{{ $book->title }}">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $book->title }}</h5>
                                <p class="card-text text-muted">{{ $book->author->name ?? 'Tanpa Penulis' }}</p>
                                <a href="{{ route('user.books.show', $book->id) }}" class="btn btn-sm btn-primary mt-auto">
                                    <i class="bi bi-eye"></i> Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info">Belum ada buku yang tersedia.</div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="footer text-center py-3 mt-5">
        &copy; {{ date('Y') }} <strong>BookNest</strong>. Teman Setia Baca Buku Digitalmu.
    </footer>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
