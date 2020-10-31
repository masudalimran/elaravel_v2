<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Model\Admin\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class BrandController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function brand(){
        $brand=Brand::all();
        return  view('admin.category.brand',compact('brand'));
    }

    public function store_brand(Request $request){
        $validatedData = $request->validate([
            'brand_name' => 'required|unique:brands|max:55',
        ]);

        $data=array();
        $data['brand_name']=$request->brand_name;
        $image=$request->file('brand_logo');
        if($image){
            $image_name=Str::random(5);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/media/brand/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);

            $data['brand_logo']=$image_url;
            $brand=DB::table('brands')
                        ->insert($data);
            $notification=array(
                'messege'=>'Brand inserted successfully',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }else{
            $brand=DB::table('brands')
                        ->insert($data);
            $notification=array(
                'messege'=>'Brand inserted without Image ',
                'alert-type'=>'warning'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function delete_brand($id){
        $data=DB::table('brands')->where('id',$id)->first();
        $image=$data->brand_logo;
        unlink($image);
        $brand=DB::table('brands')->where('id',$id)->delete();
        $notification=array(
            'messege'=>'Brand deleted successfully',
            'alert-type'=>'error'
        );
        return Redirect()->back()->with($notification);
    }
    public function edit_brand($id){
        $brand=DB::table('brands')->where('id',$id)->first();
        return view('admin.category.edit_brand',compact('brand'));
    }

    public function update_brand(Request $request, $id){
        $old_logo=$request->old_logo;
        $data=array();
        $data['brand_name']=$request->brand_name;
        $image=$request->file('brand_logo');
        if($image){
            unlink($old_logo);
            $image_name=Str::random(5);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/media/brand/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);

            $data['brand_logo']=$image_url;
            $brand=DB::table('brands')->where('id',$id)->update($data);
            $notification=array(
                'messege'=>'Brand Updated successfully',
                'alert-type'=>'success'
            );
            return Redirect()->route('brands')->with($notification);
        }else{
            $brand=DB::table('brands')->where('id',$id)->update($data);
            $notification=array(
                'messege'=>'Brand Updated without Image ',
                'alert-type'=>'warning'
            );
            return Redirect()->route('brands')->with($notification);
        }

    }
}
