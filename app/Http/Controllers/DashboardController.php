<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();       
        $userId = Auth::id();
        $posts = Post::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
        
        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

}
