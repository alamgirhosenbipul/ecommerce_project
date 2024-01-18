<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\multiImage;
use App\Models\Product;
use App\Models\Topslider;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){

        $sliders = Topslider::where('status', 1)->orderBy('id','DESC')->limit(5)->get();
        $categories = Category::orderBy('id','DESC')->get();
        $categoriess = Category::orderBy('category_name_en','ASC')->get();
        $products = Product::where('status', 1)->orderBy('id','DESC')->get();
        $featured = Product::where('featured',1)->where('status',1)->orderBy('id','DESC')->get();
        $special_offer = Product::where('special_offer',1)->where('status',1)->orderBy('id','DESC')->get();
        $special_deals = Product::where('special_deals',1)->where('status',1)->orderBy('id','DESC')->get();

        return view('frontend.home',compact('sliders','categories','categoriess','products','featured','special_offer','special_deals'));
    }


        //single product 

        public function singleProduct($id,$slug){

            $product = Product::findOrFail($id);
            $multiImage = multiImage::where('product_id',$id)->get();

    
            $relatedProducts = Product::where('category_id',$product->category_id)->orderBy('id','DESC')->get();
            $color_en = explode(',',$product->product_color_en);
            $color_bn = explode(',',$product->product_color_bn);   
            $size_en = explode(',',$product->product_size_en);
            $size_bn = explode(',',$product->product_size_bn);

    
            return view('frontend.single-Product',compact('product','relatedProducts','multiImage','color_en','color_bn','size_en','size_bn'));
        }

            //tag wise product

    public function tagWiseProduct($tag){

        $products = Product::where('status',1)->where('product_tags_en',$tag)->orWhere('product_tags_bn',$tag)->orderBy('id','DESC')->paginate(1);

        return view('frontend.tag-product',compact('products'));

    }

        //subcatwise product

        public function subcategorywiseproductshow($id,$slug){

            $products = Product::where('status',1)->where('subcategory_id',$id)->orderBy('id','DESC')->paginate(2);
     
            return view('frontend.subcategory',compact('products'));
         }
     
         //subsub cat wise product show
     
         public function subsubcatwiseproductshow($id,$slug){
             $products = Product::where('status',1)->where('subsubcategory_id',$id)->orderBy('id','DESC')->paginate(2);
             return view('frontend.subsubcategory',compact('products'));
         }


             //product view modal with ajax

         public function productViewAjax($id){

            $product = Product::with('category')->findOrFail($id);
            $color = $product->product_color_en;
            $product_color = explode(',',$color);

            $size = $product->product_size_en;
            $product_size = explode(',',$size);

            return response()->json([ 
                'product'=>$product,
                'color'=>$product_color,
                'size'=>$product_size,
            ]);

    }


}
