@extends('layouts.app')

@section('title', 'Accueil')

@section('content')

<!-- Hero Section -->
<div class="max-w-7xl mx-auto px-6 py-10">
    <h1 class="text-4xl font-bold text-[#1A1A2E] mb-8">Latest Articles</h1>

    <div class="flex gap-10">
        <!-- Articles Grid -->
        <div class="flex-1">
            @if($posts->isEmpty())
                <div class="text-center py-20 text-gray-400">
                    <p class="text-lg">No articles yet.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                    @foreach($posts as $post)
                    <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                        <!-- Image -->
                        <div class="relative">
                            @if($post->image)
                                <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" class="w-full h-52 object-cover">
                            @else
                                <div class="w-full h-52 bg-gradient-to-br from-[#4A4A8A] to-[#6C63FF] flex items-center justify-center">
                                    <span class="text-white text-5xl">📝</span>
                                </div>
                            @endif
                            <span class="absolute top-3 left-3 bg-white text-[#4A4A8A] text-xs font-semibold px-3 py-1 rounded-full shadow-sm">
                                {{ $post->category->name }}
                            </span>
                        </div>

                        <!-- Content -->
                        <div class="p-5">
                            <div class="flex items-center justify-between text-xs text-gray-400 mb-3">
                                <span>{{ $post->published_at->format('M d, Y') }}</span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                    {{ $post->comments->count() }}
                                </span>
                            </div>

                            <h2 class="text-base font-bold text-[#1A1A2E] mb-2 line-clamp-2 hover:text-[#4A4A8A] transition">
                                {{ $post->title }}
                            </h2>

                            <p class="text-sm text-gray-500 line-clamp-2 mb-4 leading-relaxed">
                                {{ Str::limit(strip_tags($post->body), 100) }}
                            </p>

                            <hr class="border-gray-100 mb-4">

                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 rounded-full bg-[#4A4A8A] flex items-center justify-center text-white text-xs font-bold">
                                        {{ strtoupper(substr($post->user->name, 0, 1)) }}
                                    </div>
                                    <span class="text-xs text-gray-600 font-medium">{{ $post->user->name }}</span>
                                </div>
                                <a href="{{ route('posts.show', $post->slug) }}" class="text-xs text-[#6C63FF] font-semibold hover:underline">
                                    Read more →
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="flex justify-center">
                    {{ $posts->links() }}
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <aside class="w-72 shrink-0 space-y-6">

            <!-- Categories -->
            <div class="bg-white rounded-2xl p-5 border border-gray-100">
                <h3 class="font-bold text-sm text-[#1A1A2E] mb-4">Categories</h3>
                <ul class="space-y-2">
                    @foreach($categories as $category)
                    <li>
                        <a href="{{ route('categories.show', $category->slug) }}"
                            class="flex justify-between items-center text-sm text-gray-600 hover:text-[#4A4A8A] py-1.5 border-b border-gray-50 last:border-0 transition">
                            <span>{{ $category->name }}</span>
                            <span class="text-xs text-gray-400">{{ $category->posts_count }}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <!-- Recent Posts -->
            <div class="bg-white rounded-2xl p-5 border border-gray-100">
                <h3 class="font-bold text-sm text-[#1A1A2E] mb-4">Recent Posts</h3>
                <ul class="space-y-3">
                    @foreach($posts->take(3) as $recent)
                    <li class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-[#4A4A8A] to-[#6C63FF] flex items-center justify-center shrink-0">
                            <span class="text-white text-lg">📝</span>
                        </div>
                        <div>
                            <a href="{{ route('posts.show', $recent->slug) }}" class="text-xs font-medium text-[#1A1A2E] hover:text-[#4A4A8A] line-clamp-2 transition">
                                {{ $recent->title }}
                            </a>
                            <p class="text-xs text-gray-400 mt-0.5">{{ $recent->published_at->diffForHumans() }}</p>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>

            <!-- Newsletter -->
            <div class="bg-[#4A4A8A] rounded-2xl p-6 text-white">
                <h3 class="font-bold text-lg mb-2">Newsletter</h3>
                <p class="text-sm text-indigo-200 mb-4 leading-relaxed">
                    Join 15,000+ readers who receive our weekly curation of thoughtful articles.
                </p>
                <input type="email" placeholder="Your email address"
                    class="w-full bg-white/10 border border-white/20 text-white placeholder-indigo-300 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:border-white mb-3">
                <button class="w-full bg-[#6C63FF] text-white text-sm py-2.5 rounded-xl hover:bg-indigo-500 transition font-semibold">
                    Subscribe
                </button>
            </div>

        </aside>
    </div>
</div>

@endsection