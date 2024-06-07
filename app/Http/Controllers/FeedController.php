<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class FeedController extends Controller
{

    public function index()
    {

        $posts = Post::orderBy('created_at', 'desc')->get();

        return view('feed',  ['posts' => $posts]);
    }


    public function show($postId)
    {
        $post = Post::with('user')->findOrFail($postId);

        // Fetch comments for the current post, ordered by created_at in descending order
        $comments = Comment::where('post_id', $postId)
            ->orderBy('created_at', 'desc')
            ->get();

        // Pass the post and comments data to the Blade view
        return view('feed', compact('post', 'comments'));
    }
}
