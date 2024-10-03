@extends('dentist.dashboard')
@section('content')
    <section class="flex max-lg:p-3  max-lg:gap-3 gap-5 bg-gray-100 p-6 max-2xl:flex-wrap max-xl:mt-20">
        <!-- Sidebar -->
        <div class=" bg-white p-4 rounded-lg shadow-md max-xl:w-full">
            <div class="flex flex-col items-center text-center">
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
        </div>

        <!-- Main Content -->
        <div class="bg-white max-xl:w-full p-4 max-lg:p-2 max-xl:text-xs rounded-lg shadow-md">
            <!-- Tab Navigation -->
            <div class="border-b border-gray-200 mb-4">
                <nav class="flex flex-wrap gap-5 max-lg:gap-2">

                    <button
                        class="text-gray-500 pb-2 border-b-2 border-transparent focus:outline-none hover:border-b-green-300 transition-all"
                        data-tab-target="#tab1">Appointment Request</button>
                    <button
                        class="text-gray-500 pb-2 border-b-2 border-transparent focus:outline-none hover:border-b-green-300 transition-all"
                        data-tab-target="#tab2">Next Appointment</button>
                    <button
                        class="text-gray-500 pb-2 border-b-2 border-transparent focus:outline-none hover:border-b-green-300 transition-all"
                        data-tab-target="#tab3">Payment</button>
                </nav>
            </div>

            <!-- Table -->
            <div>
                <div id="tab1" class="tab-content text-gray-700 hidden">

                    <!-- component -->
                    @include('dentist.contents.pending-appointments')
                    <div class="w-full">
                        {{ $pendingAppointments->links() }}
                    </div>
                </div>
                <div id="tab2" class="tab-content text-gray-700 hidden">
                    @include('dentist.contents.approved-appointments')
                    <div class="w-full">
                        {{ $approvedAppointments->links() }}
                    </div>
                </div>
                <div id="tab3" class="tab-content text-gray-700 hidden">
                    <h1 class="font-bold mt-9 max-lg:mt-4 mb-4 text-2xl max-xl:text-xs">Payment</h1>
                    <p class="text-xl max-xl:text-xs">Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur
                        excepturi unde
                        doloribus.</p>
                </div>
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
