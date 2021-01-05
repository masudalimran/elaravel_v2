<?php

namespace App\Http\Controllers\Admin\SEO;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function edit_seo(){
        $seo=DB::table('seo')->first();
        return view('admin.SEO.edit_seo',compact('seo'));
        // return view('admin.SEO.edit_seo');
    }

    public function update_seo(Request $request){
        $data=array();
        $data['meta_title_en']=$request->meta_title_en;
        $data['meta_author_en']=$request->meta_author_en;
        $data['meta_tags_en']=$request->meta_tags_en;
        $data['meta_description_en']=$request->meta_description_en;
        $data['google_analytics_en']=$request->google_analytics_en;
        $data['bing_analytics_en']=$request->bing_analytics_en;
        $data['meta_title_bn']=$request->meta_title_bn;
        $data['meta_author_bn']=$request->meta_author_bn;
        $data['meta_tags_bn']=$request->meta_tags_bn;
        $data['meta_description_bn']=$request->meta_description_bn;
        $data['google_analytics_bn']=$request->google_analytics_bn;
        $data['bing_analytics_bn']=$request->bing_analytics_bn;

        DB::table('seo')->update($data);
        $notification=array(
            'messege'=>'Seo updated successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);


    }
}
