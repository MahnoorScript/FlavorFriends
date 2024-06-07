<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

class FollowersController extends Controller
{
    public function index()
    {
        // Add your logic here
        $followers = auth()->user()->followers()->get();

        return view('followers', ['followers' => $followers]);
    }

    public function removeFollower($followerId)
    {
        $follower = User::findOrFail($followerId);

        // Remove the follower
        auth()->user()->followers()->detach($follower);

        return back()->with('success', 'Follower removed successfully.');
    }
}
