@extends('layouts.base')

@section('title-head')
    <title>Vouchers</title>
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <h5 class="card-header">Data Vouchers</h5>
            <div class="group-btn ms-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#printModal">
                    <span class="tf-icons bx bx-printer"></span>&nbsp; Print
                </button>
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#filterModal">
                    <span class="tf-icons bx bx-filter"></span>&nbsp; Filter
                </button>
            </div>
            <div class="table-responsive text-nowrap p-3">
                <table class="table table-bordered table-hover table-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th></th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Profile</th>
                            <th>Comment</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($user as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-center">
                                    @php
                                        $username = $item['name'] ?? '';
                                        $password = $item['password'] ?? '';
                                        $profile = $item['profile'] ?? '';
                                        $url =
                                            'https://wa.me/?text=Username%20%3A%20*' .
                                            urlencode($username) .
                                            '*%0APassword%20%3A%20*' .
                                            urlencode($password) .
                                            '*%0AProfile%20%3A%20*' .
                                            urlencode($profile) .
                                            '*';
                                    @endphp

                                    <button type="button" onclick="window.open('{{ $url }}', '_blank')"
                                        class="btn btn-icon btn-success">
                                        <span class="tf-icons bx bx-share-alt"></span>
                                    </button>

                                </td>
                                <td>{{ $item['name'] ?? '' }}</td>
                                <td>{{ $item['password'] ?? '' }}</td>
                                <td>{{ $item['profile'] ?? '' }}</td>
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
                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal" data-id="{{ $item['.id'] }}"
                                                data-url="{{ route('user.delete') }}"><i class="bx bx-trash me-1"></i>
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

    <!-- Modal Print -->
    <div class="modal fade" id="printModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Print Voucher</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="printForm" action="{{ route('voucher.pdf') }}" method="POST">
                        @method('POST')
                        @csrf
                        <div class="row">
                            <div class="col mb-3">
                                <label for="comment" class="form-label">Comment</label>
                                <select class="form-select" name="comment" id="comment" required>
                                    <option value="" selected disabled>- pilih comment -</option>
                                    @foreach ($comment as $item)
                                        <option value="{{ $item['comment'] ?? '' }}">{{ $item['comment'] ?? '' }}
                                            {{ $item['profile'] ?? 'N/A' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" form="printForm" class="btn btn-primary">Print</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Filter -->
    <div class="modal fade" id="filterModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Filter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="filterForm" action="{{ route('user.voucher') }}" method="GET">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="profile" class="form-label">Profile</label>
                                <select class="form-select" name="profile" id="profile" required>
                                    <option value="" selected disabled>- pilih profile -</option>
                                    @foreach ($comment as $item)
                                        <option value="{{ $item['profile'] ?? '' }}">{{ $item['profile'] ?? '' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <a class="btn btn-warning" href="{{ route('user.voucher') }}">Reset</a>
                    <button type="submit" form="filterForm" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $('#deleteModal').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            var url = $(e.relatedTarget).data('url');

            document.getElementById("id_modal").value = id;
            document.getElementById("deleteForm").action = url;
        });
    </script>
@endsection
