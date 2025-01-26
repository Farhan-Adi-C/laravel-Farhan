
@extends('layouts.app') 

@section('title', 'Data Siswa SMKN 1 Tengaran') 

@section('content')
@if (session('success'))
    <script>
        alert('{{ session('success') }}')
    </script>
    @endif
   
    
        
    
    {{-- <h1 class="text-3xl font-bold text-center mb-6">Data Phone Siswa SMKN 1 Tengaran</h1>
    <div class="flex w-11/12 ">
       
        <a href="{{ route('data') }}" class=" px-3 py-2 bg-green-500 text-white rounded-md ml-2 mb-2 inline-block hover:bg-green-600">Home</a>
        <a href="" class=" px-3 py-2 bg-green-500 text-white rounded-md ml-2 mb-2 inline-block hover:bg-green-600">Phone</a>
        <a href="{{ route('hobby') }}" class=" px-3 py-2 bg-green-500 text-white rounded-md ml-2 mb-2 inline-block hover:bg-green-600">Hobby</a>
    </div>
    <table class="border-black border-collapse w-11/12 mx-auto">
        <thead>
            <tr>
                <th class="border-[1.7px] px-4 py-2">No</th>
                <th class="border-[1.7px] px-4 py-2">Siswa</th>
                <th class="border-[1.7px] px-4 py-2">Phone</th>
                <th class="border-[1.7px] py-2">Tombol</th>
            </tr>
        </thead>
        <tbody>
         
                
            @foreach ($data as $item)
            <tr>
                    
                
                <td class="border-[1.7px] px-4 py-2">{{ $loop->index + 1 }}</td>
                <td class="border-[1.7px] px-4 py-2">{{ $item->nama }}</td>
                <td class="border-[1.7px] px-4 py-2 mx-auto ">
                    <ul>
                        @foreach ($item->phone as $phone)
                        <li>- {{ $phone->phone_number }}</li>
                        @endforeach
                    </ul>
                </td>
                <td class="border-[1.7px] py-8 text-center flex justify-center min-h-72 items-center">
                    

                <a href="{{ route('phone.edit', ['id' => $item->id]) }}" class="bg-blue-500 text-white px-5 py-2 rounded hover:bg-blue-600 max-h-10">Detail</a>
                </td>
            </tr>
            @endforeach
          


        </tbody>
    </table> --}}

    
    <div class="card-body px-6 pb-6">

      

        <div class="overflow-x-auto -mx-6 dashcode-data-table">
          <span class=" col-span-8  hidden"></span>
          <span class="  col-span-4 hidden"></span>
          <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden ">
    <table class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700 data-table">
    <thead class="bg-slate-200 dark:bg-slate-700">
        <tr>
            <th scope="col" class="table-th">No</th>
            <th scope="col" class="table-th">Nama</th>
            <th scope="col" class="table-th">Phone</th>
            <th scope="col" class="table-th">Action</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
        @foreach ($data as $item)
        <tr>
            <td class="table-td">{{ $loop->index + 1 }}</td>
            <td class="table-td">{{ $item->nama }}</td>
            <td class="table-td">
                <ul>
                    @foreach ($item->phone as $phone)
                    <li>- {{ $phone->phone_number }}</li>
                    @endforeach
                </ul>
            </td>
           
            <td class="table-td">
                <div class="flex space-x-3 rtl:space-x-reverse">
                    <button class="action-btn" type="button">
                        <a href="{{ route('phone.edit', ['id' => $item->id]) }}"><iconify-icon icon="heroicons:eye"></iconify-icon></a>
                    </button>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
</div>
</div>
</div>
@endsection