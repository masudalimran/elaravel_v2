<?php

namespace App\Http\Controllers;

// use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

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
                    $cart_count =  DB::table('cart')->where('user_id',$userId)->count();
                    return response(json_encode([
                        "msg" => "Product added to Cart",
                        "cart_count" => $cart_count
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

        $coupon_minus=0;
        $active_coupon=0;
        return view('pages.cart',compact('cart','coupon_minus','active_coupon'));

    }

    public function add_coupon(Request $request, $user_id,$sum_total){
        // echo "$sum_total";
         $coupon=DB::table('coupons')
        ->where('coupon',$request->coupon_input)
        ->first();

        $active_coupon=0;

        if($coupon != NULL){
            $coupon_minus=0;
            $coupon_data=$coupon->discount;
            $coupon_minus += (($sum_total * $coupon_data)/100);
            $cart=DB::table('cart')
            ->leftjoin('products','cart.product_id','=','products.id')
            ->select('products.*','cart.user_id','cart.product_id','cart.product_name','cart.qty','cart.asking_price','cart.price','cart.image')
            ->where('user_id',$user_id)
            ->get();
            // return response() -> json($coupon_minus) ;
            $active_coupon = $coupon_data;
            // return view('pages.cart',compact('cart','coupon_minus','active_coupon'));
            return response(json_encode([
                // "msg" => "Product Already exist in cart",
                "cart" => $cart,
                "coupon_minus" => $coupon_minus,
                "active_coupon" => $active_coupon,
                "coupon_input" => $request->coupon_input,
                "coupon_percentage" => $coupon_data
            ]), 200, ["Content-Type" => "application/json"]);

        }
        //  return response() -> json($coupon) ;
    }

    public function remove_cart($id,$active_coupon){
        DB::table('cart')
        ->where('user_id',$id)
        ->delete();

        $cart=DB::table('cart')
        ->leftjoin('products','cart.product_id','=','products.id')
        ->select('products.*','cart.user_id','cart.product_id','cart.product_name','cart.qty','cart.asking_price','cart.price','cart.image')
        ->where('user_id',$id)
        ->get();
        $active_coupon=0;
        $coupon_minus=0;
        return view('pages.cart',compact('cart','coupon_minus','active_coupon'));
    }

    public function remove_item_with_coupon($product_id,$product_price,$coupon_minus_final,$active_coupon_percentage_final, $coupon_input, $cart_total_final){
        // dd($product_id. ', '.$coupon_minus.' , '.$active_coupon);

        $userId = Auth::id();
        DB::table('cart')
        ->where('user_id',$userId)
        ->where('product_id',$product_id)
        ->delete();
        // $coupon_minus = $coupon_minus_final;
        // $coupon_minus-=($product_price*($active_coupon_percentage_final/100));
        // $cart_total = $cart_total_final-$product_price;
        // $cart_total_after_coupon = $cart_total - $coupon_minus;
        $active_coupon = $coupon_input;

        $final_cart=DB::table('cart')
        ->leftjoin('products','cart.product_id','=','products.id')
        ->select('products.*','cart.user_id','cart.product_id','cart.product_name','cart.qty','cart.asking_price','cart.price','cart.image')
        ->where('user_id',$userId)
        ->get();

        return response(json_encode([
            "msg" => "Item removed Successfully",
            "final_cart" => $final_cart,
            "product_id" => $product_id,
            // "coupon_minus" => $coupon_minus,
            "active_coupon_percentage" => $active_coupon_percentage_final,
            "coupon_input" => $active_coupon,
            // "cart_total" => $cart_total,
            // 'cart_total_after_coupon' => $cart_total_after_coupon
            // "coupon_percentage" => $coupon_data
        ]), 200, ["Content-Type" => "application/json"]);
    }

    public function remove_item_without_coupon($product_id,$price,$cart_total){

        $userId = Auth::id();
        DB::table('cart')
        ->where('user_id',$userId)
        ->where('product_id',$product_id)
        ->delete();

        $final_cart=DB::table('cart')
        ->leftjoin('products','cart.product_id','=','products.id')
        ->select('products.*','cart.user_id','cart.product_id','cart.product_name','cart.qty','cart.asking_price','cart.price','cart.image')
        ->where('user_id',$userId)
        ->get();

        // $new_cart_price = $price;

        return response(json_encode([
            "msg" => "Item removed Successfully",
            "product_id" => $product_id,
            "final_cart" => $final_cart,
            // "new_cart_price" => $new_cart_price
        ]), 200, ["Content-Type" => "application/json"]);
    }

    public function checkout(Request $request){
        $a = $request->product_id;
        return response() -> json($a) ;

        // if(Auth::check()){
        //     $notification = array(
        //         'messege'=>'Login First',
        //         'alert-type'=>'success'
        // );
        // return Redirect()->route('home')->with($notification);

        // }
    }

    public function update_cart($product_id, $qty){
        $userId = Auth::id();
        $cart=DB::table('cart')
        //->leftjoin('products','cart.product_id','=','products.id')
        //->select('products.*','cart.user_id','cart.product_id','cart.product_name','cart.qty','cart.asking_price','cart.price','cart.image')
        ->where('user_id',$userId)
        ->where('product_id',$product_id)
        ->update(['qty'=>$qty]);

        $final_cart=DB::table('cart')
        ->leftjoin('products','cart.product_id','=','products.id')
        ->select('products.*','cart.user_id','cart.product_id','cart.product_name','cart.qty','cart.asking_price','cart.price','cart.image')
        ->where('user_id',$userId)
        ->get();

        $coupon_minus=0;
        $active_coupon=0;
        return response(json_encode([
            // "msg" => "Login with your account first",
            "final_cart" => $final_cart
        ]), 200, ["Content-Type" => "application/json"]);
    }
}
