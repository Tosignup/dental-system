@extends('admin.dashboard')
@section('content')
    <div class="m-4 mb-8">
        @include('components.search')
    </div>
    <section class=" m-4 p-4 bg-white shadow-lg rounded-md">
        <div class="flex items-center justify-between py-2  max-lg:flex-wrap">
            <label class="flex items-center gap-2" for="time">
                <h1 class="font-bold text-3xl mr-4 max-md:mr-0 max-md:text-2xl">Inventory list</h1>
            </label>
            <form method="GET" action="">

                @csrf
                <button
                    class="flex justify-center items-center gap-2  rounded-md py-2 px-4 min-w-max border-2 border-gray-600 hover:shadow-md hover:border-green-700 font-semibold text-gray-800 transition-all max-md:px-2">
                    <span class="max-md:text-xs"> Add Item</span>
                    <img class="h-8 max-md:h-4" src="{{ asset('assets/images/add.png') }}" alt="">
                </button>
            </form>
        </div>

        <table class="w-full table-auto mb-2 overflow-hidden">
            <thead>
                <tr>
                    <th class="px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs">Item Code</th>
                    <th class="px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs">Item Name</th>
                    <th class="px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs">Quantity</th>
                    <th class="px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs">Category</th>
                    <th class="px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs">Actions</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <tr class="odd:bg-green-100 even:bg-slate-100">
                    <td class="border px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs">1</td>
                    <td class="border px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs">Lorem, ipsum dolor.</td>
                    <td class="border px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs">1</td>
                    <td class="border px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs">Lorem</td>
                    <td class="border px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs max-md:flex">
                        <div class="flex gap-2 justify-center flex-wrap items-center">
                            <a class=" border border-slate-600 flex max-md:flex-1 justify-center items-center rounded-md py-2 px-4 max-md:py-1 max-md:px-2 text-white font-semibold hover:bg-gray-400 transition-all"
                                href="#">
                                <img class="h-6 max-md:hidden" src="{{ asset('assets/images/edit-icon.png') }}"
                                    alt="">
                                <h1 class="hidden max-md:block text-xs text-gray-700 text-center">Edit</h1>
                            </a>
                            <a class="border border-slate-600 flex max-md:flex-1 justify-center items-center rounded-md py-2 px-4 max-md:py-1 max-md:px-2 text-white font-semibold hover:bg-gray-400 transition-all"
                                href="#">
                                <img class="h-6 max-md:hidden"src="{{ asset('assets/images/user-icon.png') }}"
                                    alt="">
                                <h1 class="hidden max-md:block text-xs text-gray-700">Delete</h1>
                            </a>

                        </div>

                    </td>
                    <td>

                    </td>
                </tr>
            </tbody>
        </table>
    </section>
@endsection
