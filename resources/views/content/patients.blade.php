@extends('admin.dashboard')
@section('content')
    <div class="m-4 mb-8">
        @include('components.search')
    </div>
    <section class="m-4 p-4 bg-white shadow-lg rounded-md">
        <div class="flex items-start justify-center max-md:items-start max-md:justify-start flex-col max-md:flex-wrap">
            <label class="flex justify-between w-full items-start gap-2" for="time">
                <h1 class="font-bold text-3xl max-md:text-xl min-w-max">Patient list</h1>
                <form class="" method="GET" action="{{ route('add.patient') }}">
                    @csrf
                    <button onclick="openModal()"
                        class="flex justify-center items-center gap-2  rounded-md py-2 px-4 min-w-max border-2 border-gray-600 hover:shadow-md hover:border-green-700 font-semibold text-gray-800 transition-all max-md:px-2">
                        <span class="max-md:text-xs"> Add patient</span>
                        <img class="h-8 max-md:h-4" src="{{ asset('assets/images/add-patient.png') }}" alt="">
                    </button>
                </form>
            </label>
            <form method="GET" action="{{ route('patient_list') }}"
                class="flex gap-4 max-md:gap-1 items-center justify-center m-4 max-md:m-2">
                <h1 class="max-md:text-xs min-w-max">Sort by: </h1>
                <select name="sort"
                    class="border text-sm w-32 border-gray-400 p-2 px-4 mx-2 rounded-md max-md:text-xs max-md:px-2 max-md:mx-1 max-md:p-1 max-md:w-lg"
                    id="sort">
                    <option value="id" {{ request()->get('sort') == 'id' ? 'selected' : '' }}>ID</option>
                    <option value="date_of_next_visit"
                        {{ request()->get('sort') == 'date_of_next_visit' ? 'selected' : '' }}>Next visit</option>
                    <option value="name" {{ request()->get('sort') == 'name' ? 'selected' : '' }}>Name</option>
                </select>
            </form>
        </div>

        <!-- run @/foreach for each field/row  -->
        <table class="w-full table-auto mb-2 overflow-hidden">
            <thead>
                <tr>
                    <th class="px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs">ID</th>
                    <th class="px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs">Name</th>
                    <th class="px-4 py-2 max-lg:hidden">Date of next visit</th>
                    <th class="px-4 py-2 max-lg:hidden">Package</th>
                    <th class="px-4 py-2 max-lg:hidden">Contacts</th>
                    <th class="px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($patients as $patient)
                    <tr class="odd:bg-green-100 even:bg-slate-100">
                        <td class="border px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs ">{{ $patient->id }}</td>
                        <td class="border px-4 py-2 max-md:py-1 max-md:px-2 max-md:text-xs">{{ $patient->last_name }}
                            {{ $patient->first_name }}</td>
                        <td class="border px-4 py-2 max-lg:hidden">{{ $patient->date_of_next_visit }}</td>
                        <td class="border px-4 py-2 max-lg:hidden">{{ $patient->package }}</td>
                        <td class="border px-4 py-2 max-lg:hidden">
                            <div class="flex justify-center items-center gap-6">
                                <div class="tooltip">
                                    <img class="h-6" src="{{ asset('assets/images/phone-call.png') }}" alt="Call Icon">
                                    <span class="tooltiptext">{{ $patient->phone_number }}</span>
                                </div>
                                <div class="tooltip">
                                    <img class="h-6" src="{{ asset('assets/images/facebook-icon.png') }}"
                                        alt="Facebook Icon">
                                    <span class="tooltiptext">{{ $patient->fb_name }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="border py-2">
                            <div class="flex gap-2 justify-center items-center">
                                <a class=" border border-slate-600 rounded-md py-2 px-4 max-md:py-1 max-md:px-2 text-white font-semibold hover:bg-gray-400 max-d transition-all max-md:hidden"
                                    href=" {{ route('edit.patient', $patient->id) }} ">
                                    <img class="h-5 sm:h-4 sm:w-4 max-md:h-4 max-md:w-4"
                                        src="{{ asset('assets/images/edit-icon.png') }}" alt="">
                                </a>
                                <a href="{{ route('show.patient', $patient->id) }}"
                                    class="border border-slate-600 rounded-md py-2 px-4 max-md:py-1 max-md:px-2 text-white font-semibold hover:bg-gray-400 transition-all">
                                    <h1 class="hidden max-md:block text-xs font-semibold text-gray-800">View</h1>
                                    <img class="h-5 sm:h-4 sm:w-4 max-md:h-4 max-md:w-4 max-md:hidden"
                                        src="{{ asset('assets/images/user-icon.png') }}" alt="">
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="w-full">
            {{ $patients->links() }}
        </div>

    </section>

    <script>
        document.getElementById('sort').addEventListener('change', function() {
            this.form.submit();
            document.getElementById('package').toUpperCase();
        });
    </script>
@endsection
