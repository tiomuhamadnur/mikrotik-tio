@extends('layouts.base')

@section('title-head')
    <title>Dashboard</title>
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-3 col-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <button type="button" class="btn btn-icon btn-primary">
                                            <span class="tf-icons bx bx-group"></span>
                                        </button>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                            <a class="dropdown-item" href="{{ route('user.index') }}">View More</a>
                                        </div>
                                    </div>
                                </div>
                                <span>All Users</span>
                                <h3 class="card-title text-nowrap mb-1">{{ $all_user ?? 0 }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <button type="button" class="btn btn-icon btn-warning">
                                            <span class="tf-icons bx bx-user-check"></span>
                                        </button>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                            <a class="dropdown-item" href="{{ route('user.active') }}">View More</a>
                                        </div>
                                    </div>
                                </div>
                                <span>Active User</span>
                                <h3 class="card-title text-nowrap mb-1">{{ $active_user ?? 0 }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <button type="button" class="btn btn-icon btn-success">
                                            <span class="tf-icons bx bx-id-card"></span>
                                        </button>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                            <a class="dropdown-item" href="{{ route('user.voucher') }}">View More</a>
                                        </div>
                                    </div>
                                </div>
                                <span>Voucher</span>
                                <h3 class="card-title text-nowrap mb-1">{{ $voucher ?? 0 }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <button type="button" class="btn btn-icon btn-danger">
                                            <span class="tf-icons bx bx-time"></span>
                                        </button>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                            <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                        </div>
                                    </div>
                                </div>
                                <span>Up Time</span>
                                <h3 class="card-title text-nowrap mb-1">{{ $uptime ?? 'N/A' }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
