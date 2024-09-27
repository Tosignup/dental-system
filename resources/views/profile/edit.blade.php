<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }} | Admin Dashboard </title>
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body>
    <nav class="flex p-4 justify-between align-center shadow-lg">
        <div class="flex gap-4 text-md justify-center items-center">
            <a href="{{ route('welcome') }}">
                <img class="h-14 max-lg:h-8" src="{{ asset('assets/images/logo.png') }}" alt="">
            </a>
            <div class="flex gap-4 max-md:hidden">
                <h1 class="hover:font-bold transition-all text-md font-semibold">Tooth Impressions Dental Clinic</h1>
            </div>
        </div>
    </nav>
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 ">
        <a class=" flex items-center justify-start gap-2 py-2 px-4 my-4 transition-all"
            @if (Auth::user()->role === 'admin') href=" {{ route('admin.dashboard') }} " @endif
            @if (Auth::user()->role === 'staff') href=" {{ route('staff.dashboard') }} " @endif
            @if (Auth::user()->role === 'dentist') href=" {{ route('dentist.dashboard') }} " @endif>
            <img class="h-8" src="{{ asset('assets/images/arrow-back.png') }}" alt="">
            <h1>Go back to patient list</h1>
        </a>
    </div>
    <div class=" flex flex-col max-w-4xl py-6 mx-auto sm:px-6 lg:px-8  ">
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div class="p-4 my-4 sm:p-8 bg-gray-400 shadow sm:rounded-lg ">
                <div class="w-full ">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 my-4 sm:p-8 bg-green-600 shadow sm:rounded-lg">
                <div class="w-full">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 my-4 sm:p-8 bg-green-600 shadow sm:rounded-lg">
                <div class="w-full">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</body>

</html>
