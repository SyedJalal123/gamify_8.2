
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- CSS -->
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
					<div class="sign__content">
						<!-- authorization form -->
						<form method="POST" action="{{ route('login') }}" class="sign__form">
                            @csrf
							<a href="{{url('/')}}" class="sign__logo">
								<h2 style="color: white;font-weight: 900;font-size: 38px;margin-bottom: 0px;padding-bottom: 0px;font-family: cursive;">Gamify</h2>
								{{-- <img src="{{asset('GoGame – Digital marketplace HTML Template Preview - ThemeForest_files/logo.svg')}}" alt=""> --}}
							</a>

							<div class="sign__group">
								<input type="text" class="sign__input" placeholder="Email" name="email" required autofocus autocomplete="username">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" style="color:red;" />
							</div>

							<div class="sign__group">
								<input type="password" id="password" name="password" class="sign__input" placeholder="Password" required autocomplete="current-password">
                                <x-input-error :messages="$errors->get('password')" class="mt-2" style="color:red;" />
							</div>

							<div class="sign__group sign__group--checkbox">
								<input id="remember" name="remember" type="checkbox" checked="checked">
								<label for="remember">Remember Me</label>
							</div>

							<button class="sign__btn" type="submit">Sign in</button>

							<span class="sign__delimiter">or</span>

							<div class="sign__social d-flex flex-column">
								<a class="fb mb-3 w-100 d-flex justify-content-around" href="{{ url('auth/facebook') }}">
									<svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'><path d='M455.27,32H56.73A24.74,24.74,0,0,0,32,56.73V455.27A24.74,24.74,0,0,0,56.73,480H256V304H202.45V240H256V189c0-57.86,40.13-89.36,91.82-89.36,24.73,0,51.33,1.86,57.51,2.68v60.43H364.15c-28.12,0-33.48,13.3-33.48,32.9V240h67l-8.75,64H330.67V480h124.6A24.74,24.74,0,0,0,480,455.27V56.73A24.74,24.74,0,0,0,455.27,32Z'/></svg>
									<span>Continue with Facebook</span>
									<span></span>
								</a>
								<a class="gl mb-3 w-100 d-flex justify-content-around" href="{{ url('auth/google') }}">
									<svg xmlns='http://www.w3.org/2000/svg' class='ionicon' viewBox='0 0 512 512'><path d='M473.16 221.48l-2.26-9.59H262.46v88.22H387c-12.93 61.4-72.93 93.72-121.94 93.72-35.66 0-73.25-15-98.13-39.11a140.08 140.08 0 01-41.8-98.88c0-37.16 16.7-74.33 41-98.78s61-38.13 97.49-38.13c41.79 0 71.74 22.19 82.94 32.31l62.69-62.36C390.86 72.72 340.34 32 261.6 32c-60.75 0-119 23.27-161.58 65.71C58 139.5 36.25 199.93 36.25 256s20.58 113.48 61.3 155.6c43.51 44.92 105.13 68.4 168.58 68.4 57.73 0 112.45-22.62 151.45-63.66 38.34-40.4 58.17-96.3 58.17-154.9 0-24.67-2.48-39.32-2.59-39.96z'/></svg>
									<span>Continue with Google</span>
									<span></span>
								</a>
								{{-- <a class="tw" href="#"><svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'><path d='M496,109.5a201.8,201.8,0,0,1-56.55,15.3,97.51,97.51,0,0,0,43.33-53.6,197.74,197.74,0,0,1-62.56,23.5A99.14,99.14,0,0,0,348.31,64c-54.42,0-98.46,43.4-98.46,96.9a93.21,93.21,0,0,0,2.54,22.1,280.7,280.7,0,0,1-203-101.3A95.69,95.69,0,0,0,36,130.4C36,164,53.53,193.7,80,211.1A97.5,97.5,0,0,1,35.22,199v1.2c0,47,34,86.1,79,95a100.76,100.76,0,0,1-25.94,3.4,94.38,94.38,0,0,1-18.51-1.8c12.51,38.5,48.92,66.5,92.05,67.3A199.59,199.59,0,0,1,39.5,405.6,203,203,0,0,1,16,404.2,278.68,278.68,0,0,0,166.74,448c181.36,0,280.44-147.7,280.44-275.8,0-4.2-.11-8.4-.31-12.5A198.48,198.48,0,0,0,496,109.5Z'/></svg></a> --}}
							</div>

							<span class="sign__text">Don't have an account? <a href="{{url('register')}}">Sign up!</a></span>

                            @if (Route::has('password.request'))
                                <span class="sign__text"><a href="{{ route('password.request') }}">Forgot password?</a></span>
                                {{-- <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a> --}}
                            @endif
							
						</form>
						<!-- end authorization form -->
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










{{-- 
<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
