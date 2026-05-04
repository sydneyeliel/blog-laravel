@extends('layouts.admin')

@section('title', 'Comment Moderation')

@section('content')

<div class="flex items-start justify-between mb-8">
    <div>
        <h1 class="text-2xl font-bold text-[#1A1A2E]">Comment Moderation</h1>
        <p class="text-sm text-gray-500 mt-1">Review and manage reader engagement across your articles.</p>
    </div>
    <button class="border border-gray-200 text-gray-600 px-4 py-2 rounded-lg text-sm hover:bg-gray-50 transition flex items-center gap-2">
        ↑ Export CSV
    </button>
</div>

<!-- Stats -->
<div class="grid grid-cols-4 gap-5 mb-8">
    <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-xs text-gray-400 uppercase tracking-wide">Pending Approval</p>
                <p class="text-3xl font-bold text-[#1A1A2E] mt-1">{{ $stats['pending'] }}</p>
                <p class="text-xs text-green-500 mt-1">↑ 22% from yesterday</p>
            </div>
            <div class="w-9 h-9 bg-blue-50 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-xs text-gray-400 uppercase tracking-wide">Flagged Spam</p>
                <p class="text-3xl font-bold text-[#1A1A2E] mt-1">0</p>
                <p class="text-xs text-gray-400 mt-1">Filtered by system</p>
            </div>
            <div class="w-9 h-9 bg-amber-50 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-xs text-gray-400 uppercase tracking-wide">Avg Response Time</p>
                <p class="text-3xl font-bold text-[#1A1A2E] mt-1">4.2h</p>
                <p class="text-xs text-green-500 mt-1">↓ 30 mins this weekend</p>
            </div>
            <div class="w-9 h-9 bg-purple-50 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-xs text-gray-400 uppercase tracking-wide">Total Approved</p>
                <p class="text-3xl font-bold text-[#1A1A2E] mt-1">{{ number_format($stats['approved']) }}</p>
                <p class="text-xs text-gray-400 mt-1">Lifetime total</p>
            </div>
            <div class="w-9 h-9 bg-green-50 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
    </div>
</div>

<!-- Filter tabs -->
<div class="flex items-center gap-1 mb-6 border-b border-gray-200">
    <button class="px-4 py-2.5 text-sm font-medium text-[#6C63FF] border-b-2 border-[#6C63FF] -mb-px">
        All Comments ({{ $stats['total'] }})
    </button>
    <button class="px-4 py-2.5 text-sm text-gray-500 hover:text-gray-700">
        Pending ({{ $stats['pending'] }})
    </button>
    <button class="px-4 py-2.5 text-sm text-gray-500 hover:text-gray-700">
        Approved ({{ $stats['approved'] }})
    </button>
</div>

<!-- Table -->
<div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">Commenter</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">Message Excerpt</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">Article Title</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($comments as $comment)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-[#4A4A8A] flex items-center justify-center text-white text-xs font-bold shrink-0">
                            {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-sm font-medium text-[#1A1A2E]">{{ $comment->user->name }}</p>
                            <p class="text-xs text-gray-400">{{ $comment->user->email }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 text-sm text-gray-500 max-w-xs">
                    "{{ Str::limit($comment->body, 60) }}"
                </td>
                <td class="px-6 py-4">
                    <a href="{{ route('posts.show', $comment->post->slug) }}" class="text-sm text-[#6C63FF] hover:underline">
                        {{ Str::limit($comment->post->title, 30) }}
                    </a>
                </td>
                <td class="px-6 py-4 text-sm text-gray-400">
                    {{ $comment->created_at->format('M d') }}<br>
                    <span class="text-xs">{{ $comment->created_at->format('Y') }}</span>
                </td>
                <td class="px-6 py-4">
                    @if($comment->status === 'approved')
                        <span class="text-xs bg-green-100 text-green-700 px-2.5 py-1 rounded-full font-medium uppercase tracking-wide">Approved</span>
                    @else
                        <span class="text-xs bg-amber-100 text-amber-700 px-2.5 py-1 rounded-full font-medium uppercase tracking-wide">Pending</span>
                    @endif
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center gap-2">
                        @if($comment->status === 'pending')
                        <form method="POST" action="{{ route('admin.comments.approve', $comment) }}">
                            @csrf
                            @method('PATCH')
                            <button class="text-gray-400 hover:text-green-500 transition" title="Approve">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            </button>
                        </form>
                        @endif
                        <form method="POST" action="{{ route('admin.comments.destroy', $comment) }}" onsubmit="return confirm('Delete?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-gray-400 hover:text-red-500 transition" title="Delete">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-10 text-center text-gray-400 text-sm">No comments yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-6 py-4 border-t border-gray-100 flex justify-between items-center">
        <span class="text-xs text-gray-400">Showing {{ $comments->count() }} of {{ $stats['total'] }} Comments</span>
        {{ $comments->links() }}
    </div>
</div>

@endsection