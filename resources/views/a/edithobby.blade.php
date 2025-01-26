<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Add Hobby Option</title>
</head>
<body class="p-10">
    @if (session('success'))
    <script>
        alert('{{ session('success') }}')
    </script>
@endif
    <h1 class="text-3xl font-bold text-center mb-6">Tambah Opsi Hobby</h1>

    <form action="{{ route('hobby.update', ['id' => $hobby->id, 'siswa_id' => $siswa->id] ) }}" method="POST" class="max-w-lg mx-auto p-6 border border-gray-300 rounded-lg shadow-lg">
        @csrf
        @method('put')
        
        <div class="mb-4">
            <label for="hobby" class="block text-lg font-medium mb-2">Hobby</label>
            <input type="text" id="hobby" name="hobby" value="{{ $hobby->hobby }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
        </div>

        <div class="justify-center mx-auto text-center">
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg">Submit</button>
       
            <a href="" class="text-center inline-block bg-slate-500 rounded-md px-4 py-2 text-white">Kembali</a>
        </div>
    </form>
    {{-- {{ route('detail.hobby', ['id' => $id]) }} --}}
</body>
</html>
