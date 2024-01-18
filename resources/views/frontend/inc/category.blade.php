<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i>@if(session()->get('language')=='bangla') ক্যাটাগরী @else Categories @endif</div>        
    <nav class="yamm megamenu-horizontal" role="navigation">
        <ul class="nav">

			@php
			
			$categories = App\Models\Category::orderBy('category_name_en','DESC')->get();

			@endphp

		@foreach($categories as $cat)
            <li class="dropdown menu-item">
				@if(session()->get('language')=='bangla')	
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="{{ $cat->category_icon }}" aria-hidden="true"></i> {{ $cat->category_name_bn }}</a>
				@else
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="{{ $cat->category_icon }}" aria-hidden="true"></i> {{ $cat->category_name_en }}</a>
				@endif
                 <ul class="dropdown-menu mega-menu">
					<li class="yamm-content">
						<div class="row">
					
							@php

							$subcategories = App\Models\SubCategory::where('category_id',$cat->id)->orderBy('subcategory_name_en','ASC')->get();

							@endphp
						@foreach($subcategories as $subcat)
							<div class="col-sm-12 col-md-3">
								<ul class="links list-unstyled"> 
									@if(session()->get('language')=='bangla')
									<a href="{{ url('subcategory/product/'.$subcat->id.'/'.$subcat->subcategory_slug_bn) }}"><h2 class="title">{{ $subcat->subcategory_name_bn }}</h2></a>
									
									@else
									<a href="{{ url('subcategory/product/'.$subcat->id.'/'.$subcat->subcategory_slug_en) }}"><h2 class="title">{{ $subcat->subcategory_name_en }}</h2></a>
									
									@endif
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
						</div>
					</li><!-- /.yamm-content -->                    
				</ul>
				</li>
         @endforeach 
        </ul><!-- /.nav -->
    </nav><!-- /.megamenu-horizontal -->
</div><!-- /.side-menu -->