<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Events\NewPostEvent;
use Illuminate\Support\Facades\Broadcast;

class CreatePostController extends Controller
{
    public function index()
    {

        return view('create-post');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle image upload (if applicable)
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('post_images', 'public');
        }

        // Create a new post
        $post = new Post([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'image' => $imagePath,
            'user_id' => auth()->user()->id,
        ]);

        $post->save();


        return redirect()->route('dashboard')->with('success', 'Post created successfully!');
    }
}
