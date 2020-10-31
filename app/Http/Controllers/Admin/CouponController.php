<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function coupon(){
        $coupon=DB::table('coupons')->get();
        return view('admin.coupon.coupon',compact('coupon'));
    }

    public function store_coupon(Request $request){
        $data=array();
        $data['coupon']=$request->coupon;
        $data['discount']=$request->discount;
        DB::table('coupons')->insert($data);
        $notification=array(
            'messege'=>'Coupon inserted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function delete_coupon($id){
        DB::table('coupons')->where('id',$id)->delete();
        $notification=array(
            'messege'=>'Coupon deleted successfully',
            'alert-type'=>'error'
        );
        return Redirect()->back()->with($notification);
    }

    public function edit_coupon($id){
        $coupon=DB::table('coupons')->where('id',$id)->first();
        return view('admin.coupon.edit_coupon',compact('coupon'));
    }

    public function update_coupon(Request $request, $id){
        $validatedData = $request->validate([
            'coupon' => 'required|max:55',
            'discount' => 'required|max:55',
        ]);

        $data=array();
        $data['coupon']=$request->coupon;
        $data['discount']=$request->discount;
        $update_data = DB::table('coupons')->where('id',$id)->update($data);
        if($update_data){
            $notification=array(
                'messege'=>'Coupons updated successfully',
                'alert-type'=>'success'
            );
            return Redirect()->route('admin.coupon')->with($notification);
        }else{
            $notification=array(
                'messege'=>'Nothing has been updated',
                'alert-type'=>'warning'
            );
            return Redirect()->route('admin.coupon')->with($notification);
        }
    }
}
