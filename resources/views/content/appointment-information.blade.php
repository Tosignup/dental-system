.
@extends('admin.dashboard')
@section('content')
    <div class="m-4">
        @include('components.search')
    </div>
    <section class="bg-white p-8 m-2 shadow-lg rounded-md flex flex-col justify-center z-0">
        <div class="flex justify-between items-start">
            <div>
                <div class="flex flex-col mb-7">
                    <h1 class="text-5xl font-bold max-md:text-3xl">
                        SAMPLE TEST NAME
                        {{ $appointment->first_name }}
                        {{ $appointment->last_name }}
                    </h1>
                    <div class="flex flex-col gap-4 my-4 rounded-md">
                        <details class="dropdown">
                            <summary class="btn my-2 border rounded-md py-1 px-2 text-xs">Actions</summary>
                            <ul
                                class="menu dropdown-content bg-base-100 rounded-box z-[1] w-52 p-2 shadow my-4 rounded-md  flex flex-col gap-2">
                                <li><a class=" flex items-center justify-start gap-2 py-2 px-4 border border-gray-500 rounded-md hover:border-gray-700 hover:shadow-sm transition-all"
                                        href=" {{ route('appointment.submission') }} ">
                                        <img class="h-8 max-md:h-4" src="{{ asset('assets/images/back-icon.png') }}"
                                            alt="">
                                        <h1 class="max-md:text-xs">Go back to patient list</h1>
                                    </a></li>
                                <li>
                                    <a href=""
                                        class=" flex items-center justify-start gap-2 py-2 px-4 border border-gray-500 rounded-md hover:border-gray-700 hover:shadow-sm transition-all">
                                        <img class="h-8 max-md:h-4" src="{{ asset('assets/images/edit-icon.png') }}"
                                            alt="Edit icon">
                                        <h1 class="max-md:text-xs">
                                            Edit appointment</h1>
                                    </a>
                                </li>
                            </ul>
                        </details>
                    </div>


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
                    <div class="flex gap-2 justify-start mt-4 items-center ">
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
                                        class="btn btn-success btn-sm flex justify-center font-semibold text-xs border-2 rounded-md border-green-600 py-1 px-2 items-center w-max gap-2">
                                        Approve
                                    </button>
                                </div>
                            </form>
                            <form method="POST" action="{{ route('appointments.decline', $appointment->id) }}">
                                @csrf
                                <div class="">
                                    <button type="submit"
                                        class="btn btn-success btn-sm flex text-xs font-semibold justify-center border-2 rounded-md border-red-600 py-1 px-2 items-center w-max gap-2">

                                        Decline
                                    </button>
                                </div>
                            </form>
                    </div>
                    @endif
                </div>

                <a class="max-lg:hidden flex items-center justify-start gap-2 py-2 px-4 border border-gray-500 rounded-md hover:border-gray-700 hover:shadow-sm transition-all"
                    href=" {{ route('appointment.submission') }} ">
                    <img class="h-8" src="{{ asset('assets/images/arrow-back.png') }}" alt="">
                    <h1>
                        Go back to schedule list</h1>
                </a>


            </div>

    </section>
@endsection
