@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content')

<div class="flex items-center gap-2 text-sm text-gray-400 mb-6">
    <a href="{{ route('admin.categories.index') }}" class="hover:text-[#6C63FF]">Categories</a>
    <span>/</span>
    <span class="text-[#1A1A2E]">Edit</span>
</div>

<h1 class="text-2xl font-bold text-[#1A1A2E] mb-8">Edit Category</h1>

<div class="max-w-lg">
    <div class="bg-white rounded-xl p-6 border border-gray-100 shadow-sm">
        <form method="POST" action="{{ route('admin.categories.update', $category) }}">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Category Name *</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}"
                    class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-[#6C63FF] @error('name') border-red-400 @enderror">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
                <input type="text" value="{{ $category->slug }}"
                    class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm bg-gray-50 text-gray-400 focus:outline-none" readonly>
            </div>
            <div class="flex gap-3">
                <button type="submit" class="flex-1 bg-[#6C63FF] text-white py-2.5 rounded-lg text-sm font-semibold hover:bg-indigo-600 transition">
                    Save Changes
                </button>
                <a href="{{ route('admin.categories.index') }}" class="flex-1 text-center bg-gray-100 text-gray-600 py-2.5 rounded-lg text-sm hover:bg-gray-200 transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@endsection