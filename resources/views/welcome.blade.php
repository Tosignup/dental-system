@extends('components.layout')
@section('title')
    | Home
@endsection
@section('content')
    <section class="flex flex-wrap justify-between md:justify-center mt-24 mx-8 items-start h-screen">
        <div class="bg-white flex flex-col py-11 px-12 mx-8 rounded-lg shadow-lg gap-6 md:max-w-lg ">
            <h1 class="text-7xl font-semibold max-md:text-5xl">
                Look forward to the dentist
            </h1>
            <h1 class="text-lg">Top-rated clinicians</h1>
            <div class="w-1/2 py-2 flex flex-col justify-center items-start gap-4">
                <a class="max-w-sm text-center mt-4" href="{{ route('appointments.request') }}">
                {{-- <a class="max-w-sm text-center mt-4" href="{{ route('welcome') }}"> --}}
                    <h1
                        class="min-w-max bg-green-600 rounded-md py-4 max-md:text-sm px-8 font-bold text-white hover:bg-green-700 transition-all">
                        BOOK NOW</h1>
                </a>
                <h1 class="text-sm min-w-max">
                    OR CALL: <span class="font-bold">212-2345-5918</span>
                </h1>
            </div>
        </div>
        <div class="w-2/5 flex justify-center items-center  max-md:hidden">
            <img class="h-max rounded-lg" src="{{ asset('assets/images/hero-image.jpg') }}" alt="">
        </div>
    </section>
    <section class="bg-green-600 flex flex-col justify-center items-center py-8 my-4 shadow-lg">
        <div class="max-w-5xl mb-9 px-7">
            <h1 class="text-white text-7xl max-md:text-6xl text-center font-bold">
                Feel amazing about your oral health
            </h1>
        </div>
        <div class="flex flex-col justify-center items-start max-sm:items-center my-5 gap-8 px-4">
            <div class="flex gap-6 justify-center items-center mx-4">
                <h1 class="bg-white text-slate-900 p-6 rounded-full font-bold text-md">
                    15+
                </h1>
                <div class="flex flex-col justify-start items-start">
                    <h1 class="text-white font-semibold text-4xl max-md:text-3xl">Decades of experiences</h1>
                    <h1 class="text-white text-md">Our clinical team is led by renowned clinicians.</h1>
                </div>
            </div>
            <div class="flex gap-6 justify-center items-center mx-4">
                <h1 class="bg-white text-green-800 p-4 rounded-full font-bold text-md">
                    <img class="h-11 object-contain" src="{{ asset('assets/images/atom.png') }}" alt="">
                </h1>
                <div class="flex flex-col justify-start items-start">
                    <h1 class="text-white font-semibold text-4xl max-md:text-3xl">Science-based care</h1>
                    <h1 class="text-white text-md">We take advantage of all the latest research.</h1>
                </div>
            </div>
            <div class="flex gap-6 justify-center items-center mx-4">
                <h1 class="bg-white text-green-800 p-4 rounded-full font-bold text-md">
                    <img class="h-11 object-contain" src="{{ asset('assets/images/tooth.png') }}" alt="">
                </h1>
                <div class="flex flex-col justify-start items-start">
                    <h1 class="text-white font-semibold text-4xl max-md:text-3xl">Only the care you need</h1>
                    <h1 class="text-white text-md">Our dentists don't make a commission on procedures.</h1>
                </div>
            </div>
            <a onclick="test(`test`)" href="" class="my-4">
                <h1
                    class="bg-white text-gray-900 font-semibold text-md py-4 px-8 rounded-md hover:bg-gray-900 hover:text-white transition-all">
                    Learn more</h1>
            </a>
        </div>
    </section>
    <section class="flex justify-evenly items-center flex-wrap gap-4 my-8">
        <div
            class="flex flex-col justify-start gap-4 max-w-xl p-12 rounded-md bg-green-600 text-white shadow-lg hover:bg-green-700 transition-all cursor-pointer mx-8">
            <h1 class="text-6xl font-semibold">
                Services
            </h1>
            <h1 class="font-semibold text-xl">
                Exceptional dental care for a healthier, brighter smile.
            </h1>
            <span class="text-md my-2">
                Skilled and compassionate dental professionals prioritize patient comfort and satisfaction, ensuring
                a
                gentle and thorough experience. Emphasis is placed on education for proper oral hygiene practices to
                maintain long-term dental health.
            </span>
        </div>
        <div
            class="flex flex-wrap justify-evenly items-center gap-12 mx-6 p-6 bg-white shadow-lg rounded-lg w-1/2 justify-self-end self-end ">
            <div
                class="flex flex-col justify-center items-center max-w-md bg-green-600 rounded-md py-4 px-2 hover:mt-[-15px] hover:bg-green-800 cursor-pointer transition-all">
                <img class="h-44 bg-white m-4 p-5 rounded-md object-contain" src="{{ asset('assets/images/root-canal.png') }}"
                    alt="">
                <h1 class="text-white font-semibold text-center">Root Canal</h1>

            </div>
            <div
                class="flex flex-col justify-center items-center max-w-md bg-green-600 rounded-md py-4 px-2 hover:mt-[-15px] hover:bg-green-800 cursor-pointer transition-all">
                <img class=" h-44 bg-white m-4 p-5 rounded-md object-contain"
                    src="{{ asset('assets/images/tooth-extraction.png') }}" alt="">
                <h1 class="text-white font-semibold text-center">Tooth Extraction</h1>
            </div>
            <div
                class="flex flex-col justify-center items-center max-w-md bg-green-600 rounded-md py-4 px-2 hover:mt-[-15px] hover:bg-green-800 cursor-pointer transition-all">
                <img class=" h-44 bg-white m-4 p-5 rounded-md object-contain"
                    src="{{ asset('assets/images/dental-restoration.png') }}" alt="">
                <h1 class="text-white font-semibold text-center">Dental Restoration</h1>
            </div>
            <div
                class="flex flex-col justify-center items-center max-w-md bg-green-600 rounded-md py-4 px-2 hover:mt-[-15px] hover:bg-green-800 cursor-pointer transition-all">
                <img class=" h-44 bg-white m-4 p-5 rounded-md object-contain" src="{{ asset('assets/images/dental-sealant.png') }}"
                    alt="">
                <h1 class="text-white font-semibold text-center">Dental Sealant</h1>
            </div>
            <div
                class="flex flex-col justify-center items-center max-w-md bg-green-600 rounded-md py-4 px-2 hover:mt-[-15px] hover:bg-green-800 cursor-pointer transition-all">
                <img class=" h-44 bg-white m-4 p-5 rounded-md object-contain" src="{{ asset('assets/images/braces.png') }}"
                    alt="">
                <h1 class="text-white font-semibold text-center">Braces</h1>
            </div>
            <div
                class="flex flex-col justify-center items-center max-w-md bg-green-600 rounded-md py-4 px-2 hover:mt-[-15px] hover:bg-green-800 cursor-pointer transition-all">
                <img class=" h-44 bg-white m-4 p-5 rounded-md object-contain" src="{{ asset('assets/images/dental-cleaning.png') }}" alt="">
                <h1 class="text-white font-semibold text-center">Dental Cleaning</h1>
            </div>
        </div>
    </section>

    @include('components.location')
    <div class="w-full flex justify-center items-center">
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded-md mb-4">
                {{ session('success') }}
            </div>
        @endif
        @include('components.contact')
    </div>

    @include('components.footer')
@endsection
