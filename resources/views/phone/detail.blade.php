
@extends('layouts.app') 

@section('title', 'Data Siswa SMKN 1 Tengaran') 

@section('content')
@if (session('success'))
        <script>
            alert('{{ session('success') }}')
        </script>
    @endif

    @foreach ($data as $item)
        <div class="max-w-lg mx-auto bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-bold text-center mb-4">Detail Phone Siswa</h2>

            <div class="mb-6">
                <p class="text-xl font-semibold">Nama: <span class="font-normal">{{ $item->nama }}</span></p>
            </div>
           @endforeach
            
            <div class="mb-6">
                @foreach ($data as $item)
                <p class="text-xl font-semibold mb-3">Nomor Telepon:</p>
                <ul class="space-y-4 px-20">
                    @foreach ($item->phone as $i)
                        <li class="flex justify-between items-center ">
                            <span class="text-lg ">{{ $i->phone_number }}</span>
                            <div class="flex space-x-2">
                                
                               
                                @can('phone-update')
                                    
                                
                                <a href="{{ route('phone.edit2', ['id' => $i->id]) }}"><button class="btn inline-flex justify-center btn-outline-primary rounded-[25px]">
                                    <span class="flex items-center">
                                        <iconify-icon class="text-xl ltr:mr-2 rtl:ml-2" icon="heroicons-outline:newspaper"></iconify-icon>
                                        <span>Edit</span>
                                    </span>
                                  </button></a>
                                  @endcan
                                  @can('phone-delete')
                                      
                                  
                                <form action="{{ route('phone.delete', ['id' => $i->id]) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" onclick="return confirm('apakah anda yakin?')" class="btn inline-flex justify-center btn-primary rounded-[25px]">
                                        <span class="flex items-center">
                                            <span>Delete</span>
                                        <iconify-icon class="text-xl ltr:ml-2 rtl:mr-2" icon="tabler:trash"></iconify-icon>
                                        </span>
                                      </button>
                                </form>
                                @endcan
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

            @endforeach

           <div class="flex mx-auto justify-center gap-4">
            
            @can('phone-store')
                
            <div class=" ">
                @foreach ($data as $item)
                
                <a href="{{ route('phone.add', ['id' =>$item->id]) }}" class="btn inline-flex justify-center mx-2 mt-3 btn-primary ">Tambah No Telepon</a>
                @endforeach
                
            </div>
            @endcan
                
       
    </div>
@endsection