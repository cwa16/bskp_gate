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
                                            <th>Accessing Start</th>
                                            <th>Accessing Until</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($logActsDetails as $index => $logActsDetail)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $logActsDetail->name ?? '-' }}</td>
                                                @if ($logActsDetail->accessing_at == null)
                                                    <td>-</td>
                                                @else
                                                    <td>{{ \Carbon\Carbon::parse($logActsDetail->accessing_at)->format('d-m-y h:i') }}
                                                    </td>
                                                @endif

                                                @if ($logActsDetail->accessing_until == null)
                                                    <td>-</td>
                                                @else
                                                    <td>{{ \Carbon\Carbon::parse($logActsDetail->accessing_until)->format('d-m-y h:i') }}
                                                    </td>
                                                @endif
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
