@extends('admin.dashboard')
@section('content')
    <div class="m-4">
        @include('components.search')
    </div>
    <section class="bg-white m-4 p-8 shadow-lg rounded-md flex flex-col justify-center z-0">
        <div class="flex justify-between items-start">
            <div>
                <div class="flex flex-col mb-7">
                    <h1 class="text-5xl font-bold max-md:text-3xl">{{ $patient->first_name }} {{ $patient->last_name }}
                    </h1>
                    <div class="flex flex-col gap-4">
                        <details class="dropdown">
                            <summary class="btn my-2 border rounded-md py-1 px-2 text-xs">Actions</summary>
                            <ul
                                class="menu dropdown-content bg-base-100 rounded-box z-[1] w-52 p-2 shadow  flex flex-col gap-2">
                                <li><a class=" flex items-center justify-start gap-2 py-2 px-4 border border-gray-500 rounded-md hover:border-gray-700 hover:shadow-sm transition-all"
                                        href=" {{ route('patient_list') }} ">
                                        <img class="h-8 max-md:h-4" src="{{ asset('assets/images/back-icon.png') }}"
                                            alt="">
                                        <h1 class="max-md:text-xs">Go back to patient list</h1>
                                    </a></li>
                                <li>
                                    <a href="{{ route('edit.patient', $patient->id) }}"
                                        class=" flex items-center justify-start gap-2 py-2 px-4 border border-gray-500 rounded-md hover:border-gray-700 hover:shadow-sm transition-all">
                                        <img class="h-8 max-md:h-4" src="{{ asset('assets/images/edit-icon.png') }}"
                                            alt="Edit icon">
                                        <h1 class="max-md:text-xs">
                                            Edit information</h1>
                                    </a>
                                </li>
                                <li>
                                    <a href=""
                                        class="flex items-center justify-start gap-2 py-2 px-4 border border-gray-500 rounded-md hover:border-gray-700 hover:shadow-sm transition-all">
                                        <img class="h-8 max-md:h-4" src="{{ asset('assets/images/contract.png') }}"
                                            alt="">
                                        <h1 class="max-md:text-xs">
                                            Contract</h1>
                                    </a>
                                </li>
                                <li>
                                    <a href=""
                                        class=" flex items-center justify-start gap-2 py-2 px-4 border border-gray-500 rounded-md hover:border-gray-700 hover:shadow-sm transition-all">
                                        <img class="h-8 max-md:h-4" src="{{ asset('assets/images/background.png') }}"
                                            alt="">
                                        <h1 class="max-md:text-xs">
                                            Background</h1>
                                    </a>
                                </li>
                                <li>
                                    <a href=""
                                        class=" flex items-center justify-start gap-2 py-2 px-4 border border-gray-500 rounded-md hover:border-gray-700 hover:shadow-sm transition-all">
                                        <img class="h-8 max-md:h-4" src="{{ asset('assets/images/x-ray.png') }}"
                                            alt="">
                                        <h1 class="max-md:text-xs">
                                            X-rays</h1>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('add.payment', $patient->id) }}"
                                        class=" flex items-center justify-start gap-2 py-2 px-4 border border-gray-500 rounded-md hover:border-gray-700 hover:shadow-sm transition-all">
                                        <img class="h-8 max-md:h-4" src="{{ asset('assets/images/payment.png') }}"
                                            alt="">
                                        <h1 class="max-md:text-xs">
                                            Add payment</h1>
                                    </a>
                                </li>
                            </ul>
                        </details>
                    </div>
                </div>

                <div class="flex flex-col gap-3 text-md">
                    <h1 class="max-md:text-sm"> Gender: <span class="font-semibold"> {{ $patient->gender }} </span> </h1>
                    <h1 class="max-md:text-sm"> Birth date: <span class="font-semibold"> {{ $patient->date_of_birth }}
                        </span>
                    </h1>
                    <h1 class="max-md:text-sm"> Facebook name: <span class="font-semibold"> {{ $patient->fb_name }} </span>
                    </h1>
                    <h1 class="max-md:text-sm"> Package availed: <span class="font-semibold"> {{ $patient->package }}
                        </span> </h1>
                    <h1 class="max-md:text-sm"> Phone number: <span class="font-semibold"> {{ $patient->phone_number }}
                        </span> </h1>
                    <h1 class="max-md:text-sm"> Date of next visit: <span class="font-semibold"> {{ $patient->next_visit }}
                        </span> </h1>
                </div>
            </div>
            <div class="flex flex-col gap-4 max-lg:hidden">
                <a class=" flex items-center justify-start gap-2 py-2 px-4 border border-gray-500 rounded-md hover:border-gray-700 hover:shadow-sm transition-all"
                    href=" {{ route('patient_list') }} ">
                    <img class="h-8" src="{{ asset('assets/images/arrow-back.png') }}" alt="">
                    <h1>
                        Go back to patient list</h1>
                </a>
                <a href="{{ route('edit.patient', $patient->id) }}"
                    class=" flex items-center justify-start gap-2 py-2 px-4 border border-gray-500 rounded-md hover:border-gray-700 hover:shadow-sm transition-all">
                    <img class="h-8 " src="{{ asset('assets/images/edit-icon.png') }}" alt="Edit icon">
                    <h1>
                        Edit information</h1>
                </a>
                <a href=""
                    class="flex items-center justify-start gap-2 py-2 px-4 border border-gray-500 rounded-md hover:border-gray-700 hover:shadow-sm transition-all">
                    <img class="h-8" src="{{ asset('assets/images/contract.png') }}" alt="">
                    <h1>
                        Contract</h1>
                </a>
                <a href=""
                    class=" flex items-center justify-start gap-2 py-2 px-4 border border-gray-500 rounded-md hover:border-gray-700 hover:shadow-sm transition-all">
                    <img class="h-8" src="{{ asset('assets/images/background.png') }}" alt="">
                    <h1>
                        Background</h1>
                </a>
                <a href=""
                    class=" flex items-center justify-start gap-2 py-2 px-4 border border-gray-500 rounded-md hover:border-gray-700 hover:shadow-sm transition-all">
                    <img class="h-8" src="{{ asset('assets/images/x-ray.png') }}" alt="">
                    <h1>
                        X-rays</h1>
                </a>
                <a href="{{ route('add.payment', $patient->id) }}"
                    class=" flex items-center justify-start gap-2 py-2 px-4 border border-gray-500 rounded-md hover:border-gray-700 hover:shadow-sm transition-all">
                    <img class="h-8" src="{{ asset('assets/images/payment.png') }}" alt="">
                    <h1>
                        Add payment</h1>
                </a>
            </div>
        </div>

    </section>
@endsection
