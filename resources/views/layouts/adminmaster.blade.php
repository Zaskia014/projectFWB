<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Author - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            height: 100vh;
            background-color: #343a40;
        }

        .sidebar a {
            color: #ffffff;
            display: block;
            padding: 15px;
            text-decoration: none;
        }

        .sidebar a:hover, .sidebar a.active {
            background-color: #495057;
        }

        .content {
            padding: 20px;
        }

        .navbar-brand {
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <nav class="col-md-2 sidebar d-flex flex-column p-0">
            <div class="text-center my-4">
                <a class="navbar-brand text-white" href="#">📚 Author Panel</a>
            </div>
            <a href="{{ route('author.books.index') }}" class="{{ request()->routeIs('author.books.*') ? 'active' : '' }}">📘 Buku Saya</a>
            <a href="{{ route('author.dashboard') }}">🏠 Dashboard</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-danger w-100 mt-auto">🚪 Logout</button>
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
