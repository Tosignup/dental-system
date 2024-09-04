@extends('admin.dashboard')
@section('content')
    <div class="m-4">
        @include('components.search')
    </div>
    <section class="bg-white m-4 p-8 shadow-lg rounded-md flex flex-col justify-center z-0">
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-5xl font-bold mb-6">{{ $dentist->dentist_first_name }} {{ $dentist->dentist_last_name }}
                </h1>
                <div class="flex flex-col gap-3 text-md">
                    <h1> Gender: <span class="font-semibold"> {{ $dentist->dentist_gender }} </span> </h1>
                    <h1> Birth date: <span class="font-semibold"> {{ $dentist->dentist_birth_date }} </span> </h1>
                    <h1> Facebook name: <span class="font-semibold"> {{ $dentist->fb_name }} </span> </h1>
                    <h1> Package availed: <span class="font-semibold"> {{ $dentist->package }} </span> </h1>
                    <h1> Phone number: <span class="font-semibold"> {{ $dentist->dentist_phone_number }} </span> </h1>
                    <h1> Date of next visit: <span class="font-semibold"> {{ $dentist->next_visit }} </span> </h1>
                </div>
            </div>
            <div>
                @if ($dentist && $dentist->schedules)
                    {
                    @foreach ($dentist->schedules as $schedule)
                        <tr class="odd:bg-green-100 even:bg-slate-100">
                            <td class="border px-4 py-2">{{ $schedule->date }}</td>
                            <td class="border px-4 py-2">{{ $schedule->start_time }}</td>
                            <td class="border px-4 py-2">{{ $schedule->end_time }}</td>
                            <td class="border px-4 py-2">{{ $schedule->appointment_duration }}</td>
                            <td class="border py-2">
                                <div class="flex gap-2 justify-center items-center">
                                    <a
                                        class=" border border-slate-600 rounded-md py-2 px-4 text-white font-semibold hover:bg-gray-400 transition-all">
                                        {{-- href=" {{ route('edit.schedule', $schedule->id) }} "> --}}
                                        <img class=h-6 src="{{ asset('assets/images/edit-icon.png') }}" alt="">
                                    </a>

                                    <a href="{{ route('show.patient', $schedule->id) }}"
                                        class="border border-slate-600 rounded-md py-2 px-4 text-white font-semibold hover:bg-gray-400 transition-all">
                                        <img class=h-6 src="{{ asset('assets/images/view-icon.png') }}" alt="">
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    }
                @else
                    <div class="flex gap-2 items-center">
                        <img class="h-8" src="{{ asset('assets/images/exclamation-mark.png') }}" alt="">
                        <p class="font-semibold text-red-600">No schedules found for this dentist.</p>
                    </div>
                @endif
            </div>
            <div class="flex flex-col gap-4">
            </div>
        </div>
    </section>
@endsection
