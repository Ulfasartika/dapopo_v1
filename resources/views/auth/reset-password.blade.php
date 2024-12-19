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
    <title>Reset Password</title>
</head>

        <x-validation-errors class="mb-4" />
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
                                            <h3>Reset Password</h3>
                                        </div>
                                        <div class="form-body">
                                            <form method="POST" action="{{ route('password.update') }}">
                                                @csrf
                                    
                                                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                    
                                                <div class="block">
                                                    <x-label for="email" value="{{ __('Email') }}" class="form-label" />
                                                    <x-input id="email" class="form-control" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                                                </div>
                                    
                                                <div class="mt-4">
                                                    <x-label for="password" value="{{ __('Password') }}" class="form-label" />
                                                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" class="form-control" required autocomplete="new-password" />
                                                </div>
                                    
                                                <div class="mt-4">
                                                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" class="form-label" />
                                                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" class="form-control" required autocomplete="new-password" />
                                                </div>
                                    
                                                <div class="flex items-center justify-end mt-4">
                                                    <x-button>
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
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <!--plugins-->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
        <script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
        <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
        <script src="assets/js/app.js"></script>

    </body>


    </html>
