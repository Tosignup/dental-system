<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }} | Request an Appointment</title>
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <style>
        .logo{
            width: 100px;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <section class="h-screen bg-slate-100 flex justify-center items-center">
        <div class="bg-white rounded-lg shadow-lg flex">
            <div class="bg-green-600 rounded-lg text-white p-8 flex flex-col justify-between">
                <div class="flex flex-col items-center p-3">
                    <div class="flex flex-col items-center">
                        <img class="logo" src="{{ asset('assets/images/logo.png') }}" alt="Dental Logo">
                        <h1 class="w-full font-bold text-3xl text-white max-w-sm mb-6">Request an Appointment</h1>
                    </div>
                    
                    <form method="POST" action="{{ route('appointments.store') }}" class="flex flex-col justify-center items-center">
                        @csrf
                        <div class="w-full px-2">
                            <label for="branch">
                                <h1 class="font-semibold">Branch</h1>
    
                                <select class="w-full border text-black border-gray-400 mb-2 py-2 px-4 rounded-md" id="branch" name="branch">
                                    <option value="Dau">Dau</option>
                                    <option value="Angeles">Angeles</option>
                                    <option value="Sindalan">Sindalan</option>
                                </select>
                            </label>
                        </div>
                        <div class="flex flex-row p-2 gap-5">
                            
                            <div>
                                <label for="first_name">
                                    <h1 class="font-semibold">First Name</h1>
                                    <input class="w-full border text-black border-gray-400 mb-2 py-2 px-4 rounded-md" type="text"
                                        name="first_name" id="first_name">
                                </label>
                                
                                <label for="email">
                                    <h1 class="font-semibold">Email</h1>
                                    <input class="w-full border text-black border-gray-400 mb-2 py-2 px-4 rounded-md" type="email"
                                        name="email" id="email">
                                </label>
                                <label for="date_of_birth">
                                    <h1 class="font-semibold">Date of Birth</h1>
                                    <input class="w-full border text-black border-gray-400 mb-2 py-2 px-4 rounded-md" type="date"
                                        name="date_of_birth" id="date_of_birth">
                                </label>
                                <label for="appointment_date">
                                    <h1 class="font-semibold">Appointment Date</h1>
                                    <input class="w-full border text-black border-gray-400 mb-2 py-2 px-4 rounded-md" type="date"
                                        name="appointment_date" id="appointment_date">
                                </label>
                            </div>
                            <div>
                                <label for="last_name">
                                    <h1 class="font-semibold">Last Name</h1>
                                    <input class="w-full border text-black border-gray-400 mb-2 py-2 px-4 rounded-md" type="text"
                                        name="last_name" id="last_name">
                                </label>
                                <label for="zip_code">
                                    <h1 class="font-semibold">Zip Code</h1>
                                    <input class="w-full border text-black border-gray-400 mb-2 py-2 px-4 rounded-md" type="number"
                                        name="zip_code" id="zip_code">
                                </label>
                                <label for="phone_number">
                                    <h1 class="font-semibold">Phone Number</h1>
                                    <input class="w-full border text-black border-gray-400 mb-2 py-2 px-4 rounded-md" type="number"
                                        name="phone_number" id="phone_number">
                                </label>
                                
                                <label for="preferred_time">
                                    <h1 class="font-semibold">Preferred Time</h1>
                                    <input class="w-full border text-black border-gray-400 mb-2 py-2 px-4 rounded-md" type="time"
                                        name="preferred_time" id="preferred_time">
                                </label>
                            </div>
                        </div>
                        <div class="w-full flex flex-col items-center p-2">
                            <label for="notes" class="w-full">
                                <h1 class="font-semibold">Note</h1>
                                <input class="w-full border text-black border-gray-400 mb-2 py-2 px-4 rounded-md" type="text"
                                    name="notes" id="notes">
                            </label>
                            <button class="bg-slate-200 w-50 text-slate-900 font-bold mt-2 py-2 px-8 rounded-md hover:bg-slate-900 hover:text-slate-100 transition-all">Request Appointment</button>
                        </div>
                        @if (session('success'))
                        <div class="alert alert-success border rounded-md bg-white py-2 px-4 text-gray-800 ">
                            {{ session('success') }}
                        </div>
                        

                    @endif
                    </form>
                    <div class="flex gap-2 flex-col text-sm max-w-44">
                        <a class="hover:font-semibold transition-all" href="{{ route('welcome') }}">Go back to homepage</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
