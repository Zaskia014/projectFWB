<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pengguna - BookNest</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .product-card:hover {
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            transform: scale(1.02);
            transition: all 0.3s ease-in-out;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">📚 BookNest</a>
            <div class="collapse navbar-collapse" id="navbarUser">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="{{ route('user.books.index') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('user.favorites.index') }}">Favorit</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('user.transactions.index') }}">Riwayat</a></li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-sm btn-outline-danger ms-2">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten -->
    <div class="container mt-4">
        <h2 class="mb-4">📚 Selamat Datang, {{ auth()->user()->name }}!</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <h4 class="mb-3">📌 Rekomendasi Buku untuk Kamu</h4>

        @if($books->count())
            <div class="row g-4">
                @foreach ($books as $book)
                    <div class="col-md-3">
                        <div class="card product-card h-100 border-0 shadow-sm">
                            <img src="{{ asset('storage/' . $book->cover_image) }}" class="card-img-top" alt="{{ $book->title }}" style="height: 250px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $book->title }}</h5>
                                <p class="card-text text-muted">{{ $book->author->name ?? 'Tanpa Penulis' }}</p>
                                <a href="{{ route('user.books.show', $book->id) }}" class="btn btn-sm btn-primary mt-auto">Lihat Detail</a>
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
    <footer class="bg-dark text-white text-center py-3 mt-5">
        &copy; {{ date('Y') }} BookNest. Teman Setia Baca Buku Digitalmu.
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
