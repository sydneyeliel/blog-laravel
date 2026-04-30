<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminPostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'category', 'comments'])
            ->latest()
            ->paginate(10);

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'body'        => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'image'       => ['nullable', 'image', 'max:2048'],
            'published_at'=> ['nullable', 'date'],
        ]);

        $data = $request->only('title', 'body', 'category_id', 'published_at');
        $data['slug']    = Str::slug($request->title);
        $data['user_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        Post::create($data);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Article créé avec succès.');
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'body'        => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'image'       => ['nullable', 'image', 'max:2048'],
            'published_at'=> ['nullable', 'date'],
        ]);

        $data = $request->only('title', 'body', 'category_id', 'published_at');
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($data);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Article modifié avec succès.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')
            ->with('success', 'Article supprimé.');
    }
}