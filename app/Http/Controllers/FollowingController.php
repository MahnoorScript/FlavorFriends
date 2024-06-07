<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

class FollowingController extends Controller
{
    public function index()
    {

        $followings = auth()->user()->followings()->get();

        return view('followings', ['followings' => $followings]);
    }

    public function addFollowing($userId)
    {
        $userToFollow = User::findOrFail($userId);

        // Check if the user is not already being followed
        if (!auth()->user()->followings->contains($userToFollow)) {
            // Add the user to the list of followings
            auth()->user()->followings()->attach($userToFollow);

            $userToFollow->followers()->attach(auth()->user());

            session()->flash('success', 'Now following ' . $userToFollow->name);

            return back()->with('success', 'Now following ' . $userToFollow->name . '.');
        }

        return back()->with('info', 'You are already following ' . $userToFollow->name . '.');
    }

    public function removeFollowing($followingId)
    {
        $following = User::findOrFail($followingId);

        // Remove the following
        auth()->user()->followings()->detach($following);

        return back()->with('success', 'Following removed successfully.');
    }
}
