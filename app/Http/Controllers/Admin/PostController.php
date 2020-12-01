<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function add_post(){
        $category=DB::table('post_category')->get();
        return view('admin.blog.add_post',compact('category'));
    }

    public function store_post(Request $request){
        $validatedData = $request->validate([
            'post_title_en' => 'required|unique:posts',
            'post_title_bn' => 'required|unique:posts',
        ]);

        $data=array();
        $data['post_title_en']=$request->post_title_en;
        $data['post_title_bn']=$request->post_title_bn;
        $data['category_id']=$request->category_id;
        $data['details_en']=$request->details_en;
        $data['details_bn']=$request->details_bn;
        $data['post_image']=$request->post_image;

        $post_image=$request->file('post_image');
        if($post_image){
            $post_image_name = hexdec(uniqid()).'.'.$post_image->getClientOriginalExtension();
            Image::make($post_image)->resize(400,250)->save('public/media/post/'.$post_image_name);
            $data['post_image']='public/media/post/'.$post_image_name;
            DB::table('posts')->insert($data);
            $notification=array(
                'messege'=>'Post Created successfully',
                'alert-type'=>'success'
                );
            return Redirect()->back()->with($notification);
        }else{
            $data['post_image']='';
            DB::table('posts')->insert($data);
            $notification=array(
                'messege'=>'post Created without image ',
                'alert-type'=>'warning'
                );
            return Redirect()->back()->with($notification);
        }
    }

    public function all_post(){
        $all_post=DB::table('posts')
                    ->leftJoin('post_category','posts.category_id','=','post_category.id')
                    ->select('posts.*','post_category.*')
                    ->get();
        return view('admin.blog.all_post',compact('all_post'));
    }

    public function delete_post($id){
        $post=DB::table('posts')->where('id',$id)->first();
        $image=$post->post_image;
        unlink($image);
        DB::table('posts')->where('id',$id)->delete();
        $notification=array(
            'messege'=>'Post Deleted Successfully',
            'alert-type'=>'error'
            );
        return Redirect()->back()->with($notification);
    }

    public function edit_post($id){
        $post=DB::table('posts')->where('id',$id)->first();
        return view('admin.blog.edit_post',compact('post'));
    }

    public function update_post(Request $request,$id){
        // $validatedData = $request->validate([
        //     'post_title_en' => 'unique:posts',
        //     'post_title_bn' => 'unique:posts',
        // ]);

        $old_post_image=$request->old_post_image;
        $data=array();
        $data['post_title_en']=$request->post_title_en;
        $data['post_title_bn']=$request->post_title_bn;
        $data['category_id']=$request->category_id;
        $data['details_en']=$request->details_en;
        $data['details_bn']=$request->details_bn;
        $data['post_image']=$request->post_image;

        $post_image=$request->file('post_image');
        if($post_image){
            unlink($old_post_image);
            $post_image_name = hexdec(uniqid()).'.'.$post_image->getClientOriginalExtension();
            Image::make($post_image)->resize(400,250)->save('public/media/post/'.$post_image_name);
            $data['post_image']='public/media/post/'.$post_image_name;
            DB::table('posts')->where('id',$id)->update($data);
            $notification=array(
                'messege'=>'Post Updated successfully',
                'alert-type'=>'success'
                );
            return Redirect()->route('all.blogpost')->with($notification);
        }else{
            $data['post_image']=$old_post_image;
            DB::table('posts')->where('id',$id)->update($data);
            $notification=array(
                'messege'=>'Post Updated Without Image ',
                'alert-type'=>'warning'
                );
            return Redirect()->route('all.blogpost')->with($notification);
        }
    }

    public function post_category(){
        return view('admin.blog.post_category');
    }

    public function store_post_category(Request $request){
        // $validatedData = $request->validate([
        //     'category_name_en' => 'required|unique:post_category',
        //     'category_name_bn' => 'required|unique:post_category',
        // ]);

        $data=array();
        $data['category_name_en']=$request->post_category_en;
        $data['category_name_bn']=$request->post_category_bn;

        DB::table('post_category')
        ->insert($data);

        $notification=array(
            'messege'=>'Post Category Added successfully',
            'alert-type'=>'success'
            );
        return Redirect()->back()->with($notification);
        // return response() -> json("completed");
    }

}
