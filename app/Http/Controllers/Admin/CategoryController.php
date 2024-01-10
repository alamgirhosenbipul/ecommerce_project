<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CategoryController extends Controller
{
    public function index(){

        $categories = Category::latest()->get();
        return view('admin.category.index',compact('categories'));
    }

    //category insert start
    public function store(Request $request){

        $request->validate([
            'category_name_en'=>'required',
            'category_name_bn'=>'required',
            'category_icon'=>'required',
        ]);

        Category::insert([

            'category_name_en'=>$request->category_name_en,
            'category_name_bn'=>$request->category_name_bn,
            'category_slug_en'=>strtolower(str_replace('','-',$request->category_name_en)),
            'category_slug_bn'=>str_replace('','-',$request->category_name_bn),
            'category_icon'=>$request->category_icon,
            'created_at'=>Carbon::now(),
        ]);

        $notification = array(
            'message'=>'Category added successfully!',
            'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);
    }

    //category insert end
    //category edit start
    public function categoryEdit($id){

        $category = Category::findOrFail($id);
        return view('admin.category.edit',compact('category'));
    }


    public function categoryUpdate(Request $request,$id){

        $request->validate([
            'category_name_en'=>'required',
            'category_name_bn'=>'required',
            
            'category_icon'=>'required',
        ]);

        Category::findOrFail($id)->update([

            'category_name_en'=>$request->category_name_en,
            'category_name_bn'=>$request->category_name_bn,
            'category_slug_en'=>strtolower(str_replace('','-',$request->category_name_en)),
            'category_slug_bn'=>str_replace('','-',$request->category_name_bn),
            'category_icon'=>$request->category_icon,
            'created_at'=>Carbon::now(),
        ]);

        $notification = array(
            'message'=>'Category update success!',
            'alert-type'=>'success',
        );
        return redirect()->route('category')->with($notification);

    }
    //category edit end
    //category delete start
    public function categoryDelete(Request $request,$id){

        Category::findOrFail($id)->delete();

        $notification = array(
            'message'=>'Category delete success!',
            'alert-type'=>'error',
        );
        return redirect()->back()->with($notification);
    }
    //category delete end

    //sub category start
    public function subIndex(){
        $subCategories =  SubCategory::latest()->get();
        $categories = Category::orderBy('category_name_en','ASC')->get();
         return view('admin.sub-category.index',compact('subCategories','categories'));
     }

     public function subCategoryStore(Request $request){

        $request->validate([
            'category_id'=>'required',
            'subcategory_name_en'=>'required',
            'subcategory_name_bn'=>'required',
            
        ]);

        SubCategory::insert([

            'category_id'=>$request->category_id,
            'subcategory_name_en'=>$request->subcategory_name_en,
            'subcategory_name_bn'=>$request->subcategory_name_bn,
            'subcategory_slug_en'=>strtolower(str_replace('','-',$request->subcategory_name_en)),
            'subcategory_slug_bn'=>str_replace('','-',$request->subcategory_name_bn),
            'created_at'=>Carbon::now(),
        ]);

        $notification = array(
            'message'=>'Category added successfully!',
            'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);

    }
    public function subCategoryEdit($cat_id){

        $subCategories= SubCategory::findOrFail($cat_id);
        $categories = Category::orderBy('category_name_en','ASC')->get();

        return view('admin.sub-category.edit',compact('subCategories','categories'));
    }

    public function subCategoryUpdate(Request $request, $id){

       // $subCatid = SubCategory::findOrFail($id);
        SubCategory::findOrFail($id)->update([

            'category_id'=>$request->category_id,
            'subcategory_name_en'=>$request->subcategory_name_en,
            'subcategory_name_bn'=>$request->subcategory_name_bn,
            'subcategory_slug_en'=>strtolower(str_replace('','-',$request->subcategory_name_en)),
            'subcategory_slug_bn'=>str_replace('','-',$request->subcategory_name_bn),
            'updated_at'=>Carbon::now(),
        ]);

        $notification = array(
            'message'=>'Sub Category updated successfully!',
            'alert-type'=>'success',
        );
        return redirect()->route('sub-category')->with($notification);
    }

    //sub category delete 

    public function subCategoryDelete(Request $request,$id){

        SubCategory::findOrFail($id)->delete();
        $notification = array(
            'message'=>'SubCategory deleted successfully!',
            'alert-type'=>'error',
        );
        return redirect()->back()->with($notification);
    }

    //sub category end 

     //Sub-sub-category

     public function subSubIndex(){

        $categories = Category::orderBy('category_name_en','ASC')->get();
        $subsubcategories = SubSubCategory::latest()->get();
        return view('admin.sub-sub-category.index',compact('categories','subsubcategories'));
    }

    //get sub cat with ajax

    public function getSubCat($cat_id){

        $subcat = SubCategory::where('category_id',$cat_id)->orderBy('subcategory_name_en','ASC')->get();
        return json_encode($subcat);
    }

    public function subsubCategoryStore(Request $request){

        $request->validate([
            'category_id'=>'required',
            'subcategory_id'=>'required',
            'subsubcategory_name_en'=>'required',
            'subsubcategory_name_bn'=>'required',
            
        ]);

        SubSubCategory::insert([

            'category_id'=>$request->category_id,
            'subcategory_id'=>$request->subcategory_id,
            'subsubcategory_name_en'=>$request->subsubcategory_name_en,
            'subsubcategory_name_bn'=>$request->subsubcategory_name_bn,
            'subsubcategory_slug_en'=>strtolower(str_replace('','-',$request->subsubcategory_name_en)),
            'subsubcategory_slug_bn'=>str_replace('','-',$request->subsubcategory_name_bn),
            'created_at'=>Carbon::now(),
        ]);

        $notification = array(
            'message'=>'Sub Sub Category added successfully!',
            'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);
    }

    //sub-sub category edit

    public function subSubCategoryEdit($subsubcat_id){
            
        $subsubcat = SubSubCategory::findOrFail($subsubcat_id);
        
        return view('admin.sub-sub-category.edit',compact('subsubcat'));

    }



    public function subSubCategoryUpdate(Request $request,$subsubcat_id){

        SubSubCategory::findOrFail($subsubcat_id)->update([

            'subsubcategory_name_en'=>$request->subsubcategory_name_en,
            'subsubcategory_name_bn'=>$request->subsubcategory_name_bn,
            'subsubcategory_slug_en'=>strtolower(str_replace('','-',$request->subsubcategory_name_en)),
            'subsubcategory_slug_bn'=>str_replace('','-',$request->subsubcategory_name_bn),
            'updated_at'=>Carbon::now(),
        ]);

        $notification = array(
            'message'=>'Sub SubCategory updated successfully!',
            'alert-type'=>'success',
        );
        return redirect()->route('sub-sub-category')->with($notification);

    }



    public function subSubCategoryDelete($subsubcat_id){

        SubSubCategory::findOrFail($subsubcat_id)->delete();

        $notification = array(
            'message'=>'Sub SubCategory deleted successfully!',
            'alert-type'=>'error',
        );
        return redirect()->back()->with($notification);

    }

}
