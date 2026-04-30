<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;

class AdminCommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with(['user', 'post'])
            ->latest()
            ->paginate(15);

        $stats = [
            'pending'  => Comment::where('status', 'pending')->count(),
            'approved' => Comment::where('status', 'approved')->count(),
            'total'    => Comment::count(),
        ];

        return view('admin.comments.index', compact('comments', 'stats'));
    }

    public function approve(Comment $comment)
    {
        $comment->update(['status' => 'approved']);
        return back()->with('success', 'Commentaire approuvé.');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('success', 'Commentaire supprimé.');
    }
}

