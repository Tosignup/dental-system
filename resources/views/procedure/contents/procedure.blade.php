@extends('admin.dashboard')
@section('content')
    <div class="m-4 mb-8">
        @include('components.search')
    </div>
    <section class=" m-4 p-4 bg-white shadow-lg rounded-md max-lg:mt-14">
        <div class="flex items-center justify-between py-2  max-lg:flex-wrap">
            <label class="flex items-center gap-2" for="time">
                <h1 class="font-bold text-3xl mr-4 max-md:mr-0 max-md:text-2xl">Procedure List</h1>
            </label>
            <form method="GET" action="{{ route('procedure.add') }}">
                @csrf
                <button
                    class="flex justify-center items-center gap-2  rounded-md py-2 px-4 min-w-max border-2 border-gray-600 hover:shadow-md hover:border-green-700 font-semibold text-gray-800 transition-all max-md:px-2">
                    <span class="max-md:text-xs"> Add Procedure</span>
                    <img class="h-8 max-md:h-4" src="{{ asset('assets/images/add.png') }}" alt="">
                </button>
            </form>
        </div>

        <table class="w-full table-auto mb-2 overflow-hidden">
            <thead>
                <tr class="bg-gray-300 text-gray-500">
                    <th class="px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs">Procedure Code</th>
                    <th class="px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs">Procedure Name</th>
                    <th class="px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs">Price</th>
                    <th class="px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs">Type of visit</th>
                    <th class="px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs">Actions</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($procedures as $procedure)
                    <tr class="border-b-2">
                        <td class="px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs">{{ $procedure->id }}</td>
                        <td class="px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs">{{ $procedure->name }}</td>
                        <td class="px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs">{{ $procedure->price }}</td>
                        <td class="px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs">
                            <span
                                @if ($procedure->visit_type === 'Single') class="bg-slate-200 text-slate-700 py-1 px-3 rounded-full font-semibold">
                                @elseif ($procedure->visit_type === 'Multiple') class="bg-green-200 text-green-700 py-1 px-3 rounded-full font-semibold"> @endif
                                {{ $procedure->visit_type }}</span>
                        </td>
                        <td class="px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs max-md:flex">
                            <div class="flex gap-2 justify-center flex-wrap items-center">
                                <a class=" border border-slate-600 flex max-md:flex-1 justify-center items-center rounded-md py-2 px-4 max-md:py-1 max-md:px-2 text-white font-semibold hover:bg-gray-300 transition-all"
                                    href="#">
                                    <h1 class=" text-xs text-gray-700 text-center">Edit</h1>
                                </a>

                                <div class="flex self-start max-md:text-xs ">
                                    <div
                                        class=" border border-slate-600 flex max-md:flex-1 justify-center items-center rounded-md py-2 px-4 max-md:py-1 max-md:px-2 text-white font-semibold hover:bg-gray-300 transition-all">
                                        <button class="  text-xs text-gray-700 text-center"
                                            onclick="my_modal_5.showModal()">Delete</button>
                                    </div>
                                    <dialog id="my_modal_5" class="modal p-4 rounded-md max-md:text-lg">
                                        <div class="modal-box flex flex-col">
                                            <h3 class="text-lg font-bold max-md:text-sm text-left">Inventory</h3>
                                            <p class="py-4 max-md:text-sm mb-4">Are you sure you want to delete this item?
                                            </p>
                                            <div class="modal-action flex gap-2 self-end">
                                                <form method="dialog"
                                                    class="border rounded-md hover:bg-gray-300 transition-all py-2 px-4">
                                                    <button class="btn max-md:text-xs">Close</button>
                                                </form>
                                                <form method="dialog"
                                                    class="border rounded-md  hover:bg-gray-300 transition-all py-2 px-4">
                                                    <button class="btn max-md:text-xs">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </dialog>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection
