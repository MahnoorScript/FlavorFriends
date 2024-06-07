<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Comment;


class EditPostController extends Controller
{
    public function index(Post $post)
    {
        $userId = Auth::id();
        $posts = Post::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
        return view('edit-post', compact('posts'));
    }

    public function edit($postId)
    {
        $post = Post::find($postId); // Fetch the post by ID
        // You might want to add additional logic here, such as authorization checks
        return view('posts-edit', compact('post'));
    }

    public function update(Request $request, $postId)
    {
        $post = Post::find($postId);

        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            // Add validation rules for other fields as needed
        ]);

        // Update the post with validated data
        $post->title = $validatedData['title'];
        $post->description = $validatedData['description'];
        // Update other fields similarly

        // Handle image update if required
        if ($request->hasFile('image')) {
            // Handle image upload and update logic here
            // For example:
            $imagePath = $request->file('image')->store('public/images');
            $post->image = str_replace('public/', '', $imagePath);
        }

        $post->save();

        session()->flash('success', 'Post updated successfully');

        return redirect()->route('edit-post', ['postId' => $postId])->with('success', 'Post updated successfully');
    }


    public function deletePost($postId)
    {
        $post = Post::findOrFail($postId);

        // Check if the authenticated user owns the post
        if (auth()->user()->id == $post->user_id) {

            $post->comments()->delete();
            // Delete the post
            $post->delete();

            return redirect()->route('edit-post')->with('success', 'Post deleted successfully.');
        } else {
            // Unauthorized access
            return redirect()->route('edit-post')->with('error', 'Unauthorized access.');
        }
    }
}
