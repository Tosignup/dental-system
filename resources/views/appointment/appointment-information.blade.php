@extends('admin.dashboard')
@section('content')
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
    <div class="m-4">
        @include('components.search')
    </div>
    <section class="bg-white p-8 m-2 shadow-lg rounded-md flex flex-col justify-center z-0  max-lg:mt-14">
        <div class="pb-4">
            <a @if ($appointment->is_online === 0) href=" {{ route('appointments.walkIn') }} "
            @elseif ($appointment->is_online === 1) href=" {{ route('appointments.online') }}" @endif
                class="flex justify-start font-semibold max-lg:text-xs border-gray-600 py-1 max-lg:px-2 w-max gap-2"><img
                    class="h-6" src="{{ asset('assets/images/arrow-back.png') }}" alt=""> Back</a>
        </div>
        <div class="flex justify-around  p-2 max-sm:flex-col">
            <div class="flex flex-col max-2xl:flex-wrap  p-2 max-md:mb-4">
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
            <div class="flex flex-col justify-between max-2xl:flex-wrap p-2 max-md:mb-4">

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
                        @if (is_null($appointment->payment))
                            <a href="{{ route('payments.form', $appointment->id) }}"
                                class="flex items-center justify-start gap-2 py-2 px-4 my-2 border border-gray-500 rounded-md hover:border-gray-700 hover:shadow-sm transition-all max-sm:justify-center">
                                <img class="h-8 max-lg:h-4" src="{{ asset('assets/images/payment.png') }}" alt="">
                                <h1 class="max-lg:text-xs">Add payment</h1>
                            </a>
                        @elseif ($appointment->payment->status === 'Pending')
                            <a href="{{ route('payments.form', $appointment->id) }}"
                                class="flex items-center justify-start gap-2 py-2 px-4 my-2 border border-gray-500 rounded-md hover:border-gray-700 hover:shadow-sm transition-all max-sm:justify-center">
                                <img class="h-8 max-lg:h-4" src="{{ asset('assets/images/payment.png') }}" alt="">
                                <h1 class="max-lg:text-xs">Add payment</h1>
                            </a>
                            <a href="{{ route('payments.history', $appointment->id) }}"
                                class="flex items-center justify-start gap-2 py-2 px-4 my-2 border border-gray-500 rounded-md hover:border-gray-700 hover:shadow-sm transition-all max-sm:justify-center">
                                <img class="h-8 max-lg:h-4" src="{{ asset('assets/images/payment.png') }}" alt="">
                                <h1 class="max-lg:text-xs">Payment history</h1>
                            </a>
                        @elseif ($appointment->payment->status === 'Paid')
                            <a href="{{ route('payments.history', $appointment->id) }}"
                                class="flex items-center justify-start gap-2 py-2 px-4 my-2 border border-gray-500 rounded-md hover:border-gray-700 hover:shadow-sm transition-all max-sm:justify-center">
                                <img class="h-8 max-lg:h-4" src="{{ asset('assets/images/payment.png') }}" alt="">
                                <h1 class="max-lg:text-xs">Payment history</h1>
                            </a>
                        @elseif ($appointment->payment->status === 'Declined')
                            <p>Payment has been declined</p>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </section>
    <script>
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
