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
                                <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                    data-bs-target="#addRowModal">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Application</th>
                                            <th>URL</th>
                                            <th>Slug</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($apps as $index => $app)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $app->name }}</td>
                                                <td>{{ $app->url }}</td>
                                                <td>{{ $app->slug }}</td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-icon btn-round btn-warning"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editRowModal-{{ $app->id }}">
                                                        <i class="fa fa-exclamation-circle"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-icon btn-round btn-danger"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteRowModal-{{ $app->id }}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    <a href="{{ $app->url }}" class="btn btn-icon btn-round btn-light"
                                                        target="_blank"><i class="fa fa-link"></i></a>
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

    <!-- Modal -->
    <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold"> Input</span>
                        <span class="fw-light"> Data </span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="small">
                        Create a new data
                    </p>

                    <form action="{{ route('app-link-store') }}" method="POST">
                        @csrf
                        <div class="row">

                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>Apps Name</label>
                                    <input id="addName" type="text" class="form-control" placeholder="input apps name"
                                        name="name" />
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>URL</label>
                                    <input id="addPosition" type="text" class="form-control" name="url"
                                        placeholder="input url" />
                                </div>
                            </div>

                        </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="submit" class="btn btn-primary">
                        Add
                    </button>
                    <button type="button" id="addRowButton" class="btn btn-danger" data-dismiss="modal">
                        Close
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($apps as $app)
        <div class="modal fade" id="editRowModal-{{ $app->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header border-0">
                        <h5 class="modal-title">
                            <span class="fw-mediumbold"> Input</span>
                            <span class="fw-light"> Data </span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('app-link-update', $app->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <p class="small">
                                Create a new data
                            </p>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group form-group-default">
                                        <label>Name</label>
                                        <input id="addName" type="text" class="form-control" name="name"
                                            value="{{ $app->name }}" placeholder="fill apps name" />
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group form-group-default">
                                        <label>URL</label>
                                        <input id="addPosition" type="text" class="form-control" name="url"
                                            value="{{ $app->url }}" placeholder="fill url" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="submit" id="addRowButton" class="btn btn-primary">
                                Update
                            </button>
                            <button type="button" id="addRowButton" class="btn btn-danger" data-dismiss="modal">
                                Close
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteRowModal-{{ $app->id }}" tabindex="-1" role="dialog"
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
                    <form action="{{ route('app-link-delete', $app->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <p class="small">
                                Apakah anda yakin ingin menghapus data?
                            </p>
                            <div class="row">
                                <div class="col-sm-12">
                                    <input id="addName" type="hidden" class="form-control" name="id"
                                        value="{{ $app->id }}" />
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
