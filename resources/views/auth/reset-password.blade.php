<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{ asset('assets/images/favicon-32x32.png') }}" type="image/png" />
	<!-- loader-->
	<link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />
	<script src="{{ asset('assets/js/pace.min.js') }}"></script>
	<!-- Bootstrap CSS -->
	<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
	<title>Data Potensi Power - NOP Dumai</title>
</head>

<body>
	<!-- wrapper -->
	<div class="wrapper">
		<div class="authentication-reset-password d-flex align-items-center justify-content-center">
			<div class="row">
				<div class="col-12 col-lg-10 mx-auto">
					<div class="card">
						<div class="row g-0">
							<div class="col-lg-5 border-end">
								<div class="card-body">
									<div class="p-5">
										<div class="text-start">
											<img src="{{ asset('assets/images/logo-img.png') }}" width="180" alt="">
										</div>
										<h4 class="mt-5 font-weight-bold">Generate New Password</h4>
										<p class="text-muted">We received your reset password request. Please enter your new password!</p>
                                        <form method="POST" action="{{ route('password.update') }}">
                                            @csrf    
                                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
										<div class="mb-3 mt-5">
                                            <x-label for="email" value="{{ __('Email') }}" class="form-label" />
                                            <x-input id="email" class="form-control" type="email" name="email"
                                                :value="old('email', $request->email)" required autofocus autocomplete="username"/>
                                        </div>
										<div class="mb-3 mt-5">    
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
										<div class="mb-3">
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
										<div class="d-grid gap-2">
                                            <x-button class="btn btn-primary">
                                                {{ __('Reset Password') }}
                                            </x-button>
                                        <a href="{{ route('login') }}" class="btn btn-light"><i class='bx bx-arrow-back mr-1'></i>Back to Login</a>
										</div>
                                    </form>
									</div>
								</div>
							</div>
							<div class="col-lg-7">
								<img src="{{ asset('assets/images/login-images/forgot-password-frent-img.jpg') }}" class="card-img login-img h-100" alt="...">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end wrapper -->
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