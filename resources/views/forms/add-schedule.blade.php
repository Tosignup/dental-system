@extends('admin.dashboard')
@section('content')
    <style>
        /* Fade-in and Fade-out CSS */
        .validation-message {
            display: none;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        .validation-message.show {
            display: block;
            opacity: 1;
        }

        .validation-message.hide {
            opacity: 0;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const branchSelect = document.querySelector('#branch_id');
            const dentistSelect = document.querySelector('#dentist_id');


            if (branchSelect) {
                branchSelect.addEventListener('change', function() {
                    const branchId = this.value;

                    // Clear dentist and schedule options
                    dentistSelect.innerHTML = '<option value="">Select Dentist</option>';

                    if (branchId) {
                        fetch(`/appointments/add-walk-in/dentists/${branchId}`)
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                data.forEach(dentist => {
                                    const option = document.createElement('option');
                                    option.value = dentist.id;
                                    option.textContent =
                                        `Dr. ${dentist.dentist_last_name } ${dentist.dentist_first_name}`;
                                    dentistSelect.appendChild(option);
                                });
                            })
                            .catch(error => console.error('Error fetching dentists:', error));
                    }
                });
            }

        });
    </script>
    <div class="m-4 mb-8">
        @include('components.search')
    </div>
    <section class="bg-white shadow-lg rounded-md max-w-max p-6 my-4 mx-auto  max-lg:mt-14">
        <h1 class="font-bold text-3xl p-4">Add Dentist Schedule</h1>
        <form method="POST" action="{{ route('store.schedule') }}">
            @method('POST')
            @csrf
            <div class="flex flex-col items-start justify-start gap-8 max-w-4xl p-4">
                <div class="w-full ">
                    <label class="flex flex-col flex-1 pb-4 " for="branch_id">
                        <h1 class="">Select Branch</h1>
                        <select class="border flex-grow min-w-max border-gray-400 py-2 px-4 rounded-md max-md:text-xs"
                            id="branch_id" name="branch_id" required>
                            <option class="max-md:text-xs" value="">Select your branch</option>
                            @foreach ($branches as $branch)
                                <option class="max-md:text-xs" value="{{ $branch->id }}">
                                    {{ $branch->branch_loc }}
                                </option>
                            @endforeach
                        </select>
                    </label>
                    {{-- <label class="flex flex-col flex-1 pb-4" for="dentist_id">
                        <h1>Select Dentist</h1>
                        <select class="border max-md:text-xs flex-grow min-w-max border-gray-400 py-2 px-4 rounded-md"
                            id="dentist_id" name="dentist_id" required>
                            <option class="max-md:text-xs" value="">Select your dentist</option>
                            @foreach ($dentists as $dentist)
                                <option class="max-md:text-xs" value="{{ $dentist->id }}">
                                    {{ $dentist->dentist_first_name . ' ' . $dentist->dentist_last_name }}
                                </option>
                            @endforeach
                        </select>
                    </label> --}}
                    <label class="flex flex-col flex-1 pb-4" for="dentist_id">
                        <h1>Select Dentist</h1>
                        <select class="border max-md:text-xs flex-grow min-w-max border-gray-400 py-2 px-4 rounded-md"
                            id="dentist_id" name="dentist_id" required>
                            <option class="max-md:text-xs" value="">Select Dentist</option>
                        </select>
                    </label>
                    <label class="flex flex-col flex-1 pb-4" for="date">
                        <h1>Date</h1>
                        <input class="border max-md:text-xs flex-grow min-w-max border-gray-400 py-2 px-4 rounded-md"
                            name="date" type="date" id="date" autocomplete="off" placeholder="Juan"
                            value="{{ old('date') }}" oninput="validateInput('date')">
                        @error('date')
                            <span id="date_error"
                                class="validation-message text-white bg-red-600 p-1 rounded-md my-1 show">{{ $message }}</span>
                        @enderror
                    </label>
                    <div class="flex flex-wrap flex-1 gap-4 pb-4">
                        <label class="flex flex-col flex-1 pb-4" for="start_time">
                            <h1>Start Time</h1>
                            <input class="border max-md:text-xs flex-grow min-w-max border-gray-400 py-2 px-4 rounded-md"
                                name="start_time" type="time" id="start_time" step="600">
                            @error('start_time')
                                <span id="start_time_error"
                                    class="validation-message text-white bg-red-600 p-1 rounded-md my-1 show">{{ $message }}</span>
                            @enderror
                        </label>
                        <label class="flex flex-col flex-1 pb-4" for="end_time">
                            <h1>End Time</h1>
                            <input class="border max-md:text-xs flex-grow min-w-max border-gray-400 py-2 px-4 rounded-md"
                                name="end_time" type="time" id="end_time" step="600">
                            @error('end_time')
                                <span id="end_time_error"
                                    class="validation-message text-white bg-red-600 p-1 rounded-md my-1 show">{{ $message }}</span>
                            @enderror
                        </label>
                    </div>
                    <label class="flex flex-col flex-1 pb-4" for="appointment_duration">
                        <h1>Appointment Duration</h1>
                        <select class="border max-md:text-xs flex-grow min-w-max border-gray-400 py-2 px-4 rounded-md"
                            id="appointment_duration" name="appointment_duration" required>
                            <option value="15"> 15 Minutes</option>
                            <option value="30"> 30 Minutes</option>
                            <option value="45"> 45 Minutes</option>
                            <option value="60"> 60 Minutes</option>
                        </select>
                        @error('appointment_duration')
                            <span id="appointment_duration_error"
                                class="validation-message text-white bg-red-600 p-1 rounded-md my-1 show">{{ $message }}</span>
                        @enderror
                    </label>
                </div>
                <div class="flex gap-4 mt-4 ">
                    <button
                        class="py-2 px-8 max-md:text-xs
                            max-md:py-2 max-md:px-4
                        font-semibold rounded-md hover:bg-green-600 hover:border-green-600 hover:text-white text-gray-800 border-2 border-gray-600 transition-all"
                        type="submit">
                        Add
                    </button>
                    <button
                        class="py-2 max-md:text-xs
                            max-md:py-2 max-md:px-4 px-8 font-semibold rounded-md hover:bg-gray-600 border-2 border-gray-600 hover:text-white text-gray-800  transition-all"
                        type="reset">
                        Reset
                    </button>
                    <a href=" {{ route('schedule') }} "
                        class="py-2 max-md:text-xs
                            max-md:py-2 max-md:px-4 flex justify-center items-center px-8 font-semibold rounded-md hover:bg-red-600 hover:border-red-600 border-2 border-gray-600 text-gray-800  hover:text-white transition-all"
                        type="reset">
                        Cancel
                    </a>
                </div>
            </div>
        </form>
    </section>
    <script>
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('date').setAttribute('min', today);

        function validateInput(field) {
            const input = document.getElementById(field);
            const errorElement = document.getElementById(`${field}_error`);

            // Assuming that the presence of errorElement means the field has an error initially
            if (errorElement) {
                // If the input is valid (e.g., not empty), hide the error message
                if (input.value.trim() !== '') {
                    errorElement.classList.remove('show');
                    errorElement.classList.add('hide');

                    setTimeout(() => {
                        errorElement.style.display = 'none';
                    }, 500);
                } else {
                    // If the input is still invalid, keep the error message visible
                    errorElement.classList.remove('hide');
                    errorElement.classList.add('show');
                }
            }
        }
    </script>
@endsection
