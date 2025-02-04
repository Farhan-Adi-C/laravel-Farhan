@extends('layouts.app')

@section('title', 'write Blog')

@section('content')
    @if (session('success'))
        <script>
            alert('{{ session('success') }}')
        </script>
    @endif

    <h1 class="text-3xl font-bold text-center mb-6">Write Blog</h1>

    <form action="{{ route('blog.post') }}" enctype="multipart/form-data" method="POST"
        class="max-w-lg mx-auto p-6 border border-gray-300 rounded-lg shadow-lg">
        @csrf


        <input type="hidden" value="{{ Auth::user()->id }}" id="user_id" name="user_id" required
            class="w-full px-4 py-2 border border-gray-300 rounded-lg">
        <input type="hidden" value="{{ Auth::user()->name }}" id="user_id" name="name" required
            class="w-full px-4 py-2 border border-gray-300 rounded-lg">

        <div class="mb-4">
            <label for="title" class="block text-lg font-medium mb-2">Title Blog</label>
            <input type="text" id="title" name="title" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg">
        </div>

        <label for="summernote" class="block text-lg font-medium mb-2">Content: </label>
        <textarea id="summernote" name="content"></textarea>

        <div class="mb-4 mt-4">
            <label for="featured_image" class="block text-lg font-medium mb-2">Upload Thumbnail Image</label>
            <input type="file" id="featured_image" name="featured_image"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg">
        </div>

        <div class="mb-4" id="image-slebew">
            <label for="image" class="block text-lg font-medium mb-2">Upload Additional Images</label>
            <div class="flex items-center gap-2" id="input-container">
                <input type="file" name="image[]" class="w-full px-1 py-2 border border-gray-300 rounded-lg">
            </div>
        </div>
        <button type="button" id="add-image" class="btn btn-secondary btn-sm">Add More</button>
        
        <div class="mb-4 text-center">
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg">Submit</button>
        </div>

        @if ($errors->any())
            <ul class="px-4 py-2 bg-red-200">
                @foreach ($errors->all() as $error)
                    <li class="my-2 text-red-400">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </form>

    <script>
    document.getElementById('add-image').addEventListener('click', function() {
    // Membuat elemen container baru untuk input file dan tombol hapus
    var newInputContainer = document.createElement('div');
    newInputContainer.classList.add('flex', 'w-full', 'items-center', 'gap-2', 'mb-2');

    // Membuat elemen input file untuk gambar
    var newInput = document.createElement('input');
    newInput.type = 'file';
    newInput.name = 'image[]';
    newInput.classList.add('w-full', 'px-4', 'py-2', 'border', 'border-gray-300', 'rounded-lg');

    // Membuat tombol hapus (X)
    var deleteBtn = document.createElement('span');
    deleteBtn.textContent = 'x';
    deleteBtn.classList.add('px-3', 'py-1', 'bg-red-500', 'text-white', 'text-lg', 'cursor-pointer');
    
    // Menambahkan event listener untuk tombol hapus
    deleteBtn.addEventListener('click', function() {
        newInputContainer.remove();
    });

    // Menambahkan input dan tombol hapus ke dalam container baru
    newInputContainer.appendChild(newInput);
    newInputContainer.appendChild(deleteBtn);

    // Menambahkan container baru ke dalam div image-slebew, bukan input-container
    document.getElementById('image-slebew').appendChild(newInputContainer);
});
    </script>

    <script>
        $('#summernote').summernote({
            placeholder: 'Hello stand alone ui',
            tabsize: 2,
            height: 320,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    </script>

@endsection
