@extends('admin.dashboard')
@section('content')
    <style>
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

        .loading-indicator {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            /* Ensure it appears above other content */
        }

        .spinner {
            border: 8px solid #f3f3f3;
            /* Light grey */
            border-top: 8px solid #3498db;
            /* Blue */
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    <div class="m-4 mb-8">
        @include('components.search')
    </div>
    <section class="bg-white shadow-lg rounded-md max-w-max p-6 my-4 mx-auto  max-lg:mt-14">
        <div class="p-4">
            <h1 class="font-bold text-3xl pb-2">Edit dentist schedule of Dr. {{ $schedule->dentist->dentist_last_name }}
                {{ $schedule->dentist->dentist_first_name }}</h1>
            <h1>Current date: <span>{{ $schedule->date }}</span></h1>
            <h1>Current start-time: <span>{{ $schedule->start_time }}</span></h1>
            <h1>Current end-time: <span>{{ $schedule->end_time }}</span></h1>
        </div>
        <form action="{{ route('schedule.update', $schedule->id) }}" method="POST">
            @method('POST')
            @csrf
            <div class="flex flex-col items-start justify-start gap-8 max-w-4xl p-4">
                <div class="w-full ">
                    {{-- Original Approach --}}
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

                    {{-- Checkboxes Approach --}}
                    {{-- <label for="base_date">Select Base Date:</label>
                    <input type="date" id="base_date" name="base_date" required>

                    <div>
                        <label><input type="checkbox" name="days_of_week[]" value="Monday"> Monday</label>
                        <label><input type="checkbox" name="days_of_week[]" value="Tuesday"> Tuesday</label>
                        <label><input type="checkbox" name="days_of_week[]" value="Wednesday"> Wednesday</label>
                        <label><input type="checkbox" name="days_of_week[]" value="Thursday"> Thursday</label>
                        <label><input type="checkbox" name="days_of_week[]" value="Friday"> Friday</label>
                        <label><input type="checkbox" name="days_of_week[]" value="Saturday"> Saturday</label>
                        <label><input type="checkbox" name="days_of_week[]" value="Sunday"> Sunday</label>
                    </div> --}}

                    {{-- JavaScript Approach --}}
                    {{-- <label for="date">Select Date:</label>
                    <input type="date" id="date" name="date" required>
                    <button type="button" id="addDate">Add Date</button>

                    <input type="hidden" name="selected_dates" id="selected_dates">

                    <script>
                        const selectedDates = [];

                        document.getElementById('addDate').addEventListener('click', function() {
                            const dateInput = document.getElementById('date');
                            const dateValue = dateInput.value;

                            if (dateValue && !selectedDates.includes(dateValue)) {
                                selectedDates.push(dateValue);
                                document.getElementById('selected_dates').value = JSON.stringify(selectedDates);
                                alert(`Date ${dateValue} added!`);
                            } else {
                                alert('Please select a valid date or avoid duplicates.');
                            }
                        });
                    </script> --}}

                    {{-- Date Range Picker Approach --}}
                    {{-- <label for="start_date">Start Date:</label>
                    <input type="date" id="start_date" name="start_date" required>

                    <label for="end_date">End Date:</label>
                    <input type="date" id="end_date" name="end_date" required> --}}


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
        document.getElementById('appointment_date').setAttribute('min', today);

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
