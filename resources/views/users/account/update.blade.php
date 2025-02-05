@extends('layouts.main-layout')
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
                            <div class="card-title text-left">{{ $title }}</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user-account-store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-lg-12">
                                        <div class="form-group">
                                            <label for="nik2">NIK</label>
                                            <input type="text" class="form-control" id="nik2" name="nik"
                                                placeholder="Enter NIK" />
                                        </div>

                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Enter Name" />
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Status</label>
                                            <select class="form-select" id="exampleFormControlSelect1" name="status">
                                                <option selected disabled>Select Status</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Dept</label>
                                            <select class="form-select" id="exampleFormControlSelect1" name="dept">
                                                <option selected disabled>Select Dept</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Jabatan</label>
                                            <select class="form-select" id="exampleFormControlSelect1" name="jabatan">
                                                <option selected disabled>Select Jabatan</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-12">
                                        <div class="form-group">
                                            <label for="email">Email Address</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Enter Email" />
                                        </div>

                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password" name="password"
                                                placeholder="Password" />
                                        </div>

                                        <div id="password-hint" style="display: none; color: red; font-size: 12px">
                                            Password harus memiliki:
                                            <ul>
                                                <li>Minimal 16 karakter</li>
                                                <li>
                                                    Gunakan penggabungan huruf kapital, angka, dan
                                                    karakter spesial (!@#$%^&*)
                                                </li>
                                            </ul>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="card-action">
                            <button class="btn btn-success">Submit</button>
                            </form>
                            <a href="{{ route('user-account-index') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        function showPasswordHint() {
            document.getElementById("password-hint").style.display = "block";
        }

        function hidePasswordHint() {
            document.getElementById("password-hint").style.display = "none";
        }

        function validateRegisterForm() {
            const password = document.getElementById("register-password").value;
            const rePassword = document.getElementById("register-re-password").value;
            const email = document.getElementById("register-email").value;

            if (email.trim() === "") {
                alert("Email harus diisi!");
                return false;
            }

            // Regex untuk validasi password
            const passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&]).{16,}$/;

            if (!passwordRegex.test(password)) {
                alert(
                    "Password harus minimal 16 karakter dan mengandung minimal satu huruf kapital, satu angka, dan satu karakter spesial (!@#$%^&*)."
                );
                return false;
            }

            if (password !== rePassword) {
                alert("Password dan Re-enter Password tidak sama");
                return false;
            }

            return true;
        }
    </script>
@endsection
