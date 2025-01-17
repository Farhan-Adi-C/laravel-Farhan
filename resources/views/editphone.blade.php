<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Form Data Siswa</title>
</head>
<body class="p-10">


    <h1 class="text-3xl font-bold text-center mb-6">Tambah No Telpon</h1>

    <form action="{{ route('phone.update', ['id' => $phone->id]) }}" method="POST" class="max-w-lg mx-auto p-6 border border-gray-300 rounded-lg shadow-lg">
        @csrf
        @method('put')
        <div class="mb-4">
            <label for="phone_number" class="block text-lg font-medium mb-2">No Telepon</label>
            <input value="{{ $phone->phone_number }}" type="text" id="phone_number" name="phone_number" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
        </div>

        <div class="mb-4 text-center flex gap-2 justify-center">
            <a href="{{ route('detail', ['id' => $phone->siswa_id]) }}" class="bg-green-500 text-white px-6 py-2 rounded-lg">Kembali</a>
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg">Submit</button>
        </div>
    </form>
</body>
</html>
