<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class AdminCartController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

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
        // dd($id);
        DB::table('cart')->where('id',$id)->delete();
        $notification=array(
            'messege'=>'Cart Deleted successfully',
            'alert-type'=>'error'
        );
        return Redirect()->back()->with($notification);
    }

    public function edit_cart_item($id){
        $product=DB::table('cart')->where('id',$id)->first();
        // dd($product);
        return view('admin.Admin_cart.edit_cart',compact('product'));
    }

    public function update_cart(Request $request, $id){
        // dd($request->old_image);
        $data=array();

        $data['product_name']=$request->product_name;
        $data['qty']=$request->qty;
        $data['product_size']=$request->product_size;
        $data['product_color']=$request->product_color;
        $data['asking_price']=$request->asking_price;
        $data['discount_price']=$request->discount_price;
        $price = $request->asking_price - $request->discount_price;
        $data['price']=$price;

        if($request->image == NULL){
            $image=$request->old_image;
            $data['image']=$image;
        }else{
            unlink($request->old_image);
            $image=$request->image;
            $image_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('public/media/product/'.$image_name);
            $data['image']='public/media/product/'.$image_name;
        }


        DB::table('cart')->where('id',$id)->update($data);
        $notification=array(
            'messege'=>'Cart Updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function cart_by_user(){
        $cart_by_user=DB::table('cart')
        ->leftJoin('users','cart.user_id', '=', 'users.id')
        ->leftJoin('payments','cart.cart_id', '=', 'payments.cart_id')
        ->select('users.name','cart.*','payments.coupon_discount','payments.shipping_cost','payments.vat','payments.total_cost','payments.paid_with','payments.created_at')
        // ->where('cart.cart_id',$cart_id)
        ->get();
        return view('admin.Admin_cart.cart_by_user',compact('cart_by_user'));
    }

}
