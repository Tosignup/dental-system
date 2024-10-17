@extends('admin.dashboard')
@section('content')
    <div class="m-4">
        @include('components.search')
    </div>
    <section class="bg-white max-lg:mt-14 m-4 p-8 shadow-lg rounded-md flex flex-wrap justify-between z-0">
        <div class="flex w-full max-lg:flex-col flex-wrap justify-between items-start">
            <div class="flex w-full flex-wrap justify-between items-start">
                <div class="flex flex-wrap justify-between mb-6 gap-4 items-start ">
                    <div class="flex flex-col">
                        <div class="pb-4">
                            <a href="{{ route('schedule') }}"
                                class="flex justify-start font-semibold max-lg:text-xs border-gray-600 py-1 max-lg:px-2 w-max gap-2"><img
                                    class="h-6" src="{{ asset('assets/images/arrow-back.png') }}" alt=""> Back</a>
                        </div>
                        <div>
                            <h1 class="text-5xl mb-4 font-bold max-md:text-3xl">{{ $staff->first_name }}
                                {{ $staff->last_name }}
                            </h1>
                            <div class="flex flex-col justify-start items-start gap-3 text-md mb-5">
                                <h1 class=" max-md:text-sm"> Gender: <span class="font-semibold">
                                        {{ $staff->gender }}
                                    </span>
                                </h1>
                                <h1 class=" max-md:text-sm"> Facebook name: <span class="font-semibold">
                                        {{ $staff->fb_name }}
                                    </span>
                                </h1>
                                <h1 class=" max-md:text-sm"> Phone number: <span class="font-semibold">
                                        {{ $staff->phone_number }}
                                    </span> </h1>
                                <h1 class=" max-md:text-sm"> Branch: <span class="font-semibold">
                                        {{ $staff->branch->branch_loc }}
                                    </span> </h1>
                            </div>
                            <a class="flex justify-center gap-3 items-center border border-slate-600 rounded-md py-2 px-4 max-md:py-1 max-md:px-2 text-white font-semibold hover:bg-gray-400 transition-all w-max"
                                href=" {{ route('edit.staff', $staff->id) }} ">
                                <img class="h-7 sm:h-4 sm:w-4 max-sm:h-4 max-sm:w-4"
                                    src="{{ asset('assets/images/edit-icon.png') }}" alt="">
                                <h1 class="text-slate-900 max-md:hidden">Edit information</h1>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
