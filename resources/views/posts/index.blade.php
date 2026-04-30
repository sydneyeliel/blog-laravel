@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
<div class="flex gap-8">

    <!-- Articles -->
    <div class="flex-1">
        <h1 class="text-4xl font-bold mb-8 text-[#4A4A8A]">Derniers articles</h1>

        @if($posts->isEmpty())
            <div class="text-center py-16 text-gray-400">Aucun article pour le moment.</div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                @foreach($posts as $post)
                <a href="{{ route('posts.show', $post->slug) }}" class="bg-white rounded-xl shadow-sm hover:shadow-md transition overflow-hidden border border-gray-100">
                    @if($post->image)
                        <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gradient-to-br from-[#4A4A8A] to-[#6C63FF] flex items-center justify-center text-white text-4xl">📝</div>
                    @endif
                    <div class="p-4">
                        <span class="text-xs font-medium text-[#6C63FF] bg-indigo-50 px-2 py-1 rounded-full">
                            {{ $post->category->name }}
                        </span>
                        <h2 class="text-base font-semibold mt-2 mb-1 text-[#1A1A2E]">{{ $post->title }}</h2>
                        <p class="text-sm text-gray-500 line-clamp-2">{{ Str::limit($post->body, 100) }}</p>
                        <div class="flex items-center justify-between mt-3 text-xs text-gray-400">
                            <span>{{ $post->user->name }}</span>
                            <span>{{ $post->published_at->format('d/m/Y') }}</span>
                            <span>💬 {{ $post->comments->count() }}</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            {{ $posts->links() }}
        @endif
    </div>

    <!-- Sidebar -->
    <aside class="w-72 shrink-0">
        <div class="bg-white rounded-xl p-4 shadow-sm mb-4 border border-gray-100">
            <h3 class="font-semibold mb-3 text-sm text-[#1A1A2E]">🔍 Recherche</h3>
            <form method="GET" action="{{ route('home') }}">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Mot-clé..."
                    class="w-full text-sm border border-gray-200 rounded-lg px-3 py-2 focus:outline-none focus:border-[#4A4A8A]">
                <button class="mt-2 w-full bg-[#4A4A8A] text-white text-sm py-2 rounded-lg hover:bg-[#6C63FF] transition">
                    Rechercher
                </button>
            </form>
        </div>

        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
            <h3 class="font-semibold mb-3 text-sm text-[#1A1A2E]">🏷️ Catégories</h3>
            <ul class="space-y-2">
                @foreach($categories as $category)
                <li>
                    <a href="{{ route('categories.show', $category->slug) }}"
                        class="flex justify-between items-center text-sm text-gray-600 hover:text-[#4A4A8A]">
                        <span>{{ $category->name }}</span>
                        <span class="bg-indigo-50 text-[#6C63FF] text-xs px-2 py-0.5 rounded-full">{{ $category->posts_count }}</span>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </aside>

</div>
@endsection