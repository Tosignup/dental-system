.
@extends('admin.dashboard')
@section('content')
    <div class="m-4">
        @include('components.search')
    </div>
    <section class="bg-white p-8 m-2 shadow-lg rounded-md flex flex-col justify-center z-0  max-lg:mt-14">
        <div class="pb-4">
            <a href=" {{ route('appointment.submission') }} "
                class="flex justify-start font-semibold max-lg:text-xs border-gray-600 py-1 max-lg:px-2 w-max gap-2"><img
                    class="h-6" src="{{ asset('assets/images/arrow-back.png') }}" alt=""> Back</a>
        </div>
        <div class="flex justify-between items-start">
            <div>
                <div class="flex flex-col max-2xl:flex-wrap mb-7 ">
                    <h1 class="text-5xl font-bold max-md:text-3xl mb-4 max-lg:mb-2">
                        {{ $appointment->patient->last_name }}
                        {{ $appointment->patient->first_name }}
                    </h1>
                    <h2 class="text-3xl font-bold max-md:text-2xl mb-2 max-lg:mb-1"> Dr.
                        {{ $appointment->dentist->dentist_last_name }}
                        {{ $appointment->dentist->dentist_first_name }}
                    </h2>
                    <div class="flex flex-col gap-3 text-md max-md:text-xs">
                        <h1 class="max-md:text-xs"> Birth date: <span class="font-semibold">
                                {{ $appointment->patient->date_of_birth }}
                            </span>
                        </h1>
                        <h1 class="max-md:text-xs"> Phone number: <span class="font-semibold">
                                {{ $appointment->patient->phone_number }}
                            </span>
                        </h1>
                        <h1 class="max-md:text-xs"> Email: <span class="font-semibold">
                                {{ $appointment->patient->email }}
                            </span> </h1>
                        <h1 class="max-md:text-xs"> Branch: <span class="font-semibold">
                                {{ $appointment->branch->branch_loc }}
                            </span> </h1>
                        <h1 class="max-md:text-xs"> Appointment date: <span class="font-semibold">
                                {{ $appointment->appointment_date }}
                            </span> </h1>
                        <h1 class="max-md:text-xs"> Preferred time: <span class="font-semibold">
                                {{ $appointment->preferred_time }}
                            </span> </h1>
                        <h1 class="max-md:text-xs"> Notes: <span class="font-semibold"> Wala pa
                                {{ $appointment->notes }}
                            </span> </h1>
                        {{-- <h1 class="max-md:text-xs"> Status: <span class="font-semibold">
                                {{ $appointment->pending }}
                            </span> </h1> --}}
                    </div>
                    <div class="flex gap-4 max-lg:gap-2 justify-start mt-8 items-start w-full">
                        @if ($appointment->pending === 'Approved')
                            <div class="tooltip">
                                <div class="flex gap-3">
                                    <h1 class="font-bold text-green-500">Approved</h1>
                                    <span class="tooltiptext">Approved</span>
                                </div>
                            </div>
                        @elseif($appointment->pending === 'Declined')
                            <div class="tooltip">
                                <div class="flex gap-3">
                                    <h1 class="font-bold text-red-500">Declined</h1>
                                    <span class="tooltiptext">Declined</span>
                                </div>
                            </div>
                        @else
                            <div class="tooltip">
                                <div class="flex gap-3">
                                    <h1 class="font-bold text-slate-500">Pending</h1>
                                    <span class="tooltiptext">Pending</span>
                                </div>
                            </div>
                            {{-- <form method="POST" action="{{ route('appointments.approve', $appointment->id) }}">
                                @csrf
                                <div class="">
                                    <button type="submit"
                                        class="btn btn-success btn-sm flex justify-center font-semibold  border-2 rounded-md border-green-600 px-4 py-2 max-lg:text-xs  max-lg:py-1 max-lg:px-2 items-center w-max gap-2 ">
                                        Approve
                                    </button>
                                </div>
                            </form>
                            <form method="POST" action="{{ route('appointments.decline', $appointment->id) }}">
                                @csrf
                                <div class="">
                                    <button type="submit"
                                        class="btn btn-success btn-sm flex max-lg:text-xs max-lg:py-1 max-lg:px-2 font-semibold justify-center border-2 rounded-md border-red-600 py-2 px-4 items-center w-max gap-2">
                                        Decline
                                    </button>
                                </div>
                            </form> --}}
                    </div>
                    @endif
                </div>
            </div>

    </section>
@endsection
