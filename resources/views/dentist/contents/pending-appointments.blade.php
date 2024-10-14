@extends('dentist.dashboard')
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
    <section class="bg-white shadow-lg rounded-md p-6 my-4 mx-2  max-lg:mt-14">
        <h1 class="font-bold text-3xl p-4">Pending Appointments</h1>

        @if ($pendingAppointments->isEmpty())
            <p>No pending appointments.</p>
        @else
            <table class="min-w-full bg-white border">
                <thead>
                    <tr class="w-full bg-gray-100">
                        <th class="py-2 px-4 border-b text-left text-gray-600 max-lg:text-xs">Appointment Date</th>
                        <th class="py-2 px-4 border-b text-left text-gray-600 max-xl:hidden">Patient</th>
                        <th class="py-2 px-4 border-b text-left text-gray-600  max-lg:text-xs">Procedure</th>
                        <th class="py-2 px-4 border-b text-left text-gray-600 max-xl:hidden">Branch</th>
                        <th class="py-2 px-4 border-b text-left text-gray-600 max-lg:text-xs">
                            Actions</th>
                        <th class="py-2 px-4 border-b text-left text-gray-600 max-lg:text-xs max-2xl:hidden">
                            View</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pendingAppointments as $appointment)
                        <tr>
                            <td class="py-2 px-4 border-b   max-lg:text-xs">
                                {{ $appointment->appointment_date }} - <span
                                    class="font-bold">{{ $appointment->preferred_time }}</span>
                            </td>
                            <td class="py-2 px-4 border-b  max-xl:hidden">{{ $appointment->patient->last_name }},
                                {{ $appointment->patient->first_name }}</td>
                            <td class="py-2 px-4 border-b max-lg:text-xs">
                                {{ $appointment->procedure ? $appointment->procedure->name : 'N/A' }}
                            </td>

                            <td class="py-2 px-4 border-b  max-xl:hidden  ">
                                {{ $appointment->branch ? $appointment->branch->branch_loc : 'N/A' }}</td>
                            <td
                                class="py-2 px-2 border flex gap-2 justify-center items-center max-lg:text-xs max-2xl:hidden h-max">
                                @if ($appointment->pending === 'Approved')
                                    <div class="tooltip flex gap-2 justify-center items-center">
                                        <button type="submit" class="btn btn-success btn-sm " disabled>
                                            <img src="{{ asset('assets/images/accept.png') }}" alt="">
                                            <span class="tooltiptext">Approved</span>
                                        </button>
                                    </div>
                                @elseif($appointment->pending === 'Declined')
                                    <div class="tooltip flex gap-2 justify-center items-center">
                                        <button type="submit" class="btn btn-danger btn-sm" disabled>
                                            <img src="{{ asset('assets/images/decline.png') }}" alt="">
                                            <span class="tooltiptext">Declined</span>
                                        </button>
                                    </div>
                                @else
                                    <div class="flex justify-center m-0 p-0 items-center gap-2 ">
                                        <form class="" method="POST"
                                            action="{{ route('appointments.approve', $appointment->id) }}">
                                            @csrf
                                            <div class="tooltip m-0 p-0 flex gap-2 justify-center items-center">
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    <img class="m-0 p-0" src="{{ asset('assets/images/accept.png') }}"
                                                        alt="">
                                                    <span class="tooltiptext">Approve</span>
                                                </button>
                                            </div>
                                        </form>
                                        <form method="POST"
                                            action="{{ route('appointments.decline', $appointment->id) }}">
                                            @csrf
                                            <div class="tooltip flex gap-2 justify-center items-center ">
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <img src="{{ asset('assets/images/decline.png') }}" alt="">
                                                    <span class="tooltiptext">Decline</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                            </td>
                    @endif
                    <td class="py-2 px-4 max-xl:flex justify-center border items-center text-xs">
                        {{-- <button class="text-gray-800 border-2 rounded-md px-4 py-2  transition"
                            onclick="openModal('view_modal_{{ $appointment->id }}')">View</button> --}}

                        <a href="{{ route('appointments.show', $appointment->id) }}"
                            class="flex justify-center items-center border rounded-md py-2 px-4 max-md:py-1 max-md:px-2 text-white font-semibold hover:bg-gray-400 transition-all">
                            <h1 class="hidden max-2xl:block text-xs font-semibold text-gray-800">View</h1>
                            <img class="h-5 sm:h-4 sm:w-4 max-md:h-4 max-md:w-4 max-2xl:hidden"
                                src="{{ asset('assets/images/user-icon.png') }}" alt="">

                        </a>

                        <div id="view_modal_{{ $appointment->id }}"
                            class="fixed hidden z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4 modal">
                            <div class="relative top-40 mx-auto shadow-xl rounded-md bg-white max-w-md">

                                <!-- Modal header -->
                                <div class="flex justify-between items-center text-gray-600 text-xl rounded-t-md px-4 py-2">
                                    <h3 class="text-sm py-2 font-semibold">Appointment details</h3>
                                    <button onclick="closeModal('view_modal_{{ $appointment->id }}')">x</button>
                                </div>

                                <!-- Modal body -->
                                <div class="max-h-96 overflow-y-scroll p-4">
                                    <div class=" bg-white p-4 rounded-lg shadow-md">
                                        <div class="flex flex-col justify-left">
                                            <h2 class="mt-4 text-xl font-bold">
                                                {{ $appointment->procedure->name ?? 'None' }}
                                            </h2>
                                            <p class="text-gray-500">
                                                {{ $appointment->appointment_date }} - <span
                                                    class="font-bold">{{ $appointment->preferred_time }}</span>
                                        </div>
                                        <div class="mt-6 max-lg:text-sm">
                                            <hr class="w-full bg-gray">
                                            <div class="flex flex-col justify-center items-between">
                                                <div class="flex flex-col justify-between my-2 py-2 px-4 gap-4">
                                                    <h3 class="font-bold text-gray-600">Teeth No.</h3>
                                                    <p>{{-- {{ $appointment->teeth_number }} --}}26</p>
                                                </div>
                                                <hr class="w-full bg-gray">
                                                <div class="flex justify-between my-2 py-2 px-4 gap-4 flex-col">
                                                    <h3 class="font-bold text-gray-600">Description</h3>
                                                    <p>{{-- {{ $appointment->description }} --}}
                                                        There are three missing teeth, 26 has been extracted due
                                                        to
                                                        extensive caries, 18 and 28 unerupted
                                                    </p>
                                                </div>
                                                <hr class="w-full bg-gray">
                                                <div class="flex justify-between my-2 py-2 px-4 gap-4 flex-col">
                                                    <h3 class="font-bold text-gray-600">Fees</h3>
                                                    <p> &#8369
                                                        {{ $appointment->procedure->price ?? 'None' }}
                                                    </p>
                                                </div>
                                                <hr class="w-full bg-gray">
                                                <div class="flex justify-between my-2 py-2 px-4 gap-4 flex-col">
                                                    <h3 class="font-bold text-gray-600">Remarks</h3>
                                                    <p>{{-- {{ $appointment->remarks }} --}}
                                                        hahahaha remarks
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal footer -->
                                <div class="px-4 py-2 border-t border-t-gray-500 flex justify-end items-center space-x-4">
                                    <button class="border text-gray-600 px-4 py-2 rounded-md transition"
                                        onclick="closeModal('view_modal_{{ $appointment->id }}')">Close </button>
                                </div>
                            </div>
                        </div>
                    </td>
                    </tr>
        @endforeach

        </tbody>
        </table>
        @endif
    </section>
@endsection
<script>
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('hidden');
        }
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('hidden');
        }
    }
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
