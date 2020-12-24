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
                    ->get();
        return view('admin.user_tab.index_user',compact('index_user'));
    }

    public function user_details($user_id){
        $user_details=DB::table('users')
                    ->where('id',$user_id)
                    ->first();

        return view('admin.user_tab.user_details',compact('user_details'));
    }

}
