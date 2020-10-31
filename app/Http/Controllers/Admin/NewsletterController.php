<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class NewsletterController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function newsletter(){
        $newsletter=DB::table('newsletters')->get();
        return view('admin.newsletter.newsletter',compact('newsletter'));
    }

    public function delete_newsletter($id){
        DB::table('newsletters')->where('id',$id)->delete();
        $notification=array(
            'messege'=>'Subscriber Deleted Successfully ',
            'alert-type'=>'warning'
        );
        return Redirect()->back()->with($notification);
    }
}
