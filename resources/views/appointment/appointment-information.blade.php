@extends('admin.dashboard')
@section('content')
    <div class="m-4">
        @include('components.search')
    </div>
    <section class="bg-white p-8 m-2 shadow-lg rounded-md flex flex-col justify-center z-0  max-lg:mt-14">
        <div class="pb-4">
            <a @if ($appointment->is_online === 0) href=" {{ route('appointments.walkIn') }} " @elseif ($appointment->is_online === 1) href=" {{ route('appointments.online') }}" @endif
                class="flex justify-start font-semibold max-lg:text-xs border-gray-600 py-1 max-lg:px-2 w-max gap-2"><img
                    class="h-6" src="{{ asset('assets/images/arrow-back.png') }}" alt=""> Back</a>
        </div>
        <div class="flex justify-around border border-green-500 p-2 max-sm:flex-col">
            <div class="flex flex-col max-2xl:flex-wrap border border-red-500 p-2 max-md:mb-4">
                <h1 class="text-2xl font-bold max-md:text-3xl mb-4 max-lg:mb-2">
                    Appointment Information
                </h1>
                <div class="flex flex-col gap-2 max-md:gap-1 text-md max-md:text-xs">
                    <h1 class="max-md:text-xs"> Patient: <span class="font-semibold">
                            {{ $appointment->patient->last_name }}
                            {{ $appointment->patient->first_name }}
                        </span>
                    </h1>
                    <h1 class="max-md:text-xs"> Dentist: <span class="font-semibold">
                            Dr. {{ $appointment->dentist->dentist_last_name }}
                            {{ $appointment->dentist->dentist_first_name }}
                        </span>
                    </h1>
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

                <div class="flex flex-col max-2xl:flex-wrap text-lg mt-5 max-md:mt-2">
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
                    @endif
                </div>
            </div>
            <div class="flex flex-col justify-between max-2xl:flex-wrap border border-red-500 p-2 max-md:mb-4">

                <h1 class="text-2xl font-bold max-md:text-3xl mb-4 max-lg:mb-2">
                    Payment Information
                </h1>
                <div class="flex flex-col gap-2 max-md:gap-1 text-md max-md:text-xs">
                    <h4 class="max-md:text-xs"> Procedure: <span class="font-semibold">
                            {{ $appointment->procedure->name }}</span> </h4>
                    <h4 class="max-md:text-xs"> Appointment Date: <span class="font-semibold">
                            {{ $appointment->appointment_date }}</span> </h4>
                    <h4 class="max-md:text-xs"> Total Amount Due: <span class="font-semibold">&#8369
                            {{ number_format($appointment->procedure->price, 2) }}</span></h4>
                    <h4 class="max-md:text-xs">
                        Status:
                        <span class="font-semibold">
                            @if (is_null($appointment->payment) || $appointment->payment->status === null)
                                No payment status yet
                            @else
                                {{ $appointment->payment->status }}
                            @endif
                        </span>
                    </h4>

                </div>
                <div>
                    @if ($appointment->pending === 'Pending')
                        <h1 class="text-xl font-bold max-md:text-3xl mb-4 max-lg:mb-2">Wait to be approved</h1>
                    @elseif ($appointment->pending === 'Declined')
                        <h1 class="text-xl font-bold max-md:text-3xl mb-4 max-lg:mb-2">Appointment has been declined</h1>
                    @else
                        <a href="{{ route('payments.form', $appointment->id) }}"
                            class=" flex items-center justify-start gap-2 py-2 px-4 my-2 border border-gray-500 rounded-md hover:border-gray-700 hover:shadow-sm transition-all max-sm:justify-center">
                            <img class="h-8 max-lg:h-4" src="{{ asset('assets/images/payment.png') }}" alt="">
                            <h1 class="max-lg:text-xs">
                                Add payment</h1>
                        </a>
                        <a href="{{ route('payments.history', $appointment->id) }}"
                            class=" flex items-center justify-start gap-2 py-2 px-4 my-2 border border-gray-500 rounded-md hover:border-gray-700 hover:shadow-sm transition-all max-sm:justify-center">
                            <img class="h-8 max-lg:h-4" src="{{ asset('assets/images/payment.png') }}" alt="">
                            <h1 class="max-lg:text-xs">
                                Payment history</h1>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
