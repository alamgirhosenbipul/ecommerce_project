<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\multiImage;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Carbon;


class ProductController extends Controller
{
    public function addProduct(){

        $categories = Category::latest()->get();
        return view('admin.product.create',compact('categories'));
    }

    // code for automatic subsubcategory item
    public function getSubSubCat($subcat_id){

        $subsubcat = SubSubCategory::where('subCategory_Id',$subcat_id)->orderby('subsubcategory_name_en','ASC')->get();
        return json_encode($subsubcat);
      }

      //store product item
      public function storeProduct(Request $request){


        // dd($request->all());
 
         $request->validate([
           'category_id'=>'required',
           'subcategory_id'=>'required',
           'subsubcategory_id'=>'required',
           'product_name_en'=>'required',
           'product_name_bn'=>'required',
           'product_code'=>'required',
           'product_qty'=>'required',
           'product_tags_en'=>'required',
           'product_tags_bn'=>'required',
           'product_size_en'=>'required',
           'product_size_bn'=>'required',
           'product_color_en'=>'required',
           'product_color_bn'=>'required',
           'selling_price'=>'required',
           'discount_price'=>'required',
           'short_desc_en'=>'required',
           'short_desc_bn'=>'required',
           'long_desc_en'=>'required',
           'long_desc_bn'=>'required',
           'product_thumbnail'=>'required',
           'multi_img'=>'required',
         ]);
 
 
 
       
         if($request->file('product_thumbnail')){
          $thumbnail = $request->file('product_thumbnail');
          $manager = new ImageManager(new Driver());
          $name_gen = rand(9999,8888).'.'.$thumbnail->getClientOriginalExtension();
          $img = $manager->read($thumbnail);
          $img = $img->resize(917,1000);
          $img->toJpeg(80)->save(base_path('public/uploads/products/thumbnail/'.$name_gen));
          $save_url= 'uploads/products/thumbnail/'.$name_gen;

         }

     
 
 
          $product_id =  Product::insertGetId([
 
         
             'category_id'=>$request->category_id,
             'subcategory_id'=>$request->subcategory_id,
             'subsubcategory_id'=>$request->subsubcategory_id,
             'product_name_en'=>strtolower($request->product_name_en,),
             'product_name_bn'=>$request->product_name_bn,
             'product_slug_en'=>strtolower(str_replace(' ','-', $request->product_name_en)),
             'product_slug_bn'=>str_replace(' ','-',$request->product_name_bn),
             'product_code'=>$request->product_code,
             'product_qty'=>$request->product_qty,
             'product_tags_en'=>$request->product_tags_en,
             'product_tags_bn'=>$request->product_tags_bn,
             'product_size_en'=>$request->product_size_en,
             'product_size_bn'=>$request->product_size_bn,
             'product_color_en'=>$request->product_color_en,
             'product_color_bn'=>$request->product_color_bn,
             'selling_price'=>$request->selling_price,
             'discount_price'=>$request->discount_price,
             'short_desc_en'=>$request->short_desc_en,
             'short_desc_bn'=>$request->short_desc_bn,
             'long_desc_en'=>$request->long_desc_en,
             'long_desc_bn'=>$request->long_desc_bn,
             'product_thumbnail'=>$save_url,
             'hot_deals'=>$request->hot_deals,
             'featured'=>$request->featured,
             'special_offer'=>$request->special_offer,
             'special_deals'=>$request->special_deals,
             'status'=>1,
             'created_at'=>Carbon::now(),
 
           ]);
 
 if($request->file('multi_img')){

  $images = $request->file('multi_img');
  $manager = new ImageManager(new Driver());

  foreach($images as $img){

          $name_gen = rand(9999,8888).'.'.$img->getClientOriginalExtension();
          $img = $manager->read($img);
          $img = $img->resize(917,1000);
          $img->toJpeg(80)->save(base_path('public/uploads/products/multi_img/'.$name_gen));
          $save_multi_img= 'uploads/products/multi_img/'.$name_gen;

          multiImage::insert([
 
            'product_id'=>$product_id,
            'photo_name'=>$save_multi_img,
            'created_at'=>Carbon::now(),
          ]);
  }

 }
         
 
           $notification = array(
             'message'=>'Product uploaded successfully!',
             'alert-type'=>'success',
         );
         return redirect()->back()->with($notification);
     
     }

     //product store end

         //manage products starts

    public function index(){

      $products = Product::OrderBy('id','DESC')->get();
      return view('admin.product.index',compact('products'));
    }
    //manage products ends

     //product edit

     public function productEdit($id){

      $product =  product::findOrFail($id);
      $categories = Category::latest()->get();
      $subCategories = SubCategory::latest()->get();
      $subSubCategories = SubSubCategory::latest()->get();
      $multi_imgs = multiImage::where('product_id', $id)->latest()->get();
        return view('admin.product.edit',compact('product','categories','subCategories','subSubCategories','multi_imgs'));
      }
  
      //update product 
  
      public function productUpdate(Request $request, $product_id){
  
        Product::findOrFail($product_id)->update([
  
          'category_id'=>$request->category_id,
          'subcategory_id'=>$request->subcategory_id,
          'subsubcategory_id'=>$request->subsubcategory_id,
          'product_name_en'=>$request->product_name_en,
          'product_name_bn'=>$request->product_name_bn,
          'product_slug_en'=>strtolower(str_replace('','-',$request->product_name_en)),
          'product_slug_bn'=>str_replace('','-',$request->product_name_en),
          'product_code'=>$request->product_code,
          'product_qty'=>$request->product_qty,
          'product_tags_en'=>$request->product_tags_en,
          'product_tags_bn'=>$request->product_tags_bn,
          'product_size_en'=>$request->product_size_en,
          'product_size_bn'=>$request->product_size_bn,
          'product_color_en'=>$request->product_color_en,
          'product_color_bn'=>$request->product_color_bn,
          'selling_price'=>$request->selling_price,
          'discount_price'=>$request->discount_price,
          'short_desc_en'=>$request->short_desc_en,
          'short_desc_bn'=>$request->short_desc_bn,
          'long_desc_en'=>$request->long_desc_en,
          'long_desc_bn'=>$request->long_desc_bn,
          'hot_deals'=>$request->hot_deals,
          'featured'=>$request->featured,
          'special_offer'=>$request->special_offer,
          'special_deals'=>$request->special_deals,
          'status'=>1,
          'updated_at'=>Carbon::now(),
  
        ]);
  
        $notification = array(
          'message'=>'Product updated successfully!',
          'alert-type'=>'success',
      );
      return redirect()->route('manage.products')->with($notification);
  
      }

       //update product thumbnail

    public function updateProductThumbnail(Request $request){

      $proId = $request->product_id;

      $oldImg = $request->old_img;
      unlink( $oldImg);

      if($request->file('product_thumbnail')){
        $image = $request->file('product_thumbnail');
        $manager = new ImageManager(new Driver());
        $name_gen = rand(9999,8888).'.'.$image->getClientOriginalExtension();
        $img = $manager->read($image);
        $img = $img->resize(917,1000);
        $img->toJpeg(80)->save(base_path('public/uploads/products/thumbnail/'.$name_gen));
        $save_url= 'uploads/products/thumbnail/'.$name_gen;
    

      // $image = $request->file('product_thumbnail');
      // $name_gen = rand(9999,4444).'.'.$image->getClientOriginalName();
      // Image::make($image)->resize(917,1000)->save('uploads/products/thumbnail/'.$name_gen);
      // $save_url = 'uploads/products/thumbnail/'.$name_gen;

      Product::findOrFail($proId)->update([

        'product_thumbnail'=>$save_url,
        'updated_at'=>Carbon::now(),
      ]);


      $notification = array(
        'message'=>'Product thumbnail updated successfully!',
        'alert-type'=>'success',
    );
    return redirect()->back()->with($notification);
  }


}


    //multi image update

    public function updateProductImage(Request $request){

      if($request->multiImg){
        $images =  $request->multiImg;
        foreach($images as $id=>$img){

          $imageDel =  multiImage::findOrFail($id);
          unlink($imageDel->photo_name);
          $manager = new ImageManager(new Driver());
          $name_gen = rand(9999,8888).'.'.$img->getClientOriginalExtension();
          $img = $manager->read($img);
          $img = $img->resize(917,1000);
          $img->toJpeg(80)->save(base_path('public/uploads/products/multi_img/'.$name_gen));
          $save_multiImg= 'uploads/products/multi_img/'.$name_gen;

          multiImage::where('id',$id)->update([
            'photo_name'=>$save_multiImg,
            'updated_at'=>Carbon::now(),
          ]);

        }
      }
      $notification = array(
        'message'=>'Product image updated successfully!',
        'alert-type'=>'success',
    );
    return redirect()->back()->with($notification);

  
   }

   
    //multi image delete

    public function multiImageDelete($id){

      $oldImg = multiImage::findOrFail($id);
      unlink($oldImg->photo_name);

      multiImage::findOrFail($id)->delete();


      $notification = array(
        'message'=>'Product image delete successfully!',
        'alert-type'=>'error',
    );
    return redirect()->back()->with($notification);

    }

     //product inactive route

     public function inactive($id){

      Product::findOrFail($id)->update([

        'status'=> 0
      ]);

      $notification = array(
        'message'=>'Product inactive successfully!',
        'alert-type'=>'error',
    );
    return redirect()->back()->with($notification);

    }

        //product active route

        public function active($id){

          Product::findOrFail($id)->update([
    
            'status'=> 1
          ]);
    
          $notification = array(
            'message'=>'Product active successfully!',
            'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);
    
        }

        //product delete

        public function delete($id){

          $product =  Product::findOrFail($id);
 
          unlink($product->product_thumbnail);
          
          Product::findOrFail($id)->delete();
 
         $images =  multiImage::where('product_id',$id)->get();
 
         foreach($images as $img){
 
           unlink($img->photo_name);
           multiImage::where('product_id',$id)->delete();
 
         }
 
         $notification = array(
           'message'=>'Product delete successfully!',
           'alert-type'=>'error',
       );
       return redirect()->back()->with($notification);
 
         }

  
}
