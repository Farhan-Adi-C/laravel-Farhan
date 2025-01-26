<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Add Hobby</title>
</head>
<body class="p-10 bg-slate-100">
    @if (session('success'))
    <script>
        alert('{{ session('success') }}')
    </script>
@endif
    <div class="mb-6 w-1/2 mx-auto shadow-md bg-white p-10 rounded-md">
        <h1 class="text-3xl font-bold text-center mb-6">Tambah Hobby</h1>
                <form action="{{ route('hobby.post', ['id' => $id]) }}" method="POST">
                    @csrf

                    <p class="text-lg font-semibold mb-2">Pilih Hobi:</p>
                    <div class="space-y-4 ">
                      @foreach ($data as $item)

                      <div class="flex items-center">
                          <input type="checkbox" id="{{ $item->hobby }}" name="hobby[]" value="{{ $item->id }}" class="mr-2" 
                          @if ($hobby_siswa->contains('id', $item->id)) 
                          checked
                      @endif
                      >
                          <label for="{{ $item->hobby }}" class="text-md">{{ $item->hobby }}</label>
                      </div>
                          
                      @endforeach
                     
                    </div>
                    
                     <div class="mt-4 text-center">
                         <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Simpan Hobi</button>
                     </div>

                    <div class="mt-4 text-center">
                        <a href="{{ route('detail.hobby', ['id' => $siswa->id]) }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Detail Hobby</a>
                    </div>
                    {{-- <div class="mt-4 text-center">
                        <a href="{{ route('add.hobby', ['id' => $siswa->id]) }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Tambah Opsi Hobi</a>
                    </div> --}}
                    <div class="mt-5 text-center ">
                        <a href="{{ route('detail', ['id' => $siswa->id]) }}" class="px-4 py-2 bg-slate-500 text-white rounded hover:bg-slate-600">Kembali</a>
                    </div>
                </form>
            </div>
  
</body>
</html>
