@extends('layouts.admin')

@section('title', 'Modifier l\'article')

@section('content')
<h1 class="text-2xl font-bold text-[#1A1A2E] mb-8">✏️ Modifier l'article</h1>

<form method="POST" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="flex gap-8">
        <div class="flex-1 space-y-6">
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Titre *</label>
                    <input type="text" name="title" value="{{ old('title', $post->title) }}"
                        class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-[#4A4A8A] @error('title') border-red-400 @enderror">
                    @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Catégorie *</label>
                    <select name="category_id" class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-[#4A4A8A]">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Contenu *</label>
                    <textarea name="body" rows="12"
                        class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-[#4A4A8A]">{{ old('body', $post->body) }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Image de couverture</label>
                    @if($post->image)
                        <img src="{{ Storage::url($post->image) }}" class="w-full h-32 object-cover rounded-lg mb-2">
                    @endif
                    <input type="file" name="image" accept="image/*"
                        class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm">
                </div>
            </div>
        </div>

        <div class="w-72 shrink-0 space-y-4">
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                <h3 class="font-semibold text-sm mb-4">Publication</h3>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date de publication</label>
                    <input type="datetime-local" name="published_at"
                        value="{{ old('published_at', $post->published_at?->format('Y-m-d\TH:i')) }}"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-[#4A4A8A]">
                </div>
                <button type="submit" class="w-full bg-[#4A4A8A] text-white py-2 rounded-lg text-sm hover:bg-[#6C63FF] transition">
                    Enregistrer
                </button>
                <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" onsubmit="return confirm('Supprimer ?')" class="mt-2">
                    @csrf
                    @method('DELETE')
                    <button class="w-full bg-red-50 text-red-600 py-2 rounded-lg text-sm hover:bg-red-100 transition">
                        Supprimer l'article
                    </button>
                </form>
            </div>
        </div>
    </div>
</form>
@endsection