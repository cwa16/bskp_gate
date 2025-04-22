@extends('layouts/main-layout')

@section('content')
    <style>
        .fixed-height {
            min-height: 40px;
            /* Tinggi minimum yang konsisten */
            line-height: 1.2;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
    </style>
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Selamat Datang di BSKP GATE</h3>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    {{-- @if ($token)
                        <h6 class="op-7 mb-2">Token: {{ $token }}</h6>
                    @else
                        <h6 class="op-7 mb-2">No token found in session.</h6>
                    @endif --}}
                    <h6 class="op-7 mb-2">Dashboard</h6>
                </div>
            </div>
            <div class="row">

                {{-- @foreach ($links as $link)
                    <div class="col-sm-6 col-md-2">
                        <a href="" target="_blank">
                            <div class="card card-stats card-info card-round">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <i class="fas fa-users"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Visitors</p>
                                                <h4 class="card-title" style="font-size: 15px">{{ $link->name }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach --}}

                @foreach ($links as $link)
                    <div class="col-6 col-sm-4 col-lg-2">

                        <a href="{{ route('access.app', $link->id) }}" target="_blank">
                            <div class="card card-primary bg-primary-gradient">
                                <div class="card-body p-2 text-center bubble-shadow">
                                    <div class="text-end text-success">
                                        <i class="fas fa-share-square"></i>
                                    </div>
                                    <div class="h1 m-0"><i class="fas fa-box-open"></i></div>
                                    <h6 class="text-light fixed-height mb-3">{{ $link->name }}</h6>
                                </div>
                            </div>
                        </a>

                        {{-- <a href="{{ $link->url }}?token={{ session('jwt_token') }}" target="_blank">
                            <div class="card card-primary bg-primary-gradient">
                                <div class="card-body p-2 text-center bubble-shadow">
                                    <div class="text-end text-success">
                                        <i class="fas fa-share-square"></i>
                                    </div>
                                    <div class="h1 m-0"><i class="fas fa-box-open"></i></div>
                                    <h6 class="text-light fixed-height mb-3">{{ $link->name }}</h6>
                                </div>
                            </div>
                        </a> --}}

                    </div>
                @endforeach

            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Update Informasi</div>
                                <div class="card-tools">
                                    <ul class="nav nav-pills nav-secondary nav-pills-no-bd nav-sm" id="pills-tab"
                                        role="tablist">
                                        <li class="nav-item">
                                            <a href="" class="nav-link">Detail</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            @foreach ($recentActivies as $recentActivity)
                                <div class="d-flex">
                                    <div class="avatar avatar-online">
                                        <span class="avatar-title rounded-circle border border-white bg-danger">UI</span>
                                    </div>
                                    <div class="flex-1 ms-3 pt-1">
                                        <h6 class="text-uppercase fw-bold mb-1">
                                            {{ $recentActivity->name }}
                                            <span class="text-success ps-1" style="font-size: 12px"><br>
                                                {{ $recentActivity->appsName }}</span>
                                        </h6>
                                        <span class="text-muted">" {{ $recentActivity->information }} "</span>
                                    </div>
                                    <div class="float-end pt-1">
                                        <small
                                            class="text-muted">{{ \Carbon\Carbon::parse($recentActivity->created_at)->format('h:i M y') }}</small>
                                    </div>
                                </div>
                                <div class="separator-dashed"></div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
