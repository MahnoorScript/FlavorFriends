<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FollowersController;
use App\Http\Controllers\FollowingController;
use App\Http\Controllers\CreatePostController;
use App\Http\Controllers\EditPostController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [FeedController::class, 'index'])->name('feed');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::middleware(['auth'])->group(function () {
    Route::get('/create-post', [CreatePostController::class, 'index'])->name('create-post');
    Route::post('/create-post', [CreatePostController::class, 'store'])->name('store-post');
    Route::get('/edit-post', [EditPostController::class, 'index'])->name('edit-post');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/followers', [FollowersController::class, 'index'])->name('followers');
    Route::get('/followings', [FollowingController::class, 'index'])->name('followings');
    Route::post('/add-following/{userId}', [FollowingController::class, 'addFollowing'])->name('add-following');

    Route::get('/feed', [FeedController::class, 'index'])->name('feed');
    Route::get('/feed/{postId}', [FeedController::class, 'show'])->name('show-post');

    Route::post('/remove-follower/{followerId}', [FollowersController::class, 'removeFollower'])->name('remove-follower');
    Route::post('/remove-following/{followingId}', [FollowingController::class, 'removeFollowing'])->name('remove-following');



    Route::get('/posts/{postId}', [EditPostController::class, 'edit'])->name('posts-edit');
    Route::put('/posts/{postId}', [EditPostController::class, 'update'])->name('update-post');
    Route::delete('/posts/delete/{postId}', [EditPostController::class, 'deletePost'])->name('posts-delete');


    //Route::get('/feed/{postId}', [CommentController::class, 'show'])->name('comments-show');
    Route::post('/feed/post/{postId}/comments', [CommentController::class, 'store'])->name('comments-store');
});



require __DIR__.'/auth.php';
