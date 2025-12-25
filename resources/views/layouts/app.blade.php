<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistem Perpustakaan') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-light">
    <div id="app">

        <!-- NAVBAR -->
        <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
            <div class="container">

                <!-- BRAND -->
                <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ url('/') }}">
                    📚 {{ config('app.name', 'Sistem Perpustakaan') }}
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent"
                        aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- LEFT NAV -->
                    <ul class="navbar-nav me-auto">
                        @auth
                            @if(Auth::user()->role === 'admin')
                                <li class="nav-item">
                                    <span class="nav-link text-white-50">
                                        Admin Panel
                                    </span>
                                </li>
                            @endif
                        @endauth
                    </ul>

                    <!-- RIGHT NAV -->
                    <ul class="navbar-nav ms-auto">

                        <!-- GUEST -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                                </li>
                            @endif
                        @else

                            <!-- AUTH USER DROPDOWN -->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown"
                                   class="nav-link dropdown-toggle fw-semibold"
                                   href="#"
                                   role="button"
                                   data-bs-toggle="dropdown"
                                   aria-haspopup="true"
                                   aria-expanded="false">

                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end shadow-sm">

                                    <!-- USER MENU -->
                                    @if(Auth::user()->role === 'user')
                                        <a class="dropdown-item d-flex align-items-center gap-2"
                                           href="{{ route('my.borrow') }}">
                                            📄 Riwayat Pinjam
                                        </a>
                                    @endif

                                    <!-- ADMIN MENU -->
                                    @if(Auth::user()->role === 'admin')
                                        <a class="dropdown-item d-flex align-items-center gap-2"
                                           href="{{ url('/') }}">
                                            ⚙️ Kelola Buku
                                        </a>
                                    @endif

                                    <div class="dropdown-divider"></div>

                                    <!-- LOGOUT -->
                                    <a class="dropdown-item text-danger d-flex align-items-center gap-2"
                                       href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                                        🚪 Logout
                                    </a>

                                    <form id="logout-form"
                                          action="{{ route('logout') }}"
                                          method="POST"
                                          class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- MAIN CONTENT -->
        <main class="py-4">
            <div class="container">
                @yield('content')
            </div>
        </main>

        <!-- FOOTER -->
        <footer class="text-center text-muted py-3 small">
            © {{ date('Y') }} Sistem Perpustakaan — Laravel {{ app()->version() }}
        </footer>

    </div>
</body>
</html>
