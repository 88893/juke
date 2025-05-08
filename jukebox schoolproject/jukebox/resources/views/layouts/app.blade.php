<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Hatchet Jukebox - @yield('title', 'Welkom')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #1a1a1a;
            color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background-color: #121212;
            border-bottom: 1px solid #333;
        }

        .card {
            background-color: #222;
            border: 1px solid #333;
            margin-bottom: 20px;
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4);
        }

        .btn-primary {
            background-color: #e74c3c;
            border-color: #e74c3c;
        }

        .btn-primary:hover {
            background-color: #c0392b;
            border-color: #c0392b;
        }

        .song-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .jukebox-title {
            font-family: 'Impact', sans-serif;
            color: #e74c3c;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .playing-card {
            background-color: #2c3e50;
            border: none;
        }

        footer {
            background-color: #121212;
            padding: 20px 0;
            margin-top: 50px;
            border-top: 1px solid #333;
        }

        .dropdown-menu {
            background-color: #222;
            border: 1px solid #333;
        }

        .dropdown-item {
            color: #f8f9fa;
        }

        .dropdown-item:hover {
            background-color: #333;
            color: #fff;
        }
    </style>
    @yield('styles')
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container">
            <a class="navbar-brand jukebox-title" href="{{ route('songs.index') }}">
                <i class="fas fa-music me-2"></i>The Hatchet Jukebox
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('songs.index') }}">Liedjes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('songs.statistics') }}">Statistieken</a>
                    </li>
                    @auth
                    @if(auth()->user()->isAdmin())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('songs.create') }}">Nieuw Liedje</a>
                    </li>
                    @endif
                    @endauth
                </ul>

                <ul class="navbar-nav ms-auto">
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt me-1"></i> Inloggen
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            <i class="fas fa-user-plus me-1"></i> Registreren
                        </a>
                    </li>
                    @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                            @if(Auth::user()->isAdmin())
                            <span class="badge bg-danger ms-1">Admin</span>
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-1"></i> Uitloggen
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @yield('content')
    </div>

    <footer class="text-center text-white">
        <div class="container">
            <p>© {{ date('Y') }} The Hatchet Jukebox. Alle rechten voorbehouden.</p>
            <p class="text-muted">BUMA/Stemra licentie vereist voor openbaar gebruik. Neem contact op voor meer informatie.</p>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>

</html>