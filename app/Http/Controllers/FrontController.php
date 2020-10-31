<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function store_newsletter(Request $request){
        $validatedData = $request->validate([
        'email' => 'required|unique:newsletters|max:100',
        ]);
        $data=array();
        $data['email']=$request->email;
        DB::table('newsletters')->insert($data);
        $notification=array(
            'messege'=>'Thank you!!',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
