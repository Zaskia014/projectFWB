<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookNest – Jelajahi, dan Dapatkan Buku Favoritmu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
        }
        .hero {
            background: linear-gradient(to right, #6f42c1, #8e44ad);
            color: white;
            padding: 100px 0;
            text-align: center;
        }
        .section {
            padding: 60px 0;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">📚 BookNest</a>
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                    <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero">
        <div class="container">
            <h1 class="display-4">Selamat Datang di BookNest</h1>
            <p class="lead">Jelajahi ribuan buku digital dari berbagai penulis dan genre favoritmu.</p>
            <a href="{{ route('register') }}" class="btn btn-light btn-lg mt-3">Mulai Sekarang</a>
        </div>
    </section>

    <section class="section text-center">
        <div class="container">
            <h2 class="mb-4">Fitur Unggulan</h2>
            <div class="row">
                <div class="col-md-4">
                    <h4>Baca Buku Digital</h4>
                    <p>Akses dan baca buku langsung dari browser kapan saja.</p>
                </div>
                <div class="col-md-4">
                    <h4>Penulis Berkualitas</h4>
                    <p>Temukan karya terbaik dari penulis favoritmu atau jadi penulis sendiri.</p>
                </div>
                <div class="col-md-4">
                    <h4>Ulasan dan Rating</h4>
                    <p>Baca ulasan pembaca lain dan berikan rating untuk buku yang kamu baca.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-dark text-white text-center py-4">
        <p class="mb-0">&copy; {{ date('Y') }} BookNest. All rights reserved.</p>
    </footer>

</body>
</html>
