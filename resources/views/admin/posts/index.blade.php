@extends('layouts.admin')

@section('title', 'Articles')

@section('content')

<div class="flex items-start justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold text-[#1A1A2E]">Articles</h1>
        <p class="text-sm text-gray-500 mt-1">Manage and curate your publication content.</p>
    </div>
    <a href="{{ route('admin.posts.create') }}" class="bg-[#6C63FF] text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-indigo-600 transition flex items-center gap-2">
        + New Article
    </a>
</div>

<!-- Total count -->
<div class="bg-[#4A4A8A] rounded-xl p-4 mb-6 flex items-center justify-between">
    <div>
        <p class="text-white/70 text-xs uppercase tracking-wide">Total Content</p>
        <p class="text-white font-bold text-2xl mt-0.5">{{ $posts->total() }} Articles</p>
    </div>
    <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center">
        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
    </div>
</div>

<!-- Table -->
<div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">Title</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">Category</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">Comments</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">Date Published</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($posts as $post)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#4A4A8A] to-[#6C63FF] flex items-center justify-center shrink-0 text-white text-sm">
                            {{ strtoupper(substr($post->title, 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-sm font-medium text-[#1A1A2E]">{{ Str::limit($post->title, 40) }}</p>
                            <p class="text-xs text-gray-400">by {{ $post->user->name }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <span class="text-xs bg-indigo-50 text-[#6C63FF] px-2.5 py-1 rounded-full font-medium uppercase tracking-wide">{{ $post->category->name }}</span>
                </td>
                <td class="px-6 py-4">
                    @if($post->published_at)
                        <span class="text-xs bg-green-100 text-green-700