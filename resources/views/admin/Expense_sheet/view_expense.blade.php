@extends('admin.admin_layouts')
@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="#">Admin Panel</a>
            <a class="breadcrumb-item" href="#">Product</a>
            <span class="breadcrumb-item active">Product List</span>
        </nav>

        <div class="sl-pagebody" style="  overflow-x: scroll !important; display: table; width: 100%; height: 100vh">
            <div class="sl-page-title">
                <h5>Product List</h5>
                <p>Here below is the product list</p>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Here you can find all sort of product listrings</h6>
                <a style="position:absolute; right:5%;" href="{{URL::to('admin/create/expense')}}" class="btn btn-sm btn-success"
                    >Add NEW</a>
                <p class="mg-b-20 mg-sm-b-30">Searching, ordering and paging goodness will be immediately added to the
                    table, as shown in this example.</p>

                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th class="wd-4p">Id</th>
                                <th class="wd-5p">Category</th>
                                <th class="wd-20p">Category Details</th>
                                <th class="wd-5p">Image</th>
                                {{-- <th class="wd-20p">Qty</th>
                                <th class="wd-20p">Category Total</th> --}}
                                <th class="wd-5p">Amount</th>
                                <th class="wd-10p">Date</th>
                                <th class="wd-20p">Comment</th>
                                <th class="wd-20p">Action</th>
                            </tr>
                        </thead>
                        {{-- {{dd($index_product)}} --}}
                        <tbody>
                            @foreach ($expense_table_data as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->exp_category}}</td>
                                <td>{!!$row->exp_category_details!!}</td>

                                <td><img src="{{URL::to($row->exp_category_image)}}" height="50px"></td>
                                {{-- {{dd($row->exp_category_image)}} --}}
                                {{-- <td>{{$row->exp_qty}}</td>
                                <td>{{$row->exp_category_total}}</td> --}}
                                <td>{{$row->exp_amount}}</td>
                                <td>{{$row->exp_date}}</td>
                                <td>{!!$row->exp_comment!!}</td>
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
