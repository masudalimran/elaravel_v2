<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe;


class PaymentController extends Controller
{
    //
    public function stripe_charge(Request $request){
        // Set your secret key. Remember to switch to your live secret key in production!
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey('sk_test_51HvdxJBuHtSEnNpz2oh1c1fnjcj025Ruoe5CNKJ3fgULv4q4WD0FQ5cUEERMo6htJM4wrSsM1xP7T6dc8ePOtsOv00bxvkuqDr');

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];

        // Inputted By Me
        $userId = Auth::id();
        DB::table('cart_master')
        ->insert(['user_id'=>$userId, 'is_checkout'=>1]);

        $cart_master_id = DB::table('cart_master')
        ->where('user_id',$userId)
        ->max('id');

        DB::table('cart')
        ->where('user_id',$userId)
        ->where('cart_id',NULL)
        ->update(['cart_id'=> $cart_master_id]);

        DB::table('payments')
        ->where('user_id',$userId)
        ->where('cart_id',$cart_master_id)
        ->update(['paid_with'=>'Stripe']);

        $payment_data = DB::table('payments')
        ->where('user_id',$userId)
        ->orderBy('id','desc')
        ->first();
        // Inputted By Me

        $charge = \Stripe\Charge::create([
        'amount' => (intval($payment_data->total_cost)*100),
        'currency' => 'bdt',
        'description' => 'PAID TO BISMIB FASHION',
        'source' => $token,
        'metadata' => ['order_id' => $cart_master_id,'coupon' => $payment_data->coupon_discount, 'shipping_cost' => $payment_data->shipping_cost],
        ]);
        // dd($cart_master_id);
        return view('pages.after_checkout_welcome',compact('charge'));
    }

    public function pay_with_stripe(){
        $userId = Auth::id();
        // DB::table('cart_master')
        // ->insert(['user_id'=>$userId, 'is_checkout'=>1]);

        $cart_master_id = DB::table('cart_master')
        ->where('user_id',$userId)
        ->max('id');

        // dd($cart_master_id);

        return redirect()->route('pay_with_stripe2',array('c_id' =>($cart_master_id+1) ));
        // return view('pages.pay_with.stripe_payment');
    }

    public function pay_with_stripe2(){
        $userId = Auth::id();
        $cart_master_id = DB::table('cart_master')
        ->where('user_id',$userId)
        ->max('id');
        // dd($cart_master_id+1);
        if(request('c_id') == $cart_master_id+1 ){
            return view('pages.pay_with.stripe_payment');
        }else{
            return redirect()->route('welcome');
        }
    }
}
