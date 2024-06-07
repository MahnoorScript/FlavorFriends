<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller {

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'comment_text' => 'required',
        ]);

        $userId = Auth::id();
        $postId = $request->route('postId');

        // Create a new comment
        $comment = Comment::create([
            'comment_text' => $request->input('comment_text'),
            'user_id' => $userId,
            'post_id' => $postId,
        ]);

        return redirect()->back()->with('success', 'Comment created successfully!');
    }
}