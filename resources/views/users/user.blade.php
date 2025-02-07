@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    @if (session('success'))
        <script>
            alert('{{ session('success') }}')
        </script>
    @endif

    <table class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700 ">
        <thead class="bg-slate-200 dark:bg-slate-700">
            <tr>
                <th scope="col" class="table-th ">
                    NAME
                </th>
                <th scope="col" class="table-th ">
                    ROLE
                </th>

                <th scope="col" class="table-th ">
                    ACTION
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">

            @foreach ($users as $item)
                <tr class="even:bg-slate-50 dark:even:bg-slate-700">
                    <td class="table-td">
                        <div class="flex space-x-3 items-center text-left rtl:space-x-reverse">
                            <div class="flex-none">
                                <div
                                    class="h-10 w-10 rounded-full text-sm bg-[#E0EAFF] dark:bg-slate-700 flex flex-col items-center justify-center font-medium -tracking-[1px]">
                                    Ma
                                </div>
                            </div>
                            <div class="flex-1 font-medium text-sm leading-4 whitespace-nowrap">
                                {{ $item->name }}
                            </div>
                        </div>
                    </td>

                    <td class="table-td">
                        @foreach ($item->roles as $role)
                        {{ $role->name }} <br>
                    @endforeach
                    
                    </td>
                    <td class="table-td">
                        @if ($item->id == 1)
                        @else
                            <div class="dropstart relative">
                                <button class="inline-flex justify-center items-center" type="button"
                                    id="tableDropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <iconify-icon class="text-xl ltr:ml-2 rtl:mr-2"
                                        icon="heroicons-outline:dots-vertical"></iconify-icon>
                                </button>
                                <ul
                                    class="dropdown-menu min-w-max absolute text-sm text-slate-700 dark:text-white hidden bg-white dark:bg-slate-700 shadow z-[2] float-left overflow-hidden list-none text-left rounded-lg mt-1 m-0 bg-clip-padding border-none">

                                    <li>
                                        <a href="{{ route('user-role.edit', ['id' => $item->id]) }}"
                                        class="hover:bg-slate-900 dark:hover:bg-slate-600 dark:hover:bg-opacity-70 hover:text-white w-full border-b border-b-gray-500 border-opacity-10 px-4 py-2 text-sm dark:text-slate-300 last:mb-0 cursor-pointer first:rounded-t last:rounded-b flex space-x-2 items-center capitalize rtl:space-x-reverse">
                                        <iconify-icon icon="clarity:note-edit-line"></iconify-icon>
                                        <span>Edit Role</span></a>

                                       
                                    </li>
                                    <li>
                                        <form action="{{ route('user.delete', ['id' => $item->id]) }}" method="post">
                                            @csrf
                                            @method('delete')
                                        <button type="submit" onclick="return confirm('apakah anda yakin?')"
                                            class="hover:bg-slate-900 dark:hover:bg-slate-600 dark:hover:bg-opacity-70 hover:text-white w-full border-b border-b-gray-500 border-opacity-10 px-4 py-2 text-sm dark:text-slate-300 last:mb-0 cursor-pointer first:rounded-t last:rounded-b flex space-x-2 items-center capitalize rtl:space-x-reverse">
                                            <iconify-icon icon="fluent:delete-28-regular"></iconify-icon>
                                            <span>Delete</span></button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endif

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</script>




    
    
    



@endsection
