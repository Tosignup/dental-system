<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    @vite('resources/css/app.css')
</head>

<body>
    <div class="flex p-4 justify-between align-center shadow-lg">
        <div class="flex gap-4 text-md justify-center items-center">
            {{-- <a href="{{ route('homepage') }}"> --}}
            <img class="h-14" src="{{ asset('assets/images/logo.png') }}" alt="">
            </a>
            <div class="flex gap-4 max-md:hidden">
                <h1 class="hover:font-bold transition-all text-md font-semibold">Tooth Impressions Dental Clinic</h1>
            </div>
        </div>
        <div class="flex gap-6 justify-center items-center">
            @guest
                <a class="flex self-center justify-center gap-2" href="{{ route('login') }}">
                    <h1 class="font-bold">Login</h1>
                </a>
                <a class="flex gap-6 justify-center items-center" href="{{ route('appointments.request') }}">
                    <h1
                        class="py-2 px-4 rounded-md text-white font-semibold bg-green-600 hover:bg-green-700 transition-all cursor-pointer">
                        BOOK NOW</h1>
                </a>
            @endguest
            @auth
                @if (Auth::user()->role === 'client')
                    <form action="{{ route('logout') }}" method="POST" class="flex self-center justify-center gap-2">
                        @csrf
                        <button type="submit">
                            <h1 class="font-bold">Log out</h1>
                        </button>
                    </form>
                    @if (session('patient_id'))
                        <p>Patient ID: {{ session('patient_id') }}</p>
                        <a class="flex gap-6 justify-center items-center"
                            href="{{ route('client.overview', session('patient_id')) }}">
                            <h1
                                class="py-2 px-4 rounded-md text-white font-semibold bg-green-600 hover:bg-green-700 transition-all cursor-pointer">
                                PROFILE</h1>
                        </a>
                    @else
                        <p>No Patient ID found in session.</p>
                        <p>{{ Auth::user()->patient_id }}</p>
                    @endif
                @else
                @endif
            @endauth




            {{-- <a class="flex self-center justify-center gap-2" href="{{ route('login') }}">
                <h1 class="font-bold">Login</h1>
            </a>
            <a class="flex gap-6 justify-center items-center" href="{{ route('appointments.request') }}">
                <h1
                    class="py-2 px-4 rounded-md text-white font-semibold bg-green-600 hover:bg-green-700 transition-all cursor-pointer">
                    BOOK NOW</h1>
            </a> --}}



        </div>
    </div>
</body>

</html>
