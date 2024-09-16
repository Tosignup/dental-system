@extends('admin.dashboard')
@section('content')
    <div class="m-4">
        @include('components.search')
    </div>
    <section class="bg-white max-md:mt-7 m-4 p-8 shadow-lg rounded-md flex flex-wrap justify-between z-0">
        <div class="flex flex-wrap justify-between items-start">
            <div class="flex justify-between mb-6 gap-4 items-start ">
                <h1 class="text-5xl font-bold max-md:text-3xl">{{ $dentist->dentist_first_name }}
                    {{ $dentist->dentist_last_name }}
                </h1>
                @if ($dentist && $dentist->schedules)
                    {
                    @foreach ($dentist->schedules as $schedule)
                        <tr class="odd:bg-green-100 even:bg-slate-100">
                            <td class="border px-4 py-2 max-md:text-xs">{{ $schedule->date }}</td>
                            <td class="border px-4 py-2 max-md:text-xs">{{ $schedule->start_time }}</td>
                            <td class="border px-4 py-2 max-md:text-xs">{{ $schedule->end_time }}</td>
                            <td class="border px-4 py-2 max-md:text-xs">{{ $schedule->appointment_duration }}</td>
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
                    <div class="flex gap-2 items-center justify-center">
                        <img class="h-8 max-md:h-5" src="{{ asset('assets/images/exclamation-mark.png') }}" alt="">
                        <p class="font-semibold text-red-600 max-md:text-xs ">No schedules found for
                            this
                            dentist.</p>
                    </div>
                @endif

            </div>
            <div>
                <div class="flex flex-col justify-start items-start gap-3 text-md">
                    <a class="flex justify-center gap-3 items-center border border-slate-600 rounded-md py-2 px-4 max-md:py-1 max-md:px-2 text-white font-semibold hover:bg-gray-400 transition-all"
                        href=" {{ route('edit.dentist', $dentist->id) }} ">
                        <img class="h-7 sm:h-4 sm:w-4 max-sm:h-4 max-sm:w-4"
                            src="{{ asset('assets/images/edit-icon.png') }}" alt="">
                        <h1 class="text-slate-900 max-md:hidden">Edit information</h1>
                    </a>
                    <h1 class=" max-md:text-sm"> Gender: <span class="font-semibold"> {{ $dentist->dentist_gender }}
                        </span>
                    </h1>
                    <h1 class=" max-md:text-sm"> Birth date: <span class="font-semibold">
                            {{ $dentist->dentist_birth_date }}
                        </span>
                    </h1>
                    <h1 class=" max-md:text-sm"> Facebook name: <span class="font-semibold"> {{ $dentist->fb_name }}
                        </span>
                    </h1>
                    <h1 class=" max-md:text-sm"> Package availed: <span class="font-semibold"> {{ $dentist->package }}
                        </span> </h1>
                    <h1 class=" max-md:text-sm"> Phone number: <span class="font-semibold">
                            {{ $dentist->dentist_phone_number }}
                        </span> </h1>
                    <h1 class=" max-md:text-sm"> Date of next visit: <span class="font-semibold">
                            {{ $dentist->next_visit }}
                        </span>
                    </h1>
                </div>
            </div>


        </div>
    </section>
@endsection
