@extends('layouts.admin')

@section('title', 'Catégories')

@section('content')
<h1 class="text-2xl font-bold text-[#1A1A2E] mb-8">🏷️ Catégories</h1>

<div class="flex gap-8">
    <!-- Liste des catégories -->
    <div class="flex-1">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50 text-xs text-gray-500 uppercase">
                    <tr>
                        <th class="px-6 py-3 text-left">Nom</th>
                        <th class="px-6 py-3 text-left">Slug</th>
                        <th class="px-6 py-3 text-left">Articles</th>
                        <th class="px-6 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($categories as $category)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm font-medium">{{ $category->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-400">{{ $category->slug }}</td>
                        <td class="px-6 py-4">
                            <span class="text-xs bg-indigo-50 text-[#6C63FF] px-2 py-1 rounded-full">{{ $category->posts_count }}</span>
                        </td>
                        <td class="px-6 py-4 flex gap-2">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="text-xs bg-amber-100 text-amber-700 px-3 py-1 rounded-lg hover:bg-amber-200">Modifier</a>
                            <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" onsubmit="return confirm('Supprimer ?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-xs bg-red-100 text-red-700 px-3 py-1 rounded-lg hover:bg-red-200">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-gray-400 text-sm">Aucune catégorie.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Formulaire ajout -->
    <div class="w-72 shrink-0">
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <h3 class="font-semibold text-sm mb-4">Nouvelle catégorie</h3>
            <form method="POST" action="{{ route('admin.categories.store') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nom *</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        placeholder="Ex: Technologie"
                        class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-[#4A4A8A] @error('name') border-red-400 @enderror">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <button type="submit" class="w-full bg-[#4A4A8A] text-white py-2 rounded-lg text-sm hover:bg-[#6C63FF] transition">
                    Créer
                </button>
            </form>
        </div>
    </div>
</div>
@endsection