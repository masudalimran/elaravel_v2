<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminCartController extends Controller
{
    //
    public function index_cart(){
        // $index_cart=DB::table('cart')
        //         ->leftJoin('categories','products.category_id','=','categories.id')
        //         ->leftJoin('brands','products.brand_id','=','brands.id')
        //         ->leftJoin('sub_categories','products.subcategory_id','=','sub_categories.id')
        //         ->select('products.*','categories.category_name','brands.brand_name','sub_categories.sub_category_name')
        //         ->get();
        // return view('Admin_cart/index_cart',compact('index_product'));

        $index_cart = DB::table('payments')
                        ->leftJoin('cart_master','payments.cart_id', '=', 'cart_master.id')
                        ->leftJoin('users','payments.user_id', '=', 'users.id')
                        ->select('users.name','cart_master.is_checkout','payments.*')
                        ->get();
        return view('admin.Admin_cart.index_cart',compact('index_cart'));
    }

    //Delete cart
    public function delete_cart($id){

        DB::table('payments')->where('id',$id)->delete();
        $notification=array(
            'messege'=>'Cart Deleted successfully',
            'alert-type'=>'error'
        );
        return Redirect()->back()->with($notification);
    }

    //Cart Details
    public function cart_details($cart_id){

        $cart_details = DB::table('cart')
                        ->leftJoin('users','cart.user_id', '=', 'users.id')
                        ->select('users.name','cart.*')
                        ->where('cart_id',$cart_id)
                        ->first();
        return view('admin.Admin_cart.cart_details');
    }

}
