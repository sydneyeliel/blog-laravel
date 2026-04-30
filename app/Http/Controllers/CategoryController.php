<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = $category->posts()
            ->with(['user', 'category', 'comments'])
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->paginate(8);
        $categories = Category::withCount('posts')->get();

        return view('posts.index', compact('posts', 'categories', 'category'));
    }
}