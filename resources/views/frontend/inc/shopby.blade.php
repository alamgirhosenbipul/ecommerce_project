<div class="sidebar-widget wow fadeInUp">
    <h3 class="section-title">shop by</h3>
     <div class="widget-header">
         <h4 class="widget-title">Category</h4>
     </div>
     <div class="sidebar-widget-body">
         <div class="accordion">
             @php
 
             $categories = App\Models\Category::orderBy('category_name_en','DESC')->get();
             @endphp
             @foreach($categories as $category)
             <div class="accordion-group">
                 <div class="accordion-heading">
                     @if(session()->get('language')=='bangla')
                     <a href="#collapse{{ $category->id }}" data-toggle="collapse" class="accordion-toggle collapsed">{{ $category->category_name_bn }}</a>
                     @else
                     <a href="#collapse{{ $category->id }}" data-toggle="collapse" class="accordion-toggle collapsed">{{ $category->category_name_en }}</a>
                     @endif
                 </div><!-- /.accordion-heading -->
 
              
                 <div class="accordion-body collapse" id="collapse{{ $category->id }}" style="height: 0px;">
                     <div class="accordion-inner">
                         @php
                         $subcategories = App\Models\SubCategory::where('category_id',$category->id)->orderBy('subcategory_name_en','DESC')->get();
                         @endphp
                         <ul>
                             @foreach($subcategories as $subcat)
                             @if(session()->get('language')=='bangla')
                             <li><a href="{{ url('subcategory/product/'.$subcat->id.'/'.$subcat->subcategory_slug_bn) }}">{{ $subcat->subcategory_name_bn }}</a></li>
                             @else
                             <li><a href="{{ url('subcategory/product/'.$subcat->id.'/'.$subcat->subcategory_slug_en) }}">{{ $subcat->subcategory_name_en }}</a></li>
                             @endif
                             @endforeach
                       
                         </ul>
                     </div><!-- /.accordion-inner -->
                 </div><!-- /.accordion-body -->
             </div><!-- /.accordion-group -->
             @endforeach
         
         </div><!-- /.accordion -->
     </div><!-- /.sidebar-widget-body -->
 </div><!-- /.sidebar-widget -->