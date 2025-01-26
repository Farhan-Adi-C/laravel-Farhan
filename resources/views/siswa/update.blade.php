
@extends('layouts.app') 

@section('title', 'Data Siswa SMKN 1 Tengaran') 

@section('content')
{{-- <h1 class="text-3xl font-bold text-center mb-6">Tambah No Telpon</h1>

    <form action="{{ route('data.update', ['id' => $siswa->id]) }}" method="POST" class="max-w-lg mx-auto p-6 border border-gray-300 rounded-lg shadow-lg">
        @csrf
      @method('put')
        <div class="mb-4">
            <label for="nama" class="block text-lg font-medium mb-2">Nama</label>
            <input value="{{ $siswa->nama }}" type="text" id="nama" name="nama" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
        </div>
       
        <div class="mb-4">
            <label for="nisn" class="block text-lg font-medium mb-2">NISN</label>
            <input value="{{ $siswa->nisn->nisn }}" type="text" id="nisn" name="nisn" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
        </div>

        <div class="mb-4 text-center flex gap-2 justify-center">
            <a href="{{ route('data') }}" class="bg-green-500 text-white px-6 py-2 rounded-lg">Kembali</a>
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg">Submit</button>
        </div>
    </form> --}}

    <div class="card">
        <div class="card-body flex flex-col p-6">
          <header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
            <div class="flex-1">
              <div class="card-title text-slate-900 dark:text-white">Horizontal Form</div>
            </div>
          </header>
          <div class="card-text h-full ">
            <form action="{{ route('data.update', ['id' => $siswa->id]) }}" method="post" class="space-y-4">
                @csrf
                @method('put')
              <div class="input-area relative pl-28">
                <label for="largeInput" class="inline-inputLabel">Name</label>
                <input name="nama" type="text" value="{{ $siswa->nama }}" class="form-control" placeholder="Full Name">
              </div>
              <div class="input-area relative pl-28">
                <label for="largeInput" class="inline-inputLabel">NISN</label>
                <input name="nisn" type="number" value="{{ $siswa->nisn->nisn }}" class="form-control" placeholder="Enter Your Email">
              </div>
              <div class="checkbox-area grid">
                <label for="hobby" class="text-lg mb-5">Hobby :</label>
                        @foreach ($hobby as $item)
                        <label class="inline-flex items-center cursor-pointer mb-2" for="{{ $item->hobby }}">
                          <input type="checkbox" class="hidden" id="{{ $item->hobby }}" value="{{ $item->id }}" name="hobby[]"
                          @if ($hobby_siswa->contains('id', $item->id)) 
                          checked
                          @endif >
                          <span class="h-4 w-4 border flex-none border-slate-100 dark:border-slate-800 rounded inline-flex ltr:mr-3 rtl:ml-3 relative transition-all duration-150 bg-slate-100 dark:bg-slate-900">
                                <img src="/assets/images/icon/ck-white.svg" alt="" class="h-[10px] w-[10px] block m-auto opacity-0"></span>
                          <span class="text-slate-500 dark:text-slate-400 text-lg leading-6">{{ $item->hobby }}</span>
                        </label>
                        @endforeach 
                      </div>
                </div>
              {{-- <div class="input-area relative pl-28">
                <label for="largeInput" class="inline-inputLabel">Phone</label>
                <input type="tel" class="form-control" placeholder="Phone Number" pattern="[0-9]">
              </div>
              <div class="input-area relative pl-28">
                <label for="largeInput" class="inline-inputLabel">Password</label>
                <input type="password" class="form-control" placeholder="8+ characters, 1 capitat letter">
              </div>
              <div class="checkbox-area ltr:pl-28 rtl:pr-28">
                <label class="inline-flex items-center cursor-pointer">
                  <input type="checkbox" class="hidden" name="checkbox">
                  <span class="h-4 w-4 border flex-none border-slate-100 dark:border-slate-800 rounded inline-flex ltr:mr-3 rtl:ml-3 relative
                            transition-all duration-150 bg-slate-100 dark:bg-slate-900">
                        <img src="assets/images/icon/ck-white.svg" alt="" class="h-[10px] w-[10px] block m-auto opacity-0">
                    </span>
                  <span class="text-slate-500 dark:text-slate-400 text-sm leading-6">Remember me</span>
                </label>
              </div> --}}
              <div class="w-10"><button type="submit" class="btn inline-flex justify-center btn-dark w-16">Submit</button></div>
            </form>
          </div>
        </div>
      </div>
@endsection



    