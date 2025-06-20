<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookNest – Jelajahi, dan Dapatkan Buku Favoritmu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }
        .hero {
            background: linear-gradient(135deg, #6f42c1, #8e44ad);
            color: white;
            padding: 100px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .hero::after {
            content: '';
            position: absolute;
            bottom: -50px;
            left: 0;
            width: 100%;
            height: 100px;
            background: white;
            clip-path: ellipse(60% 100% at 50% 0%);
        }
        .section {
            padding: 80px 0;
        }
        .feature-card {
            transition: all 0.3s ease;
            border: none;
            border-radius: 15px;
            background: white;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }
        .feature-icon {
            font-size: 40px;
            color: #6f42c1;
            margin-bottom: 15px;
        }
        .btn-login {
            background-color: #ffffff;
            color: #6f42c1;
            border: 2px solid #6f42c1;
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            background-color: #6f42c1;
            color: #ffffff;
        }
        .btn-register {
            background-color: #ffc107;
            color: #212529;
            border: none;
            transition: all 0.3s ease;
        }
        .btn-register:hover {
            background-color: #e0a800;
            color: #ffffff;
        }
        footer {
            background-color: #343a40;
            color: #fff;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">📚 BookNest</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav gap-2">
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-login btn-sm">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="btn btn-register btn-sm">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero d-flex align-items-center justify-content-center flex-column text-center">
        <div class="container">
            <h1 class="display-4 fw-bold">Selamat Datang di BookNest</h1>
            <p class="lead">Jelajahi ribuan buku digital dari berbagai penulis dan genre favoritmu.</p>
            <a href="{{ route('register') }}" class="btn btn-register btn-lg mt-3 shadow-sm">🚀 Mulai Sekarang</a>
        </div>
    </section>

    <section class="section bg-light text-center">
        <div class="container">
            <h2 class="mb-5 fw-bold text-dark">📌 Fitur Unggulan</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="p-4 feature-card">
                        <div class="feature-icon"><i class="fas fa-book-open"></i></div>
                        <h5 class="fw-semibold">Baca Buku Digital</h5>
                        <p class="text-muted">Akses dan baca buku langsung dari browser kapan saja, di mana saja.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 feature-card">
                        <div class="feature-icon"><i class="fas fa-pen-nib"></i></div>
                        <h5 class="fw-semibold">Penulis Berkualitas</h5>
                        <p class="text-muted">Temukan karya terbaik atau bagikan tulisanmu sendiri kepada dunia.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 feature-card">
                        <div class="feature-icon"><i class="fas fa-star"></i></div>
                        <h5 class="fw-semibold">Ulasan & Rating</h5>
                        <p class="text-muted">Berikan pendapatmu dan bantu pembaca lain memilih buku terbaik.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="text-center py-4">
        <p class="mb-0">&copy; {{ date('Y') }} <strong>BookNest</strong>. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
