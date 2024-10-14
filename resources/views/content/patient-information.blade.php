@extends('admin.dashboard')

@section('content')
    @if (session('success'))
        <div id="toast" class="absolute bottom-8 right-8">
            <div class="max-w-xs bg-green-600 text-sm text-white rounded-md shadow-lg dark:bg-gray-900 mb-3 ml-3"
                role="alert">
                <div class="flex p-4">
                    {{ session('success') }} <!-- Display the success message -->

                    <div class="ml-auto px-1">
                        <button type="button"
                            class="inline-flex gap-2 flex-shrink-0 justify-center items-center h-4 w-4 rounded-md text-white/[.5] hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-gray-600 transition-all text-sm dark:focus:ring-offset-gray-900 dark:focus:ring-gray-800"
                            onclick="closeToast()">
                            <span class="sr-only">Close</span>
                            <svg class="w-3.5 h-3.5 self-center" width="16" height="16" viewBox="0 0 16 16"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0.92524 0.687069C1.126 0.486219 1.39823 0.373377 1.68209 0.373377C1.96597 0.373377 2.2382 0.486219 2.43894 0.687069L8.10514 6.35813L13.7714 0.687069C13.8701 0.584748 13.9882 0.503105 14.1188 0.446962C14.2494 0.39082 14.3899 0.361248 14.5321 0.360026C14.6742 0.358783 14.8151 0.38589 14.9468 0.439762C15.0782 0.493633 15.1977 0.573197 15.2983 0.673783C15.3987 0.774389 15.4784 0.894026 15.5321 1.02568C15.5859 1.15736 15.6131 1.29845 15.6118 1.44071C15.6105 1.58297 15.5809 1.72357 15.5248 1.85428C15.4688 1.98499 15.3872 2.10324 15.2851 2.20206L9.61883 7.87312L15.2851 13.5441C15.4801 13.7462 15.588 14.0168 15.5854 14.2977C15.5831 14.5787 15.4705 14.8474 15.272 15.046C15.0735 15.2449 14.805 15.3574 14.5244 15.3599C14.2437 15.3623 13.9733 15.2543 13.7714 15.0591L8.10514 9.38812L2.43894 15.0591C2.23704 15.2543 1.96663 15.3623 1.68594 15.3599C1.40526 15.3574 1.13677 15.2449 0.938279 15.046C0.739807 14.8474 0.627232 14.5787 0.624791 14.2977C0.62235 14.0168 0.730236 13.7462 0.92524 13.5441L6.59144 7.87312L0.92524 2.20206C0.724562 2.00115 0.611816 1.72867 0.611816 1.44457C0.611816 1.16047 0.724562 0.887983 0.92524 0.687069Z"
                                    fill="currentColor" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
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
                    <h1 class="max-md:text-sm"> Date of next visit: <span class="font-semibold"> {{ $patient->next_visit }}
                        </span> </h1>
                    <h1 class="max-md:text-sm"> Branch visited: <span class="font-semibold">
                            {{ $patient->branch->branch_loc }}
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
                                href=" {{ route('patient_list') }} ">
                                <img class="h-8 max-lg:h-4" src="{{ asset('assets/images/back-icon.png') }}"
                                    alt="">
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
                        {{-- <li>
                            <a href="{{ route('add.payment', $patient->id) }}"
                                class=" flex items-center justify-start gap-2 py-2 px-4 border border-gray-500 rounded-md hover:border-gray-700 hover:shadow-sm transition-all">
                                <img class="h-8 max-lg:h-4" src="{{ asset('assets/images/payment.png') }}" alt="">
                                <h1 class="max-lg:text-xs">
                                    Add payment</h1>
                            </a>
                        </li> --}}
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
                    href=" {{ route('patient_list') }} ">
                    <img class="h-8" src="{{ asset('assets/images/arrow-back.png') }}" alt="">
                    <h1>
                        Go back to patient list</h1>
                </a>
                <a href="{{ route('edit.patient', $patient->id) }}"
                    class=" flex items-center justify-start gap-2 py-2 px-4 border border-gray-500 rounded-md hover:border-gray-700 hover:shadow-sm transition-all">
                    <img class="h-8 " src="{{ asset('assets/images/edit-icon.png') }}" alt="Edit icon">
                    <h1>
                        Edit information</h1>
                </a>
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
                {{-- <a href="{{ route('add.payment', $patient->id) }}"
                    class=" flex items-center justify-start gap-2 py-2 px-4 border border-gray-500 rounded-md hover:border-gray-700 hover:shadow-sm transition-all">
                    <img class="h-8" src="{{ asset('assets/images/payment.png') }}" alt="">
                    <h1>
                        Add payment</h1>
                </a> --}}
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

            setTimeout(() => {
                const toast = document.getElementById('toast');
                if (toast) {
                    toast.style.display = 'none';
                }
            }, 3000);

            // Function to manually close the toast
            function closeToast() {
                const toast = document.getElementById('toast');
                if (toast) {
                    toast.style.display = 'none';
                }
            }
        </script>
    </section>
@endsection
