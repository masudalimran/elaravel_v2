<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    //
    public function show_orders_by_user_id($user_id){
        $index_cart=DB::table('payments')
                            ->leftJoin('cart_master','payments.cart_id', '=', 'cart_master.id')
                            ->leftJoin('users','payments.user_id', '=', 'users.id')
                            ->select('users.name','cart_master.cart_id','cart_master.is_checkout','payments.*')
                            ->where('users.id',$user_id)
                            ->get();

        $response = ["status" => "Success", "data"=> $index_cart];
        return response(json_encode($response), 200, ["Content-Type" => "application/json"]);

    }
}
