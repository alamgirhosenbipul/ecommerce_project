@extends('frontend.layouts.app')

@section('content')
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="home.html">Home</a></li>
				<li class='active'>Login</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
    <div class="sign-in-page">
        <div class="row">
            <div class="col-md-4 ">
           @include('user.inc.sidebar')
            </div>
            <div class="col-md-8 mt-1">
              <div class="card">
                <h3 class="text-center"> <span class="text-danger">Hi..!</span><strong class="text-warning">{{ Auth::user()->name }}</strong> Update Your password</h3>
                    <div class="card-body">
                        <form action="{{ route('update.password') }}" method="POST">
                            @csrf
                              <div class="form-group">
                                <label for="oldPassword">Old password</label>
                                <input type="password" name="oldPassword" class="form-control" id="oldPassword" aria-describedby="emailHelp" placeholder="Old password">
                                @error('oldPassword')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">New Password</label>
                                <input type="password" name="newPassword" class="form-control" id="newPassword" aria-describedby="emailHelp" placeholder="New password">
                                @error('newPassword')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                              </div>

                              <div class="form-group">
                                <label for="exampleInputEmail1">Confirm password</label>
                                <input type="password" name="password_confirmation" class="form-control" id="confirmPass" aria-describedby="emailHelp" placeholder="Confirm password">
                                @error('password_confirmation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                              </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-danger">Update</button>
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