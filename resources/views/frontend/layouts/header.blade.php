<header class="header-style-1">

	<!-- ============================================== TOP MENU ============================================== -->
<div class="top-bar animate-dropdown">
	<div class="container">
		<div class="header-top-inner">
			<div class="cnt-account">
				<ul class="list-unstyled">
					<li><a href="#"><i class="icon fa fa-user"></i>@if(session()->get('language')== 'bangla') আমার একাউন্ট @else  My Account @endif</a></li>
					<li><a href="#"><i class="icon fa fa-heart"></i>@if(session()->get('language')=='bangla') ইচ্ছে তালিকা @else  Wishlist @endif</a></li>
					<li><a href="#"><i class="icon fa fa-shopping-cart"></i>@if(session()->get('language')=='bangla') মাই কাট @else My Cart @endif</a></li>
					<li><a href="#"><i class="icon fa fa-check"></i>@if(session()->get('language')=='bangla') চেক আউট @else Checkout @endif</a></li>
					<li>
						@guest
						<a href="{{ route('login') }}"><i class="icon fa fa-lock"></i>@if(session()->get('language')=='bangla') লগইন/রেজিষ্টার @else Login/Register @endif</a>
					</li>
						@else
							<li><a href="{{ route('user.home') }}"><i class="icon fa fa-lock"></i>@if(session()->get('language')=='bangla') প্রোফাইল @else Profile @endif</a></li>
							<li><a href="{{ route('logout') }}" onclick="event.preventDefault();
								document.getElementById('logout-form').submit();"><i class="icon fa fa-sign-out"></i> @if(session()->get('language')=='bangla') সাইন আউট @else  Sign Out @endif </a></li>
				
						   <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
							   @csrf
						   </form>
							
						@endguest
						
				</ul>
			</div><!-- /.cnt-account -->

			<div class="cnt-block">
				<ul class="list-unstyled list-inline">
					<li class="dropdown dropdown-small">
						<a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">USD </span><b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="#">USD</a></li>
							<li><a href="#">INR</a></li>
							<li><a href="#">GBP</a></li>
						</ul>
					</li>

					<li class="dropdown dropdown-small">
						<a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">@if(session()->get('language')=='bangla')ভাষা পরিবতন করুন @else Language @endif</span><b class="caret"></b></a>
						<ul class="dropdown-menu">
							@if(session()->get('language')=='bangla')
							<li><a href="{{ route('english.language') }}">English</a></li>
							@else
							<li><a href="{{ route('bangla.language') }}">Bangla</a></li>
							@endif
						</ul>
					</li>
				</ul><!-- /.list-unstyled -->
			</div><!-- /.cnt-cart -->
			<div class="clearfix"></div>
		</div><!-- /.header-top-inner -->
	</div><!-- /.container -->
</div><!-- /.header-top -->
<!-- ============================================== TOP MENU : END ============================================== -->
	<div class="main-header">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
					<!-- ============================================================= LOGO ============================================================= -->
<div class="logo">
	<a href="home.html">
		
		{{-- <img src=" {{ asset('frontend') }}/assets/images/logo.png" alt=""> --}}
		<h3 style="color: #fff">ARZENA FASHION</h3>

	</a>
</div><!-- /.logo -->
<!-- ============================================================= LOGO : END ============================================================= -->				</div><!-- /.logo-holder -->

				<div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">
					<!-- /.contact-row -->
<!-- ============================================================= SEARCH AREA ============================================================= -->
<div class="search-area">
    <form>
		<div class="control-group">

            <ul class="categories-filter animate-dropdown">
                <li class="dropdown">

                    <a class="dropdown-toggle"  data-toggle="dropdown" href="category.html">@if(session()->get('language')=='bangla') ক্যাটাগরী @else Categories @endif <b class="caret"></b></a>
                    <ul class="dropdown-menu" role="menu" >
						@php
						$categories = App\Models\Category::orderBy('category_name_en','DESC')->get();	
						@endphp
                       @foreach($categories as $cat)
					   @if(session()->get('language')=='bangla')
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">{{ $cat->category_name_bn }}</a></li>
						@else
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">{{ $cat->category_name_en }}</a></li>
						@endif
						
						@endforeach
                    </ul>
                </li>
            </ul>

            <input class="search-field" placeholder=" @if(session()->get('language')=='bangla') এখানে খুজুন... @else  search here... @endif" />

            <a class="search-button" href="#" ></a>    

        </div>
    </form>
</div><!-- /.search-area -->
<!-- ============================================================= SEARCH AREA : END ============================================================= -->				</div><!-- /.top-search-holder -->

				<div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">
					<!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->

	<div class="dropdown dropdown-cart">
		<a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
			<div class="items-cart-inner">
            <div class="basket">
					<i class="glyphicon glyphicon-shopping-cart"></i>
				</div>
				<div class="basket-item-count"><span class="count" id="cartQty">2</span></div>
				<div class="total-price-basket">
					<span class="lbl">cart -</span>
					<span class="total-price">
						<span class="sign" >$</span><span class="value" id="cartSubTotal"></span>
					</span>
				</div>
				
			
		    </div>
		</a>
		<ul class="dropdown-menu">
			<li>
			<div id="miniCart">

			</div>
			<hr>
		
			<div class="clearfix cart-total">
				<div class="pull-right">
					
						<span class="text">Sub Total :</span><span class='price' id="cartSubTotal"></span>
						
				</div>
				<div class="clearfix"></div>
					
				<a href="checkout.html" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a>	
			</div><!-- /.cart-total-->
					
				
		</li>
		</ul><!-- /.dropdown-menu-->
	</div><!-- /.dropdown-cart -->

<!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= -->				</div><!-- /.top-cart-row -->
			</div><!-- /.row -->

		</div><!-- /.container -->

	</div><!-- /.main-header -->

	<!-- ============================================== NAVBAR ============================================== -->
	<div class="header-nav animate-dropdown">
		<div class="container">
			<div class="yamm navbar navbar-default" role="navigation">
				<div class="navbar-header">
					<button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="nav-bg-class">
					<div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
			<div class="nav-outer">
			<ul class="nav navbar-nav">
				<li class="active dropdown yamm-fw">
					@if(session()->get('language')=='bangla')
					<a href="{{ url('/') }}"  data-hover="dropdown" class="dropdown-toggle">হোম</a>
				
					@else	
					<a href="{{ url('/') }}" data-hover="dropdown" class="dropdown-toggle">Home</a>	
					@endif
				</li>
	
				@php
				$categories = App\Models\Category::orderBy('category_name_en','DESC')->get();	
				@endphp
	 @foreach($categories as $cat)
				<li class="dropdown yamm mega-menu">
					@if(session()->get('language')=='bangla')
					<a href="home.html" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">{{ $cat->category_name_bn }}</a>
					@else
					<a href="home.html" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">{{ $cat->category_name_en }}</a>
					@endif
					<ul class="dropdown-menu container">
	
				<li>
	
					<div class="yamm-content ">
						<div class="row">
							@php
						$subcategories = App\Models\SubCategory::where('category_id',$cat->id)->orderBy('subcategory_name_en','ASC')->get();
							@endphp
						@foreach($subcategories as $subcat)	
							<div class="col-xs-12 col-sm-6 col-md-2 col-menu">
								@if(session()->get('language')=='bangla')
								<a href="{{ url('subcategory/product/'.$subcat->id.'/'.$subcat->subcategory_slug_bn) }}"><h2 class="title">{{ $subcat->subcategory_name_bn }}</h2></a>
								@else
								<a href="{{ url('subcategory/product/'.$subcat->id.'/'.$subcat->subcategory_slug_en) }}"><h2 class="title">{{ $subcat->subcategory_name_en }}</h2></a>
								@endif
									<ul class="links">
	
									@php
	
									$subsubcategories = App\Models\SubSubCategory::where('subcategory_id',$subcat->id)->orderBy('subsubcategory_name_en','ASC')->get();
									@endphp
									@foreach($subsubcategories as $subsubcat)
	
									@if(session()->get('language')=='bangla')
										<li><a href="{{ url('subsubcategory/product/'.$subsubcat->id.'/'.$subsubcat->subsubcategory_slug_bn) }}">{{ $subsubcat->subsubcategory_name_bn }}</a></li>
									@else
										<li><a href="{{ url('subsubcategory/product/'.$subsubcat->id.'/'.$subsubcat->subsubcategory_slug_en) }}">{{ $subsubcat->subsubcategory_name_en }}</a></li>
									@endif
	
									@endforeach
									
									</ul>
								</div><!-- /.col -->
						@endforeach
											
							<div class="col-xs-12 col-sm-6 col-md-4 col-menu banner-image">
							<img class="img-responsive" src="assets/images/banners/top-menu-banner.jpg" alt="">
								  
				   </div><!-- /.yamm-content -->					
		</div><!-- /container -->	
	</div><!-- /.header-nav animate-dropdown -->	
	
				</li>
	
	
					</ul>
					
				</li>
	
		@endforeach


             <li class="dropdown  navbar-right special-menu">
				<a href="#">Todays offer</a>
			</li>
					
			
		</ul><!-- /.navbar-nav -->
		<div class="clearfix"></div>				
	</div><!-- /.nav-outer -->
</div><!-- /.navbar-collapse -->


            </div><!-- /.nav-bg-class -->
        </div><!-- /.navbar-default -->
    </div><!-- /.container-class -->

</div><!-- /.header-nav -->
<!-- ============================================== NAVBAR : END ============================================== -->

</header>