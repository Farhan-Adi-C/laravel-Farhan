@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    @if (session('success'))
        <script>
            alert('{{ session('success') }}')
        </script>
    @endif

    <div class="card">
        <div class="card-body flex flex-col p-6">
            <header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                <div class="flex-1">
                    <div class="card-title text-slate-900 dark:text-white">Array Radio Button</div>
                </div>
            </header>
            <div class="card-text h-full space-y-4">
                <div class="space-y-2">
                    <div class="secondary-radio">
                        <label class="flex items-center cursor-pointer  ">
                            <input type="radio" class="hidden" name="arrayRadio[]" value="Apple">
                            <span
                                class="flex-none bg-white dark:bg-slate-500 rounded-full border inline-flex ltr:mr-2 rtl:ml-2 relative transition-all
                                                duration-150 h-[16px] w-[16px] border-slate-400 dark:border-slate-600 dark:ring-slate-700"></span>
                            <span
                                class="text-slate-900 font-Inter font-normal text-sm leading-6 capitalize dark:text-slate-300">Apple</span>
                        </label>
                    </div>
                    <div class="secondary-radio">
                        <label class="flex items-center cursor-pointer  ">
                            <input type="radio" class="hidden" name="arrayRadio[]" value="Banana">
                            <span
                                class="flex-none bg-white dark:bg-slate-500 rounded-full border inline-flex ltr:mr-2 rtl:ml-2 relative transition-all
                                                    duration-150 h-[16px] w-[16px] border-slate-400 dark:border-slate-600 dark:ring-slate-700"></span>
                            <span
                                class="text-slate-900 font-Inter font-normal text-sm leading-6 capitalize dark:text-slate-300">Banana</span>
                        </label>
                    </div>
                    <div class="secondary-radio">
                        <label class="flex items-center cursor-pointer  ">
                            <input type="radio" class="hidden" name="arrayRadio[]" value="Orange">
                            <span
                                class="flex-none bg-white dark:bg-slate-500 rounded-full border inline-flex ltr:mr-2 rtl:ml-2 relative transition-all
                                                        duration-150 h-[16px] w-[16px] border-slate-400 dark:border-slate-600 dark:ring-slate-700"></span>
                            <span
                                class="text-slate-900 font-Inter font-normal text-sm leading-6 capitalize dark:text-slate-300">Orange</span>
                        </label>
                    </div>
                </div>
                <p>Selected Items: [<span id="radioSelectedItems"></span>]
                </p>
            </div>
        </div>
    </div>
@endsection
