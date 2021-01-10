<?php

namespace App\Http\Controllers\Admin\Expense_sheet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class ExpenseController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function create_expense(){
        return view('admin.Expense_sheet.create_expense');
    }

    public function view_expense_sheet(){
        return view('admin.Expense_sheet.show_expense_sheet');
    }

    public function store_expense_category(Request $request){
        $data=array();
        $image=array();
        $data['exp_category_image']= "";
        $data['exp_category']=$request->exp_category_name;
        $data['exp_category_details']=$request->exp_category_details;
        $image = $request->exp_category_image;
        $image_name ="";
        if( $image){
            foreach($image as $c_image){
                    $image_name = hexdec(uniqid()).'.'.$c_image->getClientOriginalExtension();
                    Image::make($c_image)->resize(300,300)->save('public/media/expense_sheet/'.$image_name);
                    $data_image='public/media/expense_sheet/'.$image_name;
                    if($data['exp_category_image']){
                        $data['exp_category_image']= $data['exp_category_image'].'::::'. $data_image;
                    }else{
                        $data['exp_category_image']= $data_image;
                    }
            }
        }
        DB::table('expense_category')->insert($data);
        $expense_category = DB::table('expense_category')->get();

        $notification=array(
            'messege'=>'Expense Category Created Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification,$expense_category);
    }

    public function store_expense_sheet(Request $request){
        $data=array();
        $image=array();
        $data['exp_document']= "";
        $data['exp_name']=$request->exp_name;
        $data['exp_amount']=$request->exp_amount;
        $data['exp_date']=dmyToYmd($request->exp_date);
        $data['exp_comment']=$request->exp_comment;
        $data['exp_category']=$request->selected_expense_category;
        $image = $request->exp_document;
        $image_name ="";
        if( $image){
            foreach($image as $e_image){
                    $image_name = hexdec(uniqid()).'.'.$e_image->getClientOriginalExtension();
                    Image::make($e_image)->resize(300,300)->save('public/media/expense_sheet_document/'.$image_name);
                    $data_image='public/media/expense_sheet_document/'.$image_name;
                    if($data['exp_document']){
                        $data['exp_document']= $data['exp_document'].'::::'. $data_image;
                    }else{
                        $data['exp_document']= $data_image;
                    }
            }
        }
        DB::table('expense_table')->insert($data);
        $notification=array(
            'messege'=>'Expense added Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function view_expense(){
        $expense_table_data = DB::table('expense_table')
                        ->leftjoin('expense_category','expense_table.exp_category','=','expense_category.id')
                        ->select('expense_category.exp_category AS category_name','expense_category.exp_category_details','expense_category.exp_category_image','expense_table.*')
                        ->get();
        // dd($expense_table_data[7]->expense_document);
        return view('admin.Expense_sheet.view_expense',compact('expense_table_data'));
    }


    public function edit_expense($exp_id){
        $expense_table_data=DB::table('expense_table')->where('id',$exp_id)->first();

        return view('admin.Expense_sheet.edit_expense',compact('expense_table_data'));
    }


    public function delete_expense_image($exp_id,$exp_img_index){
        // dd($exp_img_index);
        $expense_table_data=DB::table('expense_table')->where('id',$exp_id)->first();
        $exp_image=$expense_table_data->exp_document;

        $image=$expense_table_data->exp_document;
        $exp_image_explode = explode('::::', $image);
        $image_to_delete = $exp_image_explode[$exp_img_index];
        if($image_to_delete){
            unlink($image_to_delete);
        }
        if(strpos($exp_image,'::::')){
            if($exp_img_index == 0){
                $image_to_delete_a = $image_to_delete."::::";
                $updated_exp_image =  str_replace($image_to_delete_a,'', $exp_image);
            }else{
                $image_to_delete_b = "::::".$image_to_delete;
                $updated_exp_image =  str_replace($image_to_delete_b,'', $exp_image);
            }
        }else{
            $updated_exp_image=Null;
        }
        // $update_to_database = "";
        // dd($updated_exp_image);
        DB::table('expense_table')->where('id',$exp_id)->update(['exp_document'=>$updated_exp_image]);
        $notification=array(
            'messege'=>'Image Deleted',
            'alert-type'=>'error'
        );
        return Redirect()->back()->with($notification);


    }

    public function update_expense(Request $request,$exp_id){
        $previous_image = DB::table('expense_table')->where('id',$exp_id)->first();
        $data=array();
        $image=array();
        $data['exp_document']= "";
        $data['exp_name']=$request->exp_name;
        $data['exp_amount']=$request->exp_amount;
        $data['exp_date']=dmyToYmd($request->exp_date);
        $data['exp_comment']=$request->exp_comment;
        $data['exp_category']=$request->exp_category;
        $image = $request->exp_document;
        $image_name = "";
        if($previous_image->exp_document){
            $data['exp_document']= $previous_image->exp_document;
        }
        if( $image){
            foreach($image as $e_image){
                    $image_name = hexdec(uniqid()).'.'.$e_image->getClientOriginalExtension();
                    Image::make($e_image)->resize(300,300)->save('public/media/expense_sheet_document/'.$image_name);
                    $data_image='public/media/expense_sheet_document/'.$image_name;
                    if($data['exp_document']){
                        $data['exp_document']= $data['exp_document'].'::::'. $data_image;
                    }else{
                        $data['exp_document']= $data_image;
                    }
            }
        }
        DB::table('expense_table')->where('id',$exp_id)->update($data);
        $notification=array(
            'messege'=>'Expense Updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function delete_expense($exp_id){
        $expense_table_data=DB::table('expense_table')->where('id',$exp_id)->first();
        $exp_image=$expense_table_data->exp_document;

        if($exp_image){
            $image=$expense_table_data->exp_document;
            $exp_image = explode('::::', $image);
            foreach($exp_image as $v_exp_image){
                unlink($v_exp_image);
            }
        }else{

        }
        DB::table('expense_table')->where('id',$exp_id)->delete();
        $notification=array(
            'messege'=>'Expense Deleted successfully',
            'alert-type'=>'error'
        );
        return Redirect()->back()->with($notification);
    }
    public function view_expense_details($exp_id){
        $expense_table_data = DB::table('expense_table')
                        ->leftjoin('expense_category','expense_table.exp_category','=','expense_category.id')
                        ->select('expense_category.exp_category AS category_name','expense_category.exp_category_details','expense_category.exp_category_image','expense_table.*')
                        ->where('expense_table.id',$exp_id)
                        ->first();
        // dd($expense_table_data[7]->expense_document);
        return view('admin.Expense_sheet.view_expense_details',compact('expense_table_data'));
    }

    public function view_expense_category(){
        $expense_category_data=DB::table('expense_category')->get();
        return view('admin.Expense_sheet.view_expense_category',compact('expense_category_data'));
    }

    public function edit_expense_category($exp_category_id){
        $expense_category_table_data=DB::table('expense_category')->where('id',$exp_category_id)->first();
        return view('admin.Expense_sheet.edit_expense_category',compact('expense_category_table_data'));
    }

    public function update_expense_category(Request $request, $category_id){
        $previous_image = DB::table('expense_category')->where('id',$category_id)->first();
        $data=array();
        $image=array();
        $data['exp_category_image']= "";
        $data['exp_category']=$request->exp_category;
        $data['exp_category_details']=$request->exp_category_details;
        $image = $request->exp_category_image;
        $image_name = "";
        if($previous_image->exp_category_image){
            $data['exp_category_image']= $previous_image->exp_category_image;
        }
        if( $image){
            foreach($image as $e_image){
                    $image_name = hexdec(uniqid()).'.'.$e_image->getClientOriginalExtension();
                    Image::make($e_image)->resize(300,300)->save('public/media/expense_sheet_document/'.$image_name);
                    $data_image='public/media/expense_sheet_document/'.$image_name;
                    if($data['exp_category_image']){
                        $data['exp_category_image']= $data['exp_category_image'].'::::'. $data_image;
                    }else{
                        $data['exp_category_image']= $data_image;
                    }
            }
        }
        DB::table('expense_category')->where('id',$category_id)->update($data);
        $notification=array(
            'messege'=>'Expense Category updated Updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function delete_expense_category_image($exp_id,$exp_img_index){
        // dd($exp_img_index);
        $expense_table_data=DB::table('expense_category')->where('id',$exp_id)->first();
        $exp_image=$expense_table_data->exp_category_image;

        $image=$expense_table_data->exp_category_image;
        $exp_image_explode = explode('::::', $image);
        $image_to_delete = $exp_image_explode[$exp_img_index];
        if($image_to_delete){
            unlink($image_to_delete);
        }
        if(strpos($exp_image,'::::')){
            if($exp_img_index == 0){
                $image_to_delete_a = $image_to_delete."::::";
                $updated_exp_image =  str_replace($image_to_delete_a,'', $exp_image);
            }else{
                $image_to_delete_b = "::::".$image_to_delete;
                $updated_exp_image =  str_replace($image_to_delete_b,'', $exp_image);
            }
        }else{
            $updated_exp_image=Null;
        }
        // $update_to_database = "";
        // dd($updated_exp_image);
        DB::table('expense_category')->where('id',$exp_id)->update(['exp_category_image'=>$updated_exp_image]);
        $notification=array(
            'messege'=>'Image Deleted',
            'alert-type'=>'error'
        );
        return Redirect()->back()->with($notification);
    }

    public function delete_expense_category($exp_category_id){
        //Delete Expense
        $expense_table_data=DB::table('expense_table')->where('exp_category',$exp_category_id)->get();
        foreach($expense_table_data as $v_expense_table_data){
            $exp_image=$v_expense_table_data->exp_document;

            if($exp_image){
                $image=$v_expense_table_data->exp_document;
                $exp_image = explode('::::', $image);
                foreach($exp_image as $v_exp_image){
                    unlink($v_exp_image);
                }
            }else{

            }
        }
        DB::table('expense_table')->where('exp_category',$exp_category_id)->delete();

        //Delete Expense Category
        $expense_table_data=DB::table('expense_category')->where('id',$exp_category_id)->first();
        $exp_image=$expense_table_data->exp_category_image;

        if($exp_image){
            $image=$expense_table_data->exp_category_image;
            $exp_image = explode('::::', $image);
            foreach($exp_image as $v_exp_image){
                unlink($v_exp_image);
            }
        }else{

        }
        DB::table('expense_category')->where('id',$exp_category_id)->delete();
        $notification=array(
            'messege'=>'Expense Category Deleted successfully',
            'alert-type'=>'error'
        );
        return Redirect()->back()->with($notification);
    }
    public function view_expense_category_details($exp_category_id){
        $expense_category_data = DB::table('expense_category')
                        ->leftjoin('expense_table','expense_category.id','=','expense_table.exp_category')
                        ->select('expense_category.id as category_id','expense_category.exp_category AS category_name','expense_category.exp_category_details','expense_category.exp_category_image','expense_table.*')
                        ->where('expense_category.id',$exp_category_id)
                        ->get();
        return view('admin.Expense_sheet.view_expense_category_details',compact('expense_category_data'));
    }

    public function search_between_dates(Request $request,$exp_category_id){
        $start_date = dmyToYmd($request->start_date);
        $end_date = dmyToYmd($request->end_date);
        // dd($exp_category_id);

        $expense_category_data = DB::table('expense_category')
                        ->leftjoin('expense_table','expense_category.id','=','expense_table.exp_category')
                        ->select('expense_category.id as category_id','expense_category.exp_category AS category_name','expense_category.exp_category_details','expense_category.exp_category_image','expense_table.*')
                        ->where('expense_category.id',$exp_category_id)
                        ->whereBetween('expense_table.exp_date',[date($start_date),date($end_date)])
                        ->get();
                        // dd($expense_category_data);
        return view('admin.Expense_sheet.view_expense_category_details',compact('expense_category_data'));
    }

}
