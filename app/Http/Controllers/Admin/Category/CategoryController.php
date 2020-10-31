<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Model\Admin\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function category(){
        $category=Category::all();
        return  view('admin.category.category',compact('category'));
    }

    public function  store_category(Request $request){
        $validatedData = $request->validate([
            'category_name' => 'required|unique:categories|max:55',
        ]);
        // $data=array();
        // $data['category_name']=$request->category_name;
        // DB::table('categories')->insert($data);
        $category = new Category();
        $category->category_name = $request->category_name;
        $category->save();
        $notification=array(
            'messege'=>'Category inserted successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function delete_category($id){
        DB::table('categories')->where('id',$id)->delete();
        $notification=array(
            'messege'=>'Category deleted successfully',
            'alert-type'=>'error'
        );
        return Redirect()->back()->with($notification);
    }

    public function edit_category($id){
        $category=DB::table('categories')->where('id',$id)->first();
        return view('admin.category.edit_category',compact('category'));
    }
    public function update_category(Request $request, $id){
        $validatedData = $request->validate([
            'category_name' => 'required|max:55',
        ]);

        $data=array();
        $data['category_name']=$request->category_name;
        $update_data = DB::table('categories')->where('id',$id)->update($data);
        if($update_data){
            $notification=array(
                'messege'=>'Category updated successfully',
                'alert-type'=>'success'
            );
            return Redirect()->route('categories')->with($notification);
        }else{
            $notification=array(
                'messege'=>'Nothing to update',
                'alert-type'=>'warning'
            );
            return Redirect()->route('categories')->with($notification);
        }

    }



}
