@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    @if (session('success'))
        <script>
            alert('{{ session('success') }}')
        </script>
    @endif

    <div class="mb-3">
        <button data-bs-toggle="modal" data-bs-target="#default_modal"
            class="btn inline-flex justify-center btn-outline-dark capitalize">Add Role</button>
    </div>
    <table class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700 ">
        <thead class="bg-slate-200 dark:bg-slate-700">
            <tr>
                <th scope="col" class="table-th ">
                    ROLE
                </th>
                <th scope="col" class="table-th ">
                    GUARD
                </th>
                <th scope="col" class="table-th ">
                    PERMISSION
                </th>

                <th scope="col" class="table-th ">
                    ACTION
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">



            @foreach ($role as $item)
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
                        {{ $item->guard_name }}
                    </td>
                    <td class="table-td">
                        <ul>
                            @foreach ($item->permissions->take(5) as $permission)
                                <li>{{ $permission->name }}</li>
                            @endforeach
                        </ul>

                        @if ($item->permissions->count() > 5)
                            <button class="text-blue-500" style="color: rgb(68, 142, 253)"
                                id="more-button-{{ $item->id }}"
                                onclick="showAllPermissions({{ $item->id }})">More...</button>
                        @endif

                        <ul id="all-permissions-{{ $item->id }}" style="display: none;">
                            @foreach ($item->permissions as $permission)
                                <li>{{ $permission->name }}</li>
                            @endforeach
                        </ul>
                    </td>

                    <script>
                        function showAllPermissions(itemId) {
                            document.getElementById("all-permissions-" + itemId).style.display = "block";
                            document.getElementById("more-button-" + itemId).style.display = "none";
                        }
                    </script>


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
                                        <a href="{{ route('role-permission.edit', $item->id) }}">
                                            <button
                                                class="hover:bg-slate-900 dark:hover:bg-slate-600 dark:hover:bg-opacity-70 hover:text-white w-full border-b border-b-gray-500 border-opacity-10 px-4 py-2 text-sm dark:text-slate-300 last:mb-0 cursor-pointer first:rounded-t last:rounded-b flex space-x-2 items-center capitalize rtl:space-x-reverse">
                                                <iconify-icon icon="clarity:note-edit-line"></iconify-icon>
                                                <span>Edit</span>
                                            </button>
                                        </a>

                                    </li>
                                    <li>
                                        <form action="{{ route('role.delete', ['id' => $item->id]) }}" method="POST">
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


    {{-- Modal untuk Tambah --}}
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
                            Default Modal
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
                        <form action="{{ route('role.post') }}" method="POST">
                            @csrf

                            <div class="input-area relative">
                                <label for="role" class="form-label">Role</label>
                                <input type="text" name="role" class="form-control" placeholder="role" required>
                            </div>

                            <div class="card-text h-full space-y-4 mt-4">
                                <div class="space-y-3">

                                    <label for="permission" class="form-label">Add Permission</label>
                                    @foreach ($permissionAll as $index => $item)
                                        <div class="checkbox-area">
                                            <label class="inline-flex items-center cursor-pointer">
                                                <input type="checkbox" class="hidden" value="{{ $item->id }}"
                                                    name="permission[]">
                                                <span
                                                    class="h-4 w-4 border flex-none border-slate-100 dark:border-slate-800 rounded inline-flex ltr:mr-3 rtl:ml-3 relative transition-all duration-150 bg-slate-100 dark:bg-slate-900">
                                                    <img src="/assets/images/icon/ck-white.svg" alt=""
                                                        class="h-[10px] w-[10px] block m-auto opacity-0"></span>
                                                <span
                                                    class="text-slate-500 dark:text-slate-400 text-sm leading-6">{{ $item->name }}</span>
                                            </label>
                                        </div>

                                        @if (($index + 1) % 5 == 0)
                                            <br>
                                        @endif
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



    {{-- Modal untuk Update --}}
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
        id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
        <div class="modal-dialog relative w-auto pointer-events-none">
            <div
                class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                        <h3 class="text-xl font-medium text-white dark:text-white capitalize">
                            Edit Role
                        </h3>
                        <button type="button"
                            class="text-slate-400 bg-transparent hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-slate-600 dark:hover:text-white"
                            data-bs-dismiss="modal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="#ffffff" viewbox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-4">
                        <form action="{{ route('role.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="role-id" name="role_id">
                            <div class="input-area relative">
                                <label for="role" class="form-label">Role</label>
                                <input type="text" id="role-name" name="role" class="form-control"
                                    placeholder="Role" required>
                            </div>
                            <div class="card-text h-full space-y-4 mt-4">
                                <div class="space-y-3">
                                    <label for="permission" class="form-label">Add Permission</label>
                                    @foreach ($permissionAll as $index => $item)
                                        <div class="checkbox-area">
                                            <label class="inline-flex items-center cursor-pointer">
                                                <input type="checkbox" class="hidden" value="{{ $item->id }}"
                                                    name="permission[]" id="permission-{{ $item->id }}">
                                                <span
                                                    class="h-4 w-4 border flex-none border-slate-100 dark:border-slate-800 rounded inline-flex ltr:mr-3 rtl:ml-3 relative transition-all duration-150 bg-slate-100 dark:bg-slate-900">
                                                    <img src="/assets/images/icon/ck-white.svg" alt=""
                                                        class="h-[10px] w-[10px] block m-auto opacity-0">
                                                </span>
                                                <span
                                                    class="text-slate-500 dark:text-slate-400 text-sm leading-6">{{ $item->name }}</span>
                                            </label>
                                        </div>

                                        @if (($index + 1) % 5 == 0)
                                            <br>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div
                                class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                                <button type="submit"
                                    class="btn inline-flex justify-center text-white bg-black-500">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('[data-bs-toggle="modal"][data-bs-target="#editModal"]');

            editButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    const roleId = button.getAttribute('data-id');
                    const roleName = button.getAttribute('data-name');
                    const permissions = JSON.parse(button.getAttribute('data-permissions'));

                    document.getElementById('role-id').value = roleId;
                    document.getElementById('role-name').value = roleName;

                    const checkboxes = document.querySelectorAll('input[name="permission[]"]');
                    checkboxes.forEach(function(checkbox) {
                        checkbox.checked = false;
                    });

                    permissions.forEach(function(permissionId) {
                        const checkbox = document.getElementById('permission-' +
                            permissionId);
                        if (checkbox) {
                            checkbox.checked = true;
                        }
                    });
                });
            });
        });
    </script>

@endsection
