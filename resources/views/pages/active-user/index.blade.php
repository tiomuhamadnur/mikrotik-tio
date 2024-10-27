@extends('layouts.base')

@section('title-head')
    <title>Active Users</title>
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <h5 class="card-header">Data Active Users</h5>
            <div class="table-responsive text-nowrap p-3">
                <table class="table table-bordered table-hover table-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Mac Address</th>
                            <th>Address</th>
                            <th>Uptime</th>
                            <th>Time Left</th>
                            <th>comment</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($user as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item['user'] ?? '' }}</td>
                                <td>{{ $item['mac-address'] ?? '' }}</td>
                                <td>{{ $item['address'] ?? '' }}</td>
                                <td>{{ $item['uptime'] ?? '' }}</td>
                                <td>{{ $item['session-time-left'] ?? '' }}</td>
                                <td>{{ $item['comment'] ?? '' }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                    class="bx bx-edit-alt me-1"></i> Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                    class="bx bx-trash me-1"></i>
                                                Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
