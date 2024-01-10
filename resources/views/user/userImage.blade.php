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
                <h3 class="text-center"> <span class="text-danger">Hi..</span><strong class="text-warning">{{ Auth::user()->name }} !</strong> Update Your Image</h3>
                    <div class="card-body">
                        <form action="{{ route('user.ImageUpdate') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="old_image" value="{{ Auth::user()->image }}">
                              <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" name="image" class="form-control" id="image" aria-describedby="emailHelp" >
                                @error('image')
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