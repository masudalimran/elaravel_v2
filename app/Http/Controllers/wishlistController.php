<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class wishlistController extends Controller
{
    //
    public function add_wishlist($language, $id){
        $userId = Auth::id();
        $wishlist = DB::table('wishlists')
        ->where('user_id',$userId)
        ->where('product_id',$id)
        ->first();
        $data = array('user_id'=>$userId, 'product_id'=>$id);

        if(Auth::check()){
            if($wishlist){
                return response(json_encode([
                    "msg" => "Product Already exist in wishlist"
                ]), 200, ["Content-Type" => "application/json"]);

            }else{
                DB::table('wishlists')->insert($data);
                $wishlist_count =  DB::table('wishlists')->where('user_id',$userId)->count();
                return response(json_encode([
                    "msg" => "Product added to wishlist",
                    "wishlist_count" => $wishlist_count
                ]), 200, ["Content-Type" => "application/json"]);
            }
        }else{
            return response(json_encode([
                "msg" => "Login with your account first"
            ]), 400, ["Content-Type" => "application/json"]);

        }
    }

    public function show_wishlist(){
        $userId = Auth::id();
        $wishlist=DB::table('products')
        ->leftjoin('wishlists','products.id','=','wishlists.product_id')
        ->leftjoin('categories','products.category_id','=','categories.id')
        ->leftjoin('brands','products.brand_id','=','brands.id')
        ->leftjoin('sub_categories','products.subcategory_id','=','sub_categories.id')
        ->select('products.*','wishlists.*','categories.*','brands.*','sub_categories.*')
        ->where('wishlists.user_id',$userId)
        ->get();

        return view('pages.wishlist',compact('wishlist'));
        // return response()->json($wishlist);

    }

    public function remove_wishlist($product_id){
        $userId = Auth::id();
        DB::table('wishlists')
        ->where('product_id',$product_id)
        ->where('user_id',$userId)
        ->delete();

        return response(json_encode([
            "msg" => "Wishlist removed Successfully",
            "product_id" => $product_id
        ]), 200, ["Content-Type" => "application/json"]);

    }
}
