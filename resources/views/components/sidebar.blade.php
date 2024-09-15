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
<style>
    /* Custom CSS */
    #mobile-nav {
        transition: transform 0.3s ease;
        z-index: 20;
    }

    #mobile-nav.active {
        transform: translateX(0);
    }

    /* Add this to your CSS file */
    #overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.5);
        /* Semi-transparent white */
        z-index: 9;
        /* Ensure it is above other content */
    }

    #overlay.active {
        display: block;
    }


    .no-scroll {
        overflow: hidden;
        height: 100vh;
    }
    }
</style>

<body class="">
    <div id="overlay"></div>
    <nav
        class="max-w-max min-w-max self-start h-full bg-white z-0 flex flex-col justify-between items-center py-4 px-8 max-md:hidden">
        <div class="flex flex-col gap-4">
            <div class="flex justify-start items-center gap-2 mb-4">
                <a href="{{ route('welcome') }}">
                    <img class="h-10" src="{{ asset('assets/images/logo.png') }}" alt="">
                </a>
                <h1 class="text-sm">Tooth Impressions Dental Clinic</h1>
            </div>
            @if (Auth::user()->role === 'admin')
                <div class="flex flex-col items-start gap-2">
                    <a class="flex justify-start items-center gap-2 active:bg-green-600 hover:bg-gray-300 transition-all w-full p-2 rounded-md"
                        href="{{ route('admin.dashboard') }}">
                        <img class="h-8" src="{{ asset('assets/images/dashboard-icon.png') }}" alt="">
                        <button class="hover:font-bold  transition-all">
                            Dashboard
                        </button>
                    </a>
                    <a class="flex justify-start items-center gap-2 active:bg-green-600 hover:bg-gray-300 transition-all w-full p-2 rounded-md"
                        href="{{ route('dentist') }}">
                        <img class="h-8" src="{{ asset('assets/images/dentist.png') }}" alt="">
                        <button class="hover:font-bold transition-all">
                            Dentist
                        </button>
                    </a>
                    <a class="flex justify-start items-center gap-2 active:bg-green-600 hover:bg-gray-300 transition-all w-full p-2 rounded-md"
                        href="{{ route('patient_list') }}">
                        <img class="h-8" src="{{ asset('assets/images/patient-list-icon.png') }}" alt="">
                        <button class="hover:font-bold transition-all">
                            Patient list
                        </button>
                    </a>
                    <a class="flex justify-start items-center gap-2 active:bg-green-600 hover:bg-gray-300 transition-all w-full p-2 rounded-md"
                        href="{{ route('schedule') }}">
                        <img class="h-8" src="{{ asset('assets/images/appointment-calendar.png') }}" alt="">
                        <button class="hover:font-bold transition-all">
                            Schedule
                        </button>
                    </a>
                    <a class="flex justify-start items-center gap-2 active:bg-green-600 hover:bg-gray-300 transition-all w-full p-2 rounded-md"
                        href="{{ route('appointment.submission') }}">
                        <img class="h-8" src="{{ asset('assets/images/appointment.png') }}" alt="">
                        <button class="hover:font-bold transition-all">
                            Appointment List
                        </button>
                    </a>
                    <a class="flex justify-start items-center gap-2 active:bg-green-600 hover:bg-gray-300 transition-all w-full p-2 rounded-md"
                        href="inventory">
                        <img class="h-8" src="{{ asset('assets/images/inventory.png') }}" alt="">
                        <button class="hover:font-bold transition-all">
                            Inventory
                        </button>
                    </a>

                </div>
            @else
                <div class="flex flex-col items-start gap-4">
                    <a class="flex justify-start items-center gap-2 w-full p-2 rounded-md active:bg-green-600 hover:bg-gray-300 transition-all border"
                        href="{{ route('receptionist.dashboard') }}">
                        <img class="h-8" src="{{ asset('assets/images/dashboard-icon.png') }}" alt="">
                        <button class="hover:font-bold  transition-all">
                            Dashboard
                        </button>
                    </a>
                    <a class="flex justify-start items-center gap-2 active:bg-green-600 hover:bg-gray-300 transition-all w-full p-2 rounded-md"
                        href="{{ route('patient_list') }}">
                        <img class="h-8" src="{{ asset('assets/images/patient-list-icon.png') }}" alt="">
                        <button class="hover:font-bold transition-all">
                            Patient list
                        </button>
                    </a>
                </div>
            @endif
        </div>
        <form action="{{ route('logout') }}" method="POST" class="flex justify-center self-start gap-2">
            @csrf
            <img class="h-7" src="{{ asset('assets/images/logout.png') }}" alt="">
            <button class="hover:font-bold transition-all font-semibold hover:text-red-600">
                Log out
            </button>
        </form>
    </nav>

    {{-- - AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA - --}}

    <div class="hidden max-md:flex absolute top-0 left-0 w-screen justify-between items-center p-4 bg-white border-b-2">
        <button id="burger-icon" class="burger-icon">
            <img class="h-5" src="{{ asset('assets/images/hamburger-icon.png') }}" alt="Menu">
        </button>

        <img class="h-8" src="{{ asset('assets/images/logo.png') }}" alt="">
        <div class="flex gap-3 justify-center items-center self-start">
            {{-- <img class="h-12" src="{{ asset('assets/images/logo.png') }}" alt="">
            <h1 class="text-md font-semibold">{{ Auth::user()->name }}</h1> --}}
        </div>
    </div>

    <nav id="mobile-nav"
        class="max-w-max min-w-max hidden self-start h-svh bg-white z-10 flex-col justify-between items-center py-4 px-4 transform -translate-x-full transition-transform duration-300 max-md:absolute max-md:flex fixed">
        <div class="flex flex-col gap-4 ">
            <div class="flex justify-between items-center gap-2 mb-4">
                <a href="{{ route('welcome') }}">
                    <img class="h-8" src="{{ asset('assets/images/logo.png') }}" alt="">
                </a>
                <button id="back-icon" class="back-icon">
                    <img class="h-5" src="{{ asset('assets/images/back-icon.png') }}" alt="Menu">
                </button>
            </div>
            @if (Auth::user()->role === 'admin')
                <div class="flex flex-col items-start gap-2">
                    @include('components.search')
                    <a class="flex justify-start items-center gap-2 active:bg-green-600 hover:bg-gray-300 transition-all w-full p-2 rounded-md"
                        href="{{ route('admin.dashboard') }}">
                        <img class="h-5" src="{{ asset('assets/images/dashboard-icon.png') }}" alt="">
                        <button class="hover:font-bold transition-all text-xs">
                            Dashboard
                        </button>
                    </a>
                    <a class="flex justify-start items-center gap-2 active:bg-green-600 hover:bg-gray-300 transition-all w-full p-2 rounded-md"
                        href="{{ route('dentist') }}">
                        <img class="h-5" src="{{ asset('assets/images/dentist.png') }}" alt="">
                        <button class="hover:font-bold transition-all text-xs">
                            Dentist
                        </button>
                    </a>
                    <a class="flex justify-start items-center gap-2 active:bg-green-600 hover:bg-gray-300 transition-all w-full p-2 rounded-md"
                        href="{{ route('patient_list') }}">
                        <img class="h-5" src="{{ asset('assets/images/patient-list-icon.png') }}" alt="">
                        <button class="hover:font-bold transition-all text-xs">
                            Patient list
                        </button>
                    </a>
                    <a class="flex justify-start items-center gap-2 active:bg-green-600 hover:bg-gray-300 transition-all w-full p-2 rounded-md"
                        href="{{ route('schedule') }}">
                        <img class="h-5" src="{{ asset('assets/images/appointment-calendar.png') }}"
                            alt="">
                        <button class="hover:font-bold transition-all text-xs">
                            Schedule
                        </button>
                    </a>
                    <a class="flex justify-start items-center gap-2 active:bg-green-600 hover:bg-gray-300 transition-all w-full p-2 rounded-md"
                        href="{{ route('appointment.submission') }}">
                        <img class="h-5" src="{{ asset('assets/images/appointment.png') }}" alt="">
                        <button class="hover:font-bold transition-all text-xs">
                            Appointment List
                        </button>
                    </a>
                    <a class="flex justify-start items-center gap-2 active:bg-green-600 hover:bg-gray-300 transition-all w-full p-2 rounded-md"
                        href="inventory">
                        <img class="h-5" src="{{ asset('assets/images/inventory.png') }}" alt="">
                        <button class="hover:font-bold transition-all text-xs">
                            Inventory
                        </button>
                    </a>

                </div>
            @else
                <div class="flex flex-col items-start gap-4">
                    <a class="flex justify-start items-center gap-2 active:bg-green-600 hover:bg-gray-300 transition-all w-full p-2 rounded-md active:bg-green-600 hover:bg-gray-300 transition-all border"
                        href="{{ route('receptionist.dashboard') }}">
                        <img class="h-8" src="{{ asset('assets/images/dashboard-icon.png') }}" alt="">
                        <button class="hover:font-bold  transition-all">
                            Dashboard
                        </button>
                    </a>
                    <a class="flex justify-start items-center gap-2 active:bg-green-600 hover:bg-gray-300 transition-all w-full p-2 rounded-md"
                        href="{{ route('patient_list') }}">
                        <img class="h-8" src="{{ asset('assets/images/patient-list-icon.png') }}" alt="">
                        <button class="hover:font-bold transition-all">
                            Patient list
                        </button>
                    </a>
                </div>
            @endif
        </div>
        <form action="{{ route('logout') }}" method="POST" class="flex justify-center px-2.5 self-start gap-2">
            @csrf
            <img class="h-4" src="{{ asset('assets/images/logout.png') }}" alt="">
            <button class="hover:font-bold transition-all hover:text-red-600 text-xs">
                Log out
            </button>
        </form>
    </nav>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const burgerIcon = document.getElementById('burger-icon');
            const backIcon = document.getElementById('back-icon');
            const mobileNav = document.getElementById('mobile-nav');
            const overlay = document.getElementById('overlay');
            const body = document.body; // Reference to the body element

            // Toggle the menu, overlay, and no-scroll class when the burger icon is clicked
            burgerIcon.addEventListener('click', function() {
                mobileNav.classList.toggle('active');
                overlay.classList.toggle('active');
                body.classList.toggle('no-scroll'); // Toggle the no-scroll class
            });

            // Hide the menu, overlay, and remove the no-scroll class when the overlay is clicked
            overlay.addEventListener('click', function() {
                mobileNav.classList.remove('active');
                overlay.classList.remove('active');
                body.classList.remove('no-scroll'); // Remove the no-scroll class
            });

            // Hide the menu, overlay, and remove the no-scroll class when the back icon is clicked
            backIcon.addEventListener('click', function() {
                mobileNav.classList.remove('active');
                overlay.classList.remove('active');
                body.classList.remove('no-scroll'); // Remove the no-scroll class
            });
        });
    </script>



</body>

</html>
