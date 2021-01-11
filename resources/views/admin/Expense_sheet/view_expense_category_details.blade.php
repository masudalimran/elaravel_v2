@extends('admin.admin_layouts')
@section('admin_content')
{{-- {{dd($expense_category_data)}} --}}
@php
    $image_category=$expense_category_data[0]->exp_category_image;
    $exp_image_category = explode('::::', $image_category);
    $exp_image_category_count = count($exp_image_category);
    $summation_of_expense_amount = 0;
@endphp
@foreach ($expense_category_data as $item)
    @php
        $summation_of_expense_amount = $summation_of_expense_amount + $item->exp_amount
    @endphp
@endforeach
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
                <div class="card-header" style="text-align: center; border: 5px solid black;">
                    <img src="{{asset($exp_image_category[0])}}" style="height: 150px; width: 200px"><br>
                    <h3 style="color:red; display:inline">Category : </h3><h3 style="color:black; display: inline; text-transform: capitalize">{{$expense_category_data[0]->category_name}}<h3>
                    <h6 style="color:black; display: inline; text-transform: capitalize">{!!$expense_category_data[0]->exp_category_details!!}<h6>

                    <h3 style="color:red; display:inline">Total : </h3><h3 style="color:black; display: inline; text-transform: capitalize">{{numberFormat($summation_of_expense_amount)}} TK<h3>
                </div>
                <br>
                <div class="card pd-20 pd-sm-40">
                    <form action="{{ route('search.between.dates',[$expense_category_data[0]->category_id]) }}" method="POST">
                        @csrf
                        <h3 style="color:Blue; text-align: center;text-decoration:underline"><b>Filter Date </b></h3>
                        <input class="form-control" type="text" id="datepicker1" name="start_date" placeholder="Start Date" style="width: 20%; display: inline-block; margin-left:20%; margin-bottom: 2% ">
                        <input class="form-control" type="text" id="datepicker2" name="end_date" placeholder="End Date" style="width: 20%; display: inline-block; margin-left:20%; margin-bottom: 2%">
                        <br>
                        <button type="submit" class="btn btn-success" style="position: absolute;
                        left: 45%;">Find Expenses</button>
                    </form>
                </div>
                <br>

                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th style="text-align: center" class="wd-5p">Id</th>
                                <th style="text-align: center" class="wd-10p">Expense Name</th>
                                <th style="text-align: center" class="wd-5p">Expense Amount</th>
                                <th style="text-align: center" class="wd-5p">Expense Date</th>
                                <th style="text-align: center" style="text-align: center" class="wd-20p">In Details</th>
                                <th style="text-align: center" class="wd-10p">Expense Document</th>
                                <th style="text-align: center" class="wd-10p">Created At</th>
                                <th style="text-align: center" class="wd-10p">Updated At</th>

                                <th class="wd-20p">Action</th>
                            </tr>
                        </thead>
                        {{-- {{dd($index_product)}} --}}
                        <tbody>
                            @foreach ($expense_category_data as $row)
                            {{-- {{dd($row->exp_document)}} --}}
                            @php
                                $image_document=$row->exp_document;
                                $exp_image_document = explode('::::', $image_document);
                                $exp_image_document_count = count($exp_image_document);
                                // dd($exp_image_document)
                            @endphp
                            <tr>
                                <td style="text-align: center">{{$row->id}}</td>
                                <td style="text-align: center">{{$row->exp_name}}</td>
                                <td style="text-align: center">{{numberFormat($row->exp_amount)}} TK</td>
                                <td style="text-align: center">{{YmdTodmY($row->exp_date)}}</td>
                                <td style="text-align: center">{!!$row->exp_comment!!}</td>
                                <td>
                                    @if($exp_image_document[0])
                                    {{-- {{dd($exp_image_document[0])}} --}}
                                        <img src="{{asset($exp_image_document[0])}}" height="50px"><span class="badge badge-pill badge-info" style="z-index: 1; position: absolute;">{{$exp_image_document_count}}</span>
                                    @endif
                                </td>
                                <td style="text-align: center">{{YmdTodmYPmdMyPM($row->created_at)}}</td>
                                <td style="text-align: center">{{YmdTodmYPmdMyPM($row->updated_at)}}</td>
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
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
    $( function() {
        $( "#datepicker1" ).datepicker({
            dateFormat: 'dd-mm-yy'
        });
    } );
    $( function() {
        $( "#datepicker2" ).datepicker({
            dateFormat: 'dd-mm-yy'
        });
    } );
    </script>
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
