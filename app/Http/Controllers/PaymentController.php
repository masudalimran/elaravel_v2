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
        $payment_data = DB::table('payments')
        ->where('user_id',$userId)
        ->orderBy('id','desc')
        ->first();

        $charge = \Stripe\Charge::create([
        'amount' => $payment_data[5],
        'currency' => 'bdt',
        'description' => 'BISMIB FASHION DESC',
        'source' => $token,
        'metadata' => ['order_id' => '6735'],
        ]);

        dd($charge);
        // // return response()->json("adsadsadsad");



    }
}
