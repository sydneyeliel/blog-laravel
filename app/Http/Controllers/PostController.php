<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with(['user', 'category', 'comments'])
            ->whereNotNull('published_at')
            ->latest('published_at');

        // Recherche par mot-clé
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('body', 'like', '%' . $request->search . '%');
            });
        }

        // Filtrage par catégorie
        if ($request->filled('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $posts = $query->paginate(8);
        $categories = Category::withCount('posts')->get();

        return view('posts.index', compact('posts', 'categories'));
    }

    public function show($slug)
    {
        $post = Post::with(['user', 'category', 'comments.user'])
            ->where('slug', $slug)
            ->whereNotNull('published_at')
            ->firstOrFail();

        $relatedPosts = Post::with(['user', 'category'])
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->whereNotNull('published_at')
            ->latest()
            ->take(3)
            ->get();

        return view('posts.show', compact('post', 'relatedPosts'));
    }
}