@extends('layouts.admin')

@section('title', 'Modifier la catégorie')

@section('content')
<h1 class="text-2xl font-bold text-[#1A1A2E] mb-8">✏️ Modifier la catégorie</h1>

<div class="max-w-md">
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <form method="POST" action="{{ route('admin.categories.update', $category) }}">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nom *</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}"
                    class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-[#4A4A8A] @error('name') border-red-400 @enderror">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="flex gap-3">
                <button type="submit" class="flex-1 bg-[#4A4A8A] text-white py-2 rounded-lg text-sm hover:bg-[#6C63FF] transition">
                    Enregistrer
                </button>
                <a href="{{ route('admin.categories.index') }}" class="flex-1 text-center bg-gray-100 text-gray-600 py-2 rounded-lg text-sm hover:bg-gray-200">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection