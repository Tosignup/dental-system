@extends('admin.dashboard')
@section('content')
    <div class="m-4 mb-8">
        @include('components.search')
    </div>
    <section class=" m-4 p-4 bg-white shadow-lg rounded-md">
        <div class="flex items-center justify-between py-2">
            <label class="flex items-center gap-2" for="time">
                <h1 class="font-bold text-3xl mr-4">Inventory list</h1>
            </label>
            {{-- <form method="GET" action="{{ route('add.patient') }}"> --}}
            <form method="GET" action="">

                @csrf
                <button
                    class="flex justify-center items-center gap-2  rounded-md py-2 px-4 min-w-max border-2 border-gray-600 hover:shadow-md hover:border-green-700 font-semibold text-gray-800 transition-all">
                    Add Item
                    <img class="h-8" src="{{ asset('assets/images/dental-sealant.png') }}" alt="">
                </button>
            </form>
        </div>

        <!-- run @/foreach for each field/row  -->
        {{-- @foreach ($collection as $item) --}}

        <table class="w-full table-auto mb-2 overflow-hidden">
            <thead>
                <tr>
                    <th class="px-4 py-2 ">Item Code</th>
                    <th class="px-4 py-2 ">Item Name</th>
                    <th class="px-4 py-2 ">Quantity</th>
                    <th class="px-4 py-2 ">Category</th>
                    <th class="px-4 py-2 ">Actions</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <tr class="odd:bg-green-100 even:bg-slate-100">
                    <td class="border px-4 py-2">1</td>
                    <td class="border px-4 py-2">Lorem, ipsum dolor.</td>
                    <td class="border px-4 py-2">1</td>
                    <td class="border px-4 py-2">Lorem</td>
                    <td class="border px-4 py-2">
                        <div class="flex gap-2 justify-center items-center">
                            <a class=" border border-slate-600 rounded-md py-2 px-4 text-white font-semibold hover:bg-gray-400 transition-all"
                                href="#">
                                <img class=h-6 src="{{ asset('assets/images/edit-icon.png') }}" alt="">
                            </a>
                            <a class="border border-slate-600 rounded-md py-2 px-4 text-white font-semibold hover:bg-gray-400 transition-all"
                                href="#">
                                <img class=h-6 src="{{ asset('assets/images/view-icon.png') }}" alt="">
                            </a>
                        </div>
                    </td>
                    {{-- @endforeach --}}
                </tr>
            </tbody>
        </table>
    </section>
@endsection
