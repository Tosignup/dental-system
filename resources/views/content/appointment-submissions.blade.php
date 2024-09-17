@extends('admin.dashboard')
@section('content')
    <div class="m-4">
        @include('components.search')
    </div>
    <section class="flex flex-col gap-2 m-6 rounded-md p-4  bg-white shadow-md max-lg:flex-col">
        <label class="flex items-center gap-2 max-lg:flex-wrap" for="time">
            <h1 class="font-bold text-3xl mr-4 max-md:text-2xl">Appointment Submissions</h1>
            <form method="GET" action="{{ route('appointment.submission') }}"
                class="flex max-lg:text-xs gap-4 items-center justify-center m-4 max-lg:m-1 ">
                <h1>Sort by: </h1>
                <select name="sort" class="border text-sm w-auto border-gray-400 pr-6 mx-2 rounded-md max-lg:text-xs"
                    id="sort">
                    <option value="name" {{ request()->get('sort') == 'name' ? 'selected' : '' }}>Name</option>
                    <option value="appointment_date" {{ request()->get('sort') == 'appointment_date' ? 'selected' : '' }}>
                        Appointment Date</option>
                    <option value="branch" {{ request()->get('sort') == 'branch' ? 'selected' : '' }}>Branch</option>
                    <option value="status" {{ request()->get('sort') == 'status' ? 'selected' : '' }}>Status</option>
                </select>
            </form>
        </label>
        <table class="w-full table-auto text-center">
            <thead>
                <tr class="">
                    <th class="max-lg:py-2 max-lg:px-2 border max-lg:text-xs">Name</th>
                    <th class="py-2 px-4 max-lg:py-2 max-lg:px-2 border max-xl:hidden">Birth date</th>
                    <th class="py-2 px-4 max-lg:py-2 max-lg:px-2 border max-xl:hidden">Phone number</th>
                    <th class="py-2 px-4 max-lg:py-2 max-lg:px-2 border max-xl:hidden">Email</th>
                    <th class="py-2 px-4 max-lg:py-2 max-lg:px-2 border max-xl:hidden">Zip code</th>
                    <th class="py-2 px-4 max-lg:py-2 max-lg:px-2 border max-lg:text-xs">Appointment Date</th>
                    <th class="py-2 px-4 max-lg:py-2 max-lg:px-2 border max-lg:text-xs max-xl:hidden">Preferred time</th>
                    <th class="py-2 px-4 max-lg:py-2 max-lg:px-2 border max-xl:hidden">Notes</th>
                    <th class="py-2 px-4 max-lg:py-2 max-lg:px-2 border max-lg:text-xs max-xl:hidden">Branch</th>
                    <th class="py-2 px-4 max-lg:py-2 max-lg:px-2 border max-lg:text-xs">Status</th>
                    <th class="py-2 px-4 max-lg:py-2 max-lg:px-2 border max-lg:text-xs">Actions</th>
                </tr>
            </thead>
            {{-- testing --}}

            {{-- testing --}}
            <tbody>
                @foreach ($appointments as $appointment)
                    <tr class="text-center">
                        <td class=" max-lg:py-2 max-lg:px-2 border text-black max-lg:text-xs">
                            <span class="max-lg:hidden">{{ $appointment->first_name }}First</span>
                            {{ $appointment->last_name }}
                            Last
                        </td>
                        <td class=" max-lg:py-2 max-lg:px-2 border max-lg:hidden">
                            22-04-2002
                            {{ $appointment->date_of_birth }}</td>
                        <td class=" max-lg:py-2 max-lg:px-2 border max-lg:hidden">
                            09090909090
                            {{ $appointment->phone_number }}</td>
                        <td class=" max-lg:py-2 max-lg:px-2 border max-lg:hidden">
                            static@gmail.com
                            {{ $appointment->email }}</td>
                        <td class=" max-lg:py-2 max-lg:px-2 border max-lg:hidden">
                            2010
                            {{ $appointment->zip_code }}</td>
                        <td class=" max-lg:py-2 max-lg:px-2 border max-lg:text-xs ">

                            {{ $appointment->appointment_date }}</td>
                        <td class=" max-lg:py-2 max-lg:px-2 border max-lg:text-xs max-xl:hidden">
                            12:00
                            {{ $appointment->preferred_time }}</td>
                        <td class=" max-lg:py-2 max-lg:px-2 border max-lg:hidden max-lg:text-xs">{{ $appointment->notes }}
                        </td>
                        <td class=" max-lg:py-2 max-lg:px-2 border max-lg:text-xs max-xl:hidden">
                            staticBranch
                            {{ $appointment->branch }}</td>
                        <td class="border px-4 py-2 min-w-max h-full max-lg:text-xs">
                            @if ($appointment->status === 'approved')
                                <h1 class="text-md text-green-600 font-semibold">Approved</h1>
                            @elseif ($appointment->status === 'declined')
                                <h1 class="text-md text-red-600 font-semibold">Declined</h1>
                            @else
                                <h1 class="text-md">Pending</h1>
                            @endif
                        </td>
                        <td class="py-2 px-2 border flex gap-2 justify-center max-lg:text-xs h-max max-lg:hidden">
                            @if ($appointment->status === 'approved')
                                <form method="POST" action="{{ route('appointments.approve', $appointment->id) }}">
                                    @csrf
                                    <div class="tooltip">
                                        <button type="submit" class="btn btn-success btn-sm " disabled>
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
                                    <div class="tooltip">
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <img src="{{ asset('assets/images/accept.png') }}" alt="">
                                            <span class="tooltiptext">Approve</span>
                                        </button>
                                    </div>
                                </form>
                                <form method="POST" action="{{ route('appointments.decline', $appointment->id) }}">
                                    @csrf
                                    <div class="tooltip">
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <img src="{{ asset('assets/images/decline.png') }}" alt="">
                                            <span class="tooltiptext">Decline</span>
                                        </button>
                                    </div>
                                </form>
                        </td>
                        <td class="hidden max-lg:flex p-2.5 justify-center items-center border max-lg:text-xs">
                            <a href="{{ route('show.appointment', $appointment->id) }}"
                                class="flex justify-center items-center border rounded-md py-2 px-4 max-md:py-1 max-md:px-2 text-white font-semibold hover:bg-gray-400 transition-all">
                                <h1 class="hidden max-md:block text-xs font-semibold text-gray-800">View</h1>
                                <img class="h-5 sm:h-4 sm:w-4 max-md:h-4 max-md:w-4 max-md:hidden"
                                    src="{{ asset('assets/images/user-icon.png') }}" alt="">
                            </a>
                        </td>
                @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>
    <script>
        document.getElementById('sort').addEventListener('change', function() {
            this.form.submit();
            document.getElementById('branch').toUpperCase();

        });
    </script>
@endsection
