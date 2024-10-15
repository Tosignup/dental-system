@if (session('success'))
    <div id="toast" class="absolute bottom-8 right-8">
        <div class="max-w-xs bg-green-600 text-sm text-white rounded-md shadow-lg dark:bg-gray-900 mb-3 ml-3"
            role="alert">
            <div class="flex p-4">
                {{ session('success') }}
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

<table class="min-w-full bg-white border">
    <thead>
        <tr class="w-full bg-gray-100">
            <th class="py-2 px-4 border-b text-left text-gray-600 max-lg:text-xs">Appointment Date</th>
            <th class="py-2 px-4 border-b text-left text-gray-600  max-xl:hidden">Procedure</th>
            <th class="py-2 px-4 border-b text-left text-gray-600  max-lg:text-xs">Dentist</th>
            <th class="py-2 px-4 border-b text-left text-gray-600  max-xl:hidden">Branch</th>
            <th class="py-2 px-4 border-b text-left text-gray-600 max-xl:hidden">Status</th>
            <th class="py-2 px-4 border-b text-left text-gray-600 max-lg:text-xs">
                Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($appointments as $appointment)
            <tr>
                <td class="py-2 px-4 border-b   max-lg:text-xs">
                    {{ $appointment->appointment_date }} - <span
                        class="font-bold">{{ $appointment->preferred_time }}</span>
                </td>
                <td class="py-2 px-4 border-b max-xl:hidden max-lg:text-xs">
                    {{ $appointment->procedure ? $appointment->procedure->name : 'N/A' }}
                </td>

                <td class="py-2 px-4 border-b    max-lg:text-xs">Dr.
                    {{ $appointment->dentist->dentist_last_name }} {{ $appointment->dentist->dentist_first_name }}
                </td>

                <td class="py-2 px-4 border-b  max-xl:hidden  ">
                    {{ $appointment->branch ? $appointment->branch->branch_loc : 'N/A' }}</td>
                <td class="border-b px-4 py-2 min-w-max h-full max-lg:text-xs max-xl:hidden">
                    @if ($appointment->pending === 'Approved')
                        <h1 class="text-md text-green-600 font-semibold">Approved</h1>
                    @elseif ($appointment->pending === 'Declined')
                        <h1 class="text-md text-red-600 font-semibold">Declined</h1>
                    @else
                        <h1 class="text-md text-slate-600 font-semibold">Pending</h1>
                    @endif
                </td>
                <td class="py-2 px-4 max-xl:flex justify-center items-center text-xs">
                    <button class="text-gray-800 border-2 rounded-md px-4 py-2  transition"
                        onclick="openModal('view_modal_{{ $appointment->id }}')">
                        View</button>

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
                                            {{ $appointment->procedure->name }}
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
                                                    {{ $appointment->procedure->price }}
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
