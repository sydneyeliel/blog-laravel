@extends('layouts.admin')

@section('title', 'Categories')

@section('content')

<div class="mb-8">
    <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Management / Hub</p>
    <h1 class="text-2xl font-bold text-[#1A1A2E]">Categories</h1>
</div>

<!-- Create form -->
<div class="bg-white rounded-xl p-6 border border-gray-100 shadow-sm mb-6">
    <div class="flex items-center gap-2 text-sm font-medium text-[#6C63FF] mb-4">
        <span>⊕</span> Create New Category
    </div>
    <form method="POST" action="{{ route('admin.categories.store') }}">
        @csrf
        <div class="flex gap-4">
            <div class="flex-1">
                <label class="block text-xs font-medium text-gray-500 mb-1">Category Name</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    placeholder="e.g. Technology"
                    class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-[#6C63FF] @error('name') border-red-400 @enderror">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="flex-1">
                <label class="block text-xs font-medium text-gray-500 mb-1">Slug</label>
                <input type="text" id="slug-preview" placeholder="/technology"
                    class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm bg-gray-50 text-gray-400 focus:outline-none" readonly>
            </div>
            <div class="flex items-end">
                <button type="submit" class="bg-[#6C63FF] text-white px-5 py-2.5 rounded-lg text-sm font-semibold hover:bg-indigo-600 transition whitespace-nowrap">
                    + Add Category
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Stats -->
<div class="grid grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm">
        <p class="text-xs text-gray-400 uppercase tracking-wide">Total Categories</p>
        <p class="text-2xl font-bold text-[#1A1A2E] mt-1">{{ $categories->count() }}</p>
    </div>
    <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm">
        <p class="text-xs text-gray-400 uppercase tracking-wide">Most Active</p>
        <p class="text-2xl font-bold text-[#1A1A2E] mt-1">{{ $categories->sortByDesc('posts_count')->first()?->name ?? '—' }}</p>
    </div>
    <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm">
        <p class="text-xs text-gray-400 uppercase tracking-wide">Avg Posts/Cat</p>
        <p class="text-2xl font-bold text-[#1A1A2E] mt-1">{{ $categories->count() > 0 ? round($categories->avg('posts_count'), 1) : 0 }}</p>
    </div>
    <div class="bg-[#6C63FF] rounded-xl p-4 shadow-sm">
        <p class="text-xs text-white/70 uppercase tracking-wide">Storage Used</p>
        <p class="text-2xl font-bold text-white mt-1">68%</p>
    </div>
</div>

<!-- Table -->
<div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
        <h2 class="font-semibold text-sm text-[#1A1A2E]">Existing Categories</h2>
        <div class="flex gap-2">
            <button class="text-xs text-gray-400 hover:text-gray-600 flex items-center gap-1 border border-gray-200 px-3 py-1.5 rounded-lg">
                Filter
            </button>
            <button class="text-xs text-gray-400 hover:text-gray-600 flex items-center gap-1 border border-gray-200 px-3 py-1.5 rounded-lg">
                Export
            </button>
        </div>
    </div>
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">Category Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">Slug</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">Post Count</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">Visibility</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($categories as $category)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#6C63FF]"></span>
                        <span class="text-sm font-medium text-[#1A1A2E]">{{ $category->name }}</span>
                    </div>
                </td>
                <td class="px-6 py-4 text-sm text-gray-400">/{{ $category->slug }}</td>
                <td class="px-6 py-4 text-sm text-gray-600">{{ $category->posts_count }}</td>
                <td class="px-6 py-4">
                    <span class="text-xs bg-green-100 text-green-700 px-2.5 py-1 rounded-full font-medium">Public</span>
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="text-gray-400 hover:text-[#6C63FF] transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </a>
                        <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" onsubmit="return confirm('Delete?')">
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
                <td colspan="5" class="px-6 py-10 text-center text-gray-400 text-sm">No categories yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-6 py-3 border-t border-gray-100 flex justify-between items-center text-xs text-gray-400">
        <span>Showing {{ $categories->count() }} of {{ $categories->count() }} categories</span>
        <div class="flex gap-3">
            <button class="hover:text-gray-600">Previous</button>
            <button class="hover:text-gray-600">Next</button>
        </div>
    </div>
</div>

<script>
    document.querySelector('[name="name"]').addEventListener('input', function() {
        const slug = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
        document.getElementById('slug-preview').value = '/' + slug;
    });
</script>

@endsection