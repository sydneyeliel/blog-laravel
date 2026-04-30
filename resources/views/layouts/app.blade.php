<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} — @yield('title', 'Blog')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F8F8FF] text-[#1A1A2E] font-sans">

    <!-- Navbar -->
    <nav class="sticky top-0 z-50 bg-white shadow-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="{{ route('home') }}" class="text-xl font-bold text-[#4A4A8A]">
                📝 Blog Simple
            </a>
            <div class="flex items-center gap-6">
                <a href="{{ route('home') }}" class="text-sm text-gray-600 hover:text-[#4A4A8A]">Accueil</a>
                <form method="GET" action="{{ route('home') }}" class="flex items-center">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Rechercher..."
                        class="text-sm border border-gray-200 rounded-lg px-3 py-1.5 focus:outline-none focus:border-[#4A4A8A]">
                </form>
                @auth
                    <span class="text-sm text-gray-600">{{ auth()->user()->name }}</span>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="text-sm text-[#6C63FF] font-medium hover:underline">Admin</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-sm text-red-500 hover:underline">Déconnexion</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm bg-[#4A4A8A] text-white px-4 py-1.5 rounded-lg hover:bg-[#6C63FF] transition">
                        Connexion
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Contenu -->
    <main class="max-w-7xl mx-auto px-4 py-8">
        @if(session('success'))
            <div class="mb-4 bg-green-100 text-green-800 px-4 py-3 rounded-xl text-sm">
                {{ session('success') }}
            </div>
        @endif
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="mt-16 border-t border-gray-100 py-6 text-center text-sm text-gray-400">
        © {{ date('Y') }} Blog Simple — Tous droits réservés
    </footer>

</body>
</html>