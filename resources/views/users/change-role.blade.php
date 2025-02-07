@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    @if (session('success'))
        <script>
            alert('{{ session('success') }}')
        </script>
    @endif
    @if (session('error'))
        <script>
            alert('{{ session('error') }}')
        </script>
    @endif

    <div class="card">
    <div class="card-body flex flex-col p-6">
        <header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
            <div class="flex-1">
                <div class="card-title text-slate-900 dark:text-white">Select Role for {{$user->name}}</div>
            </div>
        </header>
        <form method="POST" action="{{ route('users.update-role', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="card-text h-full space-y-4">
                <div class="space-y-2">
                    @foreach($roles as $role)
                        <div class="secondary-radio">
                            <label class="flex items-center cursor-pointer">
                                <input 
                                    type="radio" 
                                    class="hidden" 
                                    name="role" 
                                    value="{{ $role->id }}"
                                    @if(in_array($role->id, $roleUser)) checked @endif
                                >
                                <span class="flex-none bg-white dark:bg-slate-500 rounded-full border inline-flex ltr:mr-2 rtl:ml-2 relative transition-all duration-150 h-[16px] w-[16px] border-slate-400 dark:border-slate-600 dark:ring-slate-700"></span>
                                <span class="text-slate-900 font-Inter font-normal text-sm leading-6 capitalize dark:text-slate-300">{{ $role->name }}</span>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-4">Update Role</button>
        </form>
    </div>
</div>

<script>
    // Optional: Display the selected role on the page dynamically (if needed)
    document.querySelectorAll('input[name="role"]').forEach((input) => {
        input.addEventListener('change', () => {
            document.getElementById('radioSelectedItems').textContent = input.nextElementSibling.textContent;
        });
    });
</script>

@endsection