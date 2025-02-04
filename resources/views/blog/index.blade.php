
@extends('layouts.app') 

@section('title', 'Table Blog') 

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
            <th scope="col" class="table-th">Title</th>
            <th scope="col" class="table-th">Content</th>
            <th scope="col" class="table-th">Image Thumbnail</th>
            <th scope="col" class="table-th">Image</th>
            <th scope="col" class="table-th">Action</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
       @foreach ($data as $item)
           
       <tr>
           <td class="table-td"> {{ $loop->index + 1 }} </td>
           <td class="table-td">{{ $item->user->name }}</td>
           <td class="table-td">{{ $item->title }}</td>
           <td class="table-td"><?= Str::limit(strip_tags($item->content), 20, '...') ?></td>
           <td class="table-td">{{ Str::limit(strip_tags($item->featured_image), 25, '...')  }}</td>
           <td class="table-td">
            <ul>
                @foreach ($item->image as $image)
                   <li> - {{ Str::limit($image->image, 25, '...')  }}</li>   
                @endforeach
            </ul>
           </td>
          
           <td class="table-td">
               <div class="flex space-x-3 rtl:space-x-reverse">
                   <button class="action-btn" type="button">
                       <a href="{{ route('blog.edit', ['id' => $item->id]) }}"><iconify-icon icon="heroicons:pencil-square"></iconify-icon></a>
                   </button>
                   <form action="{{ route('blog.delete', ['id' => $item->id]) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button class="action-btn" type="submit" onclick="return confirm('apakah anda yakin?')">
                        <iconify-icon icon="heroicons:trash"></iconify-icon>
                    </button>
                </form>
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