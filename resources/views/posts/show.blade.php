@extends('layouts.app')

@section('title', $post->title)

@section('content')

<!-- Hero -->
<div class="relative w-full h-72 bg-gradient-to-br from-[#1A1A2E] to-[#4A4A8A] overflow-hidden">
    @if($post->image)
        <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover opacity-60">
    @endif
    <div class="absolute inset-0 flex items-end">
        <div class="max-w-4xl mx-auto px-6 pb-8 w-full">
            <div class="flex items-center gap-2 mb-3">
                <span class="bg-[#6C63FF] text-white text-xs font-semibold px-3 py-1 rounded-full">{{ $post->category->name }}</span>
                <span class="text-white/70 text-xs">{{ ceil(str_word_count($post->body) / 200) }} min read</span>
            </div>
            <h1 class="text-3xl font-bold text-white leading-tight">{{ $post->title }}</h1>
            <div class="flex items-center gap-3 mt-3">
                <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center text-white font-bold text-xs">
                    {{ strtoupper(substr($post->user->name, 0, 1)) }}
                </div>
                <div>
                    <p class="text-white text-sm font-medium">{{ $post->user->name }}</p>
                    <p class="text-white/60 text-xs">Published {{ $post->published_at->format('M d, Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content -->
<div class="max-w-4xl mx-auto px-6 py-10">

    <!-- Article body -->
    <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 mb-8 prose max-w-none text-gray-700 leading-relaxed">
        {!! nl2br(e($post->body)) !!}
    </div>

    <!-- Comments -->
    <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 mb-8">
        <h2 class="text-xl font-bold text-[#1A1A2E] mb-6">
            Comments ({{ $post->comments->where('status', 'approved')->count() }})
        </h2>

        @forelse($post->comments->where('status', 'approved') as $comment)
        <div class="border-b border-gray-100 pb-5 mb-5 last:border-0 last:mb-0">
            <div class="flex items-start justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-[#4A4A8A] flex items-center justify-center text-white text-xs font-bold">
                        {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-[#1A1A2E]">{{ $comment->user->name }}</p>
                        <p class="text-xs text-gray-400">{{ $comment->created_at->format('M d, Y \a\t H:i') }}</p>
                    </div>
                </div>
                @auth
                    @if(auth()->id() === $comment->user_id)
                        <form method="POST" action="{{ route('comments.destroy', $comment) }}">
                            @csrf
                            @method('DELETE')
                            <button class="text-xs text-red-400 hover:text-red-600 transition">Delete</button>
                        </form>
                    @endif
                @endauth
            </div>
            <p class="text-sm text-gray-600 mt-3 leading-relaxed ml-12">{{ $comment->body }}</p>
        </div>
        @empty
            <p class="text-sm text-gray-400 text-center py-6">No approved comments yet. Be the first!</p>
        @endforelse

        <!-- Comment form -->
        @auth
            <div class="mt-6 pt-6 border-t border-gray-100">
                <h3 class="text-sm font-semibold text-[#1A1A2E] mb-3">Leave a comment</h3>
                <form method="POST" action="{{ route('comments.store', $post) }}">
                    @csrf
                    <textarea name="body" rows="3" maxlength="500"
                        placeholder="Share your thoughts... (10-500 characters)"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#4A4A8A] resize-none text-gray-700">{{ old('body') }}</textarea>
                    @error('body')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <button type="submit" class="mt-3 bg-[#4A4A8A] text-white px-6 py-2.5 rounded-xl text-sm hover:bg-[#6C63FF] transition font-semibold">
                        Post Comment
                    </button>
                </form>
            </div>
        @else
            <div class="mt-6 pt-6 border-t border-gray-100 bg-indigo-50 rounded-xl p-5 text-center">
                <p class="text-sm text-gray-600">
                    <a href="{{ route('login') }}" class="text-[#6C63FF] font-semibold hover:underline">Sign in</a> to leave a comment
                </p>
            </div>
        @endauth
    </div>

    <!-- Related articles -->
    @if($relatedPosts->isNotEmpty())
    <div>
        <h3 class="text-xl font-bold text-[#1A1A2E] mb-5">Related Articles</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            @foreach($relatedPosts as $related)
            <a href="{{ route('posts.show', $related->slug) }}" class="bg-white rounded-2xl overflow-hidden border border-gray-100 hover:shadow-md transition">
                <div class="h-32 bg-gradient-to-br from-[#4A4A8A] to-[#6C63FF] flex items-center justify-center">
                    <span class="text-white text-3xl">📝</span>
                </div>
                <div class="p-4">
                    <span class="text-xs text-[#6C63FF] font-medium">{{ $related->category->name }}</span>
                    <h4 class="text-sm font-bold mt-1 text-[#1A1A2E] line-clamp-2">{{ $related->title }}</h4>
                    <p class="text-xs text-gray-400 mt-1">{{ $related->published_at->format('M d, Y') }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

</div>
@endsection