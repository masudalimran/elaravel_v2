<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    //
    public function add_cart($id){
        // dd($id);
        // console.log("hello");


        //Cart::add($data);
        // return response()->json($data);
        // return response(json_encode([
        //     "msg" => "Product Already exist in cart"
        // ]), 200, ["Content-Type" => "application/json"]);
        $userId = Auth::id();
        $check_cart = DB::table('cart')->where('user_id',$userId)->where('product_id',$id)->first();
        $product = DB::table('products')->where('id', $id)->first();
        $data=array();
        $data['user_id']=$userId;
        $data['product_id']=$product->id;
        $data['product_name']=$product->product_name;
        $data['qty']=1;
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
                    return response(json_encode([
                        "msg" => "Product added to Cart"
                    ]), 200, ["Content-Type" => "application/json"]);

                }
            }else{
                return response(json_encode([
                    "msg" => "Login with your account first"
                ]), 400, ["Content-Type" => "application/json"]);

        }




        // $userId = Auth::id();
        // $wishlist = DB::table('wishlists')->where('user_id',$userId)->where('product_id',$id)->first();
        // $data = array('user_id'=>$userId, 'product_id'=>$id);

        // if(Auth::check()){
        //     if($wishlist){
        //         return response(json_encode([
        //             "msg" => "Product Already exist in wishlist"
        //         ]), 200, ["Content-Type" => "application/json"]);

        //     }else{
        //         DB::table('wishlists')->insert($data);
        //         return response(json_encode([
        //             "msg" => "Product added to wishlist"
        //         ]), 200, ["Content-Type" => "application/json"]);

        //     }
        // }else{
        //     return response(json_encode([
        //         "msg" => "Login with your account first"
        //     ]), 400, ["Content-Type" => "application/json"]);

        // }
        // dd($product);
    }
}
