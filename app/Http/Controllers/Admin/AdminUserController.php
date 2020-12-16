<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index_user(){

        $index_user=DB::table('users')
                    // ->leftJoin('cart_master','payments.cart_id', '=', 'cart_master.id')
                    // ->leftJoin('users','payments.user_id', '=', 'users.id')
                    // ->select('users.name','cart_master.is_checkout','payments.*')
                    ->get();
        return view('admin.user_tab.index_user',compact('index_user'));
    }
}
