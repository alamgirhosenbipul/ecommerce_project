<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function addToCart(Request $request,$id){

        $product = Product::findOrFail($id);

        if($product->discount_price == NULL){

            Cart::add([
                'id'=>$id,
                'name'=>$request->product_name,
                'qty'=>$request->qty,
                'price'=>$product->selling_price,
                'weight'=> 1,
                'options'=>[
                    'image'=>$product->product_thumbnail,
                    'color'=>$request->color,
                    'size'=>$request->size,
                ],
            ]);

            return response()->json(['success'=>'Product added successfully on cart']);
                
        }else{
            Cart::add([
                'id'=>$id,
                'name'=>$request->product_name,
                'qty'=>$request->quantity,
                'price'=>$product->discount_price,
                'weight'=> 1,
                'options'=>[
                    'image'=>$product->product_thumbnail,
                    'color'=>$request->color,
                    'size'=>$request->size,
                    
                  
                ],
               
            ]); 
            
            return response()->json(['success'=>'Product added successfully on cart']);
        }

      
    }

    //mini cart

    public function miniCart(){

        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(

            'carts'=>$carts,
            'cartQty'=>$cartQty,
            'cartTotal'=>$cartTotal,
        ));

    }

    // miniCart product remove

    public function miniCartRemove($rowId){

        Cart::remove($rowId);

        return response()->json(['success'=>'product remove from cart']);
    }
}
