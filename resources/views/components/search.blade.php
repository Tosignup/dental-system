<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }} @yield('title') </title>
    <link rel="icon" href="{{ asset('assets//images/logo.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
   
    @vite('resources/css/app.css')
</head>
<div class="flex justify-between gap-2">
    <form method="GET" class=" flex justify-center items-center gap-2" action="{{ route('patient_list') }}">
    {{-- <form method="GET" class=" flex justify-center items-center gap-2" action="{{ route('welcome') }}"> --}}

        @csrf
        <img class="h-12" src="{{ asset('assets/images/search-icon.png') }}" alt="">
        <input placeholder="Search..." autocomplete="off" name="search" type="search"
            class=" py-2 px-4 border-gray-400 rounded-md">
        <button type="submit"
            class="shadow-md py-2 px-6 rounded-md bg-white hover:bg-gray-800 hover:text-white transition-all">
            Search
        </button>
    </form>
    <div class="flex gap-3 justify-center items-center self-end">
        <img class="h-12" src="{{ asset('assets/images/logo.png') }}" alt="">
        <h1 class="text-md font-semibold">{{ Auth::user()->name }}</h1>
    </div>
</div>
</body>

</html>
