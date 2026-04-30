<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — @yield('title', 'Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F1F5F9] font-sans">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-[#1E293B] text-white flex flex-col fixed h-full">
            <div class="px-6 py-5 border-b border-slate-700">
                <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold text-white">⚙️ Admin</a>
            </div>
            <nav class="flex-1 px-4 py-6 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm hover:bg-slate-700 {{ request()->routeIs('admin.dashboard') ? 'bg-slate-700' : '' }}">
                    📊 Dashboard
                </a>
                <a href="{{ route('admin.posts.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm hover:bg-slate-700 {{ request()->routeIs('admin.posts.*') ? 'bg-slate-700' : '' }}">
                    📝 Articles
                </a>
                <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm hover:bg-slate-700 {{ request()->routeIs('admin.categories.*') ? 'bg-slate-700' : '' }}">
                    🏷️ Catégories
                </a>
                <a href="{{ route('admin.comments.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm hover:bg-slate-700 {{ request()->routeIs('admin.comments.*') ? 'bg-slate-700' : '' }}">
                    💬 Commentaires
                    @php $pending = \App\Models\Comment::where('status', 'pending')->count(); @endphp
                    @if($pending > 0)
                        <span class="ml-auto bg-amber-500 text-white text-xs px-2 py-0.5 rounded-full">{{ $pending }}</span>
                    @endif
                </a>
            </nav>
            <div class="px-4 py-4 border-t border-slate-700">
                <p class="text-xs text-slate-400 mb-2">{{ auth()->user()->name }}</p>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-sm text-red-400 hover:text-red-300">🚪 Déconnexion</button>
                </form>
            </div>
        </aside>

        <!-- Contenu principal -->
        <div class="ml-64 flex-1 p-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 text-green-800 px-4 py-3 rounded-xl text-sm">
                    {{ session('success') }}
                </div>
            @endif
            @yield('content')
        </div>
    </div>

</body>
</html>