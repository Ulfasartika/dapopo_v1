<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('assets/images/favicon-32x32.png') }}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/js/pace.min.js') }}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    <title>Reset Password</title>
</head>

<x-validation-errors class="mb-4" />
<div class="wrapper bg-login">
    <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
        <div class="container-fluid">
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                <div class="col mx-auto">
                    <div class="mb-4 text-center">
                        <img src="{{ asset('assets/images/logo-img.png') }}" width="180" alt="" />
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="text-center">
                                    <h3>Reset Password</h3>
                                </div>
                                <div class="form-body">
                                    <form method="POST" action="{{ route('password.update') }}">
                                        @csrf

                                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                        <div class="block">
                                            <x-label for="email" value="{{ __('Email') }}" class="form-label" />
                                            <x-input id="email" class="form-control" type="email" name="email"
                                                :value="old('email', $request->email)" required autofocus autocomplete="username" />
                                        </div>

                                        <div class="mt-4">
                                            <x-label for="inputChoosePassword" value="{{ __('Password') }}"
                                                class="form-label" />
                                            <div class="input-group" id="show_hide_password">
                                                <x-input id="inputChoosePassword" class="block mt-1 w-full"
                                                    type="password" name="password" class="form-control border-end-0"
                                                    autocomplete="new-password" />
                                                <a href="javascript:;" class="input-group-text bg-transparent">
                                                    <i class='bx bx-hide'></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="mt-4">
                                            <x-label for="inputConfirmPassword" value="{{ __('Confirm Password') }}"
                                                class="form-label" />
                                            <div class="input-group" id="show_hide_confirm_password">
                                                <x-input id="show_hide_confirm_password"
                                                    class="form-control border-end-0" type="password"
                                                    name="password_confirmation" class="form-control border-end-0" required
                                                    autocomplete="new-password" />
                                                <a href="javascript:;" class="input-group-text bg-transparent">
                                                    <i class='bx bx-hide'></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="flex items-center justify-end mt-4">

                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <x-button class="btn btn-primary">
                                                    {{ __('Reset Password') }}
                                                </x-button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<!--plugins-->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>
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

</body>


</html>
