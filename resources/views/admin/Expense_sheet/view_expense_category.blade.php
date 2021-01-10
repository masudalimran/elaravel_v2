@extends('admin.admin_layouts')
@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ url('admin/home') }}">Admin Panel</a>
            <a class="breadcrumb-item" href="{{ url('admin/view/expense/category/') }}">View Expense Category</a>
            <span class="breadcrumb-item active">View Expense Category</span>
        </nav>

        <div class="sl-pagebody" style="  overflow-x: scroll !important; display: table; width: 100%; height: 100vh">
            <div class="sl-page-title">
                <h5>Expense Category List</h5>
                <p>Here below is the expense category list</p>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Here you can find all sort of expense category listrings</h6>
                <a style="position:absolute; right:5%;" href="{{URL::to('admin/create/expense')}}" class="btn btn-sm btn-success"
                    >Add NEW</a>
                <p class="mg-b-20 mg-sm-b-30">Searching, ordering and paging goodness will be immediately added to the
                    table, as shown in this example.</p>

                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th style="text-align: center" class="wd-5p">Id</th>
                                <th style="text-align: center" class="wd-10p">Category Name</th>
                                <th style="text-align: center" class="wd-20p">Category Details</th>
                                <th style="text-align: center" class="wd-10p">Category Image</th>
                                <th style="text-align: center" class="wd-5p">Expense Count</th>
                                <th style="text-align: center" class="wd-5p">Expense Total</th>
                                <th style="text-align: center" class="wd-10p">Created At</th>
                                <th style="text-align: center" class="wd-10p">Updated At</th>

                                <th style="text-align: center" class="wd-20p">Action</th>
                            </tr>
                        </thead>
                        {{-- {{dd($index_product)}} --}}
                        <tbody>
                            @foreach ($expense_category_data as $row)
                            @php
                                $image=$row->exp_category_image;
                                $exp_image = explode('::::', $image);
                                $exp_image_count = count($exp_image);
                                // dd($exp_image_count)
                                $expense_data = DB::table('expense_category')
                                                        ->leftjoin('expense_table','expense_category.id','=','expense_table.exp_category')
                                                        ->select('expense_category.id as category_id','expense_category.exp_category AS category_name','expense_category.exp_category_details','expense_category.exp_category_image','expense_table.*')
                                                        ->where('expense_category.id',$row->id)
                                                        ->get();
                                $expense_count = 0;
                                $expense_total = 0;
                                foreach ($expense_data as $v_expense_data) {
                                    $expense_count++;
                                    $expense_total += $v_expense_data->exp_amount;
                                }

                            @endphp
                            <tr>
                                <td style="text-align: center">{{$row->id}}</td>
                                <td style="text-align: center">{{$row->exp_category}}</td>
                                <td style="text-align: center">{!!$row->exp_category_details!!}</td>
                                <td>
                                    <img src="{{asset($exp_image[0])}}" height="50px"><span class="badge badge-pill badge-info" style="z-index: 1; position: absolute;">{{$exp_image_count}}</span>
                                </td>
                                <td style="text-align: center">{{($expense_count)}}</td>
                                <td style="text-align: center">{{numberFormat($expense_total)}} TK</td>
                                <td style="text-align: center">{{YmdTodmYPmdMyPM($row->created_at)}}</td>
                                <td style="text-align: center">{{YmdTodmYPmdMyPM($row->updated_at)}}</td>
                                <td style="white-space: nowrap;">
                                    <a href="{{URL::to('admin/edit/expense/category/'.$row->id)}}" class="btn btn-sm btn-info">Edit</a>
                                    <a href="{{URL::to('delete/expense/category'.$row->id)}}" class="btn btn-sm btn-danger" id="delete">Delete</a>
                                    <a href="{{URL::to('view/expense/category/details/'.$row->id)}}" class="btn btn-sm btn-warning" title="View"><i class="fa fa-eye"></i>View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- table-wrapper -->
            </div><!-- card -->
        </div><!-- sl-pagebody -->


    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
