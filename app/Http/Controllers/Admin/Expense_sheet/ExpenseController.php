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
        $check_exp_amount = $data['exp_amount']=$request->exp_amount;
        $data['exp_date']=dmyToYmd($request->exp_date);
        $data['exp_comment']=$request->exp_comment;
        $check_exp_category = $data['exp_category']=$request->selected_expense_category;
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
        $get_exp_quantity = DB::table('expense_category')->where('id',$check_exp_category)->first();
        $update_exp_quantity = ($get_exp_quantity->exp_qty)+1;
        $update_exp_amount = ($get_exp_quantity->exp_category_total)+$check_exp_amount;
        // dd($update_exp_quantity);
        DB::table('expense_category')->where('id',$check_exp_category)->update(['exp_qty'=>$update_exp_quantity,'exp_category_total'=>$update_exp_amount]);
        $notification=array(
            'messege'=>'Expense added Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function view_expense(){
        $expense_table_data = DB::table('expense_table')
                        ->leftjoin('expense_category','expense_table.exp_category','=','expense_category.id')
                        ->select('expense_category.exp_category_details','expense_category.exp_category_image','expense_table.*')
                        ->get();
        // dd($expense_table_data->exp_category_image);
        return view('admin.Expense_sheet.view_expense',compact('expense_table_data'));
    }
}
