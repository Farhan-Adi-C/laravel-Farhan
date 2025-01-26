
@extends('layouts.app') 

@section('title', 'Data Siswa SMKN 1 Tengaran') 

@section('content')
@if (session('success'))
<script>
    alert('{{ session('success') }}')
</script>
@endif

<div class="max-w-lg mx-auto bg-white rounded-lg shadow-lg p-6 dark:bg-slate-800">
    <h2 class="text-2xl font-bold text-center mb-10">Pilih Hobby Siswa</h2>

  
    <div class="mb-6">

        <div class="mb-6">
            <form action="{{ route('update.hobbysiswa', ['id' => $siswa->id]) }}" method="POST">
                @csrf

                <p class="text-xl font-semibold mb-5 dark:text-slate-200">Pilih Hobi:</p>
                <div class="space-y-4">
                    {{-- @foreach ($hobby as $item)
                        <div class="flex items-center">
                            <input type="checkbox" id="{{ $item->hobby }}" name="hobby[]" value="{{ $item->id }}" class="mr-2" 
                              
                           @if ($hobby_siswa->contains('id', $item->id)) 
                           checked
                           @endif >
                            <label for="{{ $item->hobby }}" class="text-md">{{ $item->hobby }}</label>
                        </div>
                    @endforeach --}}
                    <div class="checkbox-area grid">
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

                <div class="mt-4 text-center">
                    <button type="submit" class="btn inline-flex justify-center mx-2 mt-3 btn-primary ">Simpan Hobi</button>
                </div>
            </form>
        </div> 

    </div>

    <div class="flex mx-auto justify-center gap-4">
        <div>
            {{-- <a href="{{ route('hobby.add') }}" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Tambah Hobby</a> --}}
        </div>
        
    </div>
</div>
@endsection