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
                                <table id="multi-filter-select" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIK</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Apps</th>
                                            <th>Role</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>NIK</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Apps</th>
                                            <th>Role</th>
                                            <th>Option</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($roles as $index => $role)
                                            <tr>
                                                <td class="text-center">{{ $index + 1 }}</td>
                                                <td>{{ $role->nik }}</td>
                                                <td>{{ $role->name }}</td>
                                                <td>{{ $role->email }}</td>
                                                <td>{{ $role->appname }}</td>
                                                <td>{{ $role->role }}</td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-icon btn-round btn-warning"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editRowModal-{{ $role->roleid }}">
                                                        <i class="fa fa-exclamation-circle"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-icon btn-round btn-danger"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteRowModal-{{ $role->roleid }}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    <a href="" class="btn btn-icon btn-round btn-light"><i
                                                            class="fa fa-link"></i></a>
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

                    <form action="{{ route('user-role-store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">User</label>
                                    <select class="form-select" id="exampleFormControlSelect1" name="user_id">
                                        <option selected disabled>Select User</option>
                                        @foreach ($listUsersAdd as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 pe-0">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Apps</label>
                                    <select class="form-select" id="exampleFormControlSelect1" name="app_id">
                                        <option selected disabled>Select Apps</option>
                                        @foreach ($listAppsAdd as $app)
                                            <option value="{{ $app->id }}">{{ $app->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 pe-0">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Role</label>
                                    <select class="form-select" id="exampleFormControlSelect1" name="role">
                                        <option selected disabled>Select Role</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Inputer">Inputer</option>
                                        <option value="User">User</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                </div>
                <div class="modal-footer border-0">
                    <button type="submit" id="addRowButton" class="btn btn-primary">
                        Add
                    </button>
                    </form>

                    <button type="button" id="addRowButton" class="btn btn-danger" data-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    @foreach ($roles as $role)
        <div class="modal fade" id="editRowModal-{{ $role->roleid }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title">
                            <span class="fw-mediumbold"> Update</span>
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
                        <form action="{{ route('user-role-update', $role->roleid) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">User</label>
                                        <select class="form-select" id="exampleFormControlSelect1" name="user_id">
                                            @foreach ($lisUsersUpdate as $user)
                                                <option value="{{ $user->id }}"
                                                    {{ $user->id == $role->user_id ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 pe-0">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Apps</label>
                                        <select class="form-select" id="exampleFormControlSelect1" name="app_id">
                                            @foreach ($listAppsUpdate as $apps)
                                                <option value="{{ $apps->id }}"
                                                    {{ $apps->id == $role->app_id ? 'selected' : '' }}>
                                                    {{ $apps->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 pe-0">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Role</label>
                                        <select class="form-select" id="exampleFormControlSelect1" name="role">
                                            <option value="Admin" {{ $role->role == 'Admin' ? 'selected' : '' }}>Admin
                                            </option>
                                            <option value="Inputer" {{ $role->role == 'Inputer' ? 'selected' : '' }}>
                                                Inputer
                                            </option>
                                            <option value="User" {{ $role->role == 'User' ? 'selected' : '' }}>User
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" id="addRowButton" class="btn btn-primary">
                            Edit
                        </button>
                        </form>

                        <button type="button" id="addRowButton" class="btn btn-danger" data-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteRowModal-{{ $role->roleid }}" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title">
                            <span class="fw-mediumbold"> New</span>
                            <span class="fw-light"> Row </span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{ route('user-role-delete', $role->roleid) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <p class="small">
                                Apakah anda yakin ingin menghapus data?
                            </p>
                            <div class="row">
                                <div class="col-sm-12">
                                    <input id="addName" type="hidden" class="form-control" name="id"
                                        value="{{ $role->roleid }}" />
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
