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
                                {{-- <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                    data-bs-target="#addRowModal">
                                    <i class="fa fa-plus"></i>
                                </button> --}}
                                <a href="{{ route('user-account-create') }}" class="btn btn-primary btn-round ms-auto"><i
                                        class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIK</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Dept</th>
                                            <th>Jabatan</th>
                                            <th>Email</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($userAccounts as $index => $userAccount)
                                            <tr>
                                                <td class="text-center">{{ $index + 1 }}</td>
                                                <td>{{ $userAccount->nik }}</td>
                                                <td>{{ $userAccount->name }}</td>
                                                <td>{{ $userAccount->status }}</td>
                                                <td>{{ $userAccount->dept }}</td>
                                                <td>{{ $userAccount->jabatan }}</td>
                                                <td>{{ $userAccount->email }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('user-account-edit', $userAccount->id) }}"
                                                        class="btn btn-icon btn-sm btn-round btn-warning"><i
                                                            class="fa fa-exclamation-circle"></i></a>
                                                    <button type="button" class="btn btn-sm btn-icon btn-round btn-danger"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteRowModal-{{ $userAccount->id }}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    <a href="" class="btn btn-icon btn-sm btn-round btn-light"><i
                                                            class="fas fa-user-circle"></i></a>
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

    @foreach ($userAccounts as $userAccount)
        <div class="modal fade" id="deleteRowModal-{{ $userAccount->id }}" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title">
                            <span class="fw-mediumbold"> Delete</span>
                            <span class="fw-light"> Data </span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('user-account-delete', $userAccount->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <p class="small">
                                Apakah anda yakin ingin menghapus data?
                            </p>
                            <div class="row">
                                <div class="col-sm-12">
                                    <input id="addName" type="hidden" class="form-control" name="id"
                                        value="{{ $userAccount->id }}" />
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="submit" id="addRowButton" class="btn btn-primary">
                                Delete
                            </button>
                            <button type="button" id="addRowButton" class="btn btn-danger" data-dismiss="modal">
                                Close
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
