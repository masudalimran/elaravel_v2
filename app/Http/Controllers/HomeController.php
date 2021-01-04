<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;




class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = Auth::id();
        $user_cart_info=DB::table('payments')
                        ->leftJoin('cart_master','payments.cart_id', '=', 'cart_master.id')
                        ->leftJoin('users','payments.user_id', '=', 'users.id')
                        ->select('users.name','users.id AS user_id','cart_master.is_checkout','payments.*')
                        ->get();
        return view('home',compact('user_cart_info'));
    }

//Order History

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

        $forntend_cart_details=DB::table('cart')
        ->leftJoin('users','cart.user_id', '=', 'users.id')
        ->leftJoin('payments','cart.cart_id', '=', 'payments.cart_id')
        ->select('users.name','cart.*','payments.coupon_discount','payments.shipping_cost','payments.vat','payments.total_cost','payments.paid_with','payments.created_at')
        ->where('cart.cart_id',$cart_id)
        ->get();

        return view('Home_order_history.home_order_history',compact('forntend_cart_details'));
    }

//Order History




    public function welcome()
    {
        return view('pages.index');
    }

    public function changePassword(){
        return view('auth.changepassword');
    }

    public function updatePassword(Request $request)
    {
      $password=Auth::user()->password;
      $oldpass=$request->oldpass;
      $newpass=$request->password;
      $confirm=$request->password_confirmation;
      if (Hash::check($oldpass,$password)) {
           if ($newpass === $confirm) {
                      $user=User::find(Auth::id());
                      $user->password=Hash::make($request->password);
                      $user->save();
                      Auth::logout();
                      $notification=array(
                        'messege'=>'Password Changed Successfully ! Now Login with Your New Password',
                        'alert-type'=>'success'
                         );
                       return Redirect()->route('login')->with($notification);
                 }else{
                     $notification=array(
                        'messege'=>'New password and Confirm Password not matched!',
                        'alert-type'=>'error'
                         );
                       return Redirect()->back()->with($notification);
                 }
      }else{
        $notification=array(
                'messege'=>'Old Password not matched!',
                'alert-type'=>'error'
                 );
               return Redirect()->back()->with($notification);
      }

    }

    public function Logout()
    {
        // $logout= Auth::logout();
            Auth::logout();
            $notification=array(
                'messege'=>'Successfully Logout',
                'alert-type'=>'success'
                 );
             return Redirect()->route('login')->with($notification);


    }
}
