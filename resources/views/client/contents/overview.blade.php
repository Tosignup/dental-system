@extends('client.profile')
@section('content')
    <section class="flex gap-5 bg-gray-100 p-6 border-2 border-red-500">
        <!-- Sidebar -->
        <div class="min-w-80 w-1/4 bg-white p-4 rounded-lg shadow-md">
            <div class="flex flex-col items-center text-center">
                <div
                    class="w-20 h-20 rounded-full bg-gray-300 flex items-center justify-center text-4xl text-gray-700 font-bold">
                    {{ $patient->first_initial }}
                </div>
                <h2 class="mt-4 text-xl font-bold">{{ $patient->first_name }} {{ $patient->last_name }}</h2>
                <p class="text-gray-500">{{ $patient->email }}</p>
            </div>
            <div class="mt-6">
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
                    {{-- <hr class="w-full bg-gray">
                    <div class="flex justify-between min-w-max my-2 py-2 px-4 gap-4">
                        <h3 class="font-bold text-gray-600">Address</h3>
                        <p>San Joaquin, Mabalacat</p>
                    </div> --}}
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="w-3/4 bg-white p-4 rounded-lg shadow-md">
            <!-- Tab Navigation -->
            <div class="border-b border-gray-200 mb-4">
                <nav class="flex flex-wrap gap-5">
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
                    <h1 class="font-bold mt-9 mb-4 text-2xl">Appointment</h1>
                    <p class="text-xl">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio, ad?</p>
                </div>
                <div id="tab2" class="tab-content text-gray-700 hidden">
                    <h1 class="font-bold mt-9 mb-4 text-2xl">Next Visit</h1>
                    <p class="text-xl">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit sunt possimus enim
                        cumque ullam exercitationem, rerum itaque illum repellendus consequuntur?</p>
                </div>
                <div id="tab3" class="tab-content text-gray-700 hidden">
                    <h1 class="font-bold mt-9 mb-4 text-2xl">Payment</h1>
                    <p class="text-xl">Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur excepturi unde
                        doloribus.</p>
                </div>
                {{-- <table class="min-w-full bg-white border">
                        <thead>
                            <tr class="w-full bg-gray-100">
                                <th class="py-2 px-4 border-b text-left text-gray-600">Date Visit</th>
                                <th class="py-2 px-4 border-b text-left text-gray-600">Teeth No./s</th>
                                <th class="py-2 px-4 border-b text-left text-gray-600">Treatment</th>
                                <th class="py-2 px-4 border-b text-left text-gray-600">Description</th>
                                <th class="py-2 px-4 border-b text-left text-gray-600">Fees</th>
                                <th class="py-2 px-4 border-b text-left text-gray-600">Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-2 px-4 border-b">February 17, 2022</td>
                                <td class="py-2 px-4 border-b">26</td>
                                <td class="py-2 px-4 border-b">Complicated Extraction</td>
                                <td class="py-2 px-4 border-b">There are three missing teeth, 26 has been extracted due to
                                    extensive caries, 18 and 28 unerupted</td>
                                <td class="py-2 px-4 border-b">₱ 1,000</td>
                                <td class="py-2 px-4 border-b">-</td>
                            </tr>
                        </tbody>
                    </table> --}}
            </div>
        </div>
    </section>
@endsection
