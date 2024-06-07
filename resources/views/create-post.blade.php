<!-- resources/views/create-post.blade.php -->

<x-app-layout>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-1QYB01VKRC"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-1QYB01VKRC');
</script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create New Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">

                <form action="{{ route('store-post') }}" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                    @csrf
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-white-700">Title:</label>
                        <input type="text" name="title" id="title" class="mt-1 p-2 w-full border rounded-md" style="color: black;">
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-white-700">Description:</label>
                        <textarea name="description" id="description" class="mt-1 p-2 w-full border rounded-md" style="color: black;" required></textarea>
                    </div>

                    <div class="mb-4">
    <label for="image" class="block text-sm font-medium text-white-700">Image:</label>
    <div class="custom-file-upload">
        <input type="file" name="image" id="image" class="file-input" onchange="updateFileName(this)">
        <label for="image" class="file-label">Choose File</label>
    </div>
    <p id="file-name-display" class="text-white-700 mt-2"></p>
</div>

<script>
function updateFileName(input) {
    const fileName = input.files[0].name;
    const fileNameDisplay = document.getElementById('file-name-display');
    fileNameDisplay.textContent = 'Selected file: ' + fileName;
}

function validateForm() {
    const imageInput = document.getElementById('image');
    if (!imageInput.files.length) {
        // No image selected, handle this case
        // You can set a default image or display a message
        alert('Please select an image.');
        return false; 
    }
    const file = imageInput.files[0];
    const maxSize = 2048 * 1024; // 2MB in bytes
    if (file.size > maxSize) {
        // Image size exceeds 2MB, handle this case
        alert('Image size should not exceed 2MB.');
        return false; // Prevent form submission
    }

    return true; // Proceed with form submission
}
</script>

<style>
    .custom-file-upload {
    margin-top: 10px;
    position: relative;
    overflow: hidden;
    display: inline-block;
    width: 140px; /* Adjust width as needed */
    height: 40px; /* Adjust height as needed */
    background-color: #041232; /* Button background color */
    color: #ffffff; /* Button text color */
    border: none;
    border-radius: 5px;
    text-align: center;
    line-height: 40px; /* Center the text vertically */
    cursor: pointer;
    padding: 0 15px;
    margin-bottom: 5px; /* Adjust margin as needed */
}

.file-input {
    position: absolute;
    top: 0;
    left: 0;
    font-size: 100px;
    opacity: 0;
    cursor: pointer;
}

.file-label {
    z-index: 1;
    position: relative;
}

/* Hover effect */
.custom-file-upload:hover {
    background-color: #2980b9; /* Change button color on hover */
}
</style>


                    <button type="submit" class="create-post-button" style="color: white;">Create Post</button>
                    <style>
    
                     .create-post-button {
                      background-color: #041232; /* Background color */
                      color: #ffffff; /* Text color */
                      padding: 5px 10px; /* Padding around the button text */
                     border-radius: 5px; /* Rounded corners */
                     cursor: pointer; /* Show pointer cursor on hover */
                     font-weight: bold; /* Bold text */
                     transition: background-color 0.3s ease; /* Smooth transition on hover */
                     }

                    .create-post-button:hover {
                     background-color: #2980b9; /* Change background color on hover */
                   }
                </style>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
