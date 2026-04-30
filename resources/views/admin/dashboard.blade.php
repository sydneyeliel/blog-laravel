@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<h1 class="text-2xl font-bold text-[#1A1A2E] mb-8">📊 Tableau de bord</h1>

<!-- Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <p class="text-sm text-gray-500">Total articles</p>
        <p class="text-3xl font-bold text-[#4A4A8A] mt-1">{{ $stats['total_posts'] }}</p>
    </div>
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <p class="text-sm text-gray-500">Catégories</p>
        <p class="text-3xl font-bold text-[#4A4A8A] mt-1">{{ $stats['total_categories'] }}</p>
    </div>
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <p class="text-sm text-gray-500">Total commentaires</p>
        <p class="text-3xl font-bold text-[#4A4A8A] mt-1">{{ $stats['total_comments'] }}</p>
    </div>
    <div class="bg-white rounded-xl p-6 shadow-sm border border-amber-200">
        <p class="text-sm text-amber-600">En attente</p>
        <p class="text-3xl font-bold text-amber-500 mt-1">{{ $stats['pending_comments'] }}</p>
    </div>
</div>

<!-- Articles récents -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
        <h2 class="font-semibold text-[#1A1A2E]">Articles récents</h2>
        <a href="{{ route('admin.posts.create') }}" class="text-sm bg-[#4A4A8A] text-white px-4 py-2 rounded-lg hover:bg-[#6C63FF] transition">
            + Nouvel article
        </a>
    </div>
    <table class="w-full">
        <thead class="bg-gray-50 text-xs text-gray-500 uppercase">
            <tr>
                <th class="px-6 py-3 text-left">Titre</th>
                <th class="px-6 py-3 text-left">Catégorie</th>
                <th class="px-6 py-3 text-left">Statut</th>
                <th class="px-6 py-3 text-left">Commentaires</th>
                <th class="px-6 py-3 text-left">Date</th>
                <th class="px-6 py-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($recentPosts as $post)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-sm font-medium text-[#1A1A2E]">{{ Str::limit($post->title, 40) }}</td>
                <td class="px-6 py-4">
                    <span class="text-xs bg-indigo-50 text-[#6C63FF] px-2 py-1 rounded-full">{{ $post->category->name }}</span>
                </td>
                <td class="px-6 py-4">
                    @if($post->published_at)
                        <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">Publié</span>
                    @else
                        <span class="text-xs bg-gray-100 text-gray-500 px-2 py-1 rounded-full">Brouillon</span>
                    @endif
                </td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $post->comments->count() }}</td>
                <td class="px-6 py-4 text-sm text-gray-400">{{ $post->created_at->format('d/m/Y') }}</td>
                <td class="px-6 py-4 flex gap-2">
                    <a href="{{ route('admin.posts.edit', $post) }}" class="text-xs bg-amber-100 text-amber-700 px-3 py-1 rounded-lg hover:bg-amber-200">Modifier</a>
                    <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" onsubmit="return confirm('Supprimer ?')">
                        @csrf
                        @method('DELETE')
                        <button class="text-xs bg-red-100 text-red-700 px-3 py-1 rounded-lg hover:bg-red-200">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-8 text-center text-gray-400 text-sm">Aucun article pour le moment.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection