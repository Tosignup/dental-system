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
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<style>
    /* Custom CSS for responsive sidebar */
    #client-mobile-nav {
        transition: transform 0.3s ease;
        z-index: 20;
    }

    #client-mobile-nav.active {
        transform: translateX(0);
    }

    /* Overlay for mobile sidebar */
    #client-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.5);
        z-index: 9;
    }

    #client-overlay.active {
        display: block;
    }

    .no-scroll {
        overflow: hidden;
        height: 100vh;
    }
</style>

<body class="">
    <div id="client-overlay"></div>
    <nav
        class="max-w-max min-w-max self-start h-full bg-white z-0 flex flex-col justify-between items-center py-4 px-8 max-lg:hidden">
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

    <!-- Mobile Sidebar -->
    <div class="hidden max-lg:flex absolute top-0 left-0 w-screen justify-between items-center p-4 bg-white border-b-2">
        <button id="client-burger-icon" class="burger-icon">
            <img class="h-7 border p-1 rounded-md" src="{{ asset('assets/images/hamburger-icon.png') }}"
                alt="Menu">
        </button>
        <div class="flex justify-center items-center gap-2">
            <img class="h-8" src="{{ asset('assets/images/logo.png') }}" alt="">
        </div>
    </div>
    <nav id="client-mobile-nav"
        class="max-w-max min-w-max hidden self-start h-svh bg-white z-10 flex-col justify-between items-center py-4 px-4 transform -translate-x-full transition-transform duration-300 max-lg:absolute max-lg:top-0 max-lg:flex max-lg:border-r fixed">
        <div class="flex flex-col gap-4">
            <div class="flex justify-between items-center gap-2 mb-4">
                <a href="{{ route('welcome') }}" class="flex gap-2 justify-center items-center">
                    <img class="h-8" src="{{ asset('assets/images/logo.png') }}" alt="">
                </a>
                <button id="client-back-icon" class="back-icon">
                    <img class="h-5 border p-1 rounded-md" src="{{ asset('assets/images/back-icon.png') }}"
                        alt="Menu">
                </button>
            </div>
            <div class="flex flex-col items-start gap-4">
                <a class="flex justify-center items-center gap-2" href="{{ route('welcome') }}">
                    <img class="h-7" src="{{ asset('assets/images/home-icon.png') }}" alt="">
                    <button class="hover:font-bold transition-all text-xs">
                        Homepage
                    </button>
                </a>
                <a class="flex justify-center items-center gap-2 active:bg-green-600"
                    href="{{ route('client.overview', session('patient_id')) }}">
                    <img class="h-8" src="{{ asset('assets/images/dashboard-icon.png') }}" alt="">
                    <button class="hover:font-bold transition-all text-xs">
                        Dashboard
                    </button>
                </a>
                <a class="flex justify-center items-center gap-2" href="{{ route('client.user-profile') }}">
                    <img class="h-8" src="{{ asset('assets/images/patient-list-icon.png') }}" alt="">
                    <button class="hover:font-bold transition-all text-xs">
                        User profile
                    </button>
                </a>
            </div>
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
            const burgerIcon = document.getElementById('client-burger-icon');
            const backIcon = document.getElementById('client-back-icon');
            const mobileNav = document.getElementById('client-mobile-nav');
            const overlay = document.getElementById('client-overlay');
            const body = document.body;

            // Toggle the menu, overlay, and no-scroll class when the burger icon is clicked
            burgerIcon.addEventListener('click', function() {
                mobileNav.classList.toggle('active');
                overlay.classList.toggle('active');
                body.classList.toggle('no-scroll');
            });

            // Hide the menu, overlay, and remove the no-scroll class when the overlay is clicked
            overlay.addEventListener('click', function() {
                mobileNav.classList.remove('active');
                overlay.classList.remove('active');
                body.classList.remove('no-scroll');
            });

            // Hide the menu, overlay, and remove the no-scroll class when the back icon is clicked
            backIcon.addEventListener('click', function() {
                mobileNav.classList.remove('active');
                overlay.classList.remove('active');
                body.classList.remove('no-scroll');
            });
        });
    </script>

</body>

</html>
