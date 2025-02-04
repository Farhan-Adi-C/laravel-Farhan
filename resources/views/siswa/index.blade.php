@extends('layouts.app')

@section('title', 'Home - Data Students')

@section('content')
    @if (session('success'))
        <script>
            alert('{{ session('success') }}')
        </script>
    @endif


    <button data-bs-toggle="modal" data-bs-target="#default_modal"
        class="btn inline-flex justify-center btn-outline-dark capitalize">Add Student</button>

    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
        id="default_modal" tabindex="-1" aria-labelledby="default_modal" aria-hidden="true">
        <div class="modal-dialog relative w-auto pointer-events-none">
            <div
                class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
          rounded-md outline-none text-current">
                <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                        <h3 class="text-xl font-medium text-white dark:text-white capitalize">
                            Add Student
                        </h3>
                        <button type="button"
                            class="text-slate-400 bg-transparent hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center
                      dark:hover:bg-slate-600 dark:hover:text-white"
                            data-bs-dismiss="modal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="#ffffff" viewbox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10
                                  11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-4">
                        <form action="{{ route('form.post') }}" method="POST">
                            @csrf

                            <div class="input-area relative">
                                <label for="nama" class="form-label">Name</label>
                                <input type="text" name="nama" class="form-control" placeholder="Name">
                            </div>
                            <div class="input-area relative">
                                <label for="nisn" class="form-label">NISN</label>
                                <input type="number" name="nisn" class="form-control border-2" placeholder="NISN">
                            </div>
                            {{-- <div class=" relative mb-3 w-80  " id="phone-area">
                                <label for="phone_number" class="form-label">Phone</label>
                                <div class="flex w-24 items-center">
                                    <input type="number" name="phone_number[]" class="form-control border-2 mb-2 w-10 "
                                        placeholder="Phone">
                                        <button class="px-2 text-base bg-red-500 text-white items-center text-center">x</button>
                                </div>
                            </div>
                            <button type="button" id="add-phone" class="btn btn-secondary btn-sm">Add More</button> --}}

                            <div class="relative mb-3 w-80" id="phone-area">
                              <label for="phone_number" class="form-label">Phone</label>
                              <div class="flex w-full items-center" id="input-container">
                                  <input type="number" name="phone_number[]" class="form-control border-2 mb-2 w-full" placeholder="Phone">
                              </div>
                          </div>
                          <button type="button" id="add-phone" class="btn btn-secondary btn-sm">Add More</button>
                          
                            <div class="card-text h-full space-y-4 mt-4">
                                <div class="space-y-3">

                                    <label for="hobby" class="form-label">Hobby</label>
                                    @foreach ($hobby as $item)
                                        <div class="checkbox-area">
                                            <label class="inline-flex items-center cursor-pointer"
                                                for="{{ $item->hobby }}">
                                                <input type="checkbox" class="hidden" id="{{ $item->hobby }}"
                                                    value="{{ $item->id }}" name="hobby[]">
                                                <span
                                                    class="h-4 w-4 border flex-none border-slate-100 dark:border-slate-800 rounded inline-flex ltr:mr-3 rtl:ml-3 relative transition-all duration-150 bg-slate-100 dark:bg-slate-900">
                                                    <img src="/assets/images/icon/ck-white.svg" alt=""
                                                        class="h-[10px] w-[10px] block m-auto opacity-0"></span>
                                                <span
                                                    class="text-slate-500 dark:text-slate-400 text-sm leading-6">{{ $item->hobby }}</span>
                                            </label>
                                        </div>
                                    @endforeach

                                </div>

                            </div>

                    </div>
                    <!-- Modal footer -->
                    <div
                        class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                        <button data-bs-dismiss="modal" class="btn inline-flex justify-center text-white bg-black-500"
                            type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                                <th scope="col" class="table-th">NISN</th>
                                <th scope="col" class="table-th">Phone</th>
                                <th scope="col" class="table-th">Hobbies</th>
                                <th scope="col" class="table-th">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                            @foreach ($data as $item)
                                <tr>
                                    <td class="table-td">{{ $loop->index + 1 }}</td>
                                    <td class="table-td">{{ $item->nama }}</td>
                                    <td class="table-td">{{ $item->nisn->nisn }}</td>
                                    <td class="table-td">
                                        <ul>
                                            @foreach ($item->phone as $phone)
                                                <li>- {{ $phone->phone_number }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="table-td">
                                        <ul>
                                            @foreach ($item->hobby as $hobby)
                                                <li>- {{ $hobby->hobby }}</li>
                                            @endforeach
                                        </ul>
                                    </td>

                                    <td class="table-td">
                                        <div class="flex space-x-3 rtl:space-x-reverse">
                                            <button class="action-btn" type="button">
                                                <a href="{{ route('detail', ['id' => $item->id]) }}"><iconify-icon
                                                        icon="heroicons:eye"></iconify-icon></a>
                                            </button>
                                            <button class="action-btn" type="button">
                                                <a href="{{ route('data.edit', ['id' => $item->id]) }}"><iconify-icon
                                                        icon="heroicons:pencil-square"></iconify-icon></a>
                                            </button>
                                            <form action="{{ route('data.delete', ['id' => $item->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <button class="action-btn" type="submit"
                                                    onclick="return confirm('apakah anda yakin?')">
                                                    <iconify-icon icon="heroicons:trash"></iconify-icon>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button id="openModalBtn"
                        class="px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none">
                        Buka Form
                    </button>

                    <!-- Modal -->


                    <script src="{{ asset('js/addInputPhone.js') }}"></script>
                </div>
            </div>
        </div>
    </div>

@endsection
