@extends('admin.layouts.app')
@section('adminContent')
     <!-- ########## START: MAIN PANEL ########## -->
     <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">SHopMaMa</a>
          <span class="breadcrumb-item active">Profile</span>
        </nav>
  
        <div class="sl-pagebody">
          <div class="row row-sm">
                <div class="col-md-4 ">
                    @include('admin.profile.inc.sidebar')
                </div>
                <div class="col-md-8 mt-1">
                  <div class="card" >
                    <br>
                    <h3 class="text-center"> <span class="text-danger">Hi..!</span> <strong class="text-warning">{{ Auth::user()->name }}</strong> Update Your password</h3>
                        <div class="card-body">
                            <form action="{{ route('password.update') }}" method="POST">
                                @csrf
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Old Password</label>
                                    <input type="text" name="oldPassword" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="enter old password">
                                    @error('oldPassword')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">New Password</label>
                                    <input type="text" name="newPassword" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="enter new password">
                                    @error('newPassword')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                  </div>
    
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Confirm password</label>
                                    <input type="text" name="password_confirmation" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="enter confirm password">
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
          </div><!-- row -->
        </div><!-- sl-pagebody -->
      </div><!-- sl-mainpanel -->
      <!-- ########## END: MAIN PANEL ########## -->
@endsection
