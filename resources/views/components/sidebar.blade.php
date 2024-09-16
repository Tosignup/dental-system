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
        class="max-w-max min-w-max self-start h-full bg-white z-0 flex flex-col justify-between items-center py-4 px-8 max-lg:hidden">
        <div class="flex flex-col gap-4">
            <div class="flex justify-start items-center gap-2 mb-4">
                <a href="{{ route('welcome') }}">
                    <img class="h-10" src="{{ asset('assets/images/logo.png') }}" alt="">
                </a>
                <h1 class="text-sm">Tooth Impressions Dental Clinic</h1>
            </div>
            @if (Auth::user()->role === 'admin')
                <div class="flex flex-col items-start gap-2">
                    <a class="flex justify-start items-center gap-2  hover:bg-gray-300 transition-all w-full p-2 rounded-md"
                        href="{{ route('admin.dashboard') }}">
                        <img class="h-8" src="{{ asset('assets/images/dashboard-icon.png') }}" alt="">
                        <button class="hover:font-bold  transition-all">
                            Dashboard
                        </button>
                    </a>
                    <a class="flex justify-start items-center gap-2  hover:bg-gray-300 transition-all w-full p-2 rounded-md"
                        href="{{ route('dentist') }}">
                        <img class="h-8" src="{{ asset('assets/images/dentist.png') }}" alt="">
                        <button class="hover:font-bold transition-all">
                            Dentist
                        </button>
                    </a>
                    <a class="flex justify-start items-center gap-2  hover:bg-gray-300 transition-all w-full p-2 rounded-md"
                        href="{{ route('patient_list') }}">
                        <img class="h-8" src="{{ asset('assets/images/patient-list-icon.png') }}" alt="">
                        <button class="hover:font-bold transition-all">
                            Patient list
                        </button>
                    </a>
                    <a class="flex justify-start items-center gap-2  hover:bg-gray-300 transition-all w-full p-2 rounded-md"
                        href="{{ route('schedule') }}">
                        <img class="h-8" src="{{ asset('assets/images/appointment-calendar.png') }}" alt="">
                        <button class="hover:font-bold transition-all">
                            Schedule
                        </button>
                    </a>
                    <a class="flex justify-start items-center gap-2  hover:bg-gray-300 transition-all w-full p-2 rounded-md"
                        href="{{ route('appointment.submission') }}">
                        <img class="h-8" src="{{ asset('assets/images/appointment.png') }}" alt="">
                        <button class="hover:font-bold transition-all">
                            Appointment List
                        </button>
                    </a>
                    <a class="flex justify-start items-center gap-2  hover:bg-gray-300 transition-all w-full p-2 rounded-md"
                        href="inventory">
                        <img class="h-8" src="{{ asset('assets/images/inventory.png') }}" alt="">
                        <button class="hover:font-bold transition-all">
                            Inventory
                        </button>
                    </a>

                </div>
            @else
                <div class="flex flex-col items-start gap-4">
                    <a class="flex justify-start items-center gap-2 w-full p-2 rounded-md  hover:bg-gray-300 transition-all border"
                        href="{{ route('receptionist.dashboard') }}">
                        <img class="h-8" src="{{ asset('assets/images/dashboard-icon.png') }}" alt="">
                        <button class="hover:font-bold  transition-all">
                            Dashboard
                        </button>
                    </a>
                    <a class="flex justify-start items-center gap-2  hover:bg-gray-300 transition-all w-full p-2 rounded-md"
                        href="{{ route('patient_list') }}">
                        <img class="h-8" src="{{ asset('assets/images/patient-list-icon.png') }}" alt="">
                        <button class="hover:font-bold transition-all">
                            Patient list
                        </button>
                    </a>
                </div>
            @endif
        </div>
        <div class="flex self-start max-md:text-xs m-2.5">
            <div class="flex gap-2 items-center justify-center">
                <button class="btn flex justify-center items-center gap-2" onclick="my_modal_2.showModal()">
                    <img class="max-md:h-4 h-6 " src="{{ asset('assets/images/logout.png') }}" alt="">Log
                    out</button>
            </div>
            <dialog id="my_modal_2" class="modal border shadow-lg border-gray-800  p-8 rounded-md max-md:text-lg">
                <div class="modal-box flex flex-col ">
                    <h3 class="text-2xl font-bold max-md:text-sm">Log out</h3>
                    <p class="py-4 max-md:text-sm">Are you sure you want to log out?</p>
                    <div class="modal-action flex gap-2 self-end">
                        <form method="dialog" class="border rounded-md  py-2 px-4">
                            <button class="btn max-md:text-xs">Close</button>
                        </form>
                        <form action="{{ route('logout') }}" method="POST"
                            class="border rounded-md border-red-600 py-2 px-4 ">
                            @csrf
                            <button class="btn max-md:text-xs">
                                Log out
                            </button>
                        </form>
                    </div>
                </div>
            </dialog>
        </div>
    </nav>

    {{-- - AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA - --}}

    <div class="hidden max-lg:flex absolute top-0 left-0 w-screen justify-between items-center p-4 bg-white border-b-2">
        <button id="burger-icon" class="burger-icon">
            <img class="h-7 border p-1 rounded-md" src="{{ asset('assets/images/hamburger-icon.png') }}"
                alt="Menu">

        </button>
        <div class="flex justify-center items-center gap-2">
            <div class="flex gap-3 justify-center items-center">
                @if (Auth::user()->role === 'Admin')
                    <p class="text-xs font-semibold max-w-sm">{{ Auth::user()->username }}</p>
                @elseif(Auth::user()->role === 'Dentist')
                    <p class="text-xs font-semibold max-w-sm">{{ Auth::user()->username }}</p>
                @elseif(Auth::user()->role === 'Staff')
                    <p class="text-xs font-semibold max-w-sm">{{ Auth::user()->username }}</p>
                @else
                    <p class="text-xs font-semibold max-w-xs">{{ Auth::user()->username }}</p>
                @endif
            </div>
            <img class="h-8" src="{{ asset('assets/images/logo.png') }}" alt="">
        </div>
    </div>
    <nav id="mobile-nav"
        class="max-w-max min-w-max hidden self-start h-svh bg-white z-10 flex-col justify-between items-center py-4 px-4 transform -translate-x-full transition-transform duration-300 max-lg:absolute max-lg:flex max-lg:border-r fixed">
        <div class="flex flex-col gap-4">
            <div class="flex justify-between items-center gap-2 mb-4">
                <a href="{{ route('welcome') }}" class="flex gap-2 justify-center items-center">
                    <img class="h-8" src="{{ asset('assets/images/logo.png') }}" alt="">
                </a>
                <button id="back-icon" class="back-icon">
                    <img class="h-7 border p-1 rounded-md" src="{{ asset('assets/images/back-icon.png') }}"
                        alt="Menu">
                </button>
            </div>
            @if (Auth::user()->role === 'admin')
                <div class="flex flex-col items-start gap-2">
                    <div class="block lg:hidden">
                        <form method="GET" class="flex justify-center items-center gap-2"
                            action="{{ route('patient_list') }} ">
                            @csrf
                            <input placeholder="Search..." autocomplete="off" name="search" type="search"
                                class="py-1 px-2 text-xs border-gray-400 rounded-md ">
                            <button type="submit"
                                class="border py-1 px-2 rounded-md bg-white hover:bg-gray-800 hover:text-white transition-all">
                                <img class="h-4" src="{{ asset('assets/images/search-icon.png') }}"
                                    alt="">
                            </button>
                        </form> <!-- Show on mobile -->
                    </div>
                    <div class="hidden lg:block">
                        <div class="justify-between items-center hidden max-lg:flex">
                            @include('components.search')
                        </div>
                    </div>

                    <a class="flex justify-start items-center gap-2  hover:bg-gray-300 transition-all w-full p-2 rounded-md"
                        href="{{ route('admin.dashboard') }}">
                        <img class="h-5" src="{{ asset('assets/images/dashboard-icon.png') }}" alt="">
                        <button class="hover:font-bold transition-all text-xs">
                            Dashboard
                        </button>
                    </a>
                    <a class="flex justify-start items-center gap-2  hover:bg-gray-300 transition-all w-full p-2 rounded-md"
                        href="{{ route('dentist') }}">
                        <img class="h-5" src="{{ asset('assets/images/dentist.png') }}" alt="">
                        <button class="hover:font-bold transition-all text-xs">
                            Dentist
                        </button>
                    </a>
                    <a class="flex justify-start items-center gap-2  hover:bg-gray-300 transition-all w-full p-2 rounded-md"
                        href="{{ route('patient_list') }}">
                        <img class="h-5" src="{{ asset('assets/images/patient-list-icon.png') }}" alt="">
                        <button class="hover:font-bold transition-all text-xs">
                            Patient list
                        </button>
                    </a>
                    <a class="flex justify-start items-center gap-2  hover:bg-gray-300 transition-all w-full p-2 rounded-md"
                        href="{{ route('schedule') }}">
                        <img class="h-5" src="{{ asset('assets/images/appointment-calendar.png') }}"
                            alt="">
                        <button class="hover:font-bold transition-all text-xs">
                            Schedule
                        </button>
                    </a>
                    <a class="flex justify-start items-center gap-2  hover:bg-gray-300 transition-all w-full p-2 rounded-md"
                        href="{{ route('appointment.submission') }}">
                        <img class="h-5" src="{{ asset('assets/images/appointment.png') }}" alt="">
                        <button class="hover:font-bold transition-all text-xs">
                            Appointment List
                        </button>
                    </a>
                    <a class="flex justify-start items-center gap-2  hover:bg-gray-300 transition-all w-full p-2 rounded-md"
                        href="inventory">
                        <img class="h-5" src="{{ asset('assets/images/inventory.png') }}" alt="">
                        <button class="hover:font-bold transition-all text-xs">
                            Inventory
                        </button>
                    </a>

                </div>
            @else
                <div class="flex flex-col items-start gap-4">
                    <a class="flex justify-start items-center gap-2  w-full p-2 rounded-md  hover:bg-gray-300 transition-all border"
                        href="{{ route('receptionist.dashboard') }}">
                        <img class="h-8" src="{{ asset('assets/images/dashboard-icon.png') }}" alt="">
                        <button class="hover:font-bold  transition-all">
                            Dashboard
                        </button>
                    </a>
                    <a class="flex justify-start items-center gap-2  hover:bg-gray-300 transition-all w-full p-2 rounded-md"
                        href="{{ route('patient_list') }}">
                        <img class="h-8" src="{{ asset('assets/images/patient-list-icon.png') }}" alt="">
                        <button class="hover:font-bold transition-all">
                            Patient list
                        </button>
                    </a>
                </div>
            @endif
        </div>
        <div class="flex self-start max-md:text-xs m-2.5">
            <div class="flex gap-2 items-center justify-center">
                <img class="max-md:h-4 h-4" src="{{ asset('assets/images/logout.png') }}" alt="">
                <button class="btn" onclick="my_modal_1.showModal()">Log out</button>
            </div>
            <dialog id="my_modal_1" class="modal p-4 rounded-md max-md:text-lg">
                <div class="modal-box flex flex-col">
                    <h3 class="text-lg font-bold max-md:text-sm">Log out</h3>
                    <p class="py-4 max-md:text-sm">Are you sure you want to log out?</p>
                    <div class="modal-action flex gap-2 self-end">
                        <form method="dialog" class="border rounded-md  py-2 px-4">
                            <button class="btn max-md:text-xs">Close</button>
                        </form>
                        <form action="{{ route('logout') }}" method="POST"
                            class="border rounded-md bg-red-600 py-2 px-4 text-white ">
                            @csrf
                            <button class="btn font-semibold max-md:text-xs">
                                Log out
                            </button>
                        </form>
                    </div>
                </div>
            </dialog>
        </div>
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
