@extends('client.profile')
@section('content')
    <section class="flex max-lg:p-3  max-lg:gap-3 gap-5 bg-gray-100 p-6 max-2xl:flex-wrap max-xl:mt-20">
        <!-- Sidebar -->
        <div class=" bg-white p-4 rounded-lg shadow-md max-xl:w-full">
            <div class="flex flex-col items-center text-center">
                <div
                    class="w-20 h-20 rounded-full bg-gray-300 flex items-center justify-center text-4xl text-gray-700 font-bold">
                    {{ $patient->first_initial }}
                </div>
                <h2 class="mt-4 text-xl font-bold">{{ $patient->first_name }} {{ $patient->last_name }}</h2>
                <p class="text-gray-500">{{ $patient->email }}</p>
            </div>
            <div class="mt-6 max-lg:text-sm">
                <hr class="w-full bg-gray">
                <div class="flex flex-col justify-center items-between">
                    <div class="flex justify-between min-w-max my-2 py-2 px-4 gap-4">
                        <h3 class="font-bold text-gray-600">Gender</h3>
                        <p>{{ $patient->gender }}</p>
                    </div>
                    <hr class="w-full bg-gray">
                    <div class="flex justify-between min-w-max my-2 py-2 px-4 gap-4">
                        <h3 class="font-bold text-gray-600">Birthdate</h3>
                        <p>{{ $patient->date_of_birth }}</p>
                    </div>
                    <hr class="w-full bg-gray">
                    <div class="flex justify-between min-w-max my-2 py-2 px-4 gap-4">
                        <h3 class="font-bold text-gray-600">Phone</h3>
                        <p>{{ $patient->phone_number }}</p>
                    </div>
                    <hr class="w-full bg-gray">
                    <div class="flex justify-between min-w-max my-2 py-2 px-4 gap-4">
                        <h3 class="font-bold text-gray-600">Patient ID</h3>

                        @auth
                            @if (session('patient_id'))
                                <p class="">{{ session('patient_id') }}</p>
                            @else
                                <p>No Patient ID found in session.</p>
                            @endif
                        @endauth

                    </div>

                    <div class="flex justify-between min-w-max my-2 py-2 px-4 gap-4">
                        <h3 class="font-bold text-gray-600">Address</h3>
                        <p>San Joaquin, Mabalacat</p>
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
                        data-tab-target="#tab1">
                        Appointments</button>
                    <button
                        class="text-gray-500 pb-2 border-b-2 border-transparent focus:outline-none hover:border-b-green-300 transition-all"
                        data-tab-target="#tab2">Next
                        Visit</button>
                    <button
                        class="text-gray-500 pb-2 border-b-2 border-transparent focus:outline-none hover:border-b-green-300 transition-all"
                        data-tab-target="#tab3">Payment</button>
                </nav>
            </div>

            <!-- Table -->
            <div>
                <div id="tab1" class="tab-content text-gray-700 hidden">
                    <table class="min-w-full bg-white border">
                        <thead>
                            <tr class="w-full bg-gray-100">
                                <th class="py-2 px-4 border-b text-left text-gray-600 max-lg:text-xs">Date Visit</th>
                                <th class="py-2 px-4 border-b text-left text-gray-600 max-xl:hidden">Teeth No./s</th>
                                <th class="py-2 px-4 border-b text-left text-gray-600  max-lg:text-xs">Treatment</th>
                                <th class="py-2 px-4 border-b text-left text-gray-600  max-xl:hidden">Description</th>
                                <th class="py-2 px-4 border-b text-left text-gray-600  max-xl:hidden">Fees</th>
                                <th class="py-2 px-4 border-b text-left text-gray-600  max-xl:hidden">Remarks</th>
                                <th
                                    class="py-2 px-4 border-b text-left text-gray-600 max-lg:text-xs opacity-0 max-lg:opacity-100">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-2 px-4 border-b   max-lg:text-xs">February 17, 2022</td>
                                <td class="py-2 px-4 border-b  max-xl:hidden">26</td>
                                <td class="py-2 px-4 border-b   max-lg:text-xs">Complicated Extraction</td>
                                <td class="py-2 px-4 border-b  max-xl:hidden  max-lg:text-xs">There are three missing teeth,
                                    26 has been
                                    extracted due to
                                    extensive caries, 18 and 28 unerupted</td>
                                <td class="py-2 px-4 border-b  max-xl:hidden  ">₱ 1,000</td>
                                <td class="py-2 px-4 border-b  max-xl:hidden  ">-</td>
                                <td class="hidden py-2 px-4 max-xl:flex justify-center items-center text-xs">
                                    <button class="text-gray-800 border-2 rounded-md px-4 py-2  transition"
                                        onclick="openModal('modal')">View</button>
                                    <div id="modal"
                                        class="fixed hidden z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4 modal">
                                        <div class="relative top-40 mx-auto shadow-xl rounded-md bg-white max-w-md">

                                            <!-- Modal header -->
                                            <div
                                                class="flex justify-between items-center text-gray-600 text-xl rounded-t-md px-4 py-2">
                                                <h3 class="text-sm py-2 font-semibold">Appointment details</h3>
                                                <button onclick="closeModal('modal')">x</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="max-h-96 overflow-y-scroll p-4">
                                                <div class=" bg-white p-4 rounded-lg shadow-md">
                                                    <div class="flex flex-col justify-left">
                                                        <h2 class="mt-4 text-xl font-bold">
                                                            {{-- {{ $appointment->treatment }} --}}
                                                            Complicated Extraction
                                                        </h2>
                                                        <p class="text-gray-500">
                                                            {{-- {{ $appointment->date_of_visit }} --}}
                                                            February 17, 2022</p>
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
                                                                <p>{{-- {{ $appointment->fee }} --}}
                                                                    ₱ 1,000
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
                                            <div
                                                class="px-4 py-2 border-t border-t-gray-500 flex justify-end items-center space-x-4">
                                                <button class="border text-gray-600 px-4 py-2 rounded-md transition"
                                                    onclick="closeModal('modal')">Close </button>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- component -->

                </div>
                <div id="tab2" class="tab-content text-gray-700 hidden">
                    <h1 class="font-bold mt-9 max-lg:mt-4  mb-4 text-2xl max-xl:text-xs">Next Visit</h1>
                    <p class="text-xl max-xl:text-xs">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit sunt
                        possimus enim
                        cumque ullam exercitationem, rerum itaque illum repellendus consequuntur?</p>
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
