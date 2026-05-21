<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — AcadémieOHADA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/ohada.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    @stack('styles')
</head>
<body class="dashboard-body">

    {{-- Sidebar --}}
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <a href="{{ route('accueil') }}" class="sidebar-logo">
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="sidebar-logo-img">
                <div class="sidebar-logo-text">
                    <span class="logo-text">AcadémieRédactionOHADA</span>
                    <span class="logo-sub">@yield('sidebar-role', 'Espace')</span>
                </div>
            </a>
        </div>

        <nav class="sidebar-nav">
            @yield('sidebar-links')
        </nav>

        <div class="sidebar-footer">
            <div class="sidebar-user">
                <img src="{{ auth()->user()->avatar_url }}" alt="Avatar" class="avatar-sm">
                <div>
                    <p class="sidebar-user-name">{{ auth()->user()->nom_complet }}</p>
                    <p class="sidebar-user-role">{{ auth()->user()->getRoleNames()->first() }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">Déconnexion</button>
            </form>
        </div>
    </aside>

    {{-- Contenu --}}
    <div class="dashboard-main">
        <header class="dashboard-header">
            <button class="sidebar-toggle" onclick="document.getElementById('sidebar').classList.toggle('open')" aria-label="Menu">
                <span></span><span></span><span></span>
            </button>
            <h1 class="dashboard-title">@yield('page-title', 'Dashboard')</h1>
            <div class="header-actions">
                @yield('header-actions')
            </div>
        </header>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
                <button onclick="this.parentElement.remove()">✕</button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
                <button onclick="this.parentElement.remove()">✕</button>
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-error">
                <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
        @endif

        <div class="dashboard-content">
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('js/ohada.js') }}"></script>
    @stack('scripts')
</body>
</html>
