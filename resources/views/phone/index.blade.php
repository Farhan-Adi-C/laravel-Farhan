
@extends('layouts.app') 

@section('title', 'Detail Phone Students') 

@section('content')
@if (session('success'))
    <script>
        alert('{{ session('success') }}')
    </script>
    @endif
   
    
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
            @can('phone-show')
                
            <th scope="col" class="table-th">Action</th>
            @endcan
       
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
           @can('phone-show')
               
           <td class="table-td">
               <div class="flex space-x-3 rtl:space-x-reverse">
                   <button class="action-btn" type="button">
                       <a href="{{ route('phone.edit', ['id' => $item->id]) }}"><iconify-icon icon="heroicons:eye"></iconify-icon></a>
                    </button>
                </div>
            </td>
            @endcan
          
        </tr>
        @endforeach
    </tbody>
</table>
</div>
</div>
</div>
</div>
@endsection