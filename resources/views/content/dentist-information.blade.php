@extends('admin.dashboard')
@section('content')
    <div class="m-4">
        @include('components.search')
    </div>
    <section class="bg-white max-lg:mt-14 m-4 p-8 shadow-lg rounded-md flex flex-wrap justify-between z-0">
        <div class="flex border w-full max-lg:flex-col flex-wrap justify-between items-start">
            <div class="flex w-full flex-wrap justify-between items-start border border-red-600">
                <div class="flex flex-wrap justify-between mb-6 gap-4 items-start ">
                    <div class="flex flex-col">
                        <div>
                            <h1 class="text-5xl mb-4 font-bold max-md:text-3xl">{{ $dentist->dentist_first_name }}
                                {{ $dentist->dentist_last_name }}
                            </h1>
                            <div class="flex flex-col justify-start items-start gap-3 text-md mb-5">
                                <h1 class=" max-md:text-sm"> Gender: <span class="font-semibold">
                                        {{ $dentist->dentist_gender }}
                                    </span>
                                </h1>
                                <h1 class=" max-md:text-sm"> Birth date: <span class="font-semibold">
                                        {{ $dentist->dentist_birth_date }}
                                    </span>
                                </h1>
                                <h1 class=" max-md:text-sm"> Facebook name: <span class="font-semibold">
                                        {{ $dentist->fb_name }}
                                    </span>
                                </h1>
                                <h1 class=" max-md:text-sm"> Package availed: <span class="font-semibold">
                                        {{ $dentist->package }}
                                    </span> </h1>
                                <h1 class=" max-md:text-sm"> Phone number: <span class="font-semibold">
                                        {{ $dentist->dentist_phone_number }}
                                    </span> </h1>
                            </div>
                            <a class="flex justify-center gap-3 items-center border border-slate-600 rounded-md py-2 px-4 max-md:py-1 max-md:px-2 text-white font-semibold hover:bg-gray-400 transition-all w-max"
                                href=" {{ route('edit.dentist', $dentist->id) }} ">
                                <img class="h-7 sm:h-4 sm:w-4 max-sm:h-4 max-sm:w-4"
                                    src="{{ asset('assets/images/edit-icon.png') }}" alt="">
                                <h1 class="text-slate-900 max-md:hidden">Edit information</h1>
                            </a>
                        </div>
                    </div>


                </div>
            </div>
    </section>
@endsection
