<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }} | Request an Appointment</title>
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <style>
        .logo {
            width: 100px;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <section class="h-screen bg-slate-100 flex justify-center items-center">
        <div class="bg-white rounded-lg shadow-lg flex">
            <div class="bg-green-600 rounded-lg text-white p-8 max-lg:p-0 flex flex-col justify-between">
                <div class="flex flex-col items-center p-3">
                    <div class="flex flex-col items-center">
                        <img class="h-24  max-lg:h-12" src="{{ asset('assets/images/logo.png') }}" alt="Dental Logo">
                        <h1 class="text-white font-semibold text-sm max-lg:text-xs mt-2">Tooth Impression's Dental
                            Clinic
                        </h1>
                        <h1 class="min-w-max font-bold text-4xl m-5 max-lg:text-2xl text-white max-w-sm text-center">
                            Request an
                            Appointment</h1>
                    </div>

                    <form method="POST" action="{{ route('appointments.store') }}"
                        class="flex flex-col justify-center items-center">
                        @csrf
                        <div class="w-full px-2">
                            <label for="branch">
                                <h1 class="font-semibold max-lg:text-md">Branch</h1>

                                <select
                                    class="w-full border text-black border-gray-400 mb-2 py-2 px-4 rounded-md max-lg:py-1 max-lg:px-2 max-lg:text-sm"
                                    id="branch" name="branch">
                                    <option value="Dau">Dau</option>
                                    <option value="Angeles">Angeles</option>
                                    <option value="Sindalan">Sindalan</option>
                                </select>
                            </label>
                        </div>
                        <div class="flex flex-row p-2 gap-5">
                            <div>
                                <label for="first_name">
                                    <h1 class="font-semibold max-lg:text-md">First Name</h1>
                                    <input
                                        class="w-full border text-black border-gray-400 mb-2 py-2 px-4 rounded-md max-lg:py-1 max-lg:px-2 max-lg:text-sm"
                                        type="text" name="first_name" id="first_name">
                                    @error('phone_number')
                                        <span id="phone_number_error"
                                            class="validation-message text-white bg-red-600 p-1 rounded-md my-1 show max-lg:text-xs max-lg:text-xs max-lg:p-0.5 max-lg:rounded-none">{{ $message }}</span>
                                    @enderror
                                </label>

                                <label for="email">
                                    <h1 class="font-semibold max-lg:text-md">Email</h1>
                                    <input
                                        class="w-full border text-black border-gray-400 mb-2 py-2 px-4 rounded-md max-lg:py-1 max-lg:px-2 max-lg:text-sm max-lg:p-0.5 max-lg:rounded-none"
                                        type="email" name="email" id="email">
                                    @error('phone_number')
                                        <span id="phone_number_error"
                                            class="validation-message text-white bg-red-600 p-1 rounded-md my-1 show max-lg:text-xs">{{ $message }}</span>
                                    @enderror
                                </label>
                                <label for="date_of_birth">
                                    <h1 class="font-semibold max-lg:text-md">Date of Birth</h1>
                                    <input
                                        class="w-full border text-black border-gray-400 mb-2 py-2 px-4 rounded-md max-lg:py-1 max-lg:px-2 max-lg:text-sm"
                                        type="date" name="date_of_birth" id="date_of_birth">
                                    @error('phone_number')
                                        <span id="phone_number_error"
                                            class="validation-message text-white bg-red-600 p-1 rounded-md my-1 show max-lg:text-xs max-lg:p-0.5 max-lg:rounded-none">{{ $message }}</span>
                                    @enderror
                                </label>
                                <label for="appointment_date">
                                    <h1 class="font-semibold max-lg:text-md">Appointment Date</h1>
                                    <input
                                        class="w-full border text-black border-gray-400 mb-2 py-2 px-4 rounded-md max-lg:py-1 max-lg:px-2 max-lg:text-sm"
                                        type="date" name="appointment_date" id="appointment_date">
                                    @error('phone_number')
                                        <span id="phone_number_error"
                                            class="validation-message text-white bg-red-600 p-1 rounded-md my-1 show max-lg:text-xs max-lg:p-0.5 max-lg:rounded-none">{{ $message }}</span>
                                    @enderror
                                </label>
                            </div>
                            <div>
                                <label for="last_name">
                                    <h1 class="font-semibold max-lg:text-md">Last Name</h1>
                                    <input
                                        class="w-full border text-black border-gray-400 mb-2 py-2 px-4 rounded-md max-lg:py-1 max-lg:px-2 max-lg:text-sm"
                                        type="text" name="last_name" id="last_name">
                                    @error('phone_number')
                                        <span id="phone_number_error"
                                            class="validation-message text-white bg-red-600 p-1 rounded-md my-1 show max-lg:text-xs max-lg:p-0.5 max-lg:rounded-none">{{ $message }}</span>
                                    @enderror
                                </label>
                                <label for="zip_code">
                                    <h1 class="font-semibold max-lg:text-md">Zip Code</h1>
                                    <input
                                        class="w-full border text-black border-gray-400 mb-2 py-2 px-4 rounded-md max-lg:py-1 max-lg:px-2 max-lg:text-sm"
                                        type="number" name="zip_code" id="zip_code">
                                    @error('phone_number')
                                        <span id="phone_number_error"
                                            class="validation-message text-white bg-red-600 p-1 rounded-md my-1 show max-lg:text-xs max-lg:p-0.5 max-lg:rounded-none">{{ $message }}</span>
                                    @enderror
                                </label>
                                <label for="phone_number">
                                    <h1 class="font-semibold max-lg:text-md">Phone Number</h1>
                                    <input
                                        class="w-full border text-black border-gray-400 mb-2 py-2 px-4 rounded-md max-lg:py-1 max-lg:px-2 max-lg:text-sm"
                                        type="number" name="phone_number" id="phone_number">
                                    @error('phone_number')
                                        <span id="phone_number_error"
                                            class="validation-message text-white bg-red-600 p-1 rounded-md my-1 show max-lg:text-xs max-lg:p-0.5 max-lg:rounded-none">{{ $message }}</span>
                                    @enderror
                                </label>

                                <label for="preferred_time">
                                    <h1 class="font-semibold max-lg:text-md">Preferred Time</h1>
                                    <input
                                        class="w-full border text-black border-gray-400 mb-2 py-2 px-4 rounded-md max-lg:py-1 max-lg:px-2 max-lg:text-sm"
                                        type="time" name="preferred_time" id="preferred_time">
                                    @error('phone_number')
                                        <span id="phone_number_error"
                                            class="validation-message text-white w-max bg-red-600 p-1 rounded-md my-1 show max-lg:text-xs max-lg:p-0.5 max-lg:rounded-none">{{ $message }}</span>
                                    @enderror
                                </label>
                            </div>
                        </div>
                        <div class="w-full flex flex-col items-center p-2">
                            <label for="notes" class="w-full">
                                <h1 class="font-semibold max-lg:text-md">Note</h1>
                                <input
                                    class="w-full border text-black border-gray-400 mb-2 py-2 px-4 rounded-md max-lg:text-sm"
                                    type="text" name="notes" id="notes">
                                @error('phone_number')
                                    <span id="phone_number_error"
                                        class="validation-message text-white bg-red-600 p-1 rounded-md my-1 show max-lg:text-xs">{{ $message }}</span>
                                @enderror
                            </label>
                            <button
                                class="bg-slate-200 w-50 text-slate-900 font-bold mt-2 py-2 px-8 max-lg:px-4 max-lg:text-sm rounded-md hover:bg-slate-900 hover:text-slate-100 transition-all">Request
                                Appointment</button>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success border rounded-md bg-white py-2 px-4 text-gray-800 ">
                                {{ session('success') }}
                            </div>
                        @endif
                    </form>
                    <div class="flex gap-2 flex-col text-sm max-w-44">
                        <a class="hover:font-semibold transition-all" href="{{ route('welcome') }}">Go back to
                            homepage</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
