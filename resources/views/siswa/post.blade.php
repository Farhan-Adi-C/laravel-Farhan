@extends('layouts.app') 

@section('title', 'Data Siswa SMKN 1 Tengaran') 

@section('content')
{{-- <h1 class="text-3xl font-bold text-center mb-6">Form Pengisian Data Siswa</h1>

    <form action="{{ route('form.post') }}" method="POST" class="max-w-lg mx-auto p-6 border border-gray-300 rounded-lg shadow-lg">
        @csrf
        <div class="mb-4">
            <label for="nama" class="block text-lg font-medium mb-2">Nama Siswa</label>
            <input type="text" id="nama" name="nama" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
        </div>
        
        <div class="mb-4">
            <label for="nisn" class="block text-lg font-medium mb-2">NISN</label>
            <input type="text" id="nisn" name="nisn" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
        </div>

        <div class="mb-4">
            <label for="phone_number" class="block text-lg font-medium mb-2">No Telepon</label>
            <input type="text" id="phone_number" name="phone_number" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
        </div>

                <p class="text-lg font-semibold mb-2">Pilih Hobi:</p>
                <div class="space-y-4">
                    @foreach ($hobby as $item)
                        <div class="flex items-center">
                            <input type="checkbox" id="{{ $item->hobby }}" name="hobby[]" value="{{ $item->id }}" class="mr-2" >
                            <label for="{{ $item->hobby }}" class="text-md">{{ $item->hobby }}</label>
                        </div>
                    @endforeach
                </div>
                


        <div class="mb-4 text-center flex justify-center gap-2">
            <a href="{{ route('data') }}" class="bg-green-500 text-white px-6 py-2 rounded-lg">Kembali</a>
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg">Submit</button>
        </div>
    </form> --}}

    <div class="card">
        <div class="card-body flex flex-col p-6">
          <header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
            <div class="flex-1">
              <div class="card-title text-slate-900 dark:text-white">Add Student</div>
            </div>
          </header>
          <div class="card-text h-full ">
            <form class="space-y-4" method="POST" action="{{ route('form.post') }}">
                @csrf
              <div class="input-area relative">
                <label for="largeInput" class="form-label">Name</label>
                <input type="text" name="nama" class="form-control" placeholder="Name">
              </div>
              <div class="input-area relative">
                <label for="largeInput" class="form-label">NISN</label>
                <input type="number" name="nisn" class="form-control" placeholder="NISN">
              </div>
              
              <div class="card-text h-full space-y-4">
                <div class="space-y-3">

                    @foreach ($hobby as $item)
                  <div class="checkbox-area">
                    <label class="inline-flex items-center cursor-pointer" for="{{ $item->hobby }}">
                      <input type="checkbox" class="hidden" id="{{ $item->hobby }}" value="{{ $item->id }}" name="hobby[]">
                      <span class="h-4 w-4 border flex-none border-slate-100 dark:border-slate-800 rounded inline-flex ltr:mr-3 rtl:ml-3 relative transition-all duration-150 bg-slate-100 dark:bg-slate-900">
                            <img src="/assets/images/icon/ck-white.svg" alt="" class="h-[10px] w-[10px] block m-auto opacity-0"></span>
                      <span class="text-slate-500 dark:text-slate-400 text-sm leading-6">{{ $item->hobby }}</span>
                    </label>
                  </div>
                  @endforeach
                  
                </div>
                
              </div>
              <button class="btn inline-flex justify-center btn-dark" type="submit">Submit</button>
            </form>
          </div>
        </div>
      </div>
@endsection 