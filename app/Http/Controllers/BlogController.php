<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Stichoza\GoogleTranslate\GoogleTranslate;


class BlogController extends Controller
{
    //
    public function show_blog(){
        $post=DB::table('posts')
        ->leftJoin('post_category','posts.category_id','post_category.id')
        ->select('posts.*','post_category.category_name_en','post_category.category_name_bn')
        ->get();
        return view('pages.blog',compact('post'));
    }

    public function bangla_blog(){
        Session::get('lang');
        session()->forget('lang');
        Session::put('lang','bangla');
        return redirect()->back();

    }

    public function english_blog(){
        Session::get('lang');
        session()->forget('lang');
        Session::put('lang','english');
        return redirect()->back();
    }

    public function translate($source_language, $blog_id){
        // $a = GoogleTranslate::trans($source_language, 'fr', 'en');
        return response()->json($source_language,$blog_id);
        // return response(json_encode([
        //     "a" => $a,
        // ]), 200, ["Content-Type" => "application/json"]);
    }
}
