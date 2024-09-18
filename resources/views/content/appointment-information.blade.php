.
@extends('admin.dashboard')
@section('content')
    <div class="m-4">
        @include('components.search')
    </div>
    <section class="bg-white p-8 m-2 shadow-lg rounded-md flex flex-col justify-center z-0">
        <div class="flex justify-between items-start">
            <div>
                <div class="flex flex-col max-2xl:flex-wrap mb-7 ">
                    <h1 class="text-5xl font-bold max-md:text-3xl mb-8 max-lg:mb-4">
                        SAMPLE TEST NAME
                        {{ $appointment->first_name }}
                        {{ $appointment->last_name }}
                    </h1>

                    <div class="flex flex-col gap-3 text-md max-md:text-xs">
                        <h1 class="max-md:text-xs"> Birth date: <span class="font-semibold">
                                {{ $appointment->date_of_birth }}
                            </span>
                        </h1>
                        <h1 class="max-md:text-xs"> Phone number <span class="font-semibold">
                                {{ $appointment->phone_number }}
                            </span>
                        </h1>
                        <h1 class="max-md:text-xs"> Email: <span class="font-semibold">
                                {{ $appointment->email }}
                            </span> </h1>
                        <h1 class="max-md:text-xs"> Zip code: <span class="font-semibold">
                                {{ $appointment->zip_code }}
                            </span> </h1>
                        <h1 class="max-md:text-xs"> Appointment date: <span class="font-semibold">
                                {{ $appointment->appointment_date }}
                            </span> </h1>
                        <h1 class="max-md:text-xs"> Preferred time: <span class="font-semibold">
                                {{ $appointment->preferred_time }}
                            </span> </h1>
                        <h1 class="max-md:text-xs"> Notes: <span class="font-semibold">
                                {{ $appointment->notes }}
                            </span> </h1>
                        <h1 class="max-md:text-xs"> Branch: <span class="font-semibold">
                                {{ $appointment->branch }}
                            </span> </h1>
                        <h1 class="max-md:text-xs"> Status: <span class="font-semibold">
                                {{ $appointment->status }}
                            </span> </h1>
                    </div>
                    <div class="flex gap-4 max-lg:gap-2 justify-start mt-8 items-start w-full">
                        @if ($appointment->status === 'approved')
                            <form method="POST" action="{{ route('appointments.approve', $appointment->id) }}">
                                @csrf
                                <div class="tooltip">
                                    <button type="submit" class="btn btn-success btn-sm" disabled>
                                        <img src="{{ asset('assets/images/accept.png') }}" alt="">
                                        <span class="tooltiptext">Approved</span>
                                    </button>
                                </div>
                            </form>
                        @elseif($appointment->status === 'declined')
                            <form method="POST" action="{{ route('appointments.decline', $appointment->id) }}">
                                @csrf
                                <div class="tooltip">
                                    <button type="submit" class="btn btn-danger btn-sm" disabled>
                                        <img src="{{ asset('assets/images/decline.png') }}" alt="">
                                        <span class="tooltiptext">Declined</span>
                                    </button>
                                </div>
                            </form>
                        @else
                            <form method="POST" action="{{ route('appointments.approve', $appointment->id) }}">
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
                            </form>
                            <a class=" btn btn-success btn-sm flex justify-center font-semibold max-lg:text-xs border-2 rounded-md border-gray-600 py-2 px-4 max-lg:py-1 max-lg:px-2 items-center w-max gap-2""
                                href=" {{ route('appointment.submission') }} ">
                                <h1 class="max-md:text-xs max-2xl:text-sm w-max">Go back</h1>
                            </a>

                    </div>
                    @endif
                </div>
            </div>

    </section>
@endsection
