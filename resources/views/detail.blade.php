<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
    <title>Detail Siswa</title>
</head>
<body class="bg-gray-100 p-8">
    

    @if (session('success'))
        <script>
            alert('{{ session('success') }}')
        </script>
    @endif

    @foreach ($data as $item)
        <div class="max-w-lg mx-auto bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-bold text-center mb-4">Detail Siswa</h2>

            <div class="mb-6">
                <p class="text-xl font-semibold">Nama: <span class="font-normal">{{ $item->nama }}</span></p>
            </div>
            <div class="mb-6">
                <p class="text-xl font-semibold">NISN: <span class="font-normal">{{ $item->nisn->nisn }}</span></p>
            </div>

            <div class="mb-6">
                <p class="text-lg font-semibold">Nomor Telepon:</p>
                <ul class="space-y-4">
                    @foreach ($item->phone as $i)
                        <li class="flex justify-between items-center">
                            <span class="text-md">{{ $i->phone_number }}</span>
                            <div class="flex space-x-2">
                                <a href="{{ route('phone.edit', ['id' => $i->id]) }}" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Edit</a>
                                <form action="{{ route('phone.delete', ['id' => $i->id]) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600"  onclick="return confirm('apakah anda yakin ?')">Delete</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            {{-- {{ route('hobby.store', ['id' => $item->id]) }} --}}
            <div class="mb-6">
                <form action="{{ route('hobby.post', ['id' => $item->id]) }}" method="POST">
                    @csrf

                    <p class="text-lg font-semibold mb-2">Pilih Hobi:</p>
                    <div class="space-y-4">
                        @foreach ($hobby as $item)
                            <div class="flex items-center">
                                <input type="checkbox" id="{{ $item->hobby }}" name="hobby[]" value="{{ $item->id }}" class="mr-2" 
                                @if ($hobby_siswa->contains('id', $item->id)) 
                                    checked
                                @endif> 
                                <label for="{{ $item->hobby }}" class="text-md">{{ $item->hobby }}</label>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4 text-center">
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Simpan Hobi</button>
                    </div>
                </form>
            </div>

            @endforeach

        <div class="mb-6 text-center">
            @foreach ($data as $item)
            <a href="{{ route('phone', ['id' => $item->id]) }}" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Tambah No Telepon</a>
            @endforeach
        </div>

        <div class="flex justify-center mt-6">
            <a href="{{ route('data') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Kembali</a>
        </div>
    </div>

   

</body>
</html>
