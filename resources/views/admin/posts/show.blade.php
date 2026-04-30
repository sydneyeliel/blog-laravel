@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="max-w-4xl mx-auto">

    @if($post->image)
        <div class="relative rounded-2xl overflow-hidden mb-8 h-72">
            <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-6">
                <h1 class="text-3xl font-bold text-white">{{ $post->title }}</h1>
            </div>
        </div>
    @else
        <h1 class="text-4xl font-bold text-[#4A4A8A] mb-6">{{ $post->title }}</h1>
    @endif

    <div class="flex items-center gap-4 text-sm text-gray-500 mb-8">
        <span>✍️ {{ $post->user->name }}</span>
        <span>📅 {{ $post->published_at->format('d/m/Y') }}</span>
        <span class="bg-indigo-50 text-[#6C63FF] px-3 py-1 rounded-full text-xs font-medium">
            {{ $post->category->name }}
        </span>
        <span>💬 {{ $post->comments->count() }} commentaire(s)</span>
    </div>

    <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 mb-8 prose max-w-none">
        {!! nl2br(e($post->body)) !!}
    </div>

    <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 mb-8">
        <h2 class="text-xl font-semibold mb-6">💬 Commentaires ({{ $post->comments->where('status', 'approved')->count() }})</h2>

        @forelse($post->comments->where('status', 'approved') as $comment)
        <div class="border-b border-gray-100 pb-4 mb-4 last:border-0">
            <div class="flex justify-between items-start">
                <div>
                    <span class="font-medium text-sm text-[#1A1A2E]">{{ $comment->user->name }}</span>
                    <span class="text-xs text-gray-400 ml-2">{{ $comment->created_at->format('d/m/Y H:i') }}</span>
                </div>
                @auth
                    @if(auth()->id() === $comment->user_id)
                        <form method="POST" action="{{ route('comments.destroy', $comment) }}">
                            @csrf
                            @method('DELETE')
                            <button class="text-xs text-red-400 hover:text-red-600">Supprimer</button>
                        </form>
                    @endif
                @endauth
            </div>
            <p class="text-sm text-gray-600 mt-2">{{ $comment->body }}</p>
        </div>
        @empty
            <p class="text-sm text-gray-400">Aucun commentaire approuvé pour le moment.</p>
        @endforelse

        @auth
            <form method="POST" action="{{ route('comments.store', $post) }}" class="mt-6">
                @csrf
                <label class="block text-sm font-medium text-gray-700 mb-2">Votre commentaire</label>
                <textarea name="body" rows="3" maxlength="500"
                    placeholder="Écrivez votre commentaire (10-500 caractères)..."
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#4A4A8A] resize-none">{{ old('body') }}</textarea>
                @error('body')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                <button type="submit" class="mt-3 bg-[#4A4A8A] text-white px-6 py-2 rounded-lg text-sm hover:bg-[#6C63FF] transition">
                    Publier
                </button>
            </form>
        @else
            <div class="mt-6 bg-indigo-50 rounded-xl p-4 text-sm text-center">
                <a href="{{ route('login') }}" class="text-[#6C63FF] font-medium hover:underline">Connectez-vous</a> pour laisser un commentaire.
            </div>
        @endauth
    </div>

    @if($relatedPosts->isNotEmpty())
    <div>
        <h3 class="text-lg font-semibold mb-4">📚 Articles liés</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($relatedPosts as $related)
            <a href="{{ route('posts.show', $related->slug) }}" class="bg-white rounded-xl p-4 shadow-sm hover:shadow-md transition border border-gray-100">
                <span class="text-xs text-[#6C63FF]">{{ $related->category->name }}</span>
                <h4 class="text-sm font-medium mt-1 text-[#1A1A2E]">{{ $related->title }}</h4>
                <p class="text-xs text-gray-400 mt-1">{{ $related->published_at->format('d/m/Y') }}</p>
            </a>
            @endforeach
        </div>
    </div>
    @endif

</div>
@endsection