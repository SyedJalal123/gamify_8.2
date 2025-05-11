<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/bootstrap-reboot.min.css')}}">
	<link rel="stylesheet" href="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/bootstrap-grid.min.css')}}">
	<link rel="stylesheet" href="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/owl.carousel.min.css')}}">
	<link rel="stylesheet" href="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/magnific-popup.css')}}">
	<link rel="stylesheet" href="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/nouislider.min.css')}}">
	<link rel="stylesheet" href="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/jquery.mCustomScrollbar.min.css')}}">
	<link rel="stylesheet" href="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/paymentfont.min.css')}}">
	<link rel="stylesheet" href="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/main.css')}}">
	<link rel="stylesheet" href="{{asset('css/custom.css')}}">

	<!-- Favicons -->
	<link rel="icon" type="image/png" href="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/favicon-32x32.png')}}" sizes="32x32">
	<link rel="apple-touch-icon" href="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/favicon-32x32.png')}}">

	<meta name="description" content="Digital marketplace HTML Template by Dmitry Volkov">
	<meta name="keywords" content="">
	<meta name="author" content="Dmitry Volkov">
	<title>Gamify</title>

</head>
<body>
	<!-- sign in -->
	<div class="sign section--full-bg" data-bg="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/bg2.jpg')}}" style="background: url(&quot;GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/bg2.jpg&quot;) center center / cover no-repeat;">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="sign__content color-white d-flex flex-column text-center">

                        <div class="mb-4 text-sm d-flex flex-column align-items-center">
                            <h2 class="fw-bold">{{ __('Thanks for signing up!')  }}</h2>
                            <span>{{ __('Before getting started, please verify your email address by clicking the confirmation link sent to your inbox.') }}</span>
                        </div>
                    
                        @if (session('status') == 'verification-link-sent')
                            <div class="mb-4 fs-15 fw-bold" style="color: #44ff44;">
                                {{ __('A new verification link has been sent to the email address.') }}
                            </div>
                        @endif
                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf
                    
                                <button class="sign__btn px-3">
                                    {{ __('Resend Verification Email') }}
                                </button>
                            </form>
                    
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                    
                                <button type="submit" class="btn-danger px-3 py-2 rounded">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end sign in -->

	<!-- JS -->
	<script src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/jquery-3.5.1.min.js')}}"></script>
	<script src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/bootstrap.bundle.min.js')}}"></script>
	<script src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/owl.carousel.min.js')}}"></script>
	<script src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/jquery.magnific-popup.min.js')}}"></script>
	<script src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/wNumb.js')}}"></script>
	<script src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/nouislider.min.js')}}"></script>
	<script src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/jquery.mousewheel.min.js')}}"></script>
	<script src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/jquery.mCustomScrollbar.min.js')}}"></script>
	<script src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/main.js')}}"></script>
</body>
</html>








{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout> --}}
