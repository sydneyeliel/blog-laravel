<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Simple — @yield('title', 'Accueil')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#F8F8FF] text-[#1A1A2E]">

    <!-- Navbar -->
    <nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-3 flex items-center justify-between">
            <div class="flex items-center gap-8">
                <a href="{{ route('home') }}" class="text-lg font-bold text-[#4A4A8A]">Blog Simple</a>
                <div class="hidden md:flex items-center gap-6">
                    <a href="{{ route('home') }}" class="text-sm text-[#4A4A8A] font-medium border-b-2 border-[#4A4A8A] pb-0.5">Explore</a>
                  <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-[#4A4A8A] transition">Categories</a>
<a href="#newsletter" class="text-sm text-gray-500 hover:text-[#4A4A8A] transition">Newsletter</a>
<a href="#" class="text-sm text-gray-500 hover:text-[#4A4A8A] transition">About</a>

                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="relative hidden md:block">
                    <input type="text" placeholder="Search articles..."
                        class="bg-gray-50 border border-gray-200 rounded-full px-4 py-1.5 text-sm w-48 focus:outline-none focus:border-[#4A4A8A] focus:w-64 transition-all">
                </div>
                @auth
                    <span class="text-sm text-gray-600">{{ auth()->user()->name }}</span>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="text-sm bg-[#4A4A8A] text-white px-4 py-1.5 rounded-full hover:bg-[#6C63FF] transition font-medium">
                            Admin
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-sm text-gray-500 hover:text-red-500 transition">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-[#4A4A8A] transition font-medium">Log In</a>
                    <a href="{{ route('register') }}" class="text-sm bg-[#4A4A8A] text-white px-4 py-1.5 rounded-full hover:bg-[#6C63FF] transition font-medium">
                        Get Started
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Contenu -->
    <main>
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-6 pt-4">
                <div class="bg-green-50 text-green-800 px-4 py-3 rounded-xl text-sm border border-green-200">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        @yield('content')
    </main>
<!-- Footer -->
<footer class="mt-20 border-t border-gray-100 bg-white">
    <div class="max-w-7xl mx-auto px-6 py-10">
        <div class="flex flex-col md:flex-row justify-between items-start gap-8 mb-10">
            <!-- Logo + description -->
            <div class="max-w-xs">
                <p class="font-bold text-[#4A4A8A] text-xl mb-2">Blog Simple</p>
                <p class="text-sm text-gray-400 leading-relaxed">A thoughtful blogging platform for curious minds. Read, write, and connect with ideas that matter.</p>
            </div>

            <!-- Links -->
            <div class="flex gap-16">
                <div>
                    <h4 class="font-semibold text-sm text-[#1A1A2E] mb-3">Explore</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="{{ route('home') }}" class="hover:text-[#4A4A8A]">Latest Articles</a></li>
                        <li><a href="{{ route('home') }}" class="hover:text-[#4A4A8A]">Categories</a></li>
                        <li><a href="#" class="hover:text-[#4A4A8A]">Newsletter</a></li>
                        <li><a href="#" class="hover:text-[#4A4A8A]">About</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-sm text-[#1A1A2E] mb-3">Account</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="{{ route('login') }}" class="hover:text-[#4A4A8A]">Log In</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-[#4A4A8A]">Get Started</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-sm text-[#1A1A2E] mb-3">Legal</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-[#4A4A8A]">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-[#4A4A8A]">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-[#4A4A8A]">Contact Us</a></li>
                        <li><a href="#" class="hover:text-[#4A4A8A]">RSS Feed</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-100 pt-6 flex flex-col md:flex-row justify-between items-center gap-2">
            <p class="text-sm text-gray-400">© {{ date('Y') }} Blog Simple. Designed for thoughtful creators.</p>
            <div class="flex items-center gap-4 text-sm text-gray-400">
                <a href="#" class="hover:text-[#4A4A8A]">Privacy Policy</a>
                <a href="#" class="hover:text-[#4A4A8A]">Terms of Service</a>
                <a href="#" class="hover:text-[#4A4A8A]">Contact Us</a>
                <a href="#" class="hover:text-[#4A4A8A]">RSS Feed</a>
            </div>
        </div>
    </div>
</footer>