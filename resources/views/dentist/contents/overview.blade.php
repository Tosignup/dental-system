@extends('dentist.dashboard')
@section('content')
    <section class="flex flex-col justify-center items-center p-6 border border-blue-600">

        <!-- Sidebar -->
        {{-- <div class="w-full bg-white min-w-80 p-4 rounded-lg shadow-md max-xl:w-full border border-red-600">
            <div class="w-full flex flex-col items-center text-center">
                <div
                    class="w-20 h-20 rounded-full bg-gray-300 flex items-center justify-center text-4xl text-gray-700 font-bold">
                    {{ $dentist->first_initial }}
                </div>
                <h2 class="mt-4 text-xl font-bold">{{ $dentist->dentist_first_name }} {{ $dentist->dentist_last_name }}</h2>
                <p class="text-gray-500">{{ $dentist->email }}</p>
            </div>
            <div class="mt-6 max-lg:text-sm">
                <hr class="w-full bg-gray">
                <div class="flex flex-col justify-center items-between">
                    <div class="flex justify-between min-w-max my-2 py-2 px-4 gap-4">
                        <h3 class="font-bold text-gray-600">Gender</h3>
                        <p>{{ $dentist->dentist_gender }}</p>
                    </div>
                    <hr class="w-full bg-gray">
                    <div class="flex justify-between min-w-max my-2 py-2 px-4 gap-4">
                        <h3 class="font-bold text-gray-600">Birthdate</h3>
                        <p>{{ $dentist->dentist_birth_date }}</p>
                    </div>
                    <hr class="w-full bg-gray">
                    <div class="flex justify-between min-w-max my-2 py-2 px-4 gap-4">
                        <h3 class="font-bold text-gray-600">Phone</h3>
                        <p>{{ $dentist->dentist_phone_number }}</p>
                    </div>
                    <hr class="w-full bg-gray">
                    <div class="flex justify-between min-w-max my-2 py-2 px-4 gap-4">
                        <h3 class="font-bold text-gray-600">Branch</h3>
                        <p>{{ $dentist->branch->branch_loc }}</p>
                    </div>

                </div>
            </div>
        </div> --}}

        <div
            class="flex flex-col items-center justify-center w-full rounded-xl shadow-lg p-7 bg-white my-4 mx-auto gap-4 mt-6 max-lg:mt-14 max-w-5xl border border-green-500">
            <h1 class=" text-5xl max-md:text-3xl font-bold my-2 ">Good day,
                {{ Auth::user()->username }}!
            </h1>
            <h1>Let's brighten smiles and make a difference today!</h1>
        </div>

        <div class="w-full bg-white shadow-lg rounded-xl p-8 flex flex-col items-center justify-center max-w-md">
            <div class="mb-8 text-center">
                <h1 class="text-3xl max-md:text-xl font-bold">Appointment Summary</h1>
            </div>
            <div class="flex gap-4 max-md:gap-2 md:flex-col">
                <a href="{{ route('appointment.submission') }}"
                    class="flex-1 flex max-md:flex-col max-md:p-2 py-4 px-8 justify-between bg-white shadow-lg items-center gap-2 rounded-md hover:bg-gray-100 transition-all  ">
                    <img class="h-12 max-md:h-6" src="{{ asset('assets/images/appointment-total.png') }}" alt="">
                    <h1 class="text-md font-semibold max-md:text-xs max-md:text-center">Total of Appointments</h1>
                    <h1 class="text-4xl font-bold max-md:text-2xl">
                        {{ $totalAppointments > 0 ? $totalAppointments : 0 }}
                    </h1>
                </a>
                <a href="{{ route('appointment.submission') }}"
                    class="flex-1 flex max-md:flex-col max-md:p-2 py-4 px-8 justify-between bg-white shadow-lg items-center gap-2 rounded-md hover:bg-gray-100 transition-all  ">
                    <img class="h-12 max-md:h-6" src="{{ asset('assets/images/appointment-new.png') }}" alt="">
                    <h1 class="text-md font-semibold max-md:text-xs max-md:text-center">New Appointments</h1>
                    <h1 class="text-4xl font-bold max-md:text-2xl">
                        {{ $newAppointments > 0 ? $newAppointments : 0 }}
                    </h1>
                </a>
                <a href="{{ route('appointment.submission') }}"
                    class="flex-1 flex max-md:flex-col max-md:p-2 py-4 px-8 justify-between bg-white shadow-lg items-center gap-2 rounded-md hover:bg-gray-100 transition-all  ">
                    <img class="h-12 max-md:h-6" src="{{ asset('assets/images/appointment-today.png') }}" alt="">
                    <h1 class="text-md font-semibold max-md:text-xs max-md:text-center">Today's Appointments</h1>
                    <h1 class="text-4xl font-bold max-md:text-2xl">
                        {{ $todayAppointment > 0 ? $todayAppointment : 0 }}
                    </h1>
                </a>
            </div>
        </div>

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
</script>
