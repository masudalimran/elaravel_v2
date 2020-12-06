<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;


class PaymentController extends Controller
{
    //
    public function stripe_charge(Request $request){
        // Set your secret key. Remember to switch to your live secret key in production!
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey('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');

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
        'amount' => 999*100,
        'currency' => 'usd',
        'description' => 'BISMIB FASHION DESC',
        'source' => $token,
        'metadata' => ['order_id' => '6735'],
        ]);

        //  dd('charge');
        // return response()->json("adsadsadsad");



    }
}
