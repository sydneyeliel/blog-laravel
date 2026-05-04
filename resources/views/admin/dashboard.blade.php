@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<div class="flex items-start justify-between mb-8">
    <div>
        <h1 class="text-2xl font-bold text-[#1A1A2E]">Dashboard Overview</h1>
        <p class="text-sm text-gray-500 mt-1">Welcome back. Here's what's happening with your blog today.</p>
    </div>
    <a href="{{ route('admin.posts.create') }}" class="bg-[#6C63FF] text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-indigo-600 transition flex items-center gap-2">
        + Create New Post
    </a>
</div>

<!-- Stats -->
<div class="grid grid-cols-4 gap-5 mb-8">
    <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-xs text-gray-500 uppercase tracking-wide">Total Posts</p>
                <p class="text-3xl font-bold text-[#1A1A2E] mt-1">{{ $stats['total_posts'] }}</p>
                <p class="text-xs text-green-500 mt-1">↑ 12% from last month</p>
            </div>
            <div class="w-9 h-9 bg-blue-50 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-xs text-gray-500 uppercase tracking-wide">Total Categories</p>
                <p class="text-3xl font-bold text-[#1A1A2E] mt-1">{{ $stats['total_categories'] }}</p>
                <p class="text-xs text-gray-400 mt-1">Mainly Technology & Lifestyle</p>
            </div>
            <div class="w-9 h-9 bg-purple-50 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-xs text-gray-500 uppercase tracking-wide">Total Comments</p>
                <p class="text-3xl font-bold text-[#1A1A2E] mt-1">{{ $stats['total_comments'] }}</p>
                <p class="text-xs text-green-500 mt-1">↑ 42 this week</p>
            </div>
            <div class="w-9 h-9 bg-green-50 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl p-5 border border-amber-200 shadow-sm bg-amber-50">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-xs text-amber-600 uppercase tracking-wide">Pending Comments</p>
                <p class="text-3xl font-bold text-amber-600 mt-1">{{ $stats['pending_comments'] }}</p>
                <p class="text-xs text-amber-500 mt-1">↑ Requires immediate action</p>
            </div>
            <div class="w-9 h-9 bg-amber-100 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
        </div>
    </div>
</div>

<!-- Recent Articles -->
<div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
        <div>
            <h2 class="font-semibold text-[#1A1A2E]">Recent Articles</h2>
            <p class="text-xs text-gray-400 mt-0.5">A list of the most recently created or updated blog posts.</p>
        </div>
    </div>
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">Article Title</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">Category</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">Comments</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">Last Updated</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($recentPosts as $post)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-[#4A4A8A] to-[#6C63FF] flex items-center justify-center shrink-0">
                            <span class="text-white text-xs">📝</span>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-[#1A1A2E]">{{ Str::limit($post->title, 35) }}</p>
                            <p class="text-xs text-gray-400">by {{ $post->user->name }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <span class="text-xs bg-indigo-50 text-[#6C63FF] px-2.5 py-1 rounded-full font-medium">{{ $post->category->name }}</span>
                </td>
                <td class="px-6 py-4">
                    @if($post->published_at)
                        <span class="text-xs bg-green-100 text-green-700 px-2.5 py-1 rounded-full font-medium">● Published</span>
                    @else
                        <span class="text-xs bg-gray-100 text-gray-500 px-2.5 py-1 rounded-full font-medium">● Draft</span>
                    @endif
                </td>
                <td class="px-6 py-4">
                    <span class="text-sm text-gray-500 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        {{ $post->comments->count() }}
                    </span>
                </td>
                <td class="px-6 py-4 text-sm text-gray-400">{{ $post->updated_at->format('M d, Y') }}</td>
                <td class="px-6 py-4">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.posts.edit', $post) }}" class="text-gray-400 hover:text-[#6C63FF] transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </a>
                        <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" onsubmit="return confirm('Delete this post?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-gray-400 hover:text-red-500 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-10 text-center text-gray-400 text-sm">No articles yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
