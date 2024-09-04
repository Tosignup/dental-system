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
    <section class="bg-white shadow-lg rounded-md max-w-max p-6 m-6">
        <h1 class="font-bold text-5xl p-4">Add Dentist</h1>
        <form method="POST" action="{{ route('store.dentist') }}">
            @method('POST')
            @csrf

            <div class="flex flex-wrap items-start justify-start gap-8 max-w-4xl  p-8">
                <label class="flex flex-col flex-1" for="dentist_first_name">
                    <h1>First name</h1>
                    <input class="border flex-grow min-w-max border-gray-400 py-2 px-4 rounded-md" name="dentist_first_name"
                        type="text" id="dentist_first_name" autocomplete="off" placeholder="Juan"
                        value="{{ old('dentist_first_name') }}" oninput="validateInput('dentist_first_name')">
                    @error('dentist_first_name')
                        <span id="dentist_first_name_error"
                            class="validation-message text-white bg-red-600 p-1 rounded-md my-1 show">{{ $message }}</span>
                    @enderror
                </label>
                <label class="flex flex-col flex-1" for="dentist_last_name">
                    <h1>Last name</h1>
                    <input class="border border-gray-400 py-2 px-4 rounded-md" name="dentist_last_name" type="text"
                        id="dentist_last_name" autocomplete="off" placeholder="Dela Cruz"
                        value="{{ old('dentist_last_name') }}" oninput="validateInput('dentist_last_name')">
                    @error('dentist_last_name')
                        <span id="dentist_last_name_error"
                            class="validation-message text-white bg-red-600 p-1 rounded-md my-1 show">{{ $message }}</span>
                    @enderror
                </label>
                <label class="flex flex-col flex-1" for="dentist_birth_date">
                    <h1>Date of birth</h1>
                    <input class="border border-gray-400 py-2 px-4 rounded-md" name="dentist_birth_date" type="date"
                        id="dentist_birth_date" value="{{ old('dentist_birth_date') }}"
                        oninput="validateInput('dentist_birth_date')">
                    @error('dentist_birth_date')
                        <span id="dentist_birth_date_error"
                            class="validation-message text-white bg-red-600 p-1 rounded-md my-1 show">{{ $message }}</span>
                    @enderror
                </label>
                <label class="flex flex-col flex-1" for="dentist_email">
                    <h1>Email</h1>
                    <input class="border border-gray-400 py-2 px-4 rounded-md" name="dentist_email" type="email"
                        id="dentist_email" autocomplete="off" placeholder="juan@gmail.com"
                        value="{{ old('dentist_email') }}" oninput="validateInput('dentist_email')">
                    @error('dentist_email')
                        <span id="dentist_email_error"
                            class="validation-message text-white bg-red-600 p-1 rounded-md my-1 show">{{ $message }}</span>
                    @enderror
                </label>
                <label class="flex flex-col flex-1 pb-4" for="dentist_gender">
                    <h1>Gender</h1>
                    <select class="border flex-grow min-w-max border-gray-400 py-2 px-4 rounded-md" id="dentist_gender"
                        name="dentist_gender" required>
                        <option value="male"> Male</option>
                        <option value="female"> Female</option>
                        <option value="Prefer not to say"> Prefer not to say</option>
                    </select>
                    @error('dentist_gender')
                        <span id="dentist_gender_error"
                            class="validation-message text-white bg-red-600 p-1 rounded-md my-1 show">{{ $message }}</span>
                    @enderror
                </label>
                <label class="flex flex-col flex-1" for="dentist_phone_number">
                    <h1>Phone Number</h1>
                    <input class="border border-gray-400 py-2 px-4 rounded-md" name="dentist_phone_number" type="test"
                        id="dentist_phone_number" autocomplete="off" value="{{ old('dentist_phone_number') }}"
                        oninput="validateInput('dentist_phone_number')">
                    @error('dentist_phone_number')
                        <span id="dentist_phone_number"
                            class="validation-message text-white bg-red-600 p-1 rounded-md my-1 show">{{ $message }}</span>
                    @enderror
                </label>
                <label class="flex flex-col flex-1" for="dentist_specialization">
                    <h1>Dentist Specialization</h1>
                    <input class="border border-gray-400 py-2 px-4 rounded-md" type="text" name="dentist_specialization">
                    @error('dentist_specialization')
                        <span id="dentist_specialization_error"
                            class="validation-message text-white bg-red-600 p-1 rounded-md my-1 show">{{ $message }}</span>
                    @enderror
                </label>
                <label class="flex flex-col flex-1 pb-4" for="branch">
                    <h1>Branch</h1>
                    <select class="border flex-grow min-w-max border-gray-400 py-2 px-4 rounded-md" id="branch"
                        name="branch" required>
                        <option value="dau"> Dau</option>
                        <option value="angeles"> Angeles</option>
                        <option value="sindalan"> Sindalan</option>
                    </select>
                    @error('branch')
                        <span id="branch_error"
                            class="validation-message text-white bg-red-600 p-1 rounded-md my-1 show">{{ $message }}</span>
                    @enderror
                </label>
                <label class="flex flex-col flex-1" for="password">
                    <h1>Password</h1>
                    <input class="border border-gray-400 py-2 px-4 rounded-md" name="password" type="password"
                        id="password" autocomplete="off" oninput="validateInput('password')">
                    @error('password')
                        <span id="password_error"
                            class="validation-message text-white bg-red-600 p-1 rounded-md my-1 show">{{ $message }}</span>
                    @enderror
                </label>
                <label class="flex flex-col flex-1" for="password_confirmation">
                    <h1>Confirm Password</h1>
                    <input class="border border-gray-400 py-2 px-4 rounded-md" type="password"
                        name="password_confirmation" id="password_confirmation"
                        oninput="validateInput('password_confirmation')">
                    @error('password_confirmation')
                        <span id="password_confirmation_error"
                            class="validation-message text-white bg-red-600 p-1 rounded-md my-1 show">{{ $message }}</span>
                    @enderror
                </label>
                <div class="flex gap-4 mt-4">
                    <button
                        class="py-2 px-8 font-semibold rounded-md hover:bg-green-600 hover:border-green-600 hover:text-white text-gray-800 border-2 border-gray-600 transition-all"
                        type="submit">
                        Add Dentist
                    </button>
                    <button
                        class="py-2 px-8 font-semibold rounded-md hover:bg-gray-600 border-2 border-gray-600 hover:text-white text-gray-800  transition-all"
                        type="reset">
                        Reset
                    </button>
                    <a href=" {{ route('dentist') }} "
                        class="py-2 px-8 font-semibold rounded-md hover:bg-red-600 hover:border-red-600 border-2 border-gray-600 text-gray-800  hover:text-white transition-all"
                        type="reset">
                        Cancel
                    </a>
                </div>
            </div>
        </form>
    </section>
    <script>
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('next_visit').setAttribute('min', today);

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
