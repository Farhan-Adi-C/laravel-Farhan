
@extends('layouts.app') 

@section('title', 'Data Siswa SMKN 1 Tengaran') 

@section('content')
<h1 class="text-3xl font-bold text-center mb-6">Add Hobby Option</h1>

    {{-- <form action="{{ route('hobby.post') }}" method="POST" class="max-w-lg mx-auto p-6 border border-gray-300 rounded-lg shadow-lg">
        @csrf
        
        <div class="mb-4">
            <label for="hobby" class="block text-lg font-medium mb-2">Hobby</label>
            <input type="text" id="hobby" name="hobby" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
        </div>

        <div class="mb-4 text-center">
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg">Submit</button>
        </div>
    </form> --}}

    <div class="card">
        <div class="card-body flex flex-col p-6">
          <header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
            <div class="flex-1">
              <div class="card-title text-slate-900 dark:text-white">Add Hobbies</div>
            </div>
          </header>
          <div class="card-text h-full ">
            <form class="space-y-4" method="POST" action="{{ route('hobby.post') }}">
                @csrf
              <div class="input-area relative">
                <label for="hobby" class="form-label">Hobby</label>
                <input type="text" id="hobby" name="hobby" class="form-control" placeholder="hobby">
              </div>

              <button class="btn inline-flex justify-center btn-dark" type="submit">Submit</button>
            </form>
          </div>
        </div>
      </div>
@endsection

