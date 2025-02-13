@extends('layouts/main-layout')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">{{ $title }}</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="#">
                            <i class="icon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">{{ $title }}</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">{{ $title }}</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Dept</th>
                                            <th>IP Address</th>
                                            <th>OTP Code</th>
                                            <th>OTP Valid Start</th>
                                            <th>OTP Valid Until</th>
                                            <th>OTP Verified At</th>
                                            <th>Login Time</th>
                                            <th>Logout Time</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($logActs as $index => $logAct)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $logAct->name }}</td>
                                                <td>{{ $logAct->dept }}</td>
                                                <td>{{ $logAct->ip_address }}</td>
                                                <td>{{ $logAct->otp_code }}</td>

                                                @if ($logAct->otp_valid_start == null)
                                                    <td>-</td>
                                                @else
                                                    <td>{{ \Carbon\Carbon::parse($logAct->otp_valid_start)->format('d-m-y h:i') }}
                                                    </td>
                                                @endif

                                                @if ($logAct->otp_valid_until == null)
                                                    <td>-</td>
                                                @else
                                                    <td>{{ \Carbon\Carbon::parse($logAct->otp_valid_until)->format('d-m-y h:i') }}
                                                    </td>
                                                @endif

                                                @if ($logAct->otp_verified_at == null)
                                                    <td>-</td>
                                                @else
                                                    <td>{{ \Carbon\Carbon::parse($logAct->otp_verified_at)->format('d-m-y h:i') }}
                                                    </td>
                                                @endif

                                                @if ($logAct->login_at == null)
                                                    <td>-</td>
                                                @else
                                                    <td>{{ \Carbon\Carbon::parse($logAct->login_at)->format('d-m-y h:i') }}
                                                    </td>
                                                @endif

                                                @if ($logAct->logout_at == null)
                                                    <td>-</td>
                                                @else
                                                    <td>{{ \Carbon\Carbon::parse($logAct->logout_at)->format('d-m-y h:i') }}
                                                    </td>
                                                @endif

                                                <td><a href="{{ route('activity-log-detail', $logAct->id) }}"
                                                        class="btn btn-primary btn-sm" target="_blank"><i
                                                            class="fas fa-american-sign-language-interpreting"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
