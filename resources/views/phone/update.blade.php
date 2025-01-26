
@extends('layouts.app') 

@section('title', 'Data Siswa SMKN 1 Tengaran') 

@section('content')
<h1 class="text-3xl font-bold text-center mb-6">Update No Telpon</h1>

    <form action="{{ route('phone.update', ['id' => $id]) }}" method="POST" class="max-w-lg mx-auto p-6 border border-gray-300 rounded-lg shadow-lg">
        @csrf
        @method('put')
       

       
        
       
        
        <div class="mb-4">
            <label for="phone_number" class="block text-lg font-medium mb-2">No Telepon</label>
            @foreach ($phone as $item)
            <input value="{{ $item->phone_number }}" type="text" id="phone_number" name="phone_number" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            @endforeach
        </div>

        <div class="mb-4 text-center flex gap-2 justify-center">
            {{-- <a href="{{ route('detail', ['id' => $item->siswa_id]) }}" class="bg-green-500 text-white px-6 py-2 rounded-lg">Kembali</a> --}}
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg">Submit</button>
        </div>
    </form>
@endsection

    
