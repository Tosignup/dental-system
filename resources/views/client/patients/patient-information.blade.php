@extends('admin.dashboard')

@section('content')
    @if (session('success'))
        @include('components.toast-notification')
    @endif
    <div class="m-4">
        @include('components.search')
    </div>
    <section class="bg-white m-4 p-8 max-lg:mt-12 shadow-lg rounded-md flex flex-col justify-center z-0">
        <div class="flex max-lg:flex-col justify-between items-start ">
            <div class="">
                <div class="flex flex-col mb-7 w-full max-lg:flex justify-between items-between  gap-4">
                    <h1 class="text-5xl font-bold max-md:text-3xl">
                        {{ $patient->first_name }}
                        {{ $patient->last_name }}
                    </h1>
                </div>
                <div class="flex flex-col gap-3 text-md">
                    <h1 class="max-md:text-sm"> Gender: <span class="font-semibold"> {{ $patient->gender }} </span> </h1>
                    <h1 class="max-md:text-sm"> Birth date: <span class="font-semibold"> {{ $patient->date_of_birth }}
                        </span>
                    </h1>
                    <h1 class="max-md:text-sm"> Facebook name: <span class="font-semibold"> {{ $patient->fb_name }} </span>
                    </h1>
                    <h1 class="max-md:text-sm"> Phone number: <span class="font-semibold"> {{ $patient->phone_number }}
                        </span> </h1>
                    <h1 class="max-md:text-sm"> Date of next visit: <span class="font-semibold">
                            {{ $patient->next_visit ?? 'none' }}
                        </span> </h1>
                    <h1 class="max-md:text-sm"> Branch visited: <span class="font-semibold">
                            {{ $patient->branch->branch_loc ?? 'none' }}
                        </span> </h1>
                </div>
            </div>
            <div class="hidden flex-col gap-4 max-lg:flex mt-5 border-2 border-gray-700 rounded-md min-w-xl">
                <details class="dropdown">
                    <summary class="flex btn my-2  py-2 px-8 text-sm">Actions
                    </summary>
                    <hr>
                    <ul class="menu dropdown-content bg-base-100 rounded-box z-[1] w-52 p-2 shadow flex flex-col gap-2">
                        <li><a class=" hidden items-center justify-start gap-2 py-2 px-4 border border-gray-500 rounded-md hover:border-gray-700 hover:shadow-sm transition-all"
                                href=" {{ route('patient.active') }} ">
                                <img class="h-8 max-lg:h-4" src="{{ asset('assets/images/back-icon.png') }}" alt="">
                                <h1 class="max-lg:text-xs">Go back to patient list</h1>
                            </a></li>
                        <li>
                            <a href="{{ route('edit.patient', $patient->id) }}"
                                class=" flex items-center justify-start gap-2 py-2 px-4 border border-gray-500 rounded-md hover:border-gray-700 hover:shadow-sm transition-all">
                                <img class="h-8 max-lg:h-4" src="{{ asset('assets/images/edit-icon.png') }}"
                                    alt="Edit icon">
                                <h1 class="max-lg:text-xs">
                                    Edit information</h1>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('patient.contract', $patient->id) }}"
                                class="flex items-center justify-start gap-2 py-2 px-4 border border-gray-500 rounded-md hover:border-gray-700 hover:shadow-sm transition-all">
                                <img class="h-8 max-lg:h-4" src="{{ asset('assets/images/contract.png') }}" alt="">
                                <h1 class="max-lg:text-xs">
                                    Contract</h1>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('patient.background', $patient->id) }}"
                                class=" flex items-center justify-start gap-2 py-2 px-4 border border-gray-500 rounded-md hover:border-gray-700 hover:shadow-sm transition-all">
                                <img class="h-8 max-lg:h-4" src="{{ asset('assets/images/background.png') }}"
                                    alt="">
                                <h1 class="max-lg:text-xs">
                                    Background</h1>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('patient.xray', $patient->id) }}"
                                class=" flex items-center justify-start gap-2 py-2 px-4 border border-gray-500 rounded-md hover:border-gray-700 hover:shadow-sm transition-all">
                                <img class="h-8 max-lg:h-4" src="{{ asset('assets/images/x-ray.png') }}" alt="">
                                <h1 class="max-lg:text-xs">
                                    X-rays</h1>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('payments.list', $patient->id) }}"
                                class=" flex items-center justify-start gap-2 py-2 px-4 border border-gray-500 rounded-md hover:border-gray-700 hover:shadow-sm transition-all">
                                <img class="h-8 max-lg:h-4" src="{{ asset('assets/images/payment.png') }}" alt="">
                                <h1 class="max-lg:text-xs">
                                    Payment list</h1>
                            </a>
                        </li>
                        <li>
                            <a
                                class=" flex items-center justify-start gap-2 py-2 px-4 border border-gray-500 rounded-md hover:border-gray-700 hover:shadow-sm transition-all">
                                @if (is_null($patient->archived_at))
                                    <img class="h-8 max-lg:h-4" src="{{ asset('assets/images/archive.png') }}"
                                        alt="">
                                    <button type="submit" onclick="document.getElementById('my_modal_5').showModal()">
                                        <h1>Archive</h1>
                                    </button>
                                    <dialog id="my_modal_5"
                                        class="modal border-2 shadow-lg border-gray-400 p-8 rounded-md max-md:text-lg">
                                        <div class="modal-box flex flex-col">
                                            <h3 class="text-2xl font-bold max-md:text-sm">Archive Patient</h3>
                                            <p class="py-4 font-normal max-md:text-sm">Are you sure you want to archive
                                                {{ $patient->last_name . ' ' . $patient->first_name }}?</p>
                                            <div class="modal-action flex gap-2 self-end">
                                                <form method="dialog" class="border rounded-md w-max py-2 px-4">
                                                    <button class="btn max-md:text-xs">Close</button>
                                                </form>
                                                <form action="{{ route('archive.patient', $patient->id) }}" method="POST"
                                                    class="border  bg-red-600 text-white rounded-md py-2 px-4">
                                                    @csrf
                                                    <button
                                                        class="btn  bg-red-600 text-white max-md:text-xs w-max flex gap-2">Yes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </dialog>
                                @else
                                    <img class="h-8 max-lg:h-4" src="{{ asset('assets/images/restore.png') }}"
                                        alt="">
                                    <form action="{{ route('restore.patient', $patient->id) }}" method="POST">
                                        @csrf
                                        <button type="submit">Restore</button>
                                    </form>
                                @endif
                            </a>
                        </li>
                    </ul>
                </details>
            </div>
            <div class="flex flex-col gap-4 max-lg:hidden">
                <a class=" flex items-center justify-start gap-2 py-2 px-4 border border-gray-500 rounded-md hover:border-gray-700 hover:shadow-sm transition-all"
                    @if ($patient->is_archived == '0') href=" {{ route('patient.active') }}"
                @elseif ($patient->is_archived == '1') href=" {{ route('patient.archived') }} " @endif>
                    <img class="h-8" src="{{ asset('assets/images/arrow-back.png') }}" alt="">
                    <h1>
                        Go back to patient list</h1>
                </a>
                @if ($patient->is_archived == '0')
                    <a href="{{ route('edit.patient', $patient->id) }}"
                        class=" flex items-center justify-start gap-2 py-2 px-4 border border-gray-500 rounded-md hover:border-gray-700 hover:shadow-sm transition-all">
                        <img class="h-8 " src="{{ asset('assets/images/edit-icon.png') }}" alt="Edit icon">
                        <h1>
                            Edit information</h1>
                    </a>
                @elseif ($patient->is_archived == '1')
                @endif
                <a href="{{ route('patient.contract', $patient->id) }}"
                    class="flex items-center justify-start gap-2 py-2 px-4 border border-gray-500 rounded-md hover:border-gray-700 hover:shadow-sm transition-all">
                    <img class="h-8" src="{{ asset('assets/images/contract.png') }}" alt="">
                    <h1>
                        Contract</h1>
                </a>
                <a href="{{ route('patient.background', $patient->id) }}"
                    class=" flex items-center justify-start gap-2 py-2 px-4 border border-gray-500 rounded-md hover:border-gray-700 hover:shadow-sm transition-all">
                    <img class="h-8" src="{{ asset('assets/images/background.png') }}" alt="">
                    <h1>
                        Background</h1>
                </a>
                <a href="{{ route('patient.xray', $patient->id) }}"
                    class=" flex items-center justify-start gap-2 py-2 px-4 border border-gray-500 rounded-md hover:border-gray-700 hover:shadow-sm transition-all">
                    <img class="h-8" src="{{ asset('assets/images/x-ray.png') }}" alt="">
                    <h1>
                        X-rays</h1>
                </a>
                <a href="{{ route('payments.list', $patient->id) }}"
                    class=" flex items-center justify-start gap-2 py-2 px-4 border border-gray-500 rounded-md hover:border-gray-700 hover:shadow-sm transition-all">
                    <img class="h-8" src="{{ asset('assets/images/payment.png') }}" alt="">
                    <h1>
                        Payment list</h1>
                </a>
                <a
                    class=" flex items-center justify-start gap-2 py-2 px-4 border border-gray-500 rounded-md hover:border-gray-700 hover:shadow-sm transition-all">
                    @if (is_null($patient->archived_at))
                        <img class="h-8" src="{{ asset('assets/images/archive.png') }}" alt="">
                        <button type="submit"
                            onclick="document.getElementById('my_modal_6').showModal()">Archive</button>
                        <dialog id="my_modal_6"
                            class="modal_1 border-2 shadow-lg border-gray-400 p-8 rounded-md max-md:text-lg">
                            <div class="modal-box flex flex-col">
                                <h3 class="text-2xl font-bold max-md:text-sm">Archive Patient</h3>
                                <p class="py-4 font-normal max-md:text-sm">Are you sure you want to archive
                                    {{ $patient->last_name . ' ' . $patient->first_name }}?</p>
                                <div class="modal-action flex gap-2 self-end">
                                    <form method="dialog" class="border rounded-md w-max py-2 px-4">
                                        <button class="btn max-md:text-xs">Close</button>
                                    </form>
                                    <form action="{{ route('archive.patient', $patient->id) }}" method="POST"
                                        class="border  bg-red-600 text-white rounded-md py-2 px-4">
                                        @csrf
                                        <button
                                            class="btn  bg-red-600 text-white max-md:text-xs w-max flex gap-2">Yes</button>
                                    </form>
                                </div>
                            </div>
                        </dialog>
                    @else
                        <img class="h-8" src="{{ asset('assets/images/restore.png') }}" alt="">
                        <form action="{{ route('restore.patient', $patient->id) }}" method="POST">
                            @csrf
                            <button type="submit">Restore</button>
                        </form>
                    @endif
                </a>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const modal = document.getElementById('my_modal_5');
                const modal_1 = document.getElementById('my_modal_6');
                const logoutButton = document.getElementById('logout-button');
                const closeButton = modal.querySelector('button[type="button"]');

                const overlay = document.getElementById('overlay');
                const dropdown = document.getElementById('user-dropdown');
                const mobileNav = document.getElementById('mobile-nav');
                const burgerIcon = document.getElementById('burger-icon');
                const backIcon = document.getElementById('back-icon');
                const body = document.body;

                dropdown.addEventListener('toggle', function(event) {
                    if (mobileNav.classList.contains('active')) {
                        event.preventDefault();
                    } else {
                        if (event.target.open) {
                            overlay.classList.add('active');
                            body.classList.add('no-scroll');
                        } else {
                            overlay.classList.remove('active');
                            body.classList.remove('no-scroll');
                        }
                    }
                });

                burgerIcon.addEventListener('click', function() {
                    mobileNav.classList.add('active');
                    overlay.classList.add('active');
                    body.classList.add('no-scroll');
                });

                backIcon.addEventListener('click', function() {
                    mobileNav.classList.remove('active');
                    overlay.classList.remove('active');
                    body.classList.remove('no-scroll');
                });

                overlay.addEventListener('click', function() {
                    mobileNav.classList.remove('active');
                    overlay.classList.remove('active');
                    body.classList.remove('no-scroll');
                });

                document.addEventListener('click', function(event) {
                    const isClickInsideDropdown = dropdown.contains(event.target);
                    const isClickInsideMobileNav = mobileNav.contains(event.target);

                    if (!isClickInsideDropdown && !isClickInsideMobileNav && dropdown.hasAttribute('open')) {
                        dropdown.removeAttribute('open');
                        overlay.classList.remove('active');
                        body.classList.remove('no-scroll');
                    }
                });
            });
        </script>
    </section>
@endsection
