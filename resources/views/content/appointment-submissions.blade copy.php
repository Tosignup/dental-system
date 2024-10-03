@extends('admin.dashboard')
@section('content')
    <div class="m-4">
        @include('components.search')
    </div>
    <section class="flex flex-col gap-2 m-6 rounded-md p-4  bg-white shadow-md max-lg:flex-col  max-lg:mt-14">
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

        <div class="bg-white max-xl:w-full p-4 max-lg:p-2 max-xl:text-xs rounded-lg shadow-md">

            <div class="border-b border-gray-200 mb-4">
                <nav class="flex flex-wrap gap-5 max-lg:gap-2">
                    <button
                        class="text-gray-500 pb-2 border-b-2 border-transparent focus:outline-none hover:border-b-green-300 transition-all"
                        data-tab-target="#walk-in">Walk-in Request</button>
                    <button
                        class="text-gray-500 pb-2 border-b-2 border-transparent focus:outline-none hover:border-b-green-300 transition-all"
                        data-tab-target="#online">Online Request</button>

                </nav>
            </div>
            {{-- Walk-in Contents --}}
            <div id="walk-in" class="tab-content text-gray-700 hidden">
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

                        @foreach ($appointments as $appointment)
                            <tr class="text-center">
                                <td class=" max-lg:py-2 max-lg:px-2 border text-black max-lg:text-xs">
                                    <span class="max-lg:hidden">{{ $appointment->patient->first_name }}</span>
                                    {{ $appointment->patient->last_name }}

                                </td>
                                <td class=" max-lg:py-2 max-lg:px-2 border max-lg:text-xs ">
                                    {{ $appointment->appointment_date }}</td>
                                <td class=" max-lg:py-2 max-lg:px-2 border max-lg:text-xs max-2xl:hidden">

                                    {{ $appointment->preferred_time }}</td>
                                <td class=" max-lg:py-2 max-lg:px-2 border max-lg:text-xs max-2xl:hidden">

                                    {{ $appointment->branch->branch_loc }}</td>
                                <td class="border px-4 py-2 min-w-max h-full max-lg:text-xs ">
                                    @if ($appointment->status === 'approved')
                                        <h1 class="text-md text-green-600 font-semibold">Approved</h1>
                                    @elseif ($appointment->status === 'declined')
                                        <h1 class="text-md text-red-600 font-semibold">Declined</h1>
                                    @else
                                        <h1 class="text-md">Pending</h1>
                                    @endif
                                </td>
                                <td class="py-2 px-2 border flex gap-2 justify-center max-lg:text-xs max-2xl:hidden h-max">
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
                                </td>
                                <td class="hidden max-2xl:flex p-2.5 justify-center items-center border max-lg:text-xs">
                                    <a href="{{ route('show.appointment', $appointment->id) }}"
                                        class="flex justify-center items-center border rounded-md py-2 px-4 max-md:py-1 max-md:px-2 text-white font-semibold hover:bg-gray-400 transition-all">
                                        <h1 class="hidden max-2xl:block text-xs font-semibold text-gray-800">View</h1>
                                        <img class="h-5 sm:h-4 sm:w-4 max-md:h-4 max-md:w-4 max-2xl:hidden"
                                            src="{{ asset('assets/images/user-icon.png') }}" alt="">
                                    </a>
                                </td>
                        @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- Online Contents --}}
            <div id="online" class="tab-content text-gray-700 hidden">
                <table class="w-full table-auto text-center">
                    <thead>
                        <tr class="">
                            <th class="max-lg:py-2 max-lg:px-2 border max-lg:text-xs">Patient</th>
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
                        <td class=" max-lg:py-2 max-lg:px-2 border text-black max-lg:text-xs">
                            <span class="max-lg:hidden">First</span>
                            Last
                        </td>
                        <td class=" max-lg:py-2 max-lg:px-2 border text-black max-lg:text-xs">
                            <span class="max-lg:hidden">First</span>
                            Last
                        </td>
                        <td class=" max-lg:py-2 max-lg:px-2 border text-black max-lg:text-xs">
                            <span class="max-lg:hidden">First</span>
                            Last
                        </td>
                        <td class=" max-lg:py-2 max-lg:px-2 border text-black max-lg:text-xs">
                            <span class="max-lg:hidden">First</span>
                            Last
                        </td>
                        <td class=" max-lg:py-2 max-lg:px-2 border text-black max-lg:text-xs">
                            <span class="max-lg:hidden">First</span>
                            Last
                        </td>
                        <td class=" max-lg:py-2 max-lg:px-2 border text-black max-lg:text-xs">
                            <span class="max-lg:hidden">First</span>
                            Last
                        </td>

                        @foreach ($appointments as $appointment)
                            @if ($appointment->is_online === 0)
                                {
                                <tr class="text-center">
                                    <td class=" max-lg:py-2 max-lg:px-2 border text-black max-lg:text-xs">
                                        <span class="max-lg:hidden">{{ $appointment->patient->first_name }}</span>
                                        {{ $appointment->patient->last_name }}

                                    </td>
                                    <td class=" max-lg:py-2 max-lg:px-2 border max-lg:text-xs ">
                                        {{ $appointment->appointment_date }}</td>
                                    <td class=" max-lg:py-2 max-lg:px-2 border max-lg:text-xs max-2xl:hidden">

                                        {{ $appointment->preferred_time }}</td>
                                    <td class=" max-lg:py-2 max-lg:px-2 border max-lg:text-xs max-2xl:hidden">

                                        {{ $appointment->branch->branch_loc }}</td>
                                    <td class="border px-4 py-2 min-w-max h-full max-lg:text-xs ">
                                        @if ($appointment->status === 'approved')
                                            <h1 class="text-md text-green-600 font-semibold">Approved</h1>
                                        @elseif ($appointment->status === 'declined')
                                            <h1 class="text-md text-red-600 font-semibold">Declined</h1>
                                        @else
                                            <h1 class="text-md">Pending</h1>
                                        @endif
                                    </td>
                                    <td
                                        class="py-2 px-2 border flex gap-2 justify-center max-lg:text-xs max-2xl:hidden h-max">
                                        @if ($appointment->status === 'approved')
                                            <form method="POST"
                                                action="{{ route('appointments.approve', $appointment->id) }}">
                                                @csrf
                                                <div class="tooltip">
                                                    <button type="submit" class="btn btn-success btn-sm " disabled>
                                                        <img src="{{ asset('assets/images/accept.png') }}"
                                                            alt="">
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
                                                        <img src="{{ asset('assets/images/decline.png') }}"
                                                            alt="">
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
                                                        <img src="{{ asset('assets/images/accept.png') }}"
                                                            alt="">
                                                        <span class="tooltiptext">Approve</span>
                                                    </button>
                                                </div>
                                            </form>
                                            <form method="POST"
                                                action="{{ route('appointments.decline', $appointment->id) }}">
                                                @csrf
                                                <div class="tooltip">
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <img src="{{ asset('assets/images/decline.png') }}"
                                                            alt="">
                                                        <span class="tooltiptext">Decline</span>
                                                    </button>
                                                </div>
                                            </form>
                                    </td>
                                    <td
                                        class="hidden max-2xl:flex p-2.5 justify-center items-center border max-lg:text-xs">
                                        <a href="{{ route('show.appointment', $appointment->id) }}"
                                            class="flex justify-center items-center border rounded-md py-2 px-4 max-md:py-1 max-md:px-2 text-white font-semibold hover:bg-gray-400 transition-all">
                                            <h1 class="hidden max-2xl:block text-xs font-semibold text-gray-800">View</h1>
                                            <img class="h-5 sm:h-4 sm:w-4 max-md:h-4 max-md:w-4 max-2xl:hidden"
                                                src="{{ asset('assets/images/user-icon.png') }}" alt="">
                                        </a>
                                    </td>
                            @endif
                            </tr>
                        } @else{
                            <h1>No online appointment request</h1>
                            }
                        @endif
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <script>
        document.getElementById('sort').addEventListener('change', function() {
            this.form.submit();
            document.getElementById('branch').toUpperCase();

        });

        const tabs = document.querySelectorAll('[data-tab-target]');
        const activeClass = 'border-b-green-600';

        tabs[0].classList.add(activeClass);
        document.querySelector('#walk-in').classList.remove('hidden');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const targetContent = document.querySelector(tab.dataset.tabTarget);

                document.querySelectorAll('.tab-content').forEach(content => content.classList.add(
                    'hidden'));
                targetContent.classList.remove('hidden');

                document.querySelectorAll('.border-b-green-600').forEach(activeTab => activeTab.classList
                    .remove(
                        activeClass));
                tab.classList.add(activeClass);
            })
        });
    </script>
@endsection
