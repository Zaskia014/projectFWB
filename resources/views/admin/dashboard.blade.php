<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - BookNest</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            color: white;
            padding-top: 20px;
        }
        .sidebar a {
            color: #ddd;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
        }
        .sidebar a:hover {
            background-color: #495057;
            color: #fff;
        }
        .content {
            padding: 30px;
        }
    </style>
</head>
<body>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 sidebar">
                <h4 class="text-center mb-4">📚 BookNest Admin</h4>
                <a href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
                <a href="{{ route('admin.users.index') }}">👤 Kelola Pengguna</a>
                <a href="{{ route('admin.books.index') }}">📚 Kelola Buku</a>
                <a href="{{ route('admin.categories.index') }}">📁 Kelola Kategori</a>
                <a href="{{ route('admin.reviews.index') }}">📝 Ulasan Buku</a>
                <a href="{{ route('admin.transactions.index') }}">🧾 Transaksi</a>

                <form action="/logout" method="POST" class="mt-4 px-3">
                    @csrf
                    <button class="btn btn-danger w-100">Logout</button>
                </form>
            </div>

            <!-- Konten Utama -->
            <div class="col-md-9 content">
                <h1 class="mb-4 text-primary">Dashboard Admin</h1>

                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">📚 Total Buku</h5>
                                <p class="card-text display-6">152</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">👥 Total Pengguna</h5>
                                <p class="card-text display-6">78</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">📝 Total Ulasan</h5>
                                <p class="card-text display-6">235</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <h4>⚙️ Manajemen Data</h4>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <a href="{{ route('admin.books.index') }}" class="btn btn-outline-primary w-100">📚 Kelola Buku</a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-primary w-100">👤 Kelola Pengguna</a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-primary w-100">📁 Kelola Kategori</a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('admin.reviews.index') }}" class="btn btn-outline-primary w-100">📝 Kelola Ulasan</a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('admin.transactions.index') }}" class="btn btn-outline-primary w-100">🧾 Kelola Transaksi</a>
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <h4>📈 Statistik Mingguan</h4>
                    <p>Fitur ini bisa diisi dengan chart atau data mingguan nanti.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
