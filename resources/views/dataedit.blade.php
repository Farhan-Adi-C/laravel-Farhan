<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Edit Siswa</title>
</head>
<body class="p-10">


    <h1 class="text-3xl font-bold text-center mb-6">Tambah No Telpon</h1>

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
    </form>
</body>
</html>
