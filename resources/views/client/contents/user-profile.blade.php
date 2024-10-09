@extends('client.profile')

@section('content')
    <section class="flex gap-5 h-max p-6 max-xl:mt-14">
        <!-- Main Content -->
        <div class="bg-white p-4 rounded-lg shadow-md max-xl:text-xs">
            <!-- Tab Navigation -->
            <div class="border-b border-gray-200 mb-4">
                <nav class="flex flex-wrap gap-5">
                    <button
                        class="text-gray-500 pb-2 border-b-2 border-transparent focus:outline-none hover:border-b-green-300 transition-all"
                        data-tab-target="#tab1">
                        Patient Background
                    </button>
                    <button
                        class="text-gray-500 pb-2 border-b-2 border-transparent focus:outline-none hover:border-b-green-300 transition-all"
                        data-tab-target="#tab2">X-rays
                    </button>
                    <button
                        class="text-gray-500 pb-2 border-b-2 border-transparent focus:outline-none hover:border-b-green-300 transition-all"
                        data-tab-target="#tab3">Contract
                    </button>
                </nav>
            </div>
            <!-- Table -->
            <div>
                <div id="tab1" class="tab-content text-gray-700 hidden max-h-max">
                    <h1 class="font-bold mt-9 mb-4 text-2xl">Patient Background</h1>
                    @if ($backgroundImage)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div>
                                <img src="{{ asset('storage/' . $backgroundImage->image_path) }}" alt="Contract Image"
                                    class="img-fluid ">
                            </div>
                        </div>
                    @else
                        <p>No X-ray images uploaded for this patient.</p>
                    @endif
                </div>
                <div id="tab2" class="tab-content text-gray-700 hidden">
                    <h1 class="font-bold mt-9 mb-4 text-2xl">X-rays</h1>
                    @if ($xrayImages->isEmpty())
                        <p>No X-ray images uploaded for this patient.</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($xrayImages as $image)
                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="X-ray Image" class="img-fluid">
                            @endforeach
                        </div>
                    @endif
                </div>
                <div id="tab3" class="tab-content text-gray-700 hidden">
                    <h1 class="font-bold mt-9 mb-4 text-2xl">Contract</h1>
                    @if ($contractImage)
                        <div>
                            <img src="{{ asset('storage/' . $contractImage->image_path) }}" alt="Contract Image"
                                class="img-fluid ">
                        </div>
                    @else
                        <p>No contract image uploaded for this patient.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
