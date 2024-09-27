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
    <section class="bg-white shadow-lg rounded-md max-w-max p-6  max-lg:mt-14 m-6">
        <h1 class="font-bold text-5xl p-4 max-md:text-2xl">Update Dentist information</h1>
        <form method="POST" action="{{ route('update.dentist', $dentist->id) }}">
            @method('PUT')
            @csrf
            <div class="flex flex-wrap items-start justify-start gap-8 max-md:gap-2 max-w-4xl p-8 max-md:p-4">
                <label class="flex flex-col flex-1 max-md:text-sm" for="dentist_first_name">
                    <h1>First name</h1>
                    <input class="border border-gray-400 py-2 px-4 rounded-md max-md:text-sm" name="dentist_first_name"
                        type="text" id="dentist_first_name" value="{{ old('firstname', $dentist->dentist_first_name) }}"
                        autocomplete="off" placeholder="Juan" oninput="validateInput('dentist_first_name')">
                    @error('dentist_first_name')
                        <span id="dentist_first_name_error"
                            class="validation-message text-white bg-red-600 p-1 rounded-md my-1 show">{{ $message }}</span>
                    @enderror
                </label>
                <label class="flex flex-col flex-1 max-md:text-sm" for="dentist_last_name">
                    <h1>Last name</h1>
                    <input class="border border-gray-400 py-2 px-4 rounded-md max-md:text-sm" name="dentist_last_name"
                        type="text" id="dentist_last_name"
                        value="{{ old('dentist_last_name', $dentist->dentist_last_name) }}" autocomplete="off"
                        placeholder="Dela Cruz" oninput="validateInput('dentist_last_name')">
                    @error('dentist_last_name')
                        <span id="dentist_last_name_error"
                            class="validation-message text-white bg-red-600 p-1 rounded-md my-1 show">{{ $message }}</span>
                    @enderror
                </label>
                <label class="flex flex-col flex-1 max-md:text-sm" for="dentist_birth_date">
                    <h1>Date of birth</h1>
                    <input class="border border-gray-400 py-2 px-4 rounded-md max-md:text-sm" name="dentist_birth_date"
                        type="date" value="{{ old('dentist_birth_date', $dentist->dentist_birth_date) }}"
                        id="dentist_birth_date" oninput="validateInput('dentist_birth_date')">
                    @error('dentist_birth_date')
                        <span id="dentist_birth_date_error"
                            class="validation-message text-white bg-red-600 p-1 rounded-md my-1 show">{{ $message }}</span>
                    @enderror
                </label>
                <label class="flex flex-col flex-1 max-md:text-sm" for="dentist_email">
                    <h1>Email</h1>
                    <input class="border border-gray-400 py-2 px-4 rounded-md max-md:text-sm" name="dentist_email"
                        type="text" autocomplete="off" oninput="validateInput('dentist_email')" id="dentist_email"
                        placeholder="{{ $dentist->dentist_email }}">
                    @error('dentist_email')
                        <span id="dentist_email_error"
                            class="validation-message text-white bg-red-600 p-1 rounded-md my-1 show">{{ $message }}</span>
                    @enderror
                </label>

                <label class="flex flex-col flex-1 max-md:text-sm" for="dentist_phone_number">
                    <h1>Phone number</h1>
                    <input class="border border-gray-400 py-2 px-4 rounded-md max-md:text-sm" name="dentist_phone_number"
                        type="text" autocomplete="off" oninput="validateInput('dentist_phone_number')"
                        value="{{ old('dentist_phone_number', $dentist->dentist_phone_number) }}" id="dentist_phone_number">
                    @error('dentist_phone_number')
                        <span id="dentist_phone_number_error"
                            class="validation-message text-white bg-red-600 p-1 rounded-md my-1 show">{{ $message }}</span>
                    @enderror
                </label>
                <label class="flex flex-col flex-1 max-md:text-sm" for="dentist_specialization">
                    <h1>Doctor Specialty</h1>
                    <input class="border border-gray-400 py-2 px-4 rounded-md max-md:text-sm" name="dentist_specialization"
                        type="text" autocomplete="off" oninput="validateInput('dentist_specialization')"
                        value="{{ old('dentist_specialization', $dentist->dentist_specialization) }}"
                        id="dentist_specialization">
                    @error('dentist_specialization')
                        <span id="dentist_specialization_error"
                            class="validation-message text-white bg-red-600 p-1 rounded-md my-1 show">{{ $message }}</span>
                    @enderror
                </label>
                <div class="flex gap-4 mt-4">
                    <button
                        class="py-2 px-8 font-semibold rounded-md hover:bg-green-600 hover:text-white text-gray-800 border-2 border-green-600 transition-all
                        max-md:flex max-md:justify-center max-md:items-center max-md:py-1 max-md:text-center max-md:px-2 max-md:text-sm"
                        type="submit">
                        Update
                    </button>
                    <button
                        class="py-2 px-8 font-semibold rounded-md hover:bg-gray-600 border-2 border-gray-600 hover:text-white text-gray-800  transition-all
                         max-md:flex max-md:justify-center max-md:items-center max-md:py-1 max-md:text-center max-md:px-2 max-md:text-sm"
                        type="reset">
                        Reset
                    </button>
                    <a class="py-2 px-8 font-semibold rounded-md hover:bg-red-600 border-2 border-red-600 text-gray-800  hover:text-white transition-all
                     max-md:flex max-md:justify-center max-md:items-center max-md:py-1 max-md:text-center max-md:px-2 max-md:text-sm"
                        href=" {{ route('dentist') }} ">
                        Cancel
                    </a>
                </div>
            </div>
        </form>
    </section>
    <script>
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('date_of_next_visit').setAttribute('min', today);


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
