@extends('admin.dashboard')
@section('content')
    <div class="m-4 mb-8">
        @include('components.search')
    </div>
    <section class="flex gap-5 max-lg:justify-center max-lg:items-center bg-gray-100 p-6 max-2xl:flex-wrap max-2xl:mt-16">
        <!-- Sidebar -->
        <div class="min-w-80 w-1/4 bg-white p-4 rounded-lg shadow-md">
            <div class="flex flex-col items-center text-center">
                <div
                    class="w-20 h-20 rounded-full bg-gray-300 flex items-center justify-center text-4xl text-gray-700 font-bold">
                    {{ substr($user->username, 0, 1) }}
                </div>
                <h2 class="mt-4 text-xl font-bold">{{ $user->username }}</h2>
                <p class="text-gray-500">{{ $user->email }}</p>
            </div>
            <div class="mt-6">
                <hr class="w-full bg-gray">
                <div class="flex flex-col justify-center items-between">
                    <div class="flex justify-between min-w-max my-2 py-2 px-4 gap-4">
                        <h3 class="font-bold text-gray-600">Gender</h3>
                        <p>{{ $user->gender }}</p>
                    </div>
                    <hr class="w-full bg-gray">
                    <div class="flex justify-between min-w-max my-2 py-2 px-4 gap-4">
                        <h3 class="font-bold text-gray-600">Birthdate</h3>
                        <p>{{ $user->date_of_birth }}</p>
                    </div>
                    <hr class="w-full bg-gray">
                    <div class="flex justify-between min-w-max my-2 py-2 px-4 gap-4">
                        <h3 class="font-bold text-gray-600">Phone</h3>
                        <p>{{ $user->phone_number }}</p>
                    </div>
                    <hr class="w-full bg-gray">
                    <div class="flex justify-between min-w-max my-2 py-2 px-4 gap-4">
                        <h3 class="font-bold text-gray-600">{{ $user->role }} ID</h3>
                        @auth
                            @if (session('patient_id'))
                                <p class="">{{ session('patient_id') }}</p>
                            @else
                                <p>No Patient ID found in session.</p>
                            @endif
                        @endauth
                    </div>
                    <div class="flex justify-between min-w-max my-2 py-2 px-4 gap-4">
                        <h3 class="font-bold text-gray-600">Address</h3>
                        <p>San Joaquin, Mabalacat</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
