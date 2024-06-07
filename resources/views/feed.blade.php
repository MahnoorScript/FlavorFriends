<x-app-layout>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-1QYB01VKRC"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-1QYB01VKRC');
    </script>

    <link href="{{ asset('css/feed.css') }}" rel="stylesheet">

    <div class="dashboard-container" style="background-color: #1f2937; padding: 12px;">
        <div class="dashboard-content" style="max-width: 1140px; margin: auto; padding: 0 15px;">
            <h1 class="dashboard-title" style="font-size: 2.5rem; font-weight: 600; color: #d1d5db; margin-bottom: 16px;">{{ __('Feed') }}</h1>

            @if(isset($posts) && count($posts) > 0)
            <div class="posts-grid">
                @foreach ($posts as $post)
                <div class="feed-post-item">
                    <h2 class="post-title">{{ $post->title }}</h2>
                    <img class="feed-post-image" src="{{ asset('storage/' . $post->image) }}" alt="Post Image">
                    <p class="post-description">{{ $post->description }}</p>
                    <p class="post-author">Posted by: {{ $post->user->name }}</p>
                    <a class="post-read-more" href="{{ route('show-post', ['postId' => $post->id]) }}" style="color: #8bb7ff; display: block; margin-top: 10px; text-decoration: none;">Read more</a>
                </div>
                @endforeach
            </div>
            @elseif(isset($post))
            <!-- Display a specific post -->
            <div class="single-post-item">
                <h2 class="post-title">{{ $post->title }}</h2>
                <div class="post-container">
                <img class="single-post-image" src="{{ asset('storage/' . $post->image) }}" alt="Post Image">
                </div>
                <p class="post-description">{{ $post->description }}</p>
                <p class="post-author">Made by: {{ $post->user->name }}</p>
                <p class="post-author">Contact: {{ $post->user->phone_number }}</p>
                <form action="{{ route('add-following', ['userId' => $post->user->id]) }}" method="post">
                    @csrf
                    <br>
                    <button type="submit" class="follow-button">Follow</button>

                </form>
                @if(session('success'))
                <div id="successMessage" class="success-message" style="color: green;">{{ session('success') }}</div> <!-- add css styling (pending) -->
                @endif
                <style>
                    /* Styles for the success message */
                    .success-message {
                        background-color: #d1e7dd;
                        /* Background color */
                        padding: 10px 15px;
                        /* Padding around the message */
                        margin: 10px 0;
                        /* Margin for spacing */
                        border-radius: 5px;
                        /* Rounded corners */
                        box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
                        /* Shadow effect */
                        font-weight: bold;
                        /* Bold text */
                        text-align: center;
                        /* Center-align text */
                    }
                </style>

                <div class="comment-section">
                    <br>
                    <h1>Comments</h1>
                    <!-- Display Comments for the Current Post -->
                    @isset($comments)
                    @if($comments->count() > 0)
                    <ul class="comments-show">
                        @foreach($comments as $comment)
                        <li class="comment-item">{{ $comment->comment_text }} - {{ $comment->user->name }}</li>
                        @endforeach
                    </ul>
                    @else
                    <p>No comments yet.</p>
                    @endif
                    @else
                    <p>No comments yet.</p>
                    @endisset

                    <form method="post" action="{{ route('comments-store', ['postId' => $post->id]) }}">
                        @csrf
                        <textarea name="comment_text" placeholder="Add your comment" style="color: black;" class="comment-textarea"></textarea>
                        <button type="submit" class="comment-submit-button">Done</button>
                    </form>
                </div>



                <style>
                    .comment-section {
                        margin: 10px;
                        padding: 10px;
                        border: 1px solid #1f2937;
                        background-color: #1f2937;
                        color: #ffffff;
                    }

                    .comments-show {
                        list-style: none;
                        padding: 0;
                        display: flex;
                        flex-wrap: wrap;
                    }

                    .comment-item {
                        width: calc(100% - 20px);
                        /* Set the width to full width */
                        background-color: #171B24;
                        /* Background color for the posted comments */
                        padding: 15px;
                        margin: 10px 0;
                        /* Adjust top and bottom margin */
                        border-radius: 8px;
                        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
                        /* Add a shadow for depth */
                        color: #ffffff;
                        /* Text color for the posted comments */
                        box-sizing: border-box;
                    }

                    .comment-item:last-child {
                        border-bottom: none;
                    }

                    .comment-item::before {
                        content: '\2014';
                        /* Add a dash before each comment */
                        margin-right: 5px;
                    }

                    .comment-item span {
                        font-weight: bold;
                    }

                    .comment-item p {
                        margin: 8px 0;
                        line-height: 1.4;
                    }

                    .comment-textarea {
                        width: 100%;
                        padding: 8px;
                        margin-top: 10px;
                        border: 1px solid #ccc;
                        resize: vertical;
                        color: black;
                        /* Retain the text color */
                    }

                    .comment-submit-button {
                        padding: 8px 16px;
                        margin-top: 10px;
                        background-color: #ffffff;
                        color: #1f2937;
                        border: 1px solid #ffffff;
                        cursor: pointer;
                    }

                    .comment-submit-button:hover {
                        background-color: #1f2937;
                        color: #ffffff;
                    }
                </style>
            </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var successMessage = document.getElementById('successMessage');
            if (successMessage) {
                setTimeout(function() {
                    successMessage.style.display = 'none';
                }, 2000); // Hide success message after 2 seconds
            }
        });
    </script>

</x-app-layout>