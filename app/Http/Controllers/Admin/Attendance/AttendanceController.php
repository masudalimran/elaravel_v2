<?php

namespace App\Http\Controllers\Admin\Attendance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function create_employee(){
        // dd("yo");
        return view('admin.Attendance.create_employee');
    }

    public function store_employee(Request $request){
        $data=array();
        $data['emp_name']=$request->emp_name;
        $data['emp_designation']=$request->emp_designation;
        DB::table('bismib_employee')->insert($data);
        $notification=array(
            'messege'=>'Employee added Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function give_attendance(){
        return view('admin.Attendance.give_attendance');
    }

    public function store_attendance(Request $request){
        $data=array();
        $selected_employee=$request->selected_employee;

        $get_selected_employee =  DB::table('bismib_employee')
                    ->where('id',$selected_employee)
                    ->first();
        $previous_date = $get_selected_employee->attendance_date;

        if($previous_date!=null){
            $data['attendance_date']= \Carbon\Carbon::now().'::::'. $previous_date;
        }else{
            $data['attendance_date']= \Carbon\Carbon::now();
        }
        // $data['attendance_date'] = \Carbon\Carbon::now();
        DB::table('bismib_employee')
                    ->where('id',$selected_employee)
                    ->update($data);
        $notification=array(
            'messege'=>'Attendance added successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function show_attendance(){
        $employee_table_data = array();
        for($i = 1; $i<=12; $i++){
            $get_employee_data = DB::table('bismib_employee')
                        ->whereMonth('attendance_date', $i)
                        // ->whereYear('expense_table.exp_date', $year)
                        ->orderBy('emp_name','asc')
                        ->orderBy('attendance_date','asc')
                        ->get();
            array_push($employee_table_data,$get_employee_data);
        }
        // dd($employee_table_data);
        return view('admin.Attendance.show_attendance',compact('employee_table_data'));
    }

    public function delete_employee($id){
        DB::table('bismib_employee')
                    ->where('id',$id)
                    ->delete();
        $notification=array(
            'messege'=>'Deleted successfully',
            'alert-type'=>'error'
        );
        return Redirect()->back()->with($notification);
    }
}
