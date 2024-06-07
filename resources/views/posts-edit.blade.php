<!-- posts-edit.blade.php -->

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
            {{ __('Edit Your Post') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">



                <form method="POST" action="{{ route('update-post', ['postId' => $post->id]) }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <!-- Title Field -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-white-700">Title:</label>
                        <input type="text" id="title" name="title" style="color: black;" value="{{ $post->title }}" required class="mt-1 p-2 block w-full border rounded-md">
                    </div>

                    <!-- Description Field -->
                    <div>
                        <br>
                        <label for="description" class="block text-sm font-medium text-white-700">Description:</label>
                        <textarea id="description" name="description" style="color: black;" required class="mt-1 p-2 block w-full border rounded-md">{{ $post->description }}</textarea>
                    </div>
                    <br>
                    <!-- Update Button -->
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <!-- Cancel Button -->

                        <div class="cancel-button">
                            <a href="{{ route('edit-post') }}" class="btn btn-cancel">Cancel</a>
                        </div>

                        <style>
                            .cancel-button .btn-cancel {
                                background-color: #b91c1c;
                                color: white;
                                border: 1px solid transparent;
                                padding: 8px 16px;
                                text-decoration: none;
                                display: inline-block;
                            }

                            .cancel-button .btn-cancel:hover {
                                background-color: #701010;
                            }
                        </style>



                        <!-- Update Button -->
                        <button type="submit" style="background-color: #4299e1; color: #fff; padding: 8px 16px; border-radius: 4px; cursor: pointer; transition: background-color 0.3s ease-in-out;" onmouseover="this.style.backgroundColor='#3182ce'" onmouseout="this.style.backgroundColor='#4299e1'">
                            Update Post
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>