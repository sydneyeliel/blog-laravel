<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'body' => ['required', 'string', 'min:10', 'max:500'],
        ]);

        $post->comments()->create([
            'body'    => $request->body,
            'user_id' => auth()->id(),
            'status'  => 'pending',
        ]);

        return back()->with('success', 'Commentaire soumis, en attente de modération.');
    }

    public function destroy(Comment $comment)
    {
        if (auth()->id() !== $comment->user_id) {
            abort(403);
        }

        $comment->delete();

        return back()->with('success', 'Commentaire supprimé.');
    }
}