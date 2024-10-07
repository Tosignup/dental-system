@extends('admin.dashboard')
@section('content')
    <div class="container">
        <h1>Audit Logs</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>Model Type</th>
                    <th>Model ID</th>
                    <th>User ID</th>
                    <th>Changes</th>
                    <th>Timestamp</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($auditLogs as $log)
                    <tr>
                        <td>{{ $log->action }}</td>
                        <td>{{ $log->model_type }}</td>
                        <td>{{ $log->model_id }}</td>
                        <td>{{ $log->user_id }}</td>
                        <td>{{ $log->changes }}</td>
                        <td>{{ $log->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
