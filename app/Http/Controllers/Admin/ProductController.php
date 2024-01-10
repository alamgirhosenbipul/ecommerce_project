<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function addProduct(){

        $categories = Category::latest()->get();
        return view('admin.product.create',compact('categories'));
    }

    public function getSubSubCat($subcat_id){

        $subsubcat = SubSubCategory::where('subCategory_Id',$subcat_id)->orderby('subsubcategory_name_en','ASC')->get();
        return json_encode($subsubcat);
      }
}
