@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    @if (session('success'))
        <script>
            alert('{{ session('success') }}')
        </script>
    @endif

    <div class="container mx-auto">
        <h1 class="text-xl font-bold">Edit Role: {{ $role->name }}</h1>

        <form action="{{ route('role-permission.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="role_id" value="{{ $role->id }}">

            <div class="mt-4">
                <label for="role" class="form-label">Role</label>
                <input type="text" name="role" id="role" class="form-control" value="{{ $role->name }}"
                    required>
            </div>

            <div class="mt-4">
                <label for="permission" class="form-label">Assign Permissions</label>
                @foreach ($permissionAll as $item)
                    <div class="checkbox-area">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="hidden" value="{{ $item->id }}" name="permission[]"
                                @if ($role->permissions->contains($item->id)) checked @endif>
                            <span
                                class="h-4 w-4 border flex-none border-slate-100 dark:border-slate-800 rounded inline-flex ltr:mr-3 rtl:ml-3 relative transition-all duration-150 bg-slate-100 dark:bg-slate-900">
                                <img src="/assets/images/icon/ck-white.svg" alt=""
                                    class="h-[10px] w-[10px] block m-auto opacity-0">
                            </span>
                            <span class="text-slate-500 dark:text-slate-400 text-sm leading-6">{{ $item->name }}</span>
                        </label>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit" class="btn text-white bg-black-500">Update</button>
            </div>
        </form>
    </div>



    {{-- <div class="card">
        <div class="card-body flex flex-col p-6">
          <header class="flex  items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
            <div class="flex-1">
              <div class="card-title text-slate-900 dark:text-white mb-2 text-center"><span class="text-3xl">Role : <b>Admin</b></span></div>
              <div class="card-title text-slate-900 dark:text-white "><span class="text-lg ">select permission :</span></div>
            </div>
        </header>
        <div class="card-text h-full space-y-4">
            <div class="space-y-5">
              <div class="checkbox-area">
                <label class="inline-flex items-center cursor-pointer">
                  <input type="checkbox" class="hidden" value="Apple" name="arrayCheckbox[]">
                  <span class="h-4 w-4 border flex-none border-slate-100 dark:border-slate-800 rounded inline-flex ltr:mr-3 rtl:ml-3 relative transition-all duration-150 bg-slate-100 dark:bg-slate-900">
                        <img src="assets/images/icon/ck-white.svg" alt="" class="h-[10px] w-[10px] block m-auto opacity-0"></span>
                  <span class="text-slate-500 dark:text-slate-400 text-lg leading-6">Apple</span>
                </label>
              </div>
              <div class="checkbox-area">
                <label class="inline-flex items-center cursor-pointer">
                  <input type="checkbox" class="hidden" value="Banana" name="arrayCheckbox[]">
                  <span class="h-4 w-4 border flex-none border-slate-100 dark:border-slate-800 rounded inline-flex ltr:mr-3 rtl:ml-3 relative transition-all duration-150 bg-slate-100 dark:bg-slate-900">
                        <img src="assets/images/icon/ck-white.svg" alt="" class="h-[10px] w-[10px] block m-auto opacity-0"></span>
                  <span class="text-slate-500 dark:text-slate-400 text-lg leading-6">Banana</span>
                </label>
              </div>
              <div class="checkbox-area">
                <label class="inline-flex items-center cursor-pointer">
                  <input type="checkbox" class="hidden" value="Orange" name="arrayCheckbox[]">
                  <span class="h-4 w-4 border flex-none border-slate-100 dark:border-slate-800 rounded inline-flex ltr:mr-3 rtl:ml-3 relative transition-all duration-150 bg-slate-100 dark:bg-slate-900">
                        <img src="assets/images/icon/ck-white.svg" alt="" class="h-[10px] w-[10px] block m-auto opacity-0"></span>
                  <span class="text-slate-500 dark:text-slate-400 text-lg leading-6">Orange</span>
                </label>
              </div>
            </div>
          </div>
        </div>
      </div> --}}

@endsection
