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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top text-light">
        <div class="container-fluid">
            <a class="navbar-brand">{{ config('app.name', 'Laravel App') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav">
                    @if (!request()->is('admin*'))
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('posts.index') ? 'active' : '' }}" aria-current="page" href="{{ route('posts.index') }}">Posts</a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('posts.create') ? 'active' : '' }}" aria-current="page" href="{{ route('posts.create') }}">Create</a>
                            </li>
                        @endauth
                    @endif
                </ul>
                <div class="navbar-nav me-3 align-items-center">
                    @auth('user')
                        <span class="me-3">ユーザー:  {{ Auth::user()->email }}</span>
                        <a href="{{ route('logout') }}" class="btn btn-danger me-3">ユーザーログアウト</a>
                    @endauth

                    @auth('admin')
                        <span class="me-3">管理者:  {{ Auth::guard('admin')->user()->email }}</span>
                        <a href="{{ route('admin.logout') }}" class="btn btn-danger me-3">管理者ログアウト</a>
                    @endauth
                        
                    @if (request()->is('admin*'))
                        <a href="{{ route('posts.index') }}" class="btn btn-light me-3">投稿一覧</a>
                    @endif

                    @if (!request()->is('admin*') && !Auth::guard('user')->check())
                        <a class="nav-link active" aria-current="page" href="{{ route('index') }}">ログイン</a>
                    @endif
                </div>
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