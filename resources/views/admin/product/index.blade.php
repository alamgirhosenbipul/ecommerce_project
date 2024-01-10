
@extends('admin.layouts.app')
@section('adminContent')
@section('products') active show-sub @endsection
@section('manage-products') active @endsection

     <!-- ########## START: MAIN PANEL ########## -->
     <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">SHopMama</a>
          <span class="breadcrumb-item active">Products</span>
        </nav>

        <div class="sl-pagebody">
          <div class="row row-sm">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">Products List</div>
                <div class="card-body">
                <div class="table-wrapper">
                  <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                      <tr>
                        <th class="wd-20p">Image</th>
                        <th class="wd-20p">Product Name English</th>
                        <th class="wd-20p">Product Price</th>
                        <th class="wd-15p">Product Quantity</th>
                        <th class="wd-5p">Product Discount</th>
                        <th class="wd-5p">Status</th>
                        <th class="wd-15p">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                @foreach($products as $product)
                      <tr>
                        <td>
                            <img src="{{ asset($product->product_thumbnail) }}" alt="" style="height: 60px; width:60px;">
                        </td>
                        <td>{{ $product->product_name_en }}</td>
                        <td>{{ $product->selling_price }}/-</td>
                        <td>{{ $product->product_qty }}</td>
                        <td>
                          @if( $product->discount_price == NULL)
                          <span class="badge badge-pill badge-success">No duscount</span>
                          @else
                          @php
                          $discountamount = $product->selling_price - $product->discount_price;
                          $discount = ($discountamount*100)/$product->selling_price;
                          @endphp
                          <span class="badge badge-pill badge-success">{{ round($discount) }}%</span>
                        @endif
                        <td>
                          @if($product->status == 1)
                          <span class="badge badge-pill badge-success">active</span>
                          @else
                             <span class="badge badge-pill badge-danger">inactive</span>
                          @endif
                        <td>
                          <a href="{{ url('admin/product-edit/'.$product->id) }}" class="btn btn-sm btn-primary" title="edit data"> <i class="fa fa-pencil"></i></a>
                        
                          <a href="{{ url('admin/product/delete/'.$product->id) }}" class="btn btn-sm btn-danger" id="delete" title="delete data"><i class="fa fa-trash"></i></a>
                          @if($product->status == 1)
                          <a href="{{ url('admin/product/inactive/'.$product->id) }}" class="btn btn-sm btn-danger"  title="inactive"><i class="fa fa-arrow-down"></i></a>
                          @else
                          <a href="{{ url('admin/product/active/'.$product->id) }}" class="btn btn-sm btn-success"  title="active"><i class="fa fa-arrow-up"></i></a>
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

          </div>
        </div>
    </div>

    @endsection