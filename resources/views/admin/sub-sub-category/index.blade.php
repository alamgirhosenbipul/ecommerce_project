@extends('admin.layouts.app')
@section('category')
  active show-sub
@endsection
@section('sub-sub-category')
  active
@endsection


@section('adminContent')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="index.html">Arzena Fashion</a>
      <span class="breadcrumb-item active">Sub-Sub-category</span>
    </nav>

    <div class="sl-pagebody">
      <div class="row row-sm">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">Sub Sub-Category List</div>
            <div class="card-body">
            <div class="table-wrapper">
              <table id="datatable1" class="table display responsive nowrap">
                <thead>
                  <tr>
                    <th class="wd-30p">Category</th>
                    <th class="wd-30p">Sub Category</th>
                    <th class="wd-10p">Sub-Sub-Category En</th>
                    <th class="wd-10p">Sub-Sub-Category bn</th>
                    <th class="wd-20p">Action</th>
                  </tr>
                </thead>
                <tbody>
            @foreach ($subsubcategories as $item)
                
                  <tr>
                    <td>{{ $item->category->category_name_en ?? 'None' }}</td>
                    <td>{{ $item->subcategory->subcategory_name_en ?? 'None' }}</td>
                    <td>{{ $item->subsubcategory_name_en }}</td>
                    <td>{{ $item->subsubcategory_name_bn }}</td>
                    <td>
                      <a href="{{ url('admin/sub-subcategory/edit/'.$item->id)  }}" class="btn btn-sm btn-primary" title="edit data"> <i class="fa fa-pencil"></i></a>

                      <a href="{{ url('admin/sub-subcategory/delete/'.$item->id) }}" class="btn btn-sm btn-danger" id="delete" title="delete data"><i class="fa fa-trash"></i></a>
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
            <div class="card-header">Add Sub Sub Category</div>
              <div class="card-body">
            <form action="{{ route('subsub.store') }}" method="POST">
                @csrf
               
                <div class="form-group">
                  <label class="form-control-label">Select Category: <span class="tx-danger">*</span></label>
                  <select class="form-control select2-show-search" data-placeholder="Choose one (with searchbox)" name="category_id">
                   
                    <option label="Choose one"></option>
               @foreach($categories as $item)
                    <option value="{{ $item->id }}">{{ $item->category_name_en }}</option>
                @endforeach
                  </select>
                  @error('category_id')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <label class="form-control-label">Select Sub Category: <span class="tx-danger">*</span></label>
                  <select class="form-control select2-show-search" data-placeholder="Choose one (with searchbox)" name="subcategory_id">
                   
                    <option label="Choose one"></option>

               {{-- @foreach($categories as $item)
                    <option value="{{ $item->id }}">{{ $item->category_name_en }}</option> এর মধ্যে এজাক্স ব্যাবহার করা হয়েছে ।
                @endforeach --}}
                
                  </select>
                  @error('subcategory_id')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label class="form-control-label">Sub-Sub-Category Name English: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="subsubcategory_name_en" value="" placeholder="sub-sub-Category name bangla">
                  @error('subsubcategory_name_en')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>
                <div class="form-group">
                  <label class="form-control-label">Sub-Sub-Category Name Bangla: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="subsubcategory_name_bn" value="" placeholder="sub-sub-Category name bangla">
                  @error('subsubcategory_name_bn')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>
                <div class="form-layout-footer">
                  <button type="submit" class="btn btn-info">Add sub-Category</button>
                </div><!-- form-layout-footer -->
              </form>
              </div>
          </div>
        </div>
      </div>
    </div>


</div>

<script src="{{asset('backend')}}/lib/jquery-2.2.4.min.js"></script>

<script type="text/javascript">


$(document).ready(function(){

  $('select[name="category_id"]').on('change',function(){

    var category_id = $(this).val();
    //alett(category_id);
    if(category_id){
      $.ajax({

        url:"{{ url('/admin/subcategory/ajax') }}/"+category_id,
        type:"GET",
        dataType:"json",
        success:function(response){

          var data = $('select[name="subcategory_id"]').empty();
          $.each(response,function(key,value){

            $('select[name="subcategory_id"]').append('<option value="'+value.id+'">'+value.subcategory_name_en+'</option>');
          });
        }
      });
    }else{
      alert('danger');
    }
  });
});

//   $(document).ready(function() {
    
//     $('select[name="category_id"]').on('change', function(){
//         var category_id = $(this).val();

//        // alert(category_id);
//         if(category_id) {
//             $.ajax({
//                 url: "{{  url('/admin/subcategory/ajax') }}/"+category_id,
//                 type:"GET",
//                 dataType:"json",
//                 success:function(data) {
//                    var d =$('select[name="subcategory_id"]').empty();
//                       $.each(data, function(key, value){
//                           $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name_en + '</option>');
//                       });
//                 },
//             });
//         } else {
//             alert('danger');
//         }
//     });
// });

</script>
@endsection
