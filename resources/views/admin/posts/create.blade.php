@extends('layouts.admin')

@section('title', 'Nouvel article')

@section('content')
<h1 class="text-2xl font-bold text-[#1A1A2E] mb-8">📝 Nouvel article</h1>

<form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="flex gap-8">
        <!-- Formulaire principal -->
        <div class="flex-1 space-y-6">
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Titre *</label>
                    <input type="text" name="title" value="{{ old('title') }}"
                        class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-[#4A4A8A] @error('title') border-red-400 @enderror">
                    @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Catégorie *</label>
                    <select name="category_id" class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-[#4A4A8A] @error('category_id') border-red-400 @enderror">
                        <option value="">Choisir une catégorie</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Contenu *</label>
                    <textarea name="body" rows="12"
                        class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-[#4A4A8A] @error('body') border-red-400 @enderror">{{ old('body') }}</textarea>
                    @error('body') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Image de couverture</label>
                    <input type="file" name="image" accept="image/*"
                        class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm">
                    @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <!-- Sidebar droite -->
        <div class="w-72 shrink-0 space-y-4">
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                <h3 class="font-semibold text-sm mb-4">Publication</h3>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date de publication</label>
                    <input type="datetime-local" name="published_at" value="{{ old('published_at') }}"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-[#4A4A8A]">
                    <p class="text-xs text-gray-400 mt-1">Laisser vide = brouillon</p>
                </div>
                <button type="submit" class="w-full bg-[#4A4A8A] text-white py-2 rounded-lg text-sm hover:bg-[#6C63FF] transition">
                    Publier l'article
                </button>
                <a href="{{ route('admin.posts.index') }}" class="block text-center mt-2 text-sm text-gray-400 hover:text-gray-600">
                    Annuler
                </a>
            </div>
        </div>
    </div>
</form>
@endsection