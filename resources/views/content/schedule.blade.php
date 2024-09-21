@extends('admin.dashboard')
@section('content')
    <div class="m-4 mb-8">
        @include('components.search')
    </div>
    <section class=" m-4 px-4 pb-4 bg-white shadow-lg rounded-md  max-xl:mt-14">
        <div class="flex items-center justify-between py-4">
            <label class="flex items-center gap-2" for="time">
                <h1 class="font-bold text-3xl max-md:text-xl min-w-max">Schedule list</h1>
            </label>
            <form method="GET" action="{{ route('add.schedule') }}">
                @csrf
                <button onclick="openModal()"
                    class="flex justify-center items-center gap-2 rounded-md py-2 px-4 min-w-max border-2 border-gray-600 hover:shadow-md hover:border-green-700 font-semibold text-gray-800 transition-all max-md:px-2">
                    <span class="max-md:text-xs"> Add Schedule</span>
                    <img class="h-6 max-md:h-4" src="{{ asset('assets/images/add.png') }}" alt="">
                </button>
            </form>
        </div>
        <table class="w-full table-auto mb-2 overflow-hidden">
            <thead>
                <tr>
                    <th class="px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs">Dentist</th>
                    <th class="px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs">Branch</th>
                    <th class="px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs">Date</th>

                   <th class="px-4 py-2 max-xl:hidden">Start Time</th>
                    <th class="px-4 py-2 max-xl:hidden">End Time</th>
                    <th class="px-4 py-2 max-xl:hidden">Appointment Duration</th>
                    <th class="px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs">Action</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($schedules as $schedule) --}}
                <tr class="odd:bg-green-100 even:bg-slate-100">
                    <td class="border px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs">
                        {{-- {{ $schedule->dentist->dentist_first_name . ' ' . $schedule->dentist->dentist_last_name }} --}}
                        First Last
                    </td>
                    <td class="border px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs">
                        {{-- {{ $schedule->date }} --}}
                        11-04-2024
                    </td>
                    <td class="border px-4 py-2 max-md:py-1 max-md:px-2 max-xl:hidden ">
                        {{-- {{ $schedule->start_time }} --}}
                        12:00</td>
                    <td class="border px-4 py-2 max-md:py-1 max-md:px-2 max-xl:hidden">
                        {{-- {{ $schedule->end_time }} --}}
                        13:00
                    </td>
                    <td class="border px-4 py-2 max-xl:hidden">
                        {{-- {{ $schedule->appointment_duration }} --}}
                        60 minutes</td>
                    <td class="border px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs max-xl:hidden">
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
                                        <p class="py-4 max-md:text-sm mb-4">Are you sure you want to delete this item?</p>
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
                    <td class="border px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs hidden max-xl:flex">
                        <a href="{{ route('show.schedule') }}"
                            class="flex justify-center items-center flex-1 m-1 border border-slate-600 rounded-md py-2 px-4 text-gray-900 font-semibold hover:bg-gray-400 transition-all">
                            <span class="hidden text-xs max-xl:block">View</span>
                        </a>
                    </td>
                </tr>
                {{-- @endforeach --}}

            </tbody>
        </table>
    </section>

    <script>
        document.getElementById('sort').addEventListener('change', function() {
            this.form.submit();
            document.getElementById('package').toUpperCase();
        });

        function openDeleteModal() {
            const deleteModal = document.getElementById('deleteModal');
            deleteModal.showModal();
        }
    </script>
@endsection


{{-- - schedule td still not responsive, missing schedule information page. - --}}
