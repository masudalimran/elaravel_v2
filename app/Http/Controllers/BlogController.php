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
        // Session::get('lang');
        // session()->forget('lang');
        Session::put('lang','bangla');
        return redirect('/bn/');

    }

    public function english_blog(){
        // Session::get('lang');
        // session()->forget('lang');
        Session::put('lang','english');
        return redirect('/en/');
    }

    public function translate_en($source_language){
        $a = GoogleTranslate::trans($source_language, 'bn', 'en');
        // return response()->json($source_language);
        return response(json_encode([
            "a" => $a,
        ]), 200, ["Content-Type" => "application/json"]);
    }
    public function translate_bn($source_language){
        $a = GoogleTranslate::trans($source_language, 'en', 'bn');
        // return response()->json($source_language);
        return response(json_encode([
            "a" => $a,
        ]), 200, ["Content-Type" => "application/json"]);
    }

    public function blog_details($id){
        $blog_details = DB::table('posts')
        ->where('id',$id)
        ->first();

        $post=DB::table('posts')
        ->leftJoin('post_category','posts.category_id','post_category.id')
        ->select('posts.*','post_category.category_name_en','post_category.category_name_bn')
        // ->skip('id',$id)
        ->get();
        // $counter = 0;
        // foreach($post as $item){
        //     $counter++;
        //     if($item->id == $id){
        //         unset($post[$counter]);
        //     }
        // }

        return view('pages.blog_details',compact('blog_details','post'));
    }
}
