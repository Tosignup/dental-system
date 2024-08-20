@extends('admin.dashboard')
@section('content')
    <div class="m-4">
        @include('components.search')
    </div>
    <section class="flex flex-col gap-2 m-6 rounded-md p-4  bg-white shadow-md">
        <label class="flex items-center gap-2" for="time">
            <h1 class="font-bold text-3xl mr-4">Appointment Submissions</h1>
            <form method="GET" action="{{ route('appointment.submission') }}" class="flex gap-4 items-center justify-center m-4">
                <h1>Sort by: </h1>
                <select name="sort" class="border text-sm w-auto border-gray-400 px-4 mx-2 rounded-md" id="sort">
                    <option value="name" {{ request()->get('sort') == 'name' ? 'selected' : '' }}>Name</option>
                    <option value="appointment_date" {{ request()->get('sort') == 'appointment_date' ? 'selected' : '' }}>Appointment Date</option>
                    <option value="branch" {{ request()->get('sort') == 'branch' ? 'selected' : '' }}>Branch</option>
                    <option value="status" {{ request()->get('sort') == 'status' ? 'selected' : '' }}>Status</option>
                </select>
            </form>
        </label>
        <table class="w-full table-auto text-center">
            <thead>
                <tr class="">
                    <th class="py-2 px-4 border">Name</th>
                    <th class="py-2 px-4 border">Birth date</th>
                    <th class="py-2 px-4 border">Phone number</th>
                    <th class="py-2 px-4 border">Email</th>
                    <th class="py-2 px-4 border">Zip code</th>
                    <th class="py-2 px-4 border">Appointment Date</th>
                    <th class="py-2 px-4 border">Preferred time</th>
                    <th class="py-2 px-4 border">Notes</th>
                    <th class="py-2 px-4 border">Branch</th>
                    <th class="py-2 px-4 border">Status</th>
                    <th class="py-2 px-4 border">Actions</th>
                </tr>
            </thead>
            {{-- testing --}}

            {{-- testing --}}
            <tbody>
                @foreach ($appointments as $appointment)
                    <tr class="text-center">
                        <td class="py-2 px-4 border">{{ $appointment->last_name }} {{ $appointment->first_name }}</td>
                        <td class="py-2 px-4 border">{{ $appointment->date_of_birth}}</td>
                        <td class="py-2 px-4 border">{{ $appointment->phone_number }}</td>
                        <td class="py-2 px-4 border">{{ $appointment->email }}</td>
                        <td class="py-2 px-4 border">{{ $appointment->zip_code}}</td>
                        <td class="py-2 px-4 border">{{ $appointment->appointment_date }}</td>
                        <td class="py-2 px-4 border">{{ $appointment->preferred_time}}</td>
                        <td class="py-2 px-4 border">{{ $appointment->notes }}</td>
                        <td class="py-2 px-4 border">{{ $appointment->branch }}</td>
                        <td class="border px-4 py-2 min-w-max">
                            @if ($appointment->status === 'approved')
                                <h1 class="text-md text-green-600 font-semibold">Approved</h1>
                            @elseif ($appointment->status === 'declined')
                                <h1 class="text-md text-red-600 font-semibold">Declined</h1>
                            @else <h1 class="text-md">Pending</h1>
                            @endif
                        </td>
                        <td class="py-2 px-2 border flex gap-2 justify-center">
                        @if($appointment->status === 'approved' )
                            <form method="POST" action="{{ route('appointments.approve', $appointment->id) }}">
                                @csrf
                                <div class="tooltip">
                                    <button type="submit" class="btn btn-success btn-sm" disabled>
                                        <img src="{{asset('assets/images/accept.png')}}" alt="">
                                        <span class="tooltiptext">Approved</span>
                                    </button>
                                </div>
                            </form>
                        @elseif($appointment->status === 'declined')
                            <form method="POST" action="{{ route('appointments.decline', $appointment->id) }}">
                                @csrf
                                <div class="tooltip">
                                    <button type="submit" class="btn btn-danger btn-sm" disabled>
                                        <img src="{{asset('assets/images/decline.png')}}" alt="">
                                        <span class="tooltiptext">Declined</span>
                                    </button>
                                </div>
                            </form>
                        @else
                            <form method="POST" action="{{ route('appointments.approve', $appointment->id) }}">
                                @csrf
                                <div class="tooltip">
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <img src="{{asset('assets/images/accept.png')}}" alt="">
                                        <span class="tooltiptext">Approve</span>
                                    </button>
                                </div>
                            </form>
                            <form method="POST" action="{{ route('appointments.decline', $appointment->id) }}">
                                @csrf
                                <div class="tooltip">
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <img src="{{asset('assets/images/decline.png')}}" alt="">
                                        <span class="tooltiptext">Decline</span>
                                    </button>
                                </div>
                            </form>
                        </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
    <script>
        document.getElementById('sort').addEventListener('change', function() {
            this.form.submit();
            document.getElementById('branch').toUpperCase();

        });
    </script>
@endsection
