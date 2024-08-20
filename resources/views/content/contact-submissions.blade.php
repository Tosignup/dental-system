@extends('admin.dashboard')
@section('content')
    <div class="m-4">
        @include('components.search')
    </div>
    <section class="flex flex-col gap-2 m-6 rounded-md p-4  bg-white shadow-md">
        <h1 class="text-3xl font-bold mb-6">Contact Submissions</h1>
        <table class="">
            <thead>
                <tr class="border">
                    <th class="py-2 px-4 border">Name</th>
                    <th class="py-2 px-4 border">Email</th>
                    <th class="py-2 px-4 border">Message</th>
                    <th class="py-2 px-4 border">Submitted At</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($submissions as $submission)
                    <tr class="text-center">
                        <td class="py-2 px-4 border">{{ $submission->name }}</td>
                        <td class="py-2 px-4 border">{{ $submission->email }}</td>
                        <td class="py-2 px-4 border text-left max-w-2xl">{{ $submission->message }}</td>
                        <td class="py-2 px-4 border">{{ $submission->created_at }}</td>
                    </tr>
                @endforeach --}}
            </tbody>
        </table>
    </section>
@endsection
