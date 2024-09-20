<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }} @yield('title') </title>
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    @vite('resources/css/app.css')
</head>

<body class="">
    <nav
        class="max-w-max min-w-max self-start h-full bg-white z-0 flex flex-col justify-between items-center py-4 px-8 ">
        <div class="flex flex-col gap-4">
            <div class="flex justify-start items-center gap-2 mb-4">
                <a href="{{ route('welcome') }}">
                    <img class="h-10" src="{{ asset('assets/images/logo.png') }}" alt="">
                </a>
                <h1 class="text-sm">Tooth Impressions Dental Clinic</h1>
            </div>
            <div class="flex flex-col items-start gap-4">
                <a class="flex justify-center items-center gap-2" href="{{ route('welcome') }}">
                    <img class="h-7" src="{{ asset('assets/images/home-icon.png') }}" alt="">
                    <button class="hover:font-bold transition-all">
                        Homepage
                    </button>
                </a>
                <a class="flex justify-center items-center gap-2 active:bg-green-600"
                    href="{{ route('client.overview', session('patient_id')) }}">
                    <img class="h-8" src="{{ asset('assets/images/dashboard-icon.png') }}" alt="">
                    <button class="hover:font-bold  transition-all">
                        Dashboard
                    </button>
                </a>
                <a class="flex justify-center items-center gap-2" href="{{ route('client.user-profile') }}">
                    <img class="h-8" src="{{ asset('assets/images/patient-list-icon.png') }}" alt="">
                    <button class="hover:font-bold transition-all">
                        User profile
                    </button>
                </a>

            </div>
        </div>
        <div class="flex flex-col justify-center self-start gap-2">

            <form action="{{ route('logout') }}" method="POST" class="flex justify-center self-start gap-2">
                @csrf
                <img class="h-8" src="{{ asset('assets/images/patient-list-icon.png') }}" alt="">
                <button class="hover:font-bold transition-all font-semibold hover:text-red-600">
                    Log out
                </button>
            </form>
        </div>

    </nav>
</body>

</html>
