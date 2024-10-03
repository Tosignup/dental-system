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
                    <label class="flex flex-col flex-1 pb-4" for="dentist_id">
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

        // const startTimeInput = document.getElementById('start_time');
        // const endTimeInput = document.getElementById('end_time');
        // const appointmentDurationSelect = document.getElementById('appointment_duration');

        // // Function to round the time based on the appointment duration
        // function roundTimeToInterval(timeString, interval) {
        //     const [hours, minutes] = timeString.split(':').map(Number);

        //     // Round minutes to the nearest interval (e.g., 0, 15, 30, 45)
        //     const roundedMinutes = Math.round(minutes / interval) * interval;

        //     // Ensure that minutes don't exceed 59 and roll over to the next hour if needed
        //     let newMinutes = roundedMinutes % 60;
        //     let newHours = hours + Math.floor(roundedMinutes / 60);

        //     // Ensure the hours stay within the 24-hour range
        //     if (newHours >= 24) {
        //         newHours = newHours % 24;
        //     }

        //     // Return the formatted time string (e.g., "08:15")
        //     return `${newHours.toString().padStart(2, '0')}:${newMinutes.toString().padStart(2, '0')}`;
        // }

        // // Apply rounding to start and end time based on selected duration
        // function applyRounding() {
        //     const duration = parseInt(appointmentDurationSelect.value, 10);

        //     // Round the start time
        //     const startTimeValue = startTimeInput.value;
        //     if (startTimeValue) {
        //         startTimeInput.value = roundTimeToInterval(startTimeValue, duration);
        //     }

        //     // Round the end time
        //     const endTimeValue = endTimeInput.value;
        //     if (endTimeValue) {
        //         endTimeInput.value = roundTimeToInterval(endTimeValue, duration);
        //     }
        // }

        // // When appointment duration changes, round the times accordingly
        // appointmentDurationSelect.addEventListener('change', applyRounding);

        // // Round time inputs when user interacts with start or end time fields
        // startTimeInput.addEventListener('blur', applyRounding);
        // endTimeInput.addEventListener('blur', applyRounding);

        // // Initial rounding on page load (if any values are pre-filled)
        // window.addEventListener('load', applyRounding);
    </script>
@endsection
