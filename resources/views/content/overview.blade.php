@extends('admin.dashboard')
@section('content')
    <section class="flex m-4 flex-col gap-4">
        @include('components.search')
        <div class="rounded-xl shadow-lg p-7 bg-white my-4 gap-4">
            <h1 class="text-5xl font-bold my-2">Good day, {{ Auth::user()->username }}!</h1>
            <h1>Have a nice working day!</h1>
        </div>
        <div class="w-full flex gap-5 justify-evenly">
            <div class="w-full bg-white shadow-lg rounded-xl p-5 flex flex-col items-center justify-center">
                <div class="mb-8 text-center">
                    <h1 class="text-4xl font-semibold">Patient Statistics</h1>
                    <h1>Lorem ipsum dolor sit amet, consectetur</h1>
                </div>
                <div class="flex gap-3">
                    <div
                        class="flex w-max h-36 py-4 px-2 justify-start border border-gray-700 items-center flex-col gap-2 rounded-md ">
                        <h1 class="text-md font-semibold">Total of patients</h1>
                        <h1 class="text-4xl font-bold">
                            {{ $totalPatients > 0 ? $totalPatients : 0 }}
                        </h1>
                    </div>
                    <div
                        class="flex w-max h-36 py-4 px-2 justify-start border border-gray-700 items-center flex-col gap-2 rounded-md ">
                        <h1 class="text-md font-semibold">New patients</h1>
                        <h1 class="text-4xl font-bold">
                            {{ $newPatients > 0 ? $newPatients : 0 }}
                        </h1>
                    </div>
                    <div
                        class="flex w-max h-36 py-4 px-2 justify-start border border-gray-700 items-center flex-col gap-2 rounded-md ">
                        <h1 class="text-md font-semibold">Today's Patients</h1>
                        <h1 class="text-4xl font-bold">{{ $todayPatients > 0 ? $todayPatients : 0 }}</h1>
                    </div>
                </div>
            </div>
            <div class="w-full bg-white shadow-lg rounded-xl p-5 flex flex-col items-center justify-center">
                <div class="mb-8 text-center">
                    <h1 class="text-4xl font-semibold">Appointment Summary</h1>
                    <h1>Lorem ipsum dolor sit amet, consectetur</h1>
                </div>
                <div class="flex gap-8">
                    <div
                        class="flex w-max h-36 py-4 px-2 justify-start border border-gray-700 items-center flex-col gap-2 rounded-md ">
                        <h1 class="text-md font-semibold">Total of Appointments</h1>
                        <h1 class="text-4xl font-bold">
                            {{-- {{$totalAppointments > 0 ? $totalAppointments : 0}} --}}
                        </h1>
                    </div>
                    <div
                        class="flex w-max h-36 py-4 px-2 justify-start border border-gray-700 items-center flex-col gap-2 rounded-md ">
                        <h1 class="text-md font-semibold">New Appointments</h1>
                        <h1 class="text-4xl font-bold">
                            {{-- {{$newAppointments > 0 ? $newAppointments : 0}} --}}
                        </h1>
                    </div>
                    <div
                        class="flex w-max h-36 py-4 px-2 justify-start border border-gray-700 items-center flex-col gap-2 rounded-md ">
                        <h1 class="text-md font-semibold">Today's Appointments</h1>
                        {{-- <h1 class="text-4xl font-bold">{{$todayAppointment > 0 ? $todayAppointment : 0}}</h1> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
