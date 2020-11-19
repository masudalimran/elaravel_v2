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
        $userId = Auth::id();
        $check_cart = DB::table('cart')->where('user_id',$userId)->where('product_id',$id)->first();
        $product = DB::table('products')->where('id', $id)->first();
        $data=array();
        $data['user_id']=$userId;
        $data['product_id']=$product->id;
        $data['product_name']=$product->product_name;
        $data['qty']=1;
        $data['product_size']=$product->product_size;
        $data['product_color']=$product->product_color;
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
    }

    public function show_cart(){
        $userId = Auth::id();
        $cart=DB::table('cart')
        ->leftjoin('products','cart.product_id','=','products.id')
        ->select('products.*','cart.user_id','cart.product_id','cart.product_name','cart.qty','cart.asking_price','cart.price','cart.image')
        ->where('user_id',$userId)
        ->get();

        // $product = DB::table('products')
        // ->leftjoin('categories','products.category_id','=','categories.id')
        // ->leftjoin('brands','products.brand_id','=','brands.id')
        // ->leftjoin('sub_categories','products.subcategory_id','=','sub_categories.id')
        // ->select('products.*','categories.category_name','sub_categories.sub_category_name','brands.brand_name')
        // ->where('products.id',$id)
        // ->first();
        // return response()->json($cart);
        return view('pages.cart',compact('cart'));

    }
}
