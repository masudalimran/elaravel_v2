<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VisitProductController_f extends Controller
{
    //
    public function product_view($id,$product_name){
        $product = DB::table('products')
        ->leftjoin('categories','products.category_id','=','categories.id')
        ->leftjoin('brands','products.brand_id','=','brands.id')
        ->leftjoin('sub_categories','products.subcategory_id','=','sub_categories.id')
        ->select('products.*','categories.category_name','sub_categories.sub_category_name','brands.brand_name')
        ->where('products.id',$id)
        ->first();

        $color=$product->product_color;
    	$product_color = explode(',', $color);

    	$size=$product->product_size;
        $product_size = explode(',', $size);

        return  view('pages.product_details',compact('product','product_color','product_size'));
    }

    public function AddCart(Request $request, $id)
    {
        $userId = Auth::id();
        $check_cart = DB::table('cart')->where('user_id',$userId)->where('cart_id',NULL)->where('product_id',$id)->first();
        $product = DB::table('products')->where('id', $id)->first();
        $data=array();
        $data['user_id']=$userId;
        $data['product_id']=$product->id;
        $data['product_name']=$product->product_name;
        $data['qty']=$request->qty;
        $data['product_size']=$request->size;
        $data['product_color']=$request->color;
        $data['asking_price']=$product->selling_price;
        $data['discount_price']=$product->discount_price;
        $data['price']=$product->selling_price - $product->discount_price;
        $data['image']=$product->image_1;

        if(Auth::check()){
                if($check_cart){
                    return response(json_encode([
                        "msg" => "Product Already exist in cart"
                    ]), 200, ["Content-Type" => "application/json"]);

                }else{
                    DB::table('cart')->insert($data);
                    $cart_count =  DB::table('cart')->where('cart_id',NULL)->where('user_id',$userId)->count();
                    $cart_subtotal=DB::table('cart')
                    ->select('cart.price')
                    ->where('cart_id',NULL)
                    ->where('user_id',$userId)
                    ->get();
                    return response(json_encode([
                        "msg" => "Product added to Cart",
                        "cart_count" => $cart_count,
                        'cart_subtotal' => $cart_subtotal
                    ]), 200, ["Content-Type" => "application/json"]);

                }
            }else{
                return response(json_encode([
                    "msg" => "Login with your account first"
                ]), 400, ["Content-Type" => "application/json"]);

        }
    }

    public function AddCart_from_details(Request $request, $id){
        $userId = Auth::id();
        $check_cart = DB::table('cart')->where('user_id',$userId)->where('product_id',$id)->first();
        $product = DB::table('products')->where('id', $id)->first();
        $data=array();
        $data['user_id']=$userId;
        $data['product_id']=$product->id;
        $data['product_name']=$product->product_name;
        $data['qty']=$request->qty;
        $data['product_size']=$request->size;
        $data['product_color']=$request->color;
        $data['asking_price']=$product->selling_price;
        $data['discount_price']=$product->discount_price;
        $data['price']=$product->selling_price - $product->discount_price;
        $data['image']=$product->image_1;

        if(Auth::check()){
                if($check_cart){
                    return response(json_encode([
                        "msg" => "Product Already exist in cart"
                    ]), 200, ["Content-Type" => "application/json"]);

                }else{
                    DB::table('cart')->insert($data);
                    $cart_count =  DB::table('cart')->where('user_id',$userId)->count();
                    $cart_subtotal=DB::table('cart')
                    ->select('cart.price')
                    ->where('user_id',$userId)
                    ->get();
                    return response(json_encode([
                        "msg" => "Product added to Cart",
                        "cart_count" => $cart_count,
                        'cart_subtotal' => $cart_subtotal
                    ]), 200, ["Content-Type" => "application/json"]);

                }
            }else{
                return response(json_encode([
                    "msg" => "Login with your account first"
                ]), 400, ["Content-Type" => "application/json"]);

        }
    }

}
