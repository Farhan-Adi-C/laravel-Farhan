<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @vite('resources/css/app.css')
    <title>Data Siswa SMKN 1 Tengaran</title>
</head>
<body class="p-7">
    @if (session('success'))
    <script>
        alert('{{ session('success') }}')
    </script>
    @endif
   
    
        <form action="{{ route('logout') }}" class="text-end ">
            @csrf
            <button type="submit" class="hover:underline"><i class="fa-solid fa-right-from-bracket hover:text-red-700">Logout</i> </button>
        </form>
    
    <h1 class="text-3xl font-bold text-center mb-6">Data Siswa SMKN 1 Tengaran</h1>
    <div class="flex w-11/12 justify-between mx-auto">
        @if (Auth::check())
            <p>Hallo {{ Auth::user()->name }}</p>
        @endif
        <a href="/form" class=" px-3 py-2 bg-green-500 text-white rounded-md ml-14 mb-2 inline-block hover:bg-green-600">Tambah Data</a>
    </div>
    <table class="border-black border-collapse w-11/12 mx-auto">
        <thead>
            <tr>
                <th class="border-[1.7px] px-4 py-2">No</th>
                <th class="border-[1.7px] px-4 py-2">Siswa</th>
                <th class="border-[1.7px] px-4 py-2">NISN</th>
                <th class="border-[1.7px] py-2">Tombol</th>
            </tr>
        </thead>
        <tbody>
         
                
            @foreach ($data as $item)
            <tr>
                    
                
                <td class="border-[1.7px] px-4 py-2">{{ $loop->index + 1 }}</td>
                <td class="border-[1.7px] px-4 py-2">{{ $item->nama }}</td>
                <td class="border-[1.7px] px-4 py-2 mx-auto ">{{ $item->nisn->nisn }}</td>
                <td class="border-[1.7px] py-8 text-center flex justify-center">
                    <a href="{{ route('data.edit', ['id' => $item->id]) }}" class="bg-blue-500 text-white px-5 py-2 rounded hover:bg-blue-600 ">Edit</a> <span class="text-xl mx-2">|</span>

                <form action="{{ route('data.delete', ['id' => $item->id]) }}" method="POST" >
                  @csrf
                  @method('delete')
                    <button class="bg-red-500 text-white px-5 py-2 rounded hover:bg-red-600" onclick="return confirm('apakah anda yakin?')">Delete</button>
                </form>
                <span class="text-xl mx-2">|</span>
                <a href="{{ route('detail', ['id' => $item->id]) }}" class="bg-yellow-500 text-white px-5 py-2 rounded hover:bg-yellow-600">Detail</a>
                </td>
            </tr>
            @endforeach
          


        </tbody>
    </table>
</body>
</html>
