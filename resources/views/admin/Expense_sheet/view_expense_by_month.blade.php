@extends('admin.admin_layouts')
@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ url('admin/home') }}">Admin Panel</a>
            <a class="breadcrumb-item" href="{{ url('admin/view/expense/category/') }}">View Expense By Month </a>
            <span class="breadcrumb-item active">View Expense By Month </span>
        </nav>

        <div class="sl-pagebody" style="  overflow-x: scroll !important; display: table; width: 100%; height: 100vh">
            <div class="sl-page-title">
                <h5>Expense By Month</h5>
                <p>Here below is the expense By Month</p>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Here you can find all sort of expense by month</h6>
                <a style="position:absolute; right:5%;" href="{{URL::to('admin/create/expense')}}" class="btn btn-sm btn-success"
                    >Add NEW</a>
                <p class="mg-b-20 mg-sm-b-30">Searching, ordering and paging goodness will be immediately added to the
                    table, as shown in this example.</p>

                <div class="table-wrapper">
                    <h1 style="text-decoration: underline; color: red">January</h1>
                    <h4 style="color:blue">Total: {{numberFormat($January_total)}} Taka</h4>
                    <br>
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th style="text-align: center" class="wd-5p">Id</th>
                                {{-- <th style="text-align: center" class="wd-10p">Name</th> --}}
                                <th style="text-align: center" class="wd-10p">Category</th>
                                {{-- <th style="text-align: center" class="wd-20p">Category Details</th> --}}
                                <th style="text-align: center" class="wd-10p">Image</th>
                                {{-- <th class="wd-20p">Qty</th>
                                <th class="wd-20p">Category Total</th> --}}
                                <th style="text-align: center" class="wd-5p">Amount</th>
                                <th style="text-align: center" class="wd-10p">Date</th>
                                <th style="text-align: center" class="wd-20p">In Details</th>
                                <th style="text-align: center" class="wd-5p">Action</th>
                            </tr>
                        </thead>
                        {{-- {{dd($index_product)}} --}}
                        <tbody>
                            @foreach ($expense_table_data_January as $row)
                            @php
                                $image=$row->exp_document;
                                $exp_image = explode('::::', $image);
                                $exp_image_count = count($exp_image);
                                // dd($exp_image_count)
                            @endphp
                            <tr>
                                <td style="text-align: center">{{$row->id}}</td>
                                {{-- <td style="text-align: center">{{$row->exp_name}}</td> --}}
                                <td style="text-align: center">{{$row->category_name}}</td>
                                {{-- <td style="text-align: center">{!!$row->exp_category_details!!}</td> --}}
                                <td>
                                    {{-- <select class="form-control input-sm select-100">
                                        @foreach($exp_image as $v_exp_image)
                                            <option value="<img src='{{asset($v_exp_image)}}' height='50px'>"><img src="{{asset($v_exp_image)}}" height="50px"></option>
                                        @endforeach
                                        <span class="badge badge-pill badge-success" style="z-index: 1; position: absolute;">{{$exp_image_count}}</span>
                                    </select> --}}
                                    @if($row->exp_document)
                                        <img src="{{asset($exp_image[0])}}" height="50px"><span class="badge badge-pill badge-info" style="z-index: 1; position: absolute;">{{$exp_image_count}}</span>
                                    @endif
                                </td>
                                {{-- {{dd($row->exp_category_image)}} --}}
                                {{-- <td>{{$row->exp_qty}}</td>
                                <td>{{$row->exp_category_total}}</td> --}}
                                <td style="text-align: center">{{numberFormat($row->exp_amount)}} TK</td>
                                <td style="text-align: center">{{YmdTodmY($row->exp_date)}}</td>
                                <td style="text-align: center">{!!$row->exp_comment!!}</td>
                                <td style="white-space: nowrap;">
                                    <a href="{{URL::to('edit/expense/'.$row->id)}}" class="btn btn-sm btn-info">Edit</a>
                                    <a href="{{URL::to('delete/expense/'.$row->id)}}" class="btn btn-sm btn-danger" id="delete">Delete</a>
                                    <a href="{{URL::to('view/expense/details/'.$row->id)}}" class="btn btn-sm btn-warning" title="View"><i class="fa fa-eye"></i>View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- table-wrapper -->



                <div class="table-wrapper">
                    <h1 style="text-decoration: underline; color: red">February</h1>
                    <h4 style="color:blue">Total: {{numberFormat($February_total)}} Taka</h4>
                    <br>
                    <table id="datatable2" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th style="text-align: center" class="wd-5p">Id</th>
                                {{-- <th style="text-align: center" class="wd-10p">Name</th> --}}
                                <th style="text-align: center" class="wd-10p">Category</th>
                                {{-- <th style="text-align: center" class="wd-20p">Category Details</th> --}}
                                <th style="text-align: center" class="wd-10p">Image</th>
                                {{-- <th class="wd-20p">Qty</th>
                                <th class="wd-20p">Category Total</th> --}}
                                <th style="text-align: center" class="wd-5p">Amount</th>
                                <th style="text-align: center" class="wd-10p">Date</th>
                                <th style="text-align: center" class="wd-20p">In Details</th>
                                <th style="text-align: center" class="wd-5p">Action</th>
                            </tr>
                        </thead>
                        {{-- {{dd($index_product)}} --}}
                        <tbody>
                            @foreach ($expense_table_data_February as $row)
                            @php
                                $image=$row->exp_document;
                                $exp_image = explode('::::', $image);
                                $exp_image_count = count($exp_image);
                                // dd($exp_image_count)
                            @endphp
                            <tr>
                                <td style="text-align: center">{{$row->id}}</td>
                                {{-- <td style="text-align: center">{{$row->exp_name}}</td> --}}
                                <td style="text-align: center">{{$row->category_name}}</td>
                                {{-- <td style="text-align: center">{!!$row->exp_category_details!!}</td> --}}
                                <td>
                                    {{-- <select class="form-control input-sm select-100">
                                        @foreach($exp_image as $v_exp_image)
                                            <option value="<img src='{{asset($v_exp_image)}}' height='50px'>"><img src="{{asset($v_exp_image)}}" height="50px"></option>
                                        @endforeach
                                        <span class="badge badge-pill badge-success" style="z-index: 1; position: absolute;">{{$exp_image_count}}</span>
                                    </select> --}}
                                    @if($row->exp_document)
                                        <img src="{{asset($exp_image[0])}}" height="50px"><span class="badge badge-pill badge-info" style="z-index: 1; position: absolute;">{{$exp_image_count}}</span>
                                    @endif
                                </td>
                                {{-- {{dd($row->exp_category_image)}} --}}
                                {{-- <td>{{$row->exp_qty}}</td>
                                <td>{{$row->exp_category_total}}</td> --}}
                                <td style="text-align: center">{{numberFormat($row->exp_amount)}} TK</td>
                                <td style="text-align: center">{{YmdTodmY($row->exp_date)}}</td>
                                <td style="text-align: center">{!!$row->exp_comment!!}</td>
                                <td style="white-space: nowrap;">
                                    <a href="{{URL::to('edit/expense/'.$row->id)}}" class="btn btn-sm btn-info">Edit</a>
                                    <a href="{{URL::to('delete/expense/'.$row->id)}}" class="btn btn-sm btn-danger" id="delete">Delete</a>
                                    <a href="{{URL::to('view/expense/details/'.$row->id)}}" class="btn btn-sm btn-warning" title="View"><i class="fa fa-eye"></i>View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- table-wrapper -->


                <div class="table-wrapper">
                    <h1 style="text-decoration: underline; color: red">March</h1>
                    <h4 style="color:blue">Total: {{numberFormat($March_total)}} Taka</h4>
                    <br>
                    <table id="datatable3" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th style="text-align: center" class="wd-5p">Id</th>
                                {{-- <th style="text-align: center" class="wd-10p">Name</th> --}}
                                <th style="text-align: center" class="wd-10p">Category</th>
                                {{-- <th style="text-align: center" class="wd-20p">Category Details</th> --}}
                                <th style="text-align: center" class="wd-10p">Image</th>
                                {{-- <th class="wd-20p">Qty</th>
                                <th class="wd-20p">Category Total</th> --}}
                                <th style="text-align: center" class="wd-5p">Amount</th>
                                <th style="text-align: center" class="wd-10p">Date</th>
                                <th style="text-align: center" class="wd-20p">In Details</th>
                                <th style="text-align: center" class="wd-5p">Action</th>
                            </tr>
                        </thead>
                        {{-- {{dd($index_product)}} --}}
                        <tbody>
                            @foreach ($expense_table_data_March as $row)
                            @php
                                $image=$row->exp_document;
                                $exp_image = explode('::::', $image);
                                $exp_image_count = count($exp_image);
                                // dd($exp_image_count)
                            @endphp
                            <tr>
                                <td style="text-align: center">{{$row->id}}</td>
                                {{-- <td style="text-align: center">{{$row->exp_name}}</td> --}}
                                <td style="text-align: center">{{$row->category_name}}</td>
                                {{-- <td style="text-align: center">{!!$row->exp_category_details!!}</td> --}}
                                <td>
                                    {{-- <select class="form-control input-sm select-100">
                                        @foreach($exp_image as $v_exp_image)
                                            <option value="<img src='{{asset($v_exp_image)}}' height='50px'>"><img src="{{asset($v_exp_image)}}" height="50px"></option>
                                        @endforeach
                                        <span class="badge badge-pill badge-success" style="z-index: 1; position: absolute;">{{$exp_image_count}}</span>
                                    </select> --}}
                                    @if($row->exp_document)
                                        <img src="{{asset($exp_image[0])}}" height="50px"><span class="badge badge-pill badge-info" style="z-index: 1; position: absolute;">{{$exp_image_count}}</span>
                                    @endif
                                </td>
                                {{-- {{dd($row->exp_category_image)}} --}}
                                {{-- <td>{{$row->exp_qty}}</td>
                                <td>{{$row->exp_category_total}}</td> --}}
                                <td style="text-align: center">{{numberFormat($row->exp_amount)}} TK</td>
                                <td style="text-align: center">{{YmdTodmY($row->exp_date)}}</td>
                                <td style="text-align: center">{!!$row->exp_comment!!}</td>
                                <td style="white-space: nowrap;">
                                    <a href="{{URL::to('edit/expense/'.$row->id)}}" class="btn btn-sm btn-info">Edit</a>
                                    <a href="{{URL::to('delete/expense/'.$row->id)}}" class="btn btn-sm btn-danger" id="delete">Delete</a>
                                    <a href="{{URL::to('view/expense/details/'.$row->id)}}" class="btn btn-sm btn-warning" title="View"><i class="fa fa-eye"></i>View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- table-wrapper -->



                <div class="table-wrapper">
                    <h1 style="text-decoration: underline; color: red">April</h1>
                    <h4 style="color:blue">Total: {{numberFormat($April_total)}} Taka</h4>
                    <br>
                    <table id="datatable4" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th style="text-align: center" class="wd-5p">Id</th>
                                {{-- <th style="text-align: center" class="wd-10p">Name</th> --}}
                                <th style="text-align: center" class="wd-10p">Category</th>
                                {{-- <th style="text-align: center" class="wd-20p">Category Details</th> --}}
                                <th style="text-align: center" class="wd-10p">Image</th>
                                {{-- <th class="wd-20p">Qty</th>
                                <th class="wd-20p">Category Total</th> --}}
                                <th style="text-align: center" class="wd-5p">Amount</th>
                                <th style="text-align: center" class="wd-10p">Date</th>
                                <th style="text-align: center" class="wd-20p">In Details</th>
                                <th style="text-align: center" class="wd-5p">Action</th>
                            </tr>
                        </thead>
                        {{-- {{dd($index_product)}} --}}
                        <tbody>
                            @foreach ($expense_table_data_April as $row)
                            @php
                                $image=$row->exp_document;
                                $exp_image = explode('::::', $image);
                                $exp_image_count = count($exp_image);
                                // dd($exp_image_count)
                            @endphp
                            <tr>
                                <td style="text-align: center">{{$row->id}}</td>
                                {{-- <td style="text-align: center">{{$row->exp_name}}</td> --}}
                                <td style="text-align: center">{{$row->category_name}}</td>
                                {{-- <td style="text-align: center">{!!$row->exp_category_details!!}</td> --}}
                                <td>
                                    {{-- <select class="form-control input-sm select-100">
                                        @foreach($exp_image as $v_exp_image)
                                            <option value="<img src='{{asset($v_exp_image)}}' height='50px'>"><img src="{{asset($v_exp_image)}}" height="50px"></option>
                                        @endforeach
                                        <span class="badge badge-pill badge-success" style="z-index: 1; position: absolute;">{{$exp_image_count}}</span>
                                    </select> --}}
                                    @if($row->exp_document)
                                        <img src="{{asset($exp_image[0])}}" height="50px"><span class="badge badge-pill badge-info" style="z-index: 1; position: absolute;">{{$exp_image_count}}</span>
                                    @endif
                                </td>
                                {{-- {{dd($row->exp_category_image)}} --}}
                                {{-- <td>{{$row->exp_qty}}</td>
                                <td>{{$row->exp_category_total}}</td> --}}
                                <td style="text-align: center">{{numberFormat($row->exp_amount)}} TK</td>
                                <td style="text-align: center">{{YmdTodmY($row->exp_date)}}</td>
                                <td style="text-align: center">{!!$row->exp_comment!!}</td>
                                <td style="white-space: nowrap;">
                                    <a href="{{URL::to('edit/expense/'.$row->id)}}" class="btn btn-sm btn-info">Edit</a>
                                    <a href="{{URL::to('delete/expense/'.$row->id)}}" class="btn btn-sm btn-danger" id="delete">Delete</a>
                                    <a href="{{URL::to('view/expense/details/'.$row->id)}}" class="btn btn-sm btn-warning" title="View"><i class="fa fa-eye"></i>View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- table-wrapper -->



                <div class="table-wrapper">
                    <h1 style="text-decoration: underline; color: red">May</h1>
                    <h4 style="color:blue">Total: {{numberFormat($May_total)}} Taka</h4>
                    <br>
                    <table id="datatable5" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th style="text-align: center" class="wd-5p">Id</th>
                                {{-- <th style="text-align: center" class="wd-10p">Name</th> --}}
                                <th style="text-align: center" class="wd-10p">Category</th>
                                {{-- <th style="text-align: center" class="wd-20p">Category Details</th> --}}
                                <th style="text-align: center" class="wd-10p">Image</th>
                                {{-- <th class="wd-20p">Qty</th>
                                <th class="wd-20p">Category Total</th> --}}
                                <th style="text-align: center" class="wd-5p">Amount</th>
                                <th style="text-align: center" class="wd-10p">Date</th>
                                <th style="text-align: center" class="wd-20p">In Details</th>
                                <th style="text-align: center" class="wd-5p">Action</th>
                            </tr>
                        </thead>
                        {{-- {{dd($index_product)}} --}}
                        <tbody>
                            @foreach ($expense_table_data_May as $row)
                            @php
                                $image=$row->exp_document;
                                $exp_image = explode('::::', $image);
                                $exp_image_count = count($exp_image);
                                // dd($exp_image_count)
                            @endphp
                            <tr>
                                <td style="text-align: center">{{$row->id}}</td>
                                {{-- <td style="text-align: center">{{$row->exp_name}}</td> --}}
                                <td style="text-align: center">{{$row->category_name}}</td>
                                {{-- <td style="text-align: center">{!!$row->exp_category_details!!}</td> --}}
                                <td>
                                    {{-- <select class="form-control input-sm select-100">
                                        @foreach($exp_image as $v_exp_image)
                                            <option value="<img src='{{asset($v_exp_image)}}' height='50px'>"><img src="{{asset($v_exp_image)}}" height="50px"></option>
                                        @endforeach
                                        <span class="badge badge-pill badge-success" style="z-index: 1; position: absolute;">{{$exp_image_count}}</span>
                                    </select> --}}
                                    @if($row->exp_document)
                                        <img src="{{asset($exp_image[0])}}" height="50px"><span class="badge badge-pill badge-info" style="z-index: 1; position: absolute;">{{$exp_image_count}}</span>
                                    @endif
                                </td>
                                {{-- {{dd($row->exp_category_image)}} --}}
                                {{-- <td>{{$row->exp_qty}}</td>
                                <td>{{$row->exp_category_total}}</td> --}}
                                <td style="text-align: center">{{numberFormat($row->exp_amount)}} TK</td>
                                <td style="text-align: center">{{YmdTodmY($row->exp_date)}}</td>
                                <td style="text-align: center">{!!$row->exp_comment!!}</td>
                                <td style="white-space: nowrap;">
                                    <a href="{{URL::to('edit/expense/'.$row->id)}}" class="btn btn-sm btn-info">Edit</a>
                                    <a href="{{URL::to('delete/expense/'.$row->id)}}" class="btn btn-sm btn-danger" id="delete">Delete</a>
                                    <a href="{{URL::to('view/expense/details/'.$row->id)}}" class="btn btn-sm btn-warning" title="View"><i class="fa fa-eye"></i>View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- table-wrapper -->



                <div class="table-wrapper">
                    <h1 style="text-decoration: underline; color: red">June</h1>
                    <h4 style="color:blue">Total: {{numberFormat($June_total)}} Taka</h4>
                    <br>
                    <table id="datatable6" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th style="text-align: center" class="wd-5p">Id</th>
                                {{-- <th style="text-align: center" class="wd-10p">Name</th> --}}
                                <th style="text-align: center" class="wd-10p">Category</th>
                                {{-- <th style="text-align: center" class="wd-20p">Category Details</th> --}}
                                <th style="text-align: center" class="wd-10p">Image</th>
                                {{-- <th class="wd-20p">Qty</th>
                                <th class="wd-20p">Category Total</th> --}}
                                <th style="text-align: center" class="wd-5p">Amount</th>
                                <th style="text-align: center" class="wd-10p">Date</th>
                                <th style="text-align: center" class="wd-20p">In Details</th>
                                <th style="text-align: center" class="wd-5p">Action</th>
                            </tr>
                        </thead>
                        {{-- {{dd($index_product)}} --}}
                        <tbody>
                            @foreach ($expense_table_data_June as $row)
                            @php
                                $image=$row->exp_document;
                                $exp_image = explode('::::', $image);
                                $exp_image_count = count($exp_image);
                                // dd($exp_image_count)
                            @endphp
                            <tr>
                                <td style="text-align: center">{{$row->id}}</td>
                                {{-- <td style="text-align: center">{{$row->exp_name}}</td> --}}
                                <td style="text-align: center">{{$row->category_name}}</td>
                                {{-- <td style="text-align: center">{!!$row->exp_category_details!!}</td> --}}
                                <td>
                                    {{-- <select class="form-control input-sm select-100">
                                        @foreach($exp_image as $v_exp_image)
                                            <option value="<img src='{{asset($v_exp_image)}}' height='50px'>"><img src="{{asset($v_exp_image)}}" height="50px"></option>
                                        @endforeach
                                        <span class="badge badge-pill badge-success" style="z-index: 1; position: absolute;">{{$exp_image_count}}</span>
                                    </select> --}}
                                    @if($row->exp_document)
                                        <img src="{{asset($exp_image[0])}}" height="50px"><span class="badge badge-pill badge-info" style="z-index: 1; position: absolute;">{{$exp_image_count}}</span>
                                    @endif
                                </td>
                                {{-- {{dd($row->exp_category_image)}} --}}
                                {{-- <td>{{$row->exp_qty}}</td>
                                <td>{{$row->exp_category_total}}</td> --}}
                                <td style="text-align: center">{{numberFormat($row->exp_amount)}} TK</td>
                                <td style="text-align: center">{{YmdTodmY($row->exp_date)}}</td>
                                <td style="text-align: center">{!!$row->exp_comment!!}</td>
                                <td style="white-space: nowrap;">
                                    <a href="{{URL::to('edit/expense/'.$row->id)}}" class="btn btn-sm btn-info">Edit</a>
                                    <a href="{{URL::to('delete/expense/'.$row->id)}}" class="btn btn-sm btn-danger" id="delete">Delete</a>
                                    <a href="{{URL::to('view/expense/details/'.$row->id)}}" class="btn btn-sm btn-warning" title="View"><i class="fa fa-eye"></i>View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- table-wrapper -->




                <div class="table-wrapper">
                    <h1 style="text-decoration: underline; color: red">July</h1>
                    <h4 style="color:blue">Total: {{numberFormat($July_total)}} Taka</h4>
                    <br>
                    <table id="datatable7" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th style="text-align: center" class="wd-5p">Id</th>
                                {{-- <th style="text-align: center" class="wd-10p">Name</th> --}}
                                <th style="text-align: center" class="wd-10p">Category</th>
                                {{-- <th style="text-align: center" class="wd-20p">Category Details</th> --}}
                                <th style="text-align: center" class="wd-10p">Image</th>
                                {{-- <th class="wd-20p">Qty</th>
                                <th class="wd-20p">Category Total</th> --}}
                                <th style="text-align: center" class="wd-5p">Amount</th>
                                <th style="text-align: center" class="wd-10p">Date</th>
                                <th style="text-align: center" class="wd-20p">In Details</th>
                                <th style="text-align: center" class="wd-5p">Action</th>
                            </tr>
                        </thead>
                        {{-- {{dd($index_product)}} --}}
                        <tbody>
                            @foreach ($expense_table_data_July as $row)
                            @php
                                $image=$row->exp_document;
                                $exp_image = explode('::::', $image);
                                $exp_image_count = count($exp_image);
                                // dd($exp_image_count)
                            @endphp
                            <tr>
                                <td style="text-align: center">{{$row->id}}</td>
                                {{-- <td style="text-align: center">{{$row->exp_name}}</td> --}}
                                <td style="text-align: center">{{$row->category_name}}</td>
                                {{-- <td style="text-align: center">{!!$row->exp_category_details!!}</td> --}}
                                <td>
                                    {{-- <select class="form-control input-sm select-100">
                                        @foreach($exp_image as $v_exp_image)
                                            <option value="<img src='{{asset($v_exp_image)}}' height='50px'>"><img src="{{asset($v_exp_image)}}" height="50px"></option>
                                        @endforeach
                                        <span class="badge badge-pill badge-success" style="z-index: 1; position: absolute;">{{$exp_image_count}}</span>
                                    </select> --}}
                                    @if($row->exp_document)
                                        <img src="{{asset($exp_image[0])}}" height="50px"><span class="badge badge-pill badge-info" style="z-index: 1; position: absolute;">{{$exp_image_count}}</span>
                                    @endif
                                </td>
                                {{-- {{dd($row->exp_category_image)}} --}}
                                {{-- <td>{{$row->exp_qty}}</td>
                                <td>{{$row->exp_category_total}}</td> --}}
                                <td style="text-align: center">{{numberFormat($row->exp_amount)}} TK</td>
                                <td style="text-align: center">{{YmdTodmY($row->exp_date)}}</td>
                                <td style="text-align: center">{!!$row->exp_comment!!}</td>
                                <td style="white-space: nowrap;">
                                    <a href="{{URL::to('edit/expense/'.$row->id)}}" class="btn btn-sm btn-info">Edit</a>
                                    <a href="{{URL::to('delete/expense/'.$row->id)}}" class="btn btn-sm btn-danger" id="delete">Delete</a>
                                    <a href="{{URL::to('view/expense/details/'.$row->id)}}" class="btn btn-sm btn-warning" title="View"><i class="fa fa-eye"></i>View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- table-wrapper -->




                <div class="table-wrapper">
                    <h1 style="text-decoration: underline; color: red">August</h1>
                    <h4 style="color:blue">Total: {{numberFormat($August_total)}} Taka</h4>
                    <br>
                    <table id="datatable8" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th style="text-align: center" class="wd-5p">Id</th>
                                {{-- <th style="text-align: center" class="wd-10p">Name</th> --}}
                                <th style="text-align: center" class="wd-10p">Category</th>
                                {{-- <th style="text-align: center" class="wd-20p">Category Details</th> --}}
                                <th style="text-align: center" class="wd-10p">Image</th>
                                {{-- <th class="wd-20p">Qty</th>
                                <th class="wd-20p">Category Total</th> --}}
                                <th style="text-align: center" class="wd-5p">Amount</th>
                                <th style="text-align: center" class="wd-10p">Date</th>
                                <th style="text-align: center" class="wd-20p">In Details</th>
                                <th style="text-align: center" class="wd-5p">Action</th>
                            </tr>
                        </thead>
                        {{-- {{dd($index_product)}} --}}
                        <tbody>
                            @foreach ($expense_table_data_August as $row)
                            @php
                                $image=$row->exp_document;
                                $exp_image = explode('::::', $image);
                                $exp_image_count = count($exp_image);
                                // dd($exp_image_count)
                            @endphp
                            <tr>
                                <td style="text-align: center">{{$row->id}}</td>
                                {{-- <td style="text-align: center">{{$row->exp_name}}</td> --}}
                                <td style="text-align: center">{{$row->category_name}}</td>
                                {{-- <td style="text-align: center">{!!$row->exp_category_details!!}</td> --}}
                                <td>
                                    {{-- <select class="form-control input-sm select-100">
                                        @foreach($exp_image as $v_exp_image)
                                            <option value="<img src='{{asset($v_exp_image)}}' height='50px'>"><img src="{{asset($v_exp_image)}}" height="50px"></option>
                                        @endforeach
                                        <span class="badge badge-pill badge-success" style="z-index: 1; position: absolute;">{{$exp_image_count}}</span>
                                    </select> --}}
                                    @if($row->exp_document)
                                        <img src="{{asset($exp_image[0])}}" height="50px"><span class="badge badge-pill badge-info" style="z-index: 1; position: absolute;">{{$exp_image_count}}</span>
                                    @endif
                                </td>
                                {{-- {{dd($row->exp_category_image)}} --}}
                                {{-- <td>{{$row->exp_qty}}</td>
                                <td>{{$row->exp_category_total}}</td> --}}
                                <td style="text-align: center">{{numberFormat($row->exp_amount)}} TK</td>
                                <td style="text-align: center">{{YmdTodmY($row->exp_date)}}</td>
                                <td style="text-align: center">{!!$row->exp_comment!!}</td>
                                <td style="white-space: nowrap;">
                                    <a href="{{URL::to('edit/expense/'.$row->id)}}" class="btn btn-sm btn-info">Edit</a>
                                    <a href="{{URL::to('delete/expense/'.$row->id)}}" class="btn btn-sm btn-danger" id="delete">Delete</a>
                                    <a href="{{URL::to('view/expense/details/'.$row->id)}}" class="btn btn-sm btn-warning" title="View"><i class="fa fa-eye"></i>View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- table-wrapper -->




                <div class="table-wrapper">
                    <h1 style="text-decoration: underline; color: red">September</h1>
                    <h4 style="color:blue">Total: {{numberFormat($September_total)}} Taka</h4>
                    <br>
                    <table id="datatable9" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th style="text-align: center" class="wd-5p">Id</th>
                                {{-- <th style="text-align: center" class="wd-10p">Name</th> --}}
                                <th style="text-align: center" class="wd-10p">Category</th>
                                {{-- <th style="text-align: center" class="wd-20p">Category Details</th> --}}
                                <th style="text-align: center" class="wd-10p">Image</th>
                                {{-- <th class="wd-20p">Qty</th>
                                <th class="wd-20p">Category Total</th> --}}
                                <th style="text-align: center" class="wd-5p">Amount</th>
                                <th style="text-align: center" class="wd-10p">Date</th>
                                <th style="text-align: center" class="wd-20p">In Details</th>
                                <th style="text-align: center" class="wd-5p">Action</th>
                            </tr>
                        </thead>
                        {{-- {{dd($index_product)}} --}}
                        <tbody>
                            @foreach ($expense_table_data_September as $row)
                            @php
                                $image=$row->exp_document;
                                $exp_image = explode('::::', $image);
                                $exp_image_count = count($exp_image);
                                // dd($exp_image_count)
                            @endphp
                            <tr>
                                <td style="text-align: center">{{$row->id}}</td>
                                {{-- <td style="text-align: center">{{$row->exp_name}}</td> --}}
                                <td style="text-align: center">{{$row->category_name}}</td>
                                {{-- <td style="text-align: center">{!!$row->exp_category_details!!}</td> --}}
                                <td>
                                    {{-- <select class="form-control input-sm select-100">
                                        @foreach($exp_image as $v_exp_image)
                                            <option value="<img src='{{asset($v_exp_image)}}' height='50px'>"><img src="{{asset($v_exp_image)}}" height="50px"></option>
                                        @endforeach
                                        <span class="badge badge-pill badge-success" style="z-index: 1; position: absolute;">{{$exp_image_count}}</span>
                                    </select> --}}
                                    @if($row->exp_document)
                                        <img src="{{asset($exp_image[0])}}" height="50px"><span class="badge badge-pill badge-info" style="z-index: 1; position: absolute;">{{$exp_image_count}}</span>
                                    @endif
                                </td>
                                {{-- {{dd($row->exp_category_image)}} --}}
                                {{-- <td>{{$row->exp_qty}}</td>
                                <td>{{$row->exp_category_total}}</td> --}}
                                <td style="text-align: center">{{numberFormat($row->exp_amount)}} TK</td>
                                <td style="text-align: center">{{YmdTodmY($row->exp_date)}}</td>
                                <td style="text-align: center">{!!$row->exp_comment!!}</td>
                                <td style="white-space: nowrap;">
                                    <a href="{{URL::to('edit/expense/'.$row->id)}}" class="btn btn-sm btn-info">Edit</a>
                                    <a href="{{URL::to('delete/expense/'.$row->id)}}" class="btn btn-sm btn-danger" id="delete">Delete</a>
                                    <a href="{{URL::to('view/expense/details/'.$row->id)}}" class="btn btn-sm btn-warning" title="View"><i class="fa fa-eye"></i>View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- table-wrapper -->




                <div class="table-wrapper">
                    <h1 style="text-decoration: underline; color: red">October</h1>
                    <h4 style="color:blue">Total: {{numberFormat($October_total)}} Taka</h4>
                    <br>
                    <table id="datatable10" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th style="text-align: center" class="wd-5p">Id</th>
                                {{-- <th style="text-align: center" class="wd-10p">Name</th> --}}
                                <th style="text-align: center" class="wd-10p">Category</th>
                                {{-- <th style="text-align: center" class="wd-20p">Category Details</th> --}}
                                <th style="text-align: center" class="wd-10p">Image</th>
                                {{-- <th class="wd-20p">Qty</th>
                                <th class="wd-20p">Category Total</th> --}}
                                <th style="text-align: center" class="wd-5p">Amount</th>
                                <th style="text-align: center" class="wd-10p">Date</th>
                                <th style="text-align: center" class="wd-20p">In Details</th>
                                <th style="text-align: center" class="wd-5p">Action</th>
                            </tr>
                        </thead>
                        {{-- {{dd($index_product)}} --}}
                        <tbody>
                            @foreach ($expense_table_data_October as $row)
                            @php
                                $image=$row->exp_document;
                                $exp_image = explode('::::', $image);
                                $exp_image_count = count($exp_image);
                                // dd($exp_image_count)
                            @endphp
                            <tr>
                                <td style="text-align: center">{{$row->id}}</td>
                                {{-- <td style="text-align: center">{{$row->exp_name}}</td> --}}
                                <td style="text-align: center">{{$row->category_name}}</td>
                                {{-- <td style="text-align: center">{!!$row->exp_category_details!!}</td> --}}
                                <td>
                                    {{-- <select class="form-control input-sm select-100">
                                        @foreach($exp_image as $v_exp_image)
                                            <option value="<img src='{{asset($v_exp_image)}}' height='50px'>"><img src="{{asset($v_exp_image)}}" height="50px"></option>
                                        @endforeach
                                        <span class="badge badge-pill badge-success" style="z-index: 1; position: absolute;">{{$exp_image_count}}</span>
                                    </select> --}}
                                    @if($row->exp_document)
                                        <img src="{{asset($exp_image[0])}}" height="50px"><span class="badge badge-pill badge-info" style="z-index: 1; position: absolute;">{{$exp_image_count}}</span>
                                    @endif
                                </td>
                                {{-- {{dd($row->exp_category_image)}} --}}
                                {{-- <td>{{$row->exp_qty}}</td>
                                <td>{{$row->exp_category_total}}</td> --}}
                                <td style="text-align: center">{{numberFormat($row->exp_amount)}} TK</td>
                                <td style="text-align: center">{{YmdTodmY($row->exp_date)}}</td>
                                <td style="text-align: center">{!!$row->exp_comment!!}</td>
                                <td style="white-space: nowrap;">
                                    <a href="{{URL::to('edit/expense/'.$row->id)}}" class="btn btn-sm btn-info">Edit</a>
                                    <a href="{{URL::to('delete/expense/'.$row->id)}}" class="btn btn-sm btn-danger" id="delete">Delete</a>
                                    <a href="{{URL::to('view/expense/details/'.$row->id)}}" class="btn btn-sm btn-warning" title="View"><i class="fa fa-eye"></i>View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- table-wrapper -->




                <div class="table-wrapper">
                    <h1 style="text-decoration: underline; color: red">November</h1>
                    <h4 style="color:blue">Total: {{numberFormat($November_total)}} Taka</h4>
                    <br>
                    <table id="datatable11" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th style="text-align: center" class="wd-5p">Id</th>
                                {{-- <th style="text-align: center" class="wd-10p">Name</th> --}}
                                <th style="text-align: center" class="wd-10p">Category</th>
                                {{-- <th style="text-align: center" class="wd-20p">Category Details</th> --}}
                                <th style="text-align: center" class="wd-10p">Image</th>
                                {{-- <th class="wd-20p">Qty</th>
                                <th class="wd-20p">Category Total</th> --}}
                                <th style="text-align: center" class="wd-5p">Amount</th>
                                <th style="text-align: center" class="wd-10p">Date</th>
                                <th style="text-align: center" class="wd-20p">In Details</th>
                                <th style="text-align: center" class="wd-5p">Action</th>
                            </tr>
                        </thead>
                        {{-- {{dd($index_product)}} --}}
                        <tbody>
                            @foreach ($expense_table_data_November as $row)
                            @php
                                $image=$row->exp_document;
                                $exp_image = explode('::::', $image);
                                $exp_image_count = count($exp_image);
                                // dd($exp_image_count)
                            @endphp
                            <tr>
                                <td style="text-align: center">{{$row->id}}</td>
                                {{-- <td style="text-align: center">{{$row->exp_name}}</td> --}}
                                <td style="text-align: center">{{$row->category_name}}</td>
                                {{-- <td style="text-align: center">{!!$row->exp_category_details!!}</td> --}}
                                <td>
                                    {{-- <select class="form-control input-sm select-100">
                                        @foreach($exp_image as $v_exp_image)
                                            <option value="<img src='{{asset($v_exp_image)}}' height='50px'>"><img src="{{asset($v_exp_image)}}" height="50px"></option>
                                        @endforeach
                                        <span class="badge badge-pill badge-success" style="z-index: 1; position: absolute;">{{$exp_image_count}}</span>
                                    </select> --}}
                                    @if($row->exp_document)
                                        <img src="{{asset($exp_image[0])}}" height="50px"><span class="badge badge-pill badge-info" style="z-index: 1; position: absolute;">{{$exp_image_count}}</span>
                                    @endif
                                </td>
                                {{-- {{dd($row->exp_category_image)}} --}}
                                {{-- <td>{{$row->exp_qty}}</td>
                                <td>{{$row->exp_category_total}}</td> --}}
                                <td style="text-align: center">{{numberFormat($row->exp_amount)}} TK</td>
                                <td style="text-align: center">{{YmdTodmY($row->exp_date)}}</td>
                                <td style="text-align: center">{!!$row->exp_comment!!}</td>
                                <td style="white-space: nowrap;">
                                    <a href="{{URL::to('edit/expense/'.$row->id)}}" class="btn btn-sm btn-info">Edit</a>
                                    <a href="{{URL::to('delete/expense/'.$row->id)}}" class="btn btn-sm btn-danger" id="delete">Delete</a>
                                    <a href="{{URL::to('view/expense/details/'.$row->id)}}" class="btn btn-sm btn-warning" title="View"><i class="fa fa-eye"></i>View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- table-wrapper -->



                <div class="table-wrapper">
                    <h1 style="text-decoration: underline; color: red">December</h1>
                    <h4 style="color:blue">Total: {{numberFormat($December_total)}} Taka</h4>
                    <br>
                    <table id="datatable12" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th style="text-align: center" class="wd-5p">Id</th>
                                {{-- <th style="text-align: center" class="wd-10p">Name</th> --}}
                                <th style="text-align: center" class="wd-10p">Category</th>
                                {{-- <th style="text-align: center" class="wd-20p">Category Details</th> --}}
                                <th style="text-align: center" class="wd-10p">Image</th>
                                {{-- <th class="wd-20p">Qty</th>
                                <th class="wd-20p">Category Total</th> --}}
                                <th style="text-align: center" class="wd-5p">Amount</th>
                                <th style="text-align: center" class="wd-10p">Date</th>
                                <th style="text-align: center" class="wd-20p">In Details</th>
                                <th style="text-align: center" class="wd-5p">Action</th>
                            </tr>
                        </thead>
                        {{-- {{dd($index_product)}} --}}
                        <tbody>
                            @foreach ($expense_table_data_December as $row)
                            @php
                                $image=$row->exp_document;
                                $exp_image = explode('::::', $image);
                                $exp_image_count = count($exp_image);
                                // dd($exp_image_count)
                            @endphp
                            <tr>
                                <td style="text-align: center">{{$row->id}}</td>
                                {{-- <td style="text-align: center">{{$row->exp_name}}</td> --}}
                                <td style="text-align: center">{{$row->category_name}}</td>
                                {{-- <td style="text-align: center">{!!$row->exp_category_details!!}</td> --}}
                                <td>
                                    {{-- <select class="form-control input-sm select-100">
                                        @foreach($exp_image as $v_exp_image)
                                            <option value="<img src='{{asset($v_exp_image)}}' height='50px'>"><img src="{{asset($v_exp_image)}}" height="50px"></option>
                                        @endforeach
                                        <span class="badge badge-pill badge-success" style="z-index: 1; position: absolute;">{{$exp_image_count}}</span>
                                    </select> --}}
                                    @if($row->exp_document)
                                        <img src="{{asset($exp_image[0])}}" height="50px"><span class="badge badge-pill badge-info" style="z-index: 1; position: absolute;">{{$exp_image_count}}</span>
                                    @endif
                                </td>
                                {{-- {{dd($row->exp_category_image)}} --}}
                                {{-- <td>{{$row->exp_qty}}</td>
                                <td>{{$row->exp_category_total}}</td> --}}
                                <td style="text-align: center">{{numberFormat($row->exp_amount)}} TK</td>
                                <td style="text-align: center">{{YmdTodmY($row->exp_date)}}</td>
                                <td style="text-align: center">{!!$row->exp_comment!!}</td>
                                <td style="white-space: nowrap;">
                                    <a href="{{URL::to('edit/expense/'.$row->id)}}" class="btn btn-sm btn-info">Edit</a>
                                    <a href="{{URL::to('delete/expense/'.$row->id)}}" class="btn btn-sm btn-danger" id="delete">Delete</a>
                                    <a href="{{URL::to('view/expense/details/'.$row->id)}}" class="btn btn-sm btn-warning" title="View"><i class="fa fa-eye"></i>View</a>
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
