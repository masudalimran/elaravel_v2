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
                @php
                    $exp_counter = -1;
                @endphp
                @foreach ($expense_table_data as $perYear)
                    @php
                        $exp_counter++;
                        // dd($exp_counter);
                    @endphp
                <div class="table-wrapper">
                    @if ($exp_counter == 0)
                        <h1 style="text-decoration: underline; color: red">January</h1>
                    @elseif($exp_counter == 1)
                        <h1 style="text-decoration: underline; color: red">February</h1>
                    @elseif($exp_counter == 2)
                        <h1 style="text-decoration: underline; color: red">March</h1>
                    @elseif($exp_counter == 3)
                        <h1 style="text-decoration: underline; color: red">April</h1>
                    @elseif($exp_counter == 4)
                        <h1 style="text-decoration: underline; color: red">May</h1>
                    @elseif($exp_counter == 5)
                        <h1 style="text-decoration: underline; color: red">June</h1>
                    @elseif($exp_counter == 6)
                        <h1 style="text-decoration: underline; color: red">July</h1>
                    @elseif($exp_counter == 7)
                        <h1 style="text-decoration: underline; color: red">August</h1>
                    @elseif($exp_counter == 8)
                        <h1 style="text-decoration: underline; color: red">September</h1>
                    @elseif($exp_counter == 9)
                        <h1 style="text-decoration: underline; color: red">October</h1>
                    @elseif($exp_counter == 10)
                        <h1 style="text-decoration: underline; color: red">November</h1>
                    @elseif($exp_counter == 11)
                        <h1 style="text-decoration: underline; color: red">December</h1>
                    @endif
                    <h4 style="color:blue">Total: {{numberFormat($expense_total[$exp_counter])}} Taka</h4>
                    <a href="{{route('view.before.download.pdf',[$exp_counter])}}"><button class="btn btn-success"> View As PDF </button></a>
                    <hr>
                    <table id="datatable{{$exp_counter+1}}" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th style="text-align: center" class="wd-5p">Id</th>
                                <th style="text-align: center" class="wd-10p">Category</th>
                                <th style="text-align: center" class="wd-10p">Image</th>
                                <th style="text-align: center" class="wd-5p">Amount</th>
                                <th style="text-align: center" class="wd-10p">Date</th>
                                <th style="text-align: center" class="wd-20p">In Details</th>
                                <th style="text-align: center" class="wd-5p">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($perYear as $row)
                            @php
                                $image=$row->exp_document;
                                $exp_image = explode('::::', $image);
                                $exp_image_count = count($exp_image);
                            @endphp
                            <tr>
                                <td style="text-align: center">{{$row->id}}</td>
                                <td style="text-align: center">{{$row->category_name}}</td>
                                <td>
                                    @if($row->exp_document)
                                        <img src="{{asset($exp_image[0])}}" height="50px"><span class="badge badge-pill badge-info" style="z-index: 1; position: absolute;">{{$exp_image_count}}</span>
                                    @endif
                                </td>
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
                @endforeach


            </div><!-- card -->
        </div><!-- sl-pagebody -->


    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
