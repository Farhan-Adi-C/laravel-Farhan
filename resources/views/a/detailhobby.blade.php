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
    @if (session('success'))
        <script>
            alert('{{ session('success') }}')
        </script>
    @endif
        <div class="max-w-lg mx-auto bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-bold text-center mb-4">Detail Hobby</h2>


            <div class="mb-6">
                <p class="text-lg font-semibold">Hobby:</p>
                <ul class="space-y-4">
                   @foreach ($hobby as $item)
        
                        <li class="flex justify-between items-center">
                            <span class="text-md">{{ $item->hobby }}</span>
                            <div class="flex space-x-2">
                                <a href="{{ route('hobby.edit', ['id' => $item->id, 'siswa_id' => $siswa->id]) }}" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Edit</a>

                                <form action="{{ route('hobby.delete', ['id' => $id, 'id_hobby' => $item->id]) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600"  onclick="return confirm('apakah anda yakin ?')">Delete</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

          

         

          

           <div class="flex mx-auto justify-center gap-4">
            <div class=" ">
                
                <a href="{{ route('tambah.hobby', ['id' => $id]) }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-gray-600">Tambah Opsi Hobby</a>
                
            </div>

        
        <div class=" ">
            <a href="{{ route('detail', ['id' => $id]) }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-700">Kembali</a>
        </div>
           </div>
    </div>
</body>
</html>
