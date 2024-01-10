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
                    <h3 class="text-center"> <span class="text-danger">Hi..!</span> <strong class="text-warning">{{ Auth::user()->name }}</strong> Update Your Image</h3>
                        <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="oldImage" value="{{ Auth::user()->image }}">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Image</label>
                                    <input type="file" name="image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
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
          </div><!-- row -->
        </div><!-- sl-pagebody -->
      </div><!-- sl-mainpanel -->
      <!-- ########## END: MAIN PANEL ########## -->
@endsection
