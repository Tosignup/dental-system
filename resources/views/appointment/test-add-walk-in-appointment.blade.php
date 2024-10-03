@extends('admin.dashboard')
@section('content')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const branchSelect = document.querySelector('#branch_id');
            const dentistSelect = document.querySelector('#dentist_id');
            const scheduleSelect = document.querySelector('#schedule_id');

            if (branchSelect) {
                branchSelect.addEventListener('change', function() {
                    const branchId = this.value;

                    dentistSelect.innerHTML = '<option value="">Select Dentist</option>';
                    scheduleSelect.innerHTML = '<option value="">Select Schedule</option>';

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
                                    option.textContent = dentist.dentist_last_name;
                                    dentistSelect.appendChild(option);
                                });
                            })
                            .catch(error => console.error('Error fetching dentists:', error));
                    }
                });
            }

            if (dentistSelect) {
                dentistSelect.addEventListener('change', function() {
                    const dentistId = this.value;

                    scheduleSelect.innerHTML = '<option value="">Select Schedule</option>';

                    if (dentistId) {
                        fetch(`/appointments/add-walk-in/schedules/${dentistId}`)
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                data.forEach(schedule => {
                                    const option = document.createElement('option');
                                    option.value = schedule.id;
                                    option.textContent = schedule.date;
                                    scheduleSelect.appendChild(option);
                                });
                            })
                            .catch(error => console.error('Error fetching schedules:', error));
                    }
                });
            }
        });
    </script>
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
    </style>
    <div class="m-4 mb-8">
        @include('components.search')
    </div>
    <section class="bg-white shadow-lg rounded-md max-w-max p-6 m-6  max-lg:mt-14">


        <h1 class="font-bold text-3xl p-4">Request an Appointment</h1>
        <form action="{{ route('appointments.store') }}" method="POST">
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
                            <option class="max-md:text-xs" value="">Select Dentist</option>
                        </select>
                    </label>

                    <label class="flex flex-col flex-1 pb-4" for="patient_id">
                        <h1>Patient</h1>
                        <select id="patient_id" name="patient_id"
                            class="border max-md:text-xs flex-grow min-w-max border-gray-400 py-2 px-4 rounded-md" required>
                            <option value="">Select Patient</option>
                            @foreach ($patients as $patient)
                                <option class="max-md:text-xs" value="{{ $patient->id }}">{{ $patient->last_name }}
                                </option>
                            @endforeach
                        </select>
                    </label>

                    <label class="flex flex-col flex-1 pb-4" for="schedule_id">
                        <h1>Select Schedule</h1>
                        <select id="schedule_id" name="schedule_id"
                            class="border max-md:text-xs flex-grow min-w-max border-gray-400 py-2 px-4 rounded-md" required>
                            <option value="">Select Schedule</option>
                        </select>
                    </label>
                    {{-- <label class="flex flex-col flex-1 pb-4" for="proc_id">
                        <h1>Select Procedure</h1>
                        <select id="proc_id" name="proc_id"
                            class="border max-md:text-xs flex-grow min-w-max border-gray-400 py-2 px-4 rounded-md" required>
                            <option value="">Select Procedure</option>
                        </select>
                    </label> --}}
                    <label class="flex flex-col flex-1 pb-4" for="proc_id">
                        <h1>Select Procedure</h1>
                        <select id="proc_id" name="proc_id"
                            class="border max-md:text-xs flex-grow min-w-max border-gray-400 py-2 px-4 rounded-md" required>
                            <option value="">Select Procedure</option>
                            @foreach ($procedures as $procedure)
                                <option class="max-md:text-xs" value="{{ $procedure->id }}">{{ $procedure->name }}
                                </option>
                            @endforeach
                        </select>
                    </label>
                    {{-- <div class="form-group">
                        <label for="schedule_id">Schedule</label>
                        <input type="text" name="schedule_id" class="form-control" required>
                    </div> --}}



                    <div class="form-group">
                        <label for="appointment_date">Appointment Date</label>
                        <input type="date" name="appointment_date" id="appointment_date" class="form-control">
                    </div>

                    {{-- <label class="flex flex-col flex-1 pb-4" for="preferred_time">
                        <h1>Select Time</h1>
                        <select id="preferred_time" name="preferred_time"
                            class="border max-md:text-xs flex-grow min-w-max border-gray-400 py-2 px-4 rounded-md" required>
                            <option value="">Select Time Slot</option>
                        </select>
                    </label> --}}

                    <div class="form-group">
                        <label for="preferred_time">Preferred Time</label>
                        <input type="time" name="preferred_time" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="is_online">Is Online</label>
                        <input type="checkbox" name="is_online" value="1">
                    </div>

                    <div class="flex gap-2 mt-4">
                        <button
                            class="flex justify-center items-center  py-2 px-8 text-center max-md:py-2 max-md:px-2 max-md:text-xs font-semibold rounded-md hover:bg-green-600 hover:border-green-600 hover:text-white text-gray-800 border-2 border-gray-600 transition-all"
                            type="submit">
                            Request Appointment
                        </button>
                        <button
                            class="flex justify-center items-center py-2 px-8 text-center max-md:py-2 max-md:px-2 max-md:text-xs font-semibold rounded-md hover:bg-gray-600 border-2 border-gray-600 hover:text-white text-gray-800  transition-all"
                            type="reset">
                            Reset
                        </button>
                        <a href=" {{ route('appointment.submission') }} "
                            class="flex justify-center items-center py-2 px-8 text-center max-md:py-2 max-md:px-2 max-md:text-xs font-semibold rounded-md hover:bg-red-600 hover:border-red-600 border-2 border-gray-600 text-gray-800  hover:text-white transition-all"
                            type="reset">
                            Cancel
                        </a>
                    </div>
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
