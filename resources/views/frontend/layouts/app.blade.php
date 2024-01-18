<!DOCTYPE html>
<html lang="en">
	
<head>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
	    <meta name="keywords" content="MediaCenter, Template, eCommerce">
	    <meta name="robots" content="all">
		<meta name="csrf-token" content="{{ csrf_token() }}" />

	    <title>@yield('title')</title>

	    <!-- Bootstrap Core CSS -->
	    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/bootstrap.min.css">
	    
	    <!-- Customizable CSS -->
	    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/main.css">
	    <link rel="stylesheet" href=" {{ asset('frontend') }}/assets/css/blue.css">
	    <link rel="stylesheet" href=" {{ asset('frontend') }}/assets/css/owl.carousel.css">
		<link rel="stylesheet" href=" {{ asset('frontend') }}/assets/css/owl.transitions.css">
		<link rel="stylesheet" href=" {{ asset('frontend') }}/assets/css/animate.min.css">
		<link rel="stylesheet" href=" {{ asset('frontend') }}/assets/css/rateit.css">
		<link rel="stylesheet" href=" {{ asset('frontend') }}/assets/css/bootstrap-select.min.css">
		<link rel="stylesheet" href="{{ asset('frontend') }}/assets/toastr/toastr.css">
       
		

		
		<!-- Icons/Glyphs -->
		<link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/font-awesome.css">

        <!-- Fonts --> 
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>


	</head>
    <body class="cnt-home">
		<!-- ============================================== HEADER ============================================== -->
@include('frontend.layouts.header')

<!-- ============================================== HEADER : END ============================================== -->
<div class="body-content outer-top-xs" id="top-banner-and-menu">
	<div class="container">
	   <div class="row">
	<!-- ============================================== SIDEBAR ============================================== -->	
	  
		<!-- ============================================== SIDEBAR : END ============================================== -->
		<!-- ============================================== CONTENT ============================================== -->
           @yield('content')
	<!-- ============================================== BRANDS CAROUSEL ============================================== -->
       
     <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
	</div><!-- /.container -->
</div><!-- /#top-banner-and-menu -->

<!-- ============================================================= FOOTER ============================================================= -->
@include('frontend.layouts.footer')
<!-- ============================================================= FOOTER : END============================================================= -->


{{-- product view modal start--------------------------------------- --}} 
<div class="modal fade" id="cartModal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
	<div class="modal-content"> 

	<div class="modal-header">
		<h5 class="modal-title text-danger" id="pname"></h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
	  </div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-4">
				<div class="card" style="width:16rem;">
					<img src="" class="card-img-top" id="pimage" alt="" style="height: 200px;">
				</div>
			</div>
			<div class="col-md-4">
				<ul class="list-group">
					<li class="list-group-item">Price: <strong class="text-danger">$<span
								id="pprice"></span> </strong>
						<del id="oldprice">$</del>
					</li>
					<li class="list-group-item">Product Code: <strong id="pcode"></strong></li>
					<li class="list-group-item">Category: <strong id="pcategory"></strong></li>
					<li class="list-group-item">Stock: <span class="badge badge-pill badge-success"
							id="available" style="background:green; color:white;"></span>
						<span class="badge badge-pill badge-danger" id="stockout"
							style="background:red; color:white;"></span>
					</li>
				</ul>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="color">Select Color</label>
					<select class="form-control" id="color" name="color">
					</select>
				</div>
				<div class="form-group" id="sizeArea">
					<label for="size">Select Size</label>
					<select class="form-control" id="size" name="size">
					</select>
				</div>
				<div class="form-group">
					<label for="qty">Quantity</label>
					<input type="number" class="form-control" id="qty" value="1" min="1">
				</div>
				<input type="hidden" id="product_id">
				<button type="submit" class="btn btn-danger" onclick="addToCart()">Add To Cart</button>
			</div>
		</div>
	</div>
</div>


</div>

	<!-- For demo purposes – can be removed on production -->
	
	
	<!-- For demo purposes – can be removed on production : End -->

	<!-- JavaScripts placed at the end of the document so the pages load faster -->
	<script src="{{ asset('frontend') }}/assets/js/jquery-1.11.1.min.js"></script>
	
	<script src="{{ asset('frontend') }}/assets/js/bootstrap.min.js"></script>
	
	<script src="{{ asset('frontend') }}/assets/js/bootstrap-hover-dropdown.min.js"></script>
	<script src="{{ asset('frontend') }}/assets/js/owl.carousel.min.js"></script>
	
	<script src="{{ asset('frontend') }}/assets/js/echo.min.js"></script>
	<script src="{{ asset('frontend') }}/assets/js/jquery.easing-1.3.min.js"></script>
	<script src="{{ asset('frontend') }}/assets/js/bootstrap-slider.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/jquery.rateit.min.js"></script>
    <script type="text/javascript" src="{{ asset('frontend') }}/assets/js/lightbox.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/bootstrap-select.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/wow.min.js"></script>
	<script src="{{ asset('frontend') }}/assets/js/scripts.js"></script>
	<script src="{{ asset('frontend') }}/assets/js/sweetalert2@8.js"></script>
	<script src="{{ asset('frontend') }}/assets/toastr/toastr.min.js"></script>

	
	{{-- //product view ajax on modal start --}}
	<script>
	
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		
		
			function productview(id){
	
				$.ajax({
	
					type:"GET",
					dataType:"json",
					url:"product/view/modal/"+id,
					success:function(data){
	
						$('#pname').text(data.product.product_name_en);
						$('#pcode').text(data.product.product_code);
						$('#pcategory').text(data.product.category.category_name_en);
						$('#pimage').attr('src','/'+data.product.product_thumbnail);
						$('#product_id').val(id);
						$('#qty').val(1);
	
	
						if(data.product.discount_price == null){
							$('#pprice').text('');
							$('#oldprice').text('');
	
							$('#pprice').text(data.product.selling_price);
						}else{
							$('#pprice').text(data.product.discount_price);
							$('#oldprice').text(data.product.selling_price);
						}
	
						//stock
						if(data.product.product_qty > 0){
	
							
	
							$('#available').text('available');
						}else{
	
							$('#available').text('');
							$('#stockout').text('');
	
							$('#stockout').text('stockout');
						}
	
						//color
						$('select[name="color"]').empty();
						
						$.each(data.color,function(key,value){
	
							$('select[name="color"]').append('<option value=" '+value+' ">'+value+'</option>')
	
						});
						//size 
						
	
						
						$('select[name="size"]').empty();
						$.each(data.size,function(key,value){
	
							$('select[name="size"]').append('<option value="'+value+'">'+value+'</option>');
	
							if(data.size == ""){
	
								$('#sizeArea').hide();
							}else{
								$('#sizeArea').show();
							}
						})
					
						
					}
				})
			}
			//productview();

			//start add to cart product


			function addToCart(){
				var id = $('#product_id').val();
				var product_name = $('#pname').text();
				var color = $('#color option:selected').text();
				var size = $('#size option:selected').text();
				var quantity = $('#qty').val();
				//alert(id)
				//die()

				$.ajax({
					type:"POST",
					dataType:"json",
					url: "/cart/data/store/"+id,
					data:{color:color,size:size,quantity:quantity,product_name:product_name},
					success:function(data){
						miniCart();
						$('#cartModal').click();
				
                    //  start message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    })

                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error
                        })
                    }
                    //  end message
					}
				});
			}

		
		
		</script>

		{{-- //product view mini cart start--}}

		<script>

			 function miniCart(){

				$.ajax({
				type:"GET",
				datatype:"json",
				url:"/product/mini/cart",
				success:function(response){
	
                    $('span[id="cartSubTotal"]').text(response.cartTotal);
                    $('#cartQty').text(response.cartQty);

                    var miniCart = ""

                    $.each(response.carts, function(key, value) {
                        miniCart += `<div class="cart-item product-summary">
                    <div class="row">
                    <div class="col-xs-4">
                    <div class="image">
                        <a href="detail.html"><img src="/${value.options.image}" alt=""></a>
                    </div>
                    </div>
                    <div class="col-xs-7">
                    <h3 class="name"><a href="index8a95.html?page-detail">${value.name}</a></h3>
                    <div class="price">${value.price}$ * ${value.qty}</div>
                    </div>
                    <div class="col-xs-1 action">
                    <button type="submit" id="${value.rowId}" onclick="miniCartRemove(this.id)"><i class="fa fa-trash"></i></button>
                    </div>
                    </div>
                    </div><!-- /.cart-item -->
                    <div class="clearfix"></div> <hr>` 
				       });

                    $('#miniCart').html(miniCart);
					
					}
				});
				
			}

		miniCart();

		


		</script>
		<script>
			// {{-- //product view mini cart end--}}
		// mini cart remove start

		function miniCartRemove(rowId){

			//alert(rowId);
			
			$.ajax({

				type:"GET",
				dataType:"json",
				url:"minicart/product-remove/"+rowId,
				success:function(data){
					miniCart();
					  //  start message
					  const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    })

                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error
                        })
                    }
                    //  end message
				}
		});
		}

		
		// mini cart remove end
		</script>
	
	

	{{--toastr code start --}}
	<script>
		@if(Session::has('message'))

			var type="{{ Session::get('alert-type','success') }}"

			switch(type){
				case 'info':
					toastr.info("{{ Session::get('message') }}");
					break;

				case 'success':
					toastr.success("{{ Session::get('message') }}");
					break;

				case 'error':
					toastr.error("{{ Session::get('message') }}");
					break;
			}

		@endif

	</script>
	{{--toastr code end --}}



</body>

</html>