<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - BookNest</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
        }
        .sidebar {
            background-color: #1f2937;
            min-height: 100vh;
            color: white;
            transition: all 0.3s;
        }
        .sidebar h4 {
            font-weight: 600;
        }
        .sidebar a {
            color: #d1d5db;
            text-decoration: none;
            display: block;
            padding: 14px 20px;
            transition: background 0.2s, color 0.2s;
        }
        .sidebar a:hover,
        .sidebar a.active {
            background-color: #374151;
            color: #fff;
        }
        .card-title {
            font-weight: 600;
        }
        .btn-outline-primary {
            transition: all 0.2s;
        }
        .btn-outline-primary:hover {
            background-color: #0d6efd;
            color: #fff;
        }
        .navbar-dark .navbar-brand {
            font-weight: bold;
            font-size: 1.3rem;
        }
    </style>
</head>
<body>

    <!-- Navbar (mobile) -->
    <nav class="navbar navbar-dark bg-dark d-md-none">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">📚 BookNest Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar (desktop) -->
            <aside class="col-md-3 d-none d-md-block sidebar py-4">
                <h4 class="text-center mb-4">📚 BookNest Admin</h4>
                <a href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
                <a href="{{ route('admin.users.index') }}"><i class="bi bi-people me-2"></i> Kelola Pengguna</a>
                <a href="{{ route('admin.books.index') }}"><i class="bi bi-book me-2"></i> Kelola Buku</a>
                <a href="{{ route('admin.categories.index') }}"><i class="bi bi-folder me-2"></i> Kelola Kategori</a>
                <a href="{{ route('admin.reviews.index') }}"><i class="bi bi-chat-left-text me-2"></i> Ulasan Buku</a>
                <a href="{{ route('admin.transactions.index') }}"><i class="bi bi-receipt me-2"></i> Transaksi</a>
                <form action="/logout" method="POST" class="px-3 mt-4">
                    @csrf
                    <button class="btn btn-danger w-100"><i class="bi bi-box-arrow-right me-1"></i> Logout</button>
                </form>
            </aside>

            <!-- Sidebar (mobile) -->
            <div class="offcanvas offcanvas-start text-bg-dark d-md-none" id="mobileSidebar">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title">📚 BookNest Admin</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body">
                    <a href="{{ route('admin.dashboard') }}" class="btn-sidebar">📊 Dashboard</a>
                    <a href="{{ route('admin.users.index') }}" class="btn-sidebar">👥 Kelola Pengguna</a>
                    <a href="{{ route('admin.books.index') }}" class="btn-sidebar">📚 Kelola Buku</a>
                    <a href="{{ route('admin.categories.index') }}" class="btn-sidebar">📁 Kelola Kategori</a>
                    <a href="{{ route('admin.reviews.index') }}" class="btn-sidebar">📝 Ulasan Buku</a>
                    <a href="{{ route('admin.transactions.index') }}" class="btn-sidebar">🧾 Transaksi</a>
                    <form action="/logout" method="POST" class="mt-3">
                        @csrf
                        <button class="btn btn-danger w-100">Logout</button>
                    </form>
                </div>
            </div>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto px-4 py-4">
                <h1 class="mb-4 text-primary"><i class="bi bi-speedometer2 me-2"></i>Dashboard Admin</h1>

                <!-- Summary Cards -->
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h6 class="card-title">📚 Total Buku</h6>
                                <p class="display-6 fw-semibold">152</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h6 class="card-title">👥 Total Pengguna</h6>
                                <p class="display-6 fw-semibold">78</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h6 class="card-title">📝 Total Ulasan</h6>
                                <p class="display-6 fw-semibold">235</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Management Buttons -->
                <h4 class="mb-3">⚙️ Manajemen Data</h4>
                <div class="row g-3">
                    <div class="col-md-4">
                        <a href="{{ route('admin.books.index') }}" class="btn btn-outline-primary w-100"><i class="bi bi-book"></i> Kelola Buku</a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-primary w-100"><i class="bi bi-people"></i> Kelola Pengguna</a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-primary w-100"><i class="bi bi-folder2-open"></i> Kelola Kategori</a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('admin.reviews.index') }}" class="btn btn-outline-primary w-100"><i class="bi bi-chat-dots"></i> Kelola Ulasan</a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('admin.transactions.index') }}" class="btn btn-outline-primary w-100"><i class="bi bi-receipt"></i> Kelola Transaksi</a>
                    </div>
                </div>

                <!-- Statistik Section -->
                <div class="mt-5">
                    <h4><i class="bi bi-bar-chart-line-fill me-2"></i>Statistik Mingguan</h4>
                    <p class="text-muted">Grafik dan laporan statistik akan ditambahkan di sini.</p>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
