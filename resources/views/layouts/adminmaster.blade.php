<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Author - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            height: 100vh;
            background-color: #343a40;
            padding-top: 20px;
        }

        .sidebar .nav-link {
            color: #ffffff;
            padding: 12px 20px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: #495057;
            border-left: 4px solid #ffc107;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
        }

        .sidebar .brand {
            font-weight: bold;
            font-size: 20px;
        }

        .content {
            padding: 30px;
        }

        .logout-button {
            border: none;
            width: 100%;
            text-align: left;
            color: #ffffff;
            background-color: transparent;
            padding: 12px 20px;
            transition: background-color 0.3s ease;
        }

        .logout-button:hover {
            background-color: #dc3545;
            color: #fff;
        }

        .logout-button i {
            margin-right: 10px;
        }

        @media (max-width: 768px) {
            .sidebar {
                height: auto;
            }
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <nav class="col-md-2 col-sm-12 sidebar d-flex flex-column justify-content-between">
            <div>
                <div class="text-center mb-4">
                    <a class="navbar-brand text-white brand" href="#">📚 Author Panel</a>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('author.dashboard') }}" class="nav-link {{ request()->routeIs('author.dashboard') ? 'active' : '' }}">
                            <i class="fas fa-home"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('author.books.index') }}" class="nav-link {{ request()->routeIs('author.books.*') ? 'active' : '' }}">
                            <i class="fas fa-book"></i> Buku Saya
                        </a>
                    </li>
                </ul>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-button">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </nav>

        <!-- Main content -->
        <main class="col-md-10 ms-sm-auto content">
            <div class="py-3">
                @yield('content')
            </div>
        </main>
    </div>
</div>

</body>
</html>
