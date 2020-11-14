<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class wishlistController extends Controller
{
    //
    public function add_wishlist($id){
        $userId = Auth::id();
        $wishlist = DB::table('wishlists')->where('user_id',$userId)->where('product_id',$id)->first();
        $data = array('user_id'=>$userId, 'product_id'=>$id);

        if(Auth::check()){
            if($wishlist){
                return response(json_encode([
                    "msg" => "Product Already exist in wishlist"
                ]), 200, ["Content-Type" => "application/json"]);

            }else{
                DB::table('wishlists')->insert($data);
                return response(json_encode([
                    "msg" => "Product added to wishlist"
                ]), 200, ["Content-Type" => "application/json"]);

            }
        }else{
            return response(json_encode([
                "msg" => "Login with your account first"
            ]), 400, ["Content-Type" => "application/json"]);

        }
    }
}
