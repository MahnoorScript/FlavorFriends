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

    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

    <div class="dashboard-container" style="background-color: #1f2937; padding: 12px;">
        <div class="dashboard-content" style="max-width: 1140px; margin: auto; padding: 0 15px;">
            <h1 class="dashboard-title" style="font-size: 2.5rem; font-weight: 600; color: #d1d5db; margin-bottom: 16px;">{{ __('Your Recent Posts') }}</h1>

            @if(isset($posts) && count($posts) > 0)
            <div class="posts-grid">
                @foreach ($posts as $post)
                <div class="post-item">
                    <h2 class="post-title">{{ $post->title }}</h2>
                    <img class="post-image" src="{{ asset('storage/' . $post->image) }}" alt="Post Image">
                    <p class="post-description" style="color: #d1d5db; margin-top: 10px;">{{ $post->description }}</p>
                    <p class="post-author" style="color: #9ca3af; margin-top: 5px; font-size: 0.875rem;">Posted by: {{ $post->user->name }}</p>
                    <a class="post-read-more" href="{{ route('show-post', ['postId' => $post->id]) }}" style="color: #8bb7ff; display: block; margin-top: 10px; text-decoration: none;">Read more</a>
                </div>
                @endforeach
            </div>
            @elseif(isset($post))
            <!-- Display a specific post -->
            <div class="post-item" style="margin-top: 10px;"> <!-- Use the same class as in the grid -->
                <h2 class="post-title">{{ $post->title }}</h2>
                <img class="post-image" src="{{ asset('storage/' . $post->image) }}" alt="Post Image">
                <p class="post-description">{{ $post->description }}</p>
                <p class="post-author">Made by: {{ $post->user->name }}</p>
                <p class="post-author">Contact: {{ $post->user->phone_number }}</p> <!-- Use the same class for consistency -->
                <form action="{{ route('add-following', ['userId' => $post->user->id]) }}" method="post">

                </form>
                @if(session('success'))
                <div id="successMessage" class="success-message" style="color: green;">{{ session('success') }}</div> <!-- Add a class for styling -->
                @endif
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