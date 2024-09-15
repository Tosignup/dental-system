@extends('admin.dashboard')
@section('content')
<section class="flex m-4 flex-col gap-4">
    @include('components.search')
    <div class="rounded-xl shadow-lg p-7 bg-white my-4 gap-4 max-w-">
        <h1 class="text-5xl font-bold my-2">Good day, {{ Auth::user()->username }}!</h1>
        <h1>Let's brighten smiles and make a difference today!</h1>
    </div>
    <div class="w-full flex gap-5 justify-start items flex-wrap">
        <div class="w-full bg-white shadow-lg rounded-xl p-8 flex flex-col items-center justify-center max-w-md">
            <div class="mb-8 text-center">
                <h1 class="text-3xl font-bold">Patient Statistics</h1>
            </div>
            <div class="flex gap-4 flex-col justify-center items-start">
                <div class="flex gap-4 flex-col">
                    <a href="{{ route('patient_list') }}" class="flex-1 flex py-4 px-8 justify-between bg-white shadow-lg items-center gap-4 rounded-md hover:bg-gray-100 transition-all cursor-pointer">
                        <img class="h-12" src="{{ asset('assets/images/total-icon.png') }}" alt="">
                        <h1 class="text-md font-semibold">Total Patients</h1>
                        <h1 class="text-4xl font-bold">{{ $totalPatients > 0 ? $totalPatients : 0 }}</h1>
                    </a>

                    <a href="{{ route('patient_list') }}"  class="flex-1 flex py-4 px-8 justify-between bg-white shadow-lg items-center gap-2 rounded-md hover:bg-gray-100 transition-all cursor-pointer">
                        <img class="h-12" src="{{ asset('assets/images/today-icon.png') }}" alt="">

                        <h1 class="text-md font-semibold">Today's Patients</h1>
                        <h1 class="text-4xl font-bold">{{ $todayPatients > 0 ? $todayPatients : 0 }}</h1>

                    </a>

                    <a href="{{ route('patient_list') }}"  class="flex-1 flex py-4 px-8 justify-between bg-white shadow-lg items-center gap-2 rounded-md hover:bg-gray-100 transition-all cursor-pointer">
                        <img class="h-12" src="{{ asset('assets/images/new-icon.png') }}" alt="">

                        <h1 class="text-md font-semibold">New Patients</h1>
                        <h1 class="text-4xl font-bold">{{ $newPatients > 0 ? $newPatients : 0 }}</h1>

                    </a>
                </div>

            </div>
        </div>
        <div class="w-full bg-white shadow-lg rounded-xl p-8 flex flex-col items-center justify-center max-w-md">
            <div class="mb-8 text-center">
                <h1 class="text-3xl font-bold">Appointment Summary</h1>
            </div>
            <div class="flex gap-4 flex-col">
                <a href="{{route('appointment.submission')}}"
                    class="flex-1 flex py-4 px-8 justify-between bg-white shadow-lg items-center gap-2 rounded-md hover:bg-gray-100 transition-all  ">
                    <img class="h-12" src="{{ asset('assets/images/appointment-total.png') }}" alt="">
                    <h1 class="text-md font-semibold">Total of Appointments</h1>
                    <h1 class="text-4xl font-bold">
                        {{$totalAppointments > 0 ? $totalAppointments : 0}}
                    </h1>
                </a>
                <a
                href="{{route('appointment.submission')}}"
                class="flex-1 flex py-4 px-8 justify-between bg-white shadow-lg items-center gap-2 rounded-md hover:bg-gray-100 transition-all  ">
                <img class="h-12" src="{{ asset('assets/images/appointment-new.png') }}" alt="">
                    <h1 class="text-md font-semibold">New Appointments</h1>
                    <h1 class="text-4xl font-bold">
                        {{$newAppointments > 0 ? $newAppointments : 0}}
                    </h1>
                </a>
                <a
                href="{{route('appointment.submission')}}"
                    class="flex-1 flex py-4 px-8 justify-between bg-white shadow-lg items-center gap-2 rounded-md hover:bg-gray-100 transition-all  ">
                <img class="h-12" src="{{ asset('assets/images/appointment-today.png') }}" alt="">
                    <h1 class="text-md font-semibold">Today's Appointments</h1>
                    <h1 class="text-4xl font-bold">{{$todayAppointment > 0 ? $todayAppointment : 0}}</h1>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
