@extends('admin.dashboard')
@section('content')
    <div class="m-4 ">
        @include('components.search')
    </div>
    <section class="bg-white shadow-lg rounded-md py-2 px-4 mx-2 max-h-screen  max-lg:mt-14">
        <h1 class="font-bold text-2xl p-4 max-md:text-3xl">Audit Logs</h1>
        <table class="table text-wrap">
            <thead class="">
                <tr>
                    {{-- <th class="">User ID</th> --}}
                    <th class="">User Email</th>
                    <th class="">Action</th>
                    {{-- <th class="">Model Type</th>
                        <th class="">Model ID</th> --}}
                    {{-- <th class="">Changes</th> --}}
                    <th class="">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($auditLogs as $auditLog)
                    <tr>
                        <td class="px-2 font-semibold">{{ $auditLog->user_email }}</td>
                        <td class="px-2 font-semibold">{{ $auditLog->action }} <span>
                                <ul class="flex flex-wrap font-normal text-xs">
                                    @if (isset($auditLog->changes['message']))
                                        <li>{{ $auditLog->changes['message'] }}</li>
                                    @else
                                        @foreach ($auditLog->changes as $key => $value)
                                            <li><strong>{{ ucfirst($key) }}:</strong> {{ $value }}</li>
                                        @endforeach
                                    @endif
                                </ul>
                            </span></td>
                        <td class="px-2 font-semibold">{{ $auditLog->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection
