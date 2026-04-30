@extends('layouts.admin')

@section('title', 'Commentaires')

@section('content')
<h1 class="text-2xl font-bold text-[#1A1A2E] mb-8">💬 Modération des commentaires</h1>

<!-- Stats -->
<div class="grid grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <p class="text-sm text-gray-500">Total</p>
        <p class="text-3xl font-bold text-[#4A4A8A] mt-1">{{ $stats['total'] }}</p>
    </div>
    <div class="bg-white rounded-xl p-6 shadow-sm border border-amber-200">
        <p class="text-sm text-amber-600">En attente</p>
        <p class="text-3xl font-bold text-amber-500 mt-1">{{ $stats['pending'] }}</p>
    </div>
    <div class="bg-white rounded-xl p-6 shadow-sm border border-green-200">
        <p class="text-sm text-green-600">Approuvés</p>
        <p class="text-3xl font-bold text-green-500 mt-1">{{ $stats['approved'] }}</p>
    </div>
</div>

<!-- Table -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 text-xs text-gray-500 uppercase">
            <tr>
                <th class="px-6 py-3 text-left">Article</th>
                <th class="px-6 py-3 text-left">Auteur</th>
                <th class="px-6 py-3 text-left">Commentaire</th>
                <th class="px-6 py-3 text-left">Date</th>
                <th class="px-6 py-3 text-left">Statut</th>
                <th class="px-6 py-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($comments as $comment)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-sm font-medium text-[#4A4A8A]">
                    {{ Str::limit($comment->post->title, 30) }}
                </td>
                <td class="px-6 py-4 text-sm text-gray-600">{{ $comment->user->name }}</td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ Str::limit($comment->body, 50) }}</td>
                <td class="px-6 py-4 text-sm text-gray-400">{{ $comment->created_at->format('d/m/Y') }}</td>
                <td class="px-6 py-4">
                    @if($comment->status === 'approved')
                        <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">Approuvé</span>
                    @else
                        <span class="text-xs bg-amber-100 text-amber-700 px-2 py-1 rounded-full">En attente</span>
                    @endif
                </td>
                <td class="px-6 py-4 flex gap-2">
                    @if($comment->status === 'pending')
                    <form method="POST" action="{{ route('admin.comments.approve', $comment) }}">
                        @csrf
                        @method('PATCH')
                        <button class="text-xs bg-green-100 text-green-700 px-3 py-1 rounded-lg hover:bg-green-200">Approuver</button>
                    </form>
                    @endif
                    <form method="POST" action="{{ route('admin.comments.destroy', $comment) }}" onsubmit="return confirm('Supprimer ?')">
                        @csrf
                        @method('DELETE')
                        <button class="text-xs bg-red-100 text-red-700 px-3 py-1 rounded-lg hover:bg-red-200">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-8 text-center text-gray-400 text-sm">Aucun commentaire.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-6 py-4 border-t border-gray-100">
        {{ $comments->links() }}
    </div>
</div>
@endsection