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
    <section class="bg-white shadow-lg rounded-md max-w-max p-6 m-6 max-lg:p-3 max-lg:m-3  max-lg:mt-14">
        <h1 class="font-bold text-5xl p-4 max-md:text-3xl w-max">Add new patient</h1>
        <form method="POST" action="{{ route('store.patient') }}">
            @method('POST')
            @csrf
            <div class="flex flex-wrap items-start justify-start gap-8 max-md:gap-4 max-w-4xl p-8 max-md:p-2">
                <label class="flex flex-col flex-1" for="first_name">
                    <h1 class="max-md:text-sm">First name</h1>
                    <input
                        class="max-md:text-sm max-md:py-1 max-md:px-2 border flex-grow min-w-max border-gray-400 py-2 px-4 rounded-md"
                        name="first_name" type="text" id="first_name" autocomplete="off" placeholder="Juan"
                        value="{{ old('first_name') }}" oninput="validateInput('first_name')">
                    @error('first_name')
                        <span id="first_name_error"
                            class="validation-message text-white bg-red-600 p-1 rounded-md my-1 show">{{ $message }}</span>
                    @enderror
                </label>
                <label class="flex flex-col flex-1" for="last_name">
                    <h1 class="max-md:text-sm">Last name</h1>
                    <input class="max-md:text-sm max-md:py-1 max-md:px-2 border border-gray-400 py-2 px-4 rounded-md"
                        name="last_name" type="text" id="last_name" autocomplete="off" placeholder="Dela Cruz"
                        value="{{ old('last_name') }}" oninput="validateInput('last_name')">
                    @error('last_name')
                        <span id="last_name_error"
                            class="validation-message text-white bg-red-600 p-1 rounded-md my-1 show">{{ $message }}</span>
                    @enderror
                </label>
                <label class="flex flex-col flex-1" for="date_of_birth">
                    <h1 class="max-md:text-sm">Date of birth</h1>
                    <input class="max-md:text-sm max-md:py-1 max-md:px-2 border border-gray-400 py-2 px-4 rounded-md"
                        name="date_of_birth" type="date" id="date_of_birth" value="{{ old('date_of_birth') }}"
                        oninput="validateInput('date_of_birth')">
                    @error('date_of_birth')
                        <span id="date_of_birth_error"
                            class="validation-message text-white bg-red-600 p-1 rounded-md my-1 show">{{ $message }}</span>
                    @enderror
                </label>

                <label class="flex flex-col flex-1" for="email">
                    <h1 class="max-md:text-sm">Email</h1>
                    <input class="max-md:text-sm max-md:py-1 max-md:px-2 border border-gray-400 py-2 px-4 rounded-md"
                        name="email" type="email" id="email" autocomplete="off" placeholder="juan@gmail.com"
                        value="{{ old('email') }}" oninput="validateInput('email')">
                    @error('email')
                        <span id="email_error"
                            class="validation-message text-white bg-red-600 p-1 rounded-md my-1 show">{{ $message }}</span>
                    @enderror
                </label>
                <label class="flex flex-col flex-1" for="password">
                    <h1 class="max-md:text-sm">Password</h1>
                    <input class="max-md:text-sm max-md:py-1 max-md:px-2 border border-gray-400 py-2 px-4 rounded-md"
                        name="password" type="password" id="password" autocomplete="off""
                        oninput="validateInput('password')">
                    @error('password')
                        <span id="password_error"
                            class="validation-message text-white bg-red-600 p-1 rounded-md my-1 show">{{ $message }}</span>
                    @enderror
                </label>
                <label class="flex flex-col flex-1" for="password_confirmation">
                    <h1 class="max-md:text-sm">Confirm Password</h1>
                    <input class="max-md:text-sm max-md:py-1 max-md:px-2 border border-gray-400 py-2 px-4 rounded-md"
                        type="password" name="password_confirmation" id="password_confirmation"
                        oninput="validateInput('password_confirmation')">
                    @error('password_confirmation')
                        <span id="password_confirmation_error"
                            class="validation-message text-white bg-red-600 p-1 rounded-md my-1 show">{{ $message }}</span>
                    @enderror
                </label>
                <label class="flex flex-col flex-1" for="gender">
                    <h1 class="max-md:text-sm">Gender</h1>
                    <select class="border max-md:text-sm max-md:py-1 max-md:px-2 border-gray-400 py-2 px-4 rounded-md"
                        name="gender" id="gender" oninput="validateInput('gender')">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="others">Others</option>
                        <option value="prefer not to say">Prefer not to say</option>
                    </select>
                    @error('gender')
                        <span id="gender_error"
                            class="validation-message text-white bg-red-600 p-1 rounded-md my-1 show">{{ $message }}</span>
                    @enderror
                </label>
                <label class="flex flex-col flex-1" for="fb_name">
                    <h1 class="max-md:text-sm">Facebook name</h1>
                    <input class="max-md:text-sm max-md:py-1 max-md:px-2 border border-gray-400 py-2 px-4 rounded-md"
                        name="fb_name" type="text" autocomplete="off" id="fb_name" placeholder="Dela Cruz"
                        value="{{ old('fb_name') }}" oninput="validateInput('fb_name')">
                    @error('fb_name')
                        <span id="fb_name_error"
                            class="validation-message text-white bg-red-600 p-1 rounded-md my-1 show">{{ $message }}</span>
                    @enderror
                </label>
                <label class="flex flex-col flex-1" for="phone_number">
                    <h1 class="max-md:text-sm">Phone number</h1>
                    <input class="max-md:text-sm max-md:py-1 max-md:px-2 border border-gray-400 py-2 px-4 rounded-md"
                        name="phone_number" type="text" autocomplete="off" id="phone_number"
                        value="{{ old('phone_number') }}" oninput="validateInput('phone_number')">
                    @error('phone_number')
                        <span id="phone_number_error"
                            class="validation-message text-white bg-red-600 p-1 rounded-md my-1 show">{{ $message }}</span>
                    @enderror
                </label>
                <label class="flex flex-col flex-1" for="next_visit">
                    <h1 class="max-md:text-sm">Date of next visit</h1>
                    <input class="max-md:text-sm max-md:py-1 max-md:px-2 border border-gray-400 py-2 px-4 rounded-md"
                        name="next_visit" type="date" autocomplete="off" id="next_visit"
                        value="{{ old('next_visit') }}" oninput="validateInput('next_visit')">
                    @error('next_visit')
                        <span id="next_visit_error"
                            class="validation-message text-white bg-red-600 p-1 rounded-md my-1 show">{{ $message }}</span>
                    @enderror
                </label>
                <div class="flex gap-4 mt-4">
                    <button
                        class="py-2 px-8 max-md:py-2 max-md:px-2 max-md:text-xs font-semibold rounded-md hover:bg-green-600 hover:border-green-600 hover:text-white text-gray-800 border-2 border-gray-600 transition-all"
                        type="submit">
                        Add patient
                    </button>
                    <button
                        class="py-2 px-8 max-md:py-2 max-md:px-2 max-md:text-xs font-semibold rounded-md hover:bg-gray-600 border-2 border-gray-600 hover:text-white text-gray-800  transition-all"
                        type="reset">
                        Reset
                    </button>
                    <a href=" {{ route('patient_list') }} "
                        class="py-2 px-8 max-md:py-2 max-md:px-2 max-md:text-xs font-semibold rounded-md hover:bg-red-600 hover:border-red-600 border-2 border-gray-600 text-gray-800  hover:text-white transition-all"
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
