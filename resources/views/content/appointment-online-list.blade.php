@extends('admin.dashboard')
@section('content')
    <div class="m-4 mb-8">
        @include('components.search')
    </div>
    <section class=" m-4 p-4 bg-white shadow-lg rounded-md max-lg:mt-14">
        <div class="flex items-start pt-3 pb-6 max-lg:flex-wrap gap-4 max-md:gap-2 max-md:pt-1 max-md:pb-3">
            <label class="flex items-center" for="time">
                <h1 class="font-bold text-3xl mr-4 max-md:mr-0 max-md:text-2xl">Online Request</h1>
                <div>
                    <form id="appointment-form" method="GET" action="{{ route('appointments.online') }}"
                        class="flex max-lg:text-xs gap-1 items-center max-lg:m-1">
                        <h1 class="font-semibold">Sort by: </h1>
                        <select name="sortOnline" id="sortOnline"
                            class="border text-sm w-auto border-gray-400 pr-6 mx-2 rounded-md max-lg:text-xs">
                            <option value="created_at" {{ request()->get('sortOnline') == 'created_at' ? 'selected' : '' }}>
                                Date Submitted</option>
                            <option value="preferred_time"
                                {{ request()->get('sortOnline') == 'preferred_time' ? 'selected' : '' }}>Appointment Time
                            </option>
                            <option value="appointment_date"
                                {{ request()->get('sortOnline') == 'appointment_date' ? 'selected' : '' }}>Appointment Date
                            </option>
                            <option value="branch" {{ request()->get('sortOnline') == 'branch' ? 'selected' : '' }}>Branch
                            </option>
                            <option value="status" {{ request()->get('sortOnline') == 'status' ? 'selected' : '' }}>Status
                            </option>
                        </select>
                    </form>
                </div>
            </label>
        </div>
        <table class="w-full table-auto text-center">
            <thead>
                <tr class="">
                    <th class="max-lg:py-2 max-lg:px-2 border max-lg:text-xs">Patient</th>
                    <th class="max-lg:py-2 max-lg:px-2 border max-lg:text-xs">Date Submitted</th>
                    <th class="py-2 px-4 max-lg:py-2 max-lg:px-2 border max-lg:text-xs">Appointment Date</th>
                    <th class="py-2 px-4 max-lg:py-2 max-lg:px-2 border max-lg:text-xs max-2xl:hidden">Preferred
                        time
                    </th>
                    <th class="py-2 px-4 max-lg:py-2 max-lg:px-2 border max-lg:text-xs max-2xl:hidden">Branch</th>
                    <th class="py-2 px-4 max-lg:py-2 max-lg:px-2 border max-lg:text-xs">Status</th>
                    <th class="py-2 px-4 max-lg:py-2 max-lg:px-2 border max-lg:text-xs">Actions</th>
                </tr>
            </thead>
            {{-- testing --}}

            {{-- testing --}}
            <tbody>
                @foreach ($online_appointments as $appointment)
                    <tr class="text-center">
                        <td class=" max-lg:py-2 max-lg:px-2 border text-black max-lg:text-xs">
                            <span class="max-lg:hidden">{{ $appointment->patient->first_name }}</span>
                            {{ $appointment->patient->last_name }}
                        </td>
                        <td class=" max-lg:py-2 max-lg:px-2 border max-lg:text-xs ">
                            {{ $appointment->created_at }}
                        </td>
                        <td class=" max-lg:py-2 max-lg:px-2 border max-lg:text-xs ">
                            {{ $appointment->appointment_date }}</td>
                        <td class=" max-lg:py-2 max-lg:px-2 border max-lg:text-xs max-2xl:hidden">

                            {{ $appointment->preferred_time }}</td>
                        <td class=" max-lg:py-2 max-lg:px-2 border max-lg:text-xs max-2xl:hidden">

                            {{ $appointment->branch->branch_loc }}</td>
                        <td class="border px-4 py-2 min-w-max h-full max-lg:text-xs ">
                            @if ($appointment->pending === 'Approved')
                                <h1 class="text-md text-green-600 font-semibold">Approved</h1>
                            @elseif ($appointment->pending === 'Declined')
                                <h1 class="text-md text-red-600 font-semibold">Declined</h1>
                            @else
                                <h1 class="text-md text-slate-600 font-semibold">Pending</h1>
                            @endif
                        </td>
                        {{-- <td class="py-2 px-2 border flex gap-2 justify-center max-lg:text-xs max-2xl:hidden h-max">
                            @if ($appointment->status === 'approved')
                                <form method="POST"
                                    action="{{ route('appointments.approve', $appointment->id) }}">
                                    @csrf
                                    <div class="tooltip">
                                        <button type="submit" class="btn btn-success btn-sm " disabled>
                                            <img src="{{ asset('assets/images/accept.png') }}" alt="">
                                            <span class="tooltiptext">Approved</span>
                                        </button>
                                    </div>
                                </form>
                            @elseif($appointment->status === 'declined')
                                <form method="POST"
                                    action="{{ route('appointments.decline', $appointment->id) }}">
                                    @csrf
                                    <div class="tooltip">
                                        <button type="submit" class="btn btn-danger btn-sm" disabled>
                                            <img src="{{ asset('assets/images/decline.png') }}" alt="">
                                            <span class="tooltiptext">Declined</span>
                                        </button>
                                    </div>
                                </form>
                            @else
                                <form method="POST"
                                    action="{{ route('appointments.approve', $appointment->id) }}">
                                    @csrf
                                    <div class="tooltip">
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <img src="{{ asset('assets/images/accept.png') }}" alt="">
                                            <span class="tooltiptext">Approve</span>
                                        </button>
                                    </div>
                                </form>
                                <form method="POST"
                                    action="{{ route('appointments.decline', $appointment->id) }}">
                                    @csrf
                                    <div class="tooltip">
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <img src="{{ asset('assets/images/decline.png') }}" alt="">
                                            <span class="tooltiptext">Decline</span>
                                        </button>
                                    </div>
                                </form>
                            @endif
                        </td> --}}
                        <td class="p-1 justify-center items-center border max-lg:text-xs">
                            <a href="{{ route('show.appointment', $appointment->id) }}"
                                class="flex justify-center items-center border rounded-md py-2 px-4 max-md:py-1 max-md:px-2 text-white font-semibold hover:bg-gray-400 transition-all">
                                <h1 class="hidden max-2xl:block text-xs font-semibold text-gray-800">View</h1>
                                <img class="h-5 sm:h-4 sm:w-4 max-md:h-4 max-md:w-4 max-2xl:hidden"
                                    src="{{ asset('assets/images/user-icon.png') }}" alt="">
                            </a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div class="mt-3">
            {{ $online_appointments->links() }}
        </div>
    </section>
    <script>
        document.getElementById('sortOnline').addEventListener('change', function() {
            this.form.submit();
        });
    </script>
@endsection
