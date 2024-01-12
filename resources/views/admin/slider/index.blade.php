@extends('admin.layouts.app')
@section('slider')
  active
@endsection

@section('adminContent')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="index.html">Arzena Fashion</a>
      <span class="breadcrumb-item active">Dashboard</span>
    </nav>

    <div class="sl-pagebody">
      <div class="row row-sm">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">Slider</div>
            <div class="card-body">
            <div class="table-wrapper">
              <table id="datatable1" class="table display responsive nowrap">
                <thead>
                  <tr>
                    <th class="wd-30p">Slider Image</th>
                    <th class="wd-25p">Title name En</th>
                    <th class="wd-25p">Description En</th>
                    <th class="wd-25p">status</th>
                    <th class="wd-20p">Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($slider as $item)
                  <tr>
                    <td>
                      <img src="{{ asset($item->image) }}" alt="" style="width: 80px;">
                    </td>
                    <td>
                      @if($item->title_en == NULL)

                      <span class="badge badge-pill badge-success">No title found</span>
                
                      @else
                   
                      {{ $item->title_en }}
                      @endif
                    </td>
                   
                    <td>
                      @if($item->description_en == NULL)

                      <span class="badge badge-pill badge-success">No description found</span>
                
                      @else
                   
                      {{ $item->description_en }}
                      @endif  
                      
                 
                    </td>

                    <td>
                      @if($item->status == 1)
                      <span class="badge badge-pill badge-success">active</span>
                      @else
                         <span class="badge badge-pill badge-danger">inactive</span>
                      @endif

                    </td>
                    <td>
                      <a href="{{ url('admin/slider/edit/'.$item->id) }}" class="btn btn-sm btn-primary" title="edit data"> <i class="fa fa-pencil"></i></a>

                      <a href="{{ url('admin/slider/delete/'.$item->id) }}" class="btn btn-sm btn-danger" id="delete" title="delete data"><i class="fa fa-trash"></i></a>
                      @if($item->status == 1)
                      <a href="{{ url('admin/slider/inactive/'.$item->id) }}" class="btn btn-sm btn-danger"  title="inactive"><i class="fa fa-arrow-down"></i></a>
                      @else
                      <a href="{{ url('admin/slider/active/'.$item->id) }}" class="btn btn-sm btn-success"  title="active"><i class="fa fa-arrow-up"></i></a>
                      @endif
                      
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div><!-- table-wrapper -->
          </div>
          </div><!-- card -->
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-header">Add New Slider</div>
              <div class="card-body">
            <form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label class="form-control-label">Title Name English: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="title_en" placeholder="Title name english" value="{{ old('title_en') }}">
                  @error("title_en")
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <label class="form-control-label">Title Name Bangla: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="title_bn" placeholder="Title name english" value="{{ old('title_bn') }}">
                  @error("title_bn")
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label class="form-control-label">Description English: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="description_en" value="{{ old('description_en') }}" placeholder="Description english">
                  @error("description_en")
                  <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>
                <div class="form-group">
                  <label class="form-control-label">Description Bangla: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="description_bn" value="{{ old('description_bn') }}" placeholder="Description bangla">
                  @error("description_bn")
                  <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>
                <div class="form-group">
                  <label class="form-control-label">Slider Image: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="file" name="image">
                  @error('image')
                  <span class="text-danger">{{ $message }}</span>
               @enderror
                </div>
                <div class="form-layout-footer">
                  <button type="submit" class="btn btn-info">Add New</button>
                </div><!-- form-layout-footer -->
              </form>
              </div>
          </div>
        </div>
      </div>
    </div>


</div>
@endsection
