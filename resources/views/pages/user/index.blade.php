@extends('layouts.base')

@section('title-head')
    <title>All Users</title>
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <h5 class="card-header">Data All Users</h5>
            <div class="table-responsive text-nowrap p-3">
                <table class="table table-bordered table-hover table-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Profile</th>
                            <th>Mac Address</th>
                            <th>Limit Uptime</th>
                            <th>Uptime</th>
                            <th>comment</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($user as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item['name'] ?? '' }}</td>
                                <td>{{ $item['password'] ?? '' }}</td>
                                <td>{{ $item['profile'] ?? '' }}</td>
                                <td>{{ $item['mac-address'] ?? '' }}</td>
                                <td>{{ $item['limit-uptime'] ?? '' }}</td>
                                <td>{{ $item['uptime'] ?? '' }}</td>
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
