<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function sub_categories(){
        $category=DB::table('categories')->get();
        $sub_category=DB::table('sub_categories')
                        ->join('categories','sub_categories.category_id','categories.id')
                        ->select('sub_categories.*','categories.category_name')
                        ->get();
        return view('admin.category.sub_category',compact('category','sub_category'));
    }

    public function store_sub_category(Request $request){
        $validatedData = $request->validate([
            'category_id' => 'required|max:55',
            'sub_category_name' => 'required|unique:sub_categories|max:55',
        ]);
        $data=array();
        $data['category_id']=$request->category_id;
        $data['sub_category_name']=$request->sub_category_name;
        DB::table('sub_categories')->insert($data);
        $notification=array(
            'messege'=>'Sub Category inserted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function delete_sub_category($id){
        DB::table('sub_categories')->where('id',$id)->delete();
        $notification=array(
            'messege'=>'Sub Category deleted successfully',
            'alert-type'=>'error'
        );
        return Redirect()->back()->with($notification);
    }

    public function edit_sub_category($id){
        $sub_category=DB::table('sub_categories')->where('id',$id)->first();
        $category=DB::table('categories')->get();
        return view('admin.category.edit_sub_category',compact('sub_category','category'));
    }

    public function update_sub_category(Request $request, $id){
        $validatedData = $request->validate([
            'sub_category_name' => 'required|max:55',
        ]);

        $data=array();
        $data['category_id']=$request->category_id;
        $data['sub_category_name']=$request->sub_category_name;
        $update_data = DB::table('sub_categories')->where('id',$id)->update($data);
        if($update_data){
            $notification=array(
                'messege'=>'Category updated successfully',
                'alert-type'=>'success'
            );
            return Redirect()->route('sub.categories')->with($notification);
        }else{
            $notification=array(
                'messege'=>'Nothing has been updated',
                'alert-type'=>'warning'
            );
            return Redirect()->route('sub.categories')->with($notification);
        }
    }
}
