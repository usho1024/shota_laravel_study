<!DOCTYPE html>
<html lang="JP_ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Title Section --}}
    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Basic Inline Styles (Optional) -->
    <style>
        body { padding-top: 56px; /* Adjust if using fixed-top navbar */ }
        footer { margin-top: 2rem; padding: 1rem 0; background-color: #f8f9fa; text-align: center; }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    {{-- Navigation Bar (Example) --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand">{{ config('app.name', 'Laravel App') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        {{-- Example Link - Adjust route name as needed --}}
                        <a class="nav-link {{ request()->routeIs('posts.index') ? 'active' : '' }}" aria-current="page" href="{{ route('posts.index') }}">Posts</a>
                    </li>
                    {{-- Add other nav links here --}}
                </ul>
            </div>
        </div>
    </nav>

    {{-- Main Content Area --}}
    <main class="py-4">
         <div class="container mt-4">
            @yield('content') {{-- Child view content goes here --}}
         </div>
    </main>

    {{-- Footer (Example) --}}
    <footer class="footer mt-auto py-3 bg-light">
        <div class="container text-center">
            <span class="text-muted">© {{ date('Y') }} {{ config('app.name', 'Laravel App') }}. All rights reserved.</span>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle (includes Popper) (CDN) -->
</body>
</html>