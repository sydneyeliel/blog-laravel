<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_posts'       => Post::count(),
            'total_categories'  => Category::count(),
            'total_comments'    => Comment::count(),
            'pending_comments'  => Comment::where('status', 'pending')->count(),
        ];

        $recentPosts = Post::with(['user', 'category'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentPosts'));
    }
}