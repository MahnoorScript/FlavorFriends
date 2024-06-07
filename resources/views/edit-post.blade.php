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
    <link href="{{ asset('css/editpost.css') }}" rel="stylesheet">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Posts') }}
        </h2>
    </x-slot>ƒ

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <div id="successMessage" class="success-message" style="color: green; text-align: center;">
                {{ session('success') }}
            </div>
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

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">


                <ul>
                    @if(isset($posts))
                    <!-- Display all posts -->
                    <div class="posts-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px;">
                        @foreach ($posts as $post)
                        <div class="post-item" style="margin-top: 10px;">
                            <h2 class="post-title" style="font-size: 1.5rem; font-weight: 500; margin-bottom: 8px;">{{ $post->title }}</h2>
                            <img class="post-image" src="{{ asset('storage/' . $post->image) }}" alt="Post Image" style="width: 100%; height: 150px; object-fit: cover; border-radius: 5px; margin-bottom: 10px;">
                            <p class="post-description" style="color: #d1d5db; margin-top: 10px;">{{ $post->description }}</p>
                            <p class="post-author" style="color: #9ca3af; margin-top: 5px; font-size: 0.875rem;">Posted by: {{ $post->user->name }}</p>
                            <div class="flex">
                                <a href="{{ route('posts-edit', ['postId' => $post->id]) }}" class="button-shared edit-button">Edit</a>
                                <form action="{{ route('posts-delete', ['postId' => $post->id]) }}" method="post" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button-shared delete-button">Delete</button>
                                </form>
                            </div>
                        </div>

                        @endforeach
                    </div>
                    @else
                    <p>No posts available.</p>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var successMessage = document.getElementById('successMessage');

            if (successMessage) {
                setTimeout(function() {
                    successMessage.style.display = 'none';
                }, 2000); // 2000 milliseconds (2 seconds)
            }
        });
    </script>

</x-app-layout>