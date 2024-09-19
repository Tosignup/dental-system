@extends('admin.dashboard')
@section('content')
    <div class="m-4 mb-8">
        @include('components.search')
    </div>
    <section class=" m-4 px-4 pb-4 bg-white shadow-lg rounded-md  max-lg:mt-14">
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
                    <th class="px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs">Date</th>
                    <th class="px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs">Start Time</th>
                    <th class="px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs">End Time</th>
                    <th class="px-4 py-2 max-lg:hidden">Appointment Duration</th>
                    <th class="px-4 py-2max-md:py-1 max-md:px-2 max-md:text-xs">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($schedules as $schedule)
                    <tr class="odd:bg-green-100 even:bg-slate-100">
                        <td class="border px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs">
                            {{ $schedule->dentist->dentist_first_name . ' ' . $schedule->dentist->dentist_last_name }}</td>
                        <td class="border px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs">{{ $schedule->date }}</td>
                        <td class="border px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs">{{ $schedule->start_time }}</td>
                        <td class="border px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs">{{ $schedule->end_time }}</td>
                        <td class="border px-4 py-2 max-lg:hidden">{{ $schedule->appointment_duration }}</td>
                        <td class="border py-2">
                            <div class="flex gap-2 justify-center items-center">
                                <a href="{{ route('show.schedule', $schedule->id) }}"
                                    class="border border-slate-600 rounded-md py-2 px-4 text-white font-semibold hover:bg-gray-400 transition-all">
                                    <img class="h-6" src="{{ asset('assets/images/trash-can.png') }}" alt="">
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
    </section>

    <script>
        document.getElementById('sort').addEventListener('change', function() {
            this.form.submit();
            document.getElementById('package').toUpperCase();
        });
    </script>
@endsection


{{-- - schedule td still not responsive, missing schedule information page. - --}}
