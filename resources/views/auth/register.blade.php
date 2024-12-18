<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="assets/css/pace.min.css" rel="stylesheet" />
    <script src="assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="assets/css/app.css" rel="stylesheet">
    <link href="assets/css/icons.css" rel="stylesheet">
    <title>Login</title>
</head>

<body class="bg-login">
    <!--wrapper-->
    <div class="wrapper">
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container-fluid">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="mb-4 text-center">
                            <img src="assets/images/logo-img.png" width="180" alt="" />
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="text-center">
                                        <h3 class="">Sign up</h3>
                                    </div>
                                    <div class="login-separater text-center mb-4">
                                    </div>
                                    <div class="form-body">
                                        <form method="POST" action="{{ route('register') }}" class="row g-3"> @csrf
                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">Nama</label>
                                                <input type="text" name="name" class="form-control"
                                                    id="inputEmailAddress" placeholder="Name">
                                                @error('name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">Username</label>
                                                <input type="text" name="username" class="form-control"
                                                    id="inputEmailAddress" placeholder="Username">
                                                @error('username')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <x-label for="email" class="form-label"
                                                    value="{{ __('Email') }}" />
                                                <x-input id="email" class="form-control" type="email"
                                                    name="email" :value="old('email')" autocomplete="username"
                                                    placeholder="Email" />
                                                @error('email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <label for="inputChoosePassword" class="form-label">Enter
                                                    Password</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" name="password"
                                                        class="form-control border-end-0" id="inputChoosePassword"
                                                        placeholder="Enter Password">
                                                    <a href="javascript:;" class="input-group-text bg-transparent">
                                                        <i class='bx bx-hide'></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputConfirmPassword" class="form-label">Confirm
                                                    Password</label>
                                                <div class="input-group" id="show_hide_confirm_password">
                                                    <input type="password" name="password_confirmation"
                                                        class="form-control border-end-0" id="inputConfirmPassword"
                                                        placeholder="Confirm Password">
                                                    <a href="javascript:;" class="input-group-text bg-transparent">
                                                        <i class='bx bx-hide'></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class="bx bxs-user"></i>Sign up</button>
                                                </div>
                                            </div>
                                            <div class="col-md-12 text-center"> <a
                                                href="{{ route('login') }}">Already have account</a>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <!--end wrapper-->
    <!-- Bootstrap JS -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <!--Password show & hide js -->
    <script>
        $(document).ready(function() {
            // Toggle password visibility for the password field
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                let passwordInput = $('#show_hide_password input');
                let icon = $('#show_hide_password i');
                if (passwordInput.attr("type") === "text") {
                    passwordInput.attr('type', 'password');
                    icon.addClass("bx-hide").removeClass("bx-show");
                } else {
                    passwordInput.attr('type', 'text');
                    icon.removeClass("bx-hide").addClass("bx-show");
                }
            });
    
            // Toggle password visibility for the confirm password field
            $("#show_hide_confirm_password a").on('click', function(event) {
                event.preventDefault();
                let confirmPasswordInput = $('#show_hide_confirm_password input');
                let icon = $('#show_hide_confirm_password i');
                if (confirmPasswordInput.attr("type") === "text") {
                    confirmPasswordInput.attr('type', 'password');
                    icon.addClass("bx-hide").removeClass("bx-show");
                } else {
                    confirmPasswordInput.attr('type', 'text');
                    icon.removeClass("bx-hide").addClass("bx-show");
                }
            });
        });
    </script>
    
    <!--app JS-->
    <script src="assets/js/app.js"></script>
</body>

</html>
