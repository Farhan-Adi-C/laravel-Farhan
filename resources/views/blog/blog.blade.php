
@extends('layouts.app') 

@section('title', 'Blog') 

@section('content')

@if (session('success'))
        <script>
            alert('{{ session('success') }}')
        </script>
    @endif

<div class="flex justify-start mx-auto flex-wrap">
    @foreach ($data as $item)
        
    <div class="card shadow-md p-3 mb-6" style="width: 18rem;">
        <img src="{{ asset('storage/' . $item->featured_image)  }}" class="card-img-top mb-2" alt="..." style="object-fit: cover; width: 100%; height: 200px;">
        <div class="card-body ">
        <a href="{{ route('blog.show', ['slug' => $item->slug]) }}" class="hover:underline ">
            <h5 class=" font-semibold text-xl mb-2">{{ $item->title }}</h5>
        </a>
        <p class="card-text mb-3"><?= Str::limit(strip_tags($item->content), 30) ?></p>
        
        <!-- Gambar User, Nama, dan Tanggal -->
        <div class="flex justify-between items-center">
            <!-- Gambar User -->
            
            <!-- Nama User dan Tanggal -->
            <div class="ms-3 flex items-center gap-2">
                <iconify-icon class="text-slate-900 dark:text-slate-200" icon="emojione-monotone:writing-hand"></iconify-icon>
            <p class="mb-0 dark:text-slate-400"><strong>{{ $item->user->name }}</strong></p>
            </div>
            <span>|</span>
            <small class="text-muted dark:text-slate-400">{{ $item->created_at->format('d F Y') }}</small>
        </div>
        </div>
    </div>
    @endforeach
   
    
    

</div>


<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height:300,
        });
    });
  </script>
@endsection