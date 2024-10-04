<form method="GET" class="justify-end" action="{{ route('add.walkIn') }}">
    @csrf
    <button onclick="openModal()"
        class="flex justify-center items-center gap-2 rounded-md py-2 px-4 my-2 min-w-max border-2 border-gray-600 hover:shadow-md hover:border-green-700 font-semibold text-gray-800 transition-all max-md:px-2">
        <span class="max-md:text-xs"> Add Appointment</span>
        <img class="h-6 max-md:h-4" src="{{ asset('assets/images/add.png') }}" alt="">
    </button>
</form>
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

        @foreach ($walkin_appointments as $appointment)
            <tr class="text-center">
                <td class=" max-lg:py-2 max-lg:px-2 border text-black max-lg:text-xs">
                    <span class="max-lg:hidden">{{ $appointment->patient->first_name }}</span>
                    {{ $appointment->patient->last_name }}
                </td>
                <td class=" max-lg:py-2 max-lg:px-2 border max-lg:text-xs ">
                    {{ $appointment->created_at }}
                </td>
                <td class=" max-lg:py-2 max-lg:px-2 border max-lg:text-xs ">
                    {{ $appointment->appointment_date }}
                </td>
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
                    @if ($appointment->pending === 'Approved')
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
                    @elseif($appointment->pending === 'Declined')
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
