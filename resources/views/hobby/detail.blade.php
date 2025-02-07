
@extends('layouts.app') 

@section('title', 'Detail Hobby Students') 

@section('content')
@if (session('success'))
    <script>
        alert('{{ session('success') }}')
    </script>
@endif

    <div class="max-w-lg mx-auto bg-white rounded-lg shadow-lg p-6 dark:bg-slate-800">
        <h2 class="text-2xl font-bold text-center mb-10">Hobby Student Detail</h2>

      
        <div class="mb-6">
            <p class="text-lg font-semibold dark:text-slate-200">Option Hobby:</p>
            <ul class="space-y-4 mt-4">
             
                @foreach ($data as $item)
                    
                
                <li class="flex justify-between items-center">
                    <span class="text-md dark:text-slate-300">- {{ $item->hobby }}</span>
                    <div class="flex space-x-2">
                        {{-- <a href="{{ route('hobby.edit', ['id' => $item->id]) }}" > --}}
                          
                          @can('hobby-update')
                              
                          
                            <button class="btn inline-flex justify-center btn-outline-primary rounded-[25px]" data-bs-toggle="modal" data-bs-target="#default_modal1" data-id="{{ $item->id }}"
                                data-id="{{ $item->id }}" data-hobby="{{ $item->hobby }}" id="button-edit">
                            <span class="flex items-center">
                                <iconify-icon class="text-xl ltr:mr-2 rtl:ml-2" icon="heroicons-outline:newspaper"></iconify-icon>
                                <span>Edit</span>
                            </span>
                          </button>
                          @endcan
                        {{-- </a>   --}}
                        @can('hobby-delete')
                            
                       
                        <form action="{{ route('hobby.delete', ['id' => $item->id]) }}" method="POST" >
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

        <div class="flex mx-auto justify-center gap-4">
          
          @can('hobby-store')
            <div>
                {{-- <a href="{{ route('hobby.add') }}" class="btn inline-flex justify-center mx-2 mt-3 btn-primary ">Tambah Hobby</a> --}}
                    
                <button data-bs-toggle="modal" data-bs-target="#default_modal" class="btn inline-flex justify-center btn-outline-dark capitalize">Add Hobby</button>
              </div>
              @endcan
              
        </div>
    </div>

    {{-- Modal untuk Tambah --}}
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="default_modal" tabindex="-1" aria-labelledby="default_modal" aria-hidden="true">
        <div class="modal-dialog relative w-auto pointer-events-none">
          <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
          rounded-md outline-none text-current">
            <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
              <!-- Modal header -->
              <div class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                <h3 class="text-xl font-medium text-white dark:text-white capitalize">
                  Default Modal
                </h3>
                <button type="button" class="text-slate-400 bg-transparent hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center
                      dark:hover:bg-slate-600 dark:hover:text-white" data-bs-dismiss="modal">
                  <svg aria-hidden="true" class="w-5 h-5" fill="#ffffff" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10
                              11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                  </svg>
                  <span class="sr-only">Close modal</span>
                </button>
              </div>
              <!-- Modal body -->
              <div class="p-6 space-y-4">
                <form action="{{ route('hobby.post') }}" method="POST">
                    @csrf

                    <div class="input-area relative">
                        <label for="hobby" class="form-label">Hobby</label>
                        <input type="text" name="hobby" class="form-control" placeholder="Hobby" required>
                      </div>
              </div>
              <!-- Modal footer -->
              <div class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                <button data-bs-dismiss="modal" class="btn inline-flex justify-center text-white bg-black-500" type="submit">Submit</button>
            </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    
    
    {{-- Modal untuk Update --}}

      <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="default_modal1" tabindex="-1" aria-labelledby="default_modal" aria-hidden="true">
        <div class="modal-dialog relative w-auto pointer-events-none">
          <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
          rounded-md outline-none text-current">
            <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
              <!-- Modal header -->
              <div class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                <h3 class="text-xl font-medium text-white dark:text-white capitalize">
                 sfsfsd
                </h3>
                <button type="button" class="text-slate-400 bg-transparent hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center
                      dark:hover:bg-slate-600 dark:hover:text-white" data-bs-dismiss="modal">
                  <svg aria-hidden="true" class="w-5 h-5" fill="#ffffff" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10
                              11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                  </svg>
                  <span class="sr-only">Close modal</span>
                </button>
              </div>
              <!-- Modal body -->
              <div class="p-6 space-y-4">
                <form action="{{ route('hobby.update') }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="input-area relative">
                        <label for="hobby" class="form-label">Hobby</label>
                        <input type="text" name="hobby" id="hobby" class="form-control" placeholder="Hobby" required>
                        <input type="hidden" name="id" id="hobby_id">
                      </div>
              </div>
              <!-- Modal footer -->
              <div class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                <button data-bs-dismiss="modal" class="btn inline-flex justify-center text-white bg-black-500" type="submit">Submit</button>
            </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <script src="{{ asset('js/updateHobby.js') }}"></script>
@endsection 
