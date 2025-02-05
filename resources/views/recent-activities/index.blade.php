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
                                            <th>Date</th>
                                            <th>NIK</th>
                                            <th>Name</th>
                                            <th>Apps</th>
                                            <th>IP Address</th>
                                            <th>Login Time</th>
                                            <th>Logout Time</th>
                                            <th>Information</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recentActivies as $index => $recentActivity)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ \Carbon\Carbon::parse($recentActivity->created_at)->format('d-m-y') }}
                                                </td>
                                                <td>{{ $recentActivity->nik }}</td>
                                                <td>{{ $recentActivity->name }}</td>
                                                <td>{{ $recentActivity->appsName }}</td>
                                                <td>{{ $recentActivity->ip_address }}</td>
                                                <td>{{ \Carbon\Carbon::parse($recentActivity->login_at)->format('d-m-y') }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($recentActivity->logout_at)->format('d-m-y') }}
                                                </td>
                                                <td>{{ $recentActivity->information }}</td>
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
