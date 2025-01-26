

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
            <div class="mx-auto w-full px-10">
            <h2 class="text-4xl font-bold text-center mb-8">Detail Siswa</h2>

            <div class="mb-6">
                <p class="text-2xl font-semibold dark:text-slate-200">Nama: <span class="font-normal dark:text-slate-400 ">{{ $item->nama }}</span></p>
            </div>
            <div class="mb-6">
                <p class="text-2xl font-semibold dark:text-slate-200">NISN: <span class="font-normal dark:text-slate-400">{{ $item->nisn->nisn }}</span></p>
            </div>
            @endforeach
            <div class="space-y-4 mt-5 mb-8">
                <p class="text-2xl font-semibold dark:text-slate-200">Hobby :</p>
                @foreach ($hobby_siswa as $item)
                    <div class="flex items-center">
                        <ul>
                            <li class="text-2xl dark:text-slate-400">- {{ $item->hobby }}</li>
                        </ul>
                    </div>
                @endforeach
            </div>
            <div class="mb-6">
                @foreach ($data as $item)
                <p class="text-2xl font-semibold dark:text-slate-200 mb-5">Nomor Telepon:</p>
                <ul class="space-y-4">
                    @foreach ($item->phone as $i)
                        <li class="flex justify-between items-center">
                            <span class="text-2xl dark:text-slate-400"> - {{ $i->phone_number }}</span>
                            
                        </li>
                    @endforeach
                </ul>
            </div>

            

          

            @endforeach

           <div class="flex mx-auto justify-center gap-4">
           

           </div>
        </div>
    </div>
@endsection
