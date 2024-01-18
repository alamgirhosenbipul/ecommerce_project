
@php
  $hot_deals = App\Models\Product::where('hot_deals',1)->where('status',1)->where('discount_price','!=', NULL)->orderBy('id','DESC')->get();
@endphp




<div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
	<h3 class="section-title">hot deals</h3>
	<div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">
		@foreach($hot_deals as $product)
				<div class="item">
					<div class="products">
						<div class="hot-deal-wrapper">
							<div class="image">
								@if(session()->get('language')=='bangla')
										<a href="{{ url('single/product/'.$product->id.'/'.$product->product_slug_bn) }}"><img  src="{{ asset($product->product_thumbnail) }}" alt=""></a>
										@else
										<a href="{{ url('single/product/'.$product->id.'/'.$product->product_slug_en) }}"><img  src="{{ asset($product->product_thumbnail) }}" alt=""></a>
								@endif
							</div><!-- /.image -->	
							@php
								$discount_price = $product->selling_price - $product->discount_price;
								$discount = ($discount_price*100)/$product->selling_price;
							@endphp
						
							<div class="sale-offer-tag"><span>@if(session()->get('language')=='bangla'){{ price_bn(round($discount)) }}% @else {{ round($discount) }}% @endif<br>off</span></div>
							<div class="timing-wrapper">
								<div class="box-wrapper">
									<div class="date box">
										<span class="key">120</span>
										<span class="value">DAYS</span>
									</div>
								</div>
				                
				                <div class="box-wrapper">
									<div class="hour box">
										<span class="key">20</span>
										<span class="value">HRS</span>
									</div>
								</div>

				                <div class="box-wrapper">
									<div class="minutes box">
										<span class="key">36</span>
										<span class="value">MINS</span>
									</div>
								</div>

				                <div class="box-wrapper hidden-md">
									<div class="seconds box">
										<span class="key">60</span>
										<span class="value">SEC</span>
									</div>
								</div>
							</div>
						</div><!-- /.hot-deal-wrapper -->

						<div class="product-info text-left m-t-20">
							@if(session()->get('language')=='bangla')
							<h3 class="name"><a href="{{ url('single/product/'.$product->id.'/'.$product->product_slug_bn) }}">@if(session()->get('language')=='bangla'){{ $product->product_name_bn }} @else {{ $product->product_name_en }} @endif</a></h3>
							@else
							<h3 class="name"><a href="{{ url('single/product/'.$product->id.'/'.$product->product_slug_en) }}">@if(session()->get('language')=='bangla'){{ $product->product_name_bn }} @else {{ $product->product_name_en }} @endif</a></h3>
							@endif
							<div class="rating rateit-small"></div>

							<div class="product-price">	


								<span class="price">
									@if(session()->get('language')=='bangla')${{ price_bn($product->discount_price) }} @else ${{ $product->discount_price }} @endif
								</span>
									
							    <span class="price-before-discount">@if(session()->get('language')=='bangla')${{ price_bn($product->selling_price) }} @else ${{ $product->selling_price }} @endif</span>					
							
							</div><!-- /.product-price -->
							
						</div><!-- /.product-info -->

						<div class="cart clearfix animate-effect">
							<div class="action">
								
								<div class="add-cart-button btn-group">
									<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
										<i class="fa fa-shopping-cart"></i>													
									</button>
									<button class="btn btn-primary cart-btn" type="button">Add to cart</button>
															
								</div>
								
							</div><!-- /.action -->
						</div><!-- /.cart -->
					</div>	
		    	</div>		        
	        @endforeach					
	    
    </div><!-- /.sidebar-widget -->
</div>