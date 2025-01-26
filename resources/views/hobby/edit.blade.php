
@extends('layouts.app') 

@section('title', 'Data Siswa SMKN 1 Tengaran') 

@section('content')
<h1 class="text-3xl font-bold text-center mb-6">Edit Opsi Hobby</h1>
{{-- {{ dd($data) }} --}}
    <form action="{{ route('hobby.update', ['id' => $id]) }}" method="POST" class="max-w-lg mx-auto p-6 border border-gray-300 rounded-lg shadow-lg">
        @csrf
        @method('put')
        @foreach ($data as $item)
            
        
        <div class="mb-4">
            <label for="hobby" class="block text-lg font-medium mb-2">Hobby</label>
            <input type="text" id="hobby" value="{{ $item->hobby }}" name="hobby" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
        </div>
        @endforeach
        <div class="mb-4 text-center">
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg">Submit</button>
        </div>
    </form>
@endsection 