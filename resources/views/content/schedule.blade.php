@extends('admin.dashboard')
@section('content')
    <div class="m-4 mb-8">
        @include('components.search')
    </div>
    <section class=" m-4 px-4 pb-4 bg-white shadow-lg rounded-md">
        <div class="flex items-center justify-between py-4">
            <label class="flex items-center gap-2" for="time">
                <h1 class="font-bold text-3xl mr-4">Schedule list</h1>
                {{-- <form method="GET" action="{{ route('patient_list') }}" class="flex gap-4 items-center justify-center m-4">
                    <h1>Sort by: </h1>
                    <select name="sort" class="border text-sm w-32 border-gray-400 p-2 px-4 mx-2 rounded-md"
                        id="sort">
                        <option value="id" {{ request()->get('sort') == 'id' ? 'selected' : '' }}>ID</option>
                        <option value="date_of_next_visit"
                            {{ request()->get('sort') == 'date_of_next_visit' ? 'selected' : '' }}>Next visit</option>
                        <option value="name" {{ request()->get('sort') == 'name' ? 'selected' : '' }}>Name</option>

                    </select>
                </form> --}}
            </label>
            <form method="GET" action="{{ route('add.schedule') }}">
                @csrf
                <button onclick="openModal()"
                    class="flex justify-center items-center gap-2  rounded-md py-2 px-4 min-w-max border-2 border-gray-600 hover:shadow-md hover:border-green-700 font-semibold text-gray-800 transition-all">
                    Add Schedule
                    <img class="h-6" src="{{ asset('assets/images/add.png') }}" alt="">
                </button>
            </form>
        </div>

        <!-- run @/foreach for each field/row  -->
        <table class="w-full table-auto mb-2 overflow-hidden">
            <thead>
                <tr>
                    <th class="px-4 py-2">Dentist</th>
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">Start Time</th>
                    <th class="px-4 py-2">End Time</th>
                    <th class="px-4 py-2">Appointment Duration</th>
                    <th class="px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($schedules as $schedule)
                    <tr class="odd:bg-green-100 even:bg-slate-100">
                        <td class="border px-4 py-2">
                            {{ $schedule->dentist->dentist_first_name . ' ' . $schedule->dentist->dentist_last_name }}</td>
                        <td class="border px-4 py-2">{{ $schedule->date }}</td>
                        <td class="border px-4 py-2">{{ $schedule->start_time }}</td>
                        <td class="border px-4 py-2">{{ $schedule->end_time }}</td>
                        <td class="border px-4 py-2">{{ $schedule->appointment_duration }}</td>
                        <td class="border py-2">
                            <div class="flex gap-2 justify-center items-center">
                                <a href="{{ route('show.patient', $schedule->id) }}"
                                    class="border border-slate-600 rounded-md py-2 px-4 text-white font-semibold hover:bg-gray-400 transition-all">
                                    <img class=h-6 src="{{ asset('assets/images/trash-can.png') }}" alt="">
                                </a>
                                <a href="{{ route('show.patient', $schedule->id) }}"
                                    class="border border-slate-600 rounded-md py-2 px-4 text-white font-semibold hover:bg-gray-400 transition-all">
                                    <img class=h-6 src="{{ asset('assets/images/edit-icon.png') }}" alt="">
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- <div class="w-full">
            {{ $dentists->links() }}
        </div> --}}


    </section>

    <script>
        document.getElementById('sort').addEventListener('change', function() {
            this.form.submit();
            document.getElementById('package').toUpperCase();
        });
    </script>
@endsection
