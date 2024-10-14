@extends('admin.dashboard')
@section('content')
    @if (session('success'))
        <div id="toast" class="absolute bottom-8 right-8">
            <div class="max-w-xs bg-green-600 text-sm text-white rounded-md shadow-lg dark:bg-gray-900 mb-3 ml-3"
                role="alert">
                <div class="flex p-4">
                    {{ session('success') }} <!-- Display the success message -->

                    <div class="ml-auto px-1">
                        <button type="button"
                            class="inline-flex gap-2 flex-shrink-0 justify-center items-center h-4 w-4 rounded-md text-white/[.5] hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-gray-600 transition-all text-sm dark:focus:ring-offset-gray-900 dark:focus:ring-gray-800"
                            onclick="closeToast()">
                            <span class="sr-only">Close</span>
                            <svg class="w-3.5 h-3.5 self-center" width="16" height="16" viewBox="0 0 16 16"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0.92524 0.687069C1.126 0.486219 1.39823 0.373377 1.68209 0.373377C1.96597 0.373377 2.2382 0.486219 2.43894 0.687069L8.10514 6.35813L13.7714 0.687069C13.8701 0.584748 13.9882 0.503105 14.1188 0.446962C14.2494 0.39082 14.3899 0.361248 14.5321 0.360026C14.6742 0.358783 14.8151 0.38589 14.9468 0.439762C15.0782 0.493633 15.1977 0.573197 15.2983 0.673783C15.3987 0.774389 15.4784 0.894026 15.5321 1.02568C15.5859 1.15736 15.6131 1.29845 15.6118 1.44071C15.6105 1.58297 15.5809 1.72357 15.5248 1.85428C15.4688 1.98499 15.3872 2.10324 15.2851 2.20206L9.61883 7.87312L15.2851 13.5441C15.4801 13.7462 15.588 14.0168 15.5854 14.2977C15.5831 14.5787 15.4705 14.8474 15.272 15.046C15.0735 15.2449 14.805 15.3574 14.5244 15.3599C14.2437 15.3623 13.9733 15.2543 13.7714 15.0591L8.10514 9.38812L2.43894 15.0591C2.23704 15.2543 1.96663 15.3623 1.68594 15.3599C1.40526 15.3574 1.13677 15.2449 0.938279 15.046C0.739807 14.8474 0.627232 14.5787 0.624791 14.2977C0.62235 14.0168 0.730236 13.7462 0.92524 13.5441L6.59144 7.87312L0.92524 2.20206C0.724562 2.00115 0.611816 1.72867 0.611816 1.44457C0.611816 1.16047 0.724562 0.887983 0.92524 0.687069Z"
                                    fill="currentColor" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="m-4 mb-8">
        @include('components.search')
    </div>
    @if (session('success'))
        <div class="alert alert-success fade-out" onclick="fadeOut(this)">
            {{ session('success') }}
        </div>
    @endif

    <section class=" m-4 p-4 bg-white shadow-lg rounded-md max-lg:mt-14">
        <div
            class="flex items-center justify-between pt-3 pb-6 max-lg:flex-wrap gap-4 max-md:gap-2 max-md:pt-1 max-md:pb-3">
            <div class="flex gap-4 max-md:gap-2">
                <label class="flex items-center gap-2" for="time">
                    <h1 class="font-bold text-3xl mr-4 max-md:mr-0 max-md:text-2xl">Walk-in Request</h1>
                </label>
                <div>
                    <form method="GET" action="{{ route('appointments.walkIn') }}"
                        class="flex max-lg:text-xs gap-1 items-center max-lg:m-1">
                        <h1 class="font-semibold">Sort by: </h1>
                        <select name="sortWalkin" id="sortWalkin"
                            class="border text-sm w-auto border-gray-400 pr-6 mx-2 rounded-md max-lg:text-xs">
                            <option value="created_at" {{ request()->get('sortWalkin') == 'created_at' ? 'selected' : '' }}>
                                Date Submitted</option>
                            <option value="preferred_time"
                                {{ request()->get('sortWalkin') == 'preferred_time' ? 'selected' : '' }}>Appointment Time
                            </option>
                            <option value="appointment_date"
                                {{ request()->get('sortWalkin') == 'appointment_date' ? 'selected' : '' }}>Appointment Date
                            </option>
                            <option value="branch" {{ request()->get('sortWalkin') == 'branch' ? 'selected' : '' }}>Branch
                            </option>
                            <option value="status" {{ request()->get('sortWalkin') == 'status' ? 'selected' : '' }}>Status
                            </option>
                        </select>
                    </form>
                </div>
            </div>
            <form method="GET" class="justify-end" action="{{ route('add.walkIn') }}">
                @csrf
                <button onclick="openModal()"
                    class="flex justify-center items-center gap-2 rounded-md py-2 px-4 my-2 min-w-max border-2 border-gray-600 hover:shadow-md hover:border-green-700 font-semibold text-gray-800 transition-all max-md:px-2">
                    <span class="max-md:text-xs"> Add Appointment</span>
                    <img class="h-6 max-md:h-4" src="{{ asset('assets/images/add.png') }}" alt="">
                </button>
            </form>
        </div>
        <table class="w-full table-auto text-center">
            <thead>
                <tr class="bg-gray-300 text-gray-500">
                    <th class="max-lg:py-2 max-lg:px-2 border max-lg:text-xs">Patient</th>
                    <th class="max-lg:py-2 max-lg:px-2 border max-lg:text-xs max-2xl:hidden">Date Submitted</th>
                    <th class="py-2 px-4 max-lg:py-2 max-lg:px-2 border max-lg:text-xs max-2xl:hidden">Appointment Date</th>
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
                        <td class=" max-lg:py-2 max-lg:px-2 border max-lg:text-xs max-2xl:hidden">
                            {{ $appointment->created_at }}
                        </td>
                        <td class=" max-lg:py-2 max-lg:px-2 border max-lg:text-xs max-2xl:hidden">
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
        <div class="mt-3">

            {{ $walkin_appointments->links() }}
        </div>

    </section>
    <script>
        document.getElementById('sortWalkin').addEventListener('change', function() {
            this.form.submit();
        });

        function fadeOut(element) {
            element.classList.add('hidden');
            setTimeout(() => {
                element.style.display = 'none'; // Optionally hide the element after fading out
            }, 1000); // Match this duration with the CSS transition duration
        }

        document.addEventListener('DOMContentLoaded', function() {
            const messages = document.querySelectorAll('.fade-out');
            messages.forEach(message => {
                setTimeout(() => {
                        fadeOut(message);
                    },
                    1000
                ); // Change this duration to how long you want the message to be visible (in milliseconds)
            });
        });
        setTimeout(() => {
            const toast = document.getElementById('toast');
            if (toast) {
                toast.style.display = 'none';
            }
        }, 3000);


        function closeToast() {
            const toast = document.getElementById('toast');
            if (toast) {
                toast.style.display = 'none';
            }
        }
    </script>
@endsection
