<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminCartController extends Controller
{
    //
    public function index_cart(){

        $index_cart=DB::table('payments')
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
        // dd($cart_id);

        $cart_details=DB::table('cart')
        ->leftJoin('users','cart.user_id', '=', 'users.id')
        ->leftJoin('payments','cart.cart_id', '=', 'payments.cart_id')
        ->select('users.name','cart.*','payments.coupon_discount','payments.shipping_cost','payments.vat','payments.total_cost','payments.paid_with','payments.created_at')
        ->where('cart.cart_id',$cart_id)
        ->get();

        return view('admin.Admin_cart.cart_details',compact('cart_details'));
    }

    public function delete_cart_item($id){
        dd($id);
        // DB::table('cart')->where('id',$id)->delete();
        // $notification=array(
        //     'messege'=>'Cart Deleted successfully',
        //     'alert-type'=>'error'
        // );
        // return Redirect()->back()->with($notification);
    }

    public function edit_cart_item($cart_id){
        $product=DB::table('cart')->where('cart_id',$cart_id)->first();

        return view('admin.product.edit_product',compact('product'));
    }

}
