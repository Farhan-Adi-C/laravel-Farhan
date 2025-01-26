
@extends('layouts.app') 

@section('title', 'Data Siswa SMKN 1 Tengaran') 

@section('content')
@if (session('success'))
        <script>
            alert('{{ session('success') }}')
        </script>
    @endif

    @foreach ($data as $item)
        <div class="max-w-lg mx-auto bg-white rounded-lg shadow-lg p-6 dark:bg-slate-800">
            <h2 class="text-2xl font-bold text-center mb-4">Detail Hobby Siswa</h2>

            <div class="mb-6">
                <p class="text-xl font-semibold dark:text-slate-200">Nama: <span class="font-normal dark:text-slate-400">{{ $item->nama }}</span></p>
            </div>
           @endforeach
            
            <div class="mb-6">
                @foreach ($data as $item)
                <p class="text-lg font-semibold dark:text-slate-200 mb-2">Hobby:</p>
                <ul class="space-y-4">
                    @foreach ($item->hobby as $h)
                        <li class="flex justify-between items-center ml-3">
                            <span class="text-md mb-1 font-medium dark:text-slate-400">- {{ $h->hobby }}</span>
                            <div class="flex space-x-2">
                                
                               
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

            @endforeach

           <div class="flex mx-auto justify-center gap-4">
            
        <div class=" ">
            @foreach ($data as $item)
                
            <a href="{{ route('hobbysiswa.edit', ['id' =>$item->id]) }}" class="btn inline-flex justify-center mx-2 mt-3 btn-primary ">Tambah Hobby</a>
            @endforeach
            
        </div>
                

       
    </div>
@endsection