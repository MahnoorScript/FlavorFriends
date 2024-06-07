<!-- resources/views/following.blade.php -->

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
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Following') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">

                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-3xl font-semibold mb-8">Following: {{ $followings->count() }}</h1>
                </div>

                @if ($followings->isNotEmpty())
                @foreach ($followings as $following)
                <div class="flex items-center justify-between mb-4 border-b border-gray-300 dark:border-gray-700 pb-2">
                    <p class="text-lg">{{ $following->name }}</p>
                    <form action="{{ route('remove-following', ['followingId' => $following->id]) }}" method="post" onsubmit="return confirm('Are you sure you want to unfollow this user?')">
                        @csrf
                        <button type="submit" style="color: red;">Unfollow</button>
                    </form>
                </div>
                @endforeach
                @else
                <p>Not following anyone.</p>
                @endif

                @if(session('success'))
                <div id="success-message" class="success-message" style="color: green; text-align: center;">
                    {{ session('success') }}
                </div>
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

                <script>
                    setTimeout(function() {
                        document.getElementById('success-message').style.display = 'none';
                    }, 2000);
                </script>
                @endif

            </div>
        </div>
    </div>

</x-app-layout>