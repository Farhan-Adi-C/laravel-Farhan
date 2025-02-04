@extends('layouts.app') 

@section('title', 'show Blog') 

@section('content')
@if (session('success'))
        <script>
            alert('{{ session('success') }}')
        </script>
    @endif

<div class="container mt-5 dark:bg-slate-800 dark:text-white">
    <div class="row">
            
        <div class="col-12 mb-12 p-4">
            <p class="text-muted flex gap-3 mb-2 dark:text-slate-400"><span>Writer : {{ $data->writer }}</span>  <span class="">|</span> <span>{{ $data->created_at->format('d F Y') }}</span></p>

            <h1 class="display-4 mb-5 dark:text-white">{{ $data->title }}</h1>

            <div class="my-4 mb-8">
                <img src="{{ asset('storage/' . $data->featured_image) }}" class="img-fluid items-center mx-auto" alt="Gambar Blog" style="max-height: 300px; max-width: 300px; min-width: 200px; min-height: 200px;" >
            </div>

            <div class="mt-4 px-10 break-words">
                <p class="dark:text-slate-200"><?= $data->content ?></p>
            </div>
            
        </div>
{{-- {{ dd($data) }} --}}
        <!-- Carousel Gambar -->
        <div class="">
            <div class="flex flex-col p-6">
                <div class="card-text h-full">
                    <div class="space-y-5">
                        <div class="slider carousel-interval owl-carousel">
                            @foreach ($data->image as $i)
                            <img class="img-fluid" style="max-height: 450px; object-fit: cover;" src="{{ asset('storage/' . $i->image) }}" alt="image">
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
