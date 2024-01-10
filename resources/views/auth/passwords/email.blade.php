


@extends('frontend.layouts.app')

@section('content')
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="{{ url('/') }}">Home</a></li>
				<li class='active'>Reset Password</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="sign-in-page">
			<div class="row">
				<!-- Sign-in -->			
<div class="col-md-6 col-sm-6 sign-in ">
	<h4 class="">Forget Password</h4>

	<form class="register-form outer-top-xs" role="form" method="POST" action="{{ route('password.email') }}">
			@csrf
		<div class="form-group">
		    <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
		    <input type="email" class="form-control unicase-form-control text-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" id="email" placeholder="enter email address">
			@error('email')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror
		</div>
        

	  	<button type="submit" class="btn-upper btn btn-primary checkout-page-button">Send Password Reset Link</button>
          <a href="{{ route('login') }}" class="forgot-password pull-right">Return to login!</a>
	</form>					
</div>
<!-- Sign-in -->
@endsection

