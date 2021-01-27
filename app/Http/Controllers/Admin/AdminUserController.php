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

    public function user_delete($user_id){
        DB::table('users')
                    ->where('id',$user_id)
                    ->delete();

        $notification = array(
                'messege'=>'Deleted Successfully',
                'alert-type'=>'error'
        );
        return Redirect()->back()->with($notification);
    }


    public function index_admin(){
        $index_admin=DB::table('admins')
                    ->get();
        return view('admin.user_tab.index_admin',compact('index_admin'));
    }

    public function admin_details($admin_id){
        $admin_details=DB::table('admins')
                    ->where('id',$admin_id)
                    ->first();

        return view('admin.user_tab.admin_details',compact('admin_details'));
    }

    public function admin_delete($admin_id){
        DB::table('admins')
                    ->where('id',$admin_id)
                    ->delete();

        $notification = array(
                'messege'=>'Deleted Successfully',
                'alert-type'=>'error'
        );
        return Redirect()->back()->with($notification);
    }

}
