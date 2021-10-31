@extends('frontend.layout')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-12">
			<div class="row login-wrap p-4 bg-transparent">
				<div class="col-md-12 text-center p-3">
					<img :src="logo" style="" class="img-fluid" alt="">
				</div>
				<div class="col-md-6 bg-dark justify-content-center text-center p-3">
					<h1 class="p-4" :class="showSuccessMessage ? 'mg-top-0' : 'mg-top-10'" style="color:#fff; font-size: 1.5rem;">
						WELCOME TO ILO ENCOMPASS SYSTEM.<br><span style="font-size:1.2rem">Competitiveness and Resilience Assessment Tool</span>
					</h1>
					<h2 style="font-size:1.2rem; color: #fff;">प्रतिस्पर्धात्मकता एवं लचकता मूल्यांकन प्रणाली</h2>
				</div>
				<div class="col-md-6 border bg-white">
					<div class="lwrap p-4">
						@if (Session::has('message'))
							<div class="p-2 mb-3 alert-success" role="alert">
								{{ Session::get('message') }}
							</div>
						@endif
						<div>
							<h2>{{ __('Reset Password') }}</h2>
							@error('email')
								<p class="p-2 mb-3 alert-danger" role="alert">
									<strong>{{ $message }}</strong>
								</p>
							@enderror
                            @error('password')
								<p class="p-2 mb-3 alert-danger" role="alert">
									<strong>{{ $message }}</strong>
								</p>
							@enderror

							<form method="POST" action="{{ route('reset.password.post') }}" >
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="mb-3">
									<label for="email" class="form-label mb-1">Email address</label>
									<div class="input-group mb-3">
										<div class="f-icon">
											<i class="fas fa-envelope"></i>
										</div>
										<input type="email" name="email" autofocus class="form-control form-control-lg ps-5 @error('email') is-invalid @enderror" id="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
									</div>
								</div>

                                <div class="mb-3">
									<label for="email" class="form-label mb-1">{{ __('Password') }}</label>
									<div class="input-group mb-3">
										<input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
									</div>
								</div>

                                <div class="mb-3">
									<label for="email" class="form-label mb-1">{{ __('Confirm Password') }}</label>
									<div class="input-group mb-3">
										<input id="password-confirm" type="password" class="form-control form-control-lg" name="password_confirmation" required autocomplete="new-password">
									</div>
								</div>
                                
								<div class="row">
									<div class="col-md-12">
										<button type="submit" class="btn btn-lg btn-default w-100 btn-submit"><i class="fas fa-key"></i> {{ __('Reset Password') }}</button>
									</div>
								</div>																	
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
