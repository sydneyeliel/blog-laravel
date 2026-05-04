@extends('layouts.admin')

@section('title', 'New Article')

@section('content')

<div class="flex items-center gap-2 text-sm text-gray-400 mb-6">
    <a href="{{ route('admin.posts.index') }}" class="hover:text-[#6C63FF]">Articles</a>
    <span>/</span>
    <span class="text-[#1A1A2E]">Create</span>
</div>

<h1 class="text-2xl font-bold text-[#1A1A2E] mb-1">Create Article</h1>
<p class="text-sm text-gray-500 mb-8">Manage your content settings and publishing workflow.</p>

<form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="flex gap-6">

        <!-- Main form -->
        <div class="flex-1 space-y-5">
            <div class="bg-white rounded-xl p-6 border border-gray-100 shadow-sm">

                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Article Title</label>
                    <input type="text" name="title" value="{{ old('title') }}"
                        placeholder="Enter article title..."
                        class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-[#6C63FF] @error('title') border-red-400 @enderror">
                    @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex gap-4 mb-5">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
                        <input type="text" name="slug_preview" id="slug_preview"
                            placeholder="auto-generated-slug"
                            class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm bg-gray-50 text-gray-400 focus:outline-none" readonly>
                        <p class="text-xs text-[#6C63FF] mt-1">Drag always in-sync</p>
                    </div>
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                        <select name="category_id" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-[#6C63FF] @error('category_id') border-red-400 @enderror">
                            <option value="">Select category...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cover Image</label>
                    <div class="border-2 border-dashed border-gray-200 rounded-xl p-8 text-center hover:border-[#6C63FF] transition cursor-pointer">
                        <svg class="w-8 h-8 text-gray-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <p class="text-sm text-gray-400">Click to upload or drag and drop</p>
                        <p class="text-xs text-gray-300 mt-1">SVG, PNG, JPG or GIF, max 4px, 900×600px</p>
                        <input type="file" name="image" accept="image/*" class="mt-3 text-sm text-gray-500">
                    </div>
                    @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Content Content</label>
                    <textarea name="body" rows="12"
                        placeholder="Write your article content here..."
                        class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-[#6C63FF] resize-none @error('body') border-red-400 @enderror">{{ old('body') }}</textarea>
                    @error('body') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

            </div>
        </div>

        <!-- Sidebar -->
        <div class="w-64 shrink-0 space-y-4">
            <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-semibold text-sm text-[#1A1A2E]">Publishing</h3>
                    <span class="text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full font-medium">LIVE</span>
                </div>

                <div class="mb-4">
                    <label class="block text-xs font-medium text-gray-600 mb-1">Article Visibility</label>
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-400">Sets article as live or not managed</span>
                        <input type="checkbox" name="is_published" class="rounded accent-[#6C63FF]">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-xs font-medium text-gray-600 mb-2">Publish Date</label>
                    <input type="datetime-local" name="published_at" value="{{ old('published_at') }}"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-xs focus:outline-none focus:b