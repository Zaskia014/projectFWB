<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Author</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar-custom {
            background: linear-gradient(90deg, #0051ff, #4a90e2);
        }
        .card-dashboard {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }
        .btn-custom {
            border-radius: 50px;
        }
        .navbar-brand {
            font-size: 1.5rem;
        }
        .dashboard-header {
            font-weight: 600;
        }
        .btn-group-author a {
            margin-right: 0.5rem;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">📚 Author Panel</a>
            <div class="ms-auto btn-group-author">
                <a href="{{ url('/') }}" class="btn btn-outline-light">
                    <i class="bi bi-house"></i> Beranda
                </a>
                <a href="{{ route('author.books.index') }}" class="btn btn-light">
                    <i class="bi bi-book"></i> Buku Saya
                </a>
                <a href="{{ route('logout') }}" class="btn btn-outline-light"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-lock"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container my-5">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-10 col-md-12">
                <div class="card card-dashboard p-4">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
                        <h4 class="dashboard-header mb-3 mb-md-0">
                            👋 Selamat Datang, <strong>{{ Auth::user()->name }}</strong>
                        </h4>
                        <a href="{{ url('/') }}" class="btn btn-outline-primary">
                            <i class="bi bi-house-door"></i> Kembali ke Beranda
                        </a>
                    </div>
                    <p class="text-muted">
                        Ini adalah dashboard kamu sebagai <strong>Author</strong>. Di sini kamu bisa menambah dan mengelola buku-buku yang kamu tulis.
                    </p>
                    <a href="{{ route('author.books.create') }}" class="btn btn-primary btn-lg btn-custom mt-4">
                        <i class="bi bi-plus-circle"></i> Tambah Buku Baru
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
