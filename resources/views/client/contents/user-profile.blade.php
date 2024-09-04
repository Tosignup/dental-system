@extends('client.profile')
@section('content')
    <section class="flex gap-5 h-svh p-6">
        <!-- Main Content -->
        <div class="w-3/4 bg-white p-4 rounded-lg shadow-md">
            <!-- Tab Navigation -->
            <div class="border-b border-gray-200 mb-4">
                <nav class="flex flex-wrap gap-5">
                    <button
                        class="text-gray-500 pb-2 border-b-2 border-transparent focus:outline-none hover:border-b-green-300 transition-all"
                        data-tab-target="#tab1">
                        Patient Background</button>
                    <button
                        class="text-gray-500 pb-2 border-b-2 border-transparent focus:outline-none hover:border-b-green-300 transition-all"
                        data-tab-target="#tab2">X-rays
                    </button>
                    <button
                        class="text-gray-500 pb-2 border-b-2 border-transparent focus:outline-none hover:border-b-green-300 transition-all"
                        data-tab-target="#tab3">Contract</button>
                </nav>
            </div>

            <!-- Table -->
            <div>
                <div id="tab1" class="tab-content text-gray-700 hidden">
                    <h1 class="font-bold mt-9 mb-4 text-2xl">Patient Background</h1>
                    <img class="h-4/6 w-4/6" src="{{ asset('assets/images/patient-background-image.png') }}" alt="">
                </div>
                <div id="tab2" class="tab-content text-gray-700 hidden">
                    <h1 class="font-bold mt-9 mb-4 text-2xl">X-rays</h1>
                    <img class="" src="{{ asset('assets/images/x-ray-image.png') }}" alt="">
                </div>
                <div id="tab3" class="tab-content text-gray-700 hidden">
                    <img class="h-4/6 w-4/6" src="{{ asset('assets/images/contract-image.png') }}" alt="">
                </div>

            </div>
        </div>
    </section>
@endsection
