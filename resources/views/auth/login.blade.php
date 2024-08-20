<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }} | Login</title>
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <style>
        /* Error message styling */
        .error-message {
            color: #fff;
            background-color: #f44336;
            /* Red */
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            display: none;
        }
    </style>
</head>

<body>
    <section class="h-screen bg-slate-100 flex justify-center items-center">
        <div class="bg-white rounded-lg shadow-lg flex">
            <div class="bg-green-600 rounded-lg text-white p-8 flex flex-col justify-between">
                <div>
                    <h1 class="font-bold text-4xl text-white max-w-sm mb-6">Login to your account</h1>

                    <!-- Display error message if exists -->
                    @if ($errors->any())
                        <div class="error-message show">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-4 mb-8">
                        @csrf
                        <label for="email">
                            <h1 class="font-semibold">E-mail</h1>
                            <input class="w-full border text-black border-gray-400 py-2 px-4 rounded-md" type="email"
                                name="email" id="email" value="{{ old('email') }}">
                        </label>
                        <label for="password">
                            <h1 class="font-semibold">Password</h1>
                            <input class="w-full border text-black border-gray-400 py-2 px-4 rounded-md" type="password"
                                name="password" id="password">
                        </label>
                        <a class="text-sm hover:font-semibold transition-all"
                            href="{{ route('password.request') }}">Forgot your password?</a>
                        <button
                            class="bg-slate-200 max-w-min text-slate-900 font-bold py-2 px-8 rounded-md hover:bg-slate-900 hover:text-slate-100 transition-all">Login</button>
                    </form>
                </div>

                <div class="flex gap-2 flex-col text-sm max-w-44">
                    <a class="hover:font-semibold transition-all" href="{{ route('register') }}">Don't have an
                        account?</a>
                    <a class="hover:font-semibold transition-all" href="{{ route('welcome') }}">Go back to homepage</a>
                </div>
            </div>
            <div class="p-8">
                <img class="mx-8" src="{{ asset('assets/images/logo.png') }}" alt="">
                <div class="flex flex-col justify-center text-center mt-6">
                    <h1 class="font-bold text-xl">Tooth Impressions Dental Clinic</h1>
                    <h1 class="text-sm">Your Smile, Our Passion: Quality Dental Care You Can Trust.</h1>
                </div>
            </div>
        </div>
    </section>

    <script>
        // JavaScript to show the error message if there are errors
        document.addEventListener('DOMContentLoaded', function() {
            const errorMessage = document.querySelector('.error-message');
            if (errorMessage) {
                errorMessage.style.display = 'block';
            }
        });
    </script>
</body>

</html>
