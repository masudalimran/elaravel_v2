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
                <a style="position:absolute; right:5%;" href="{{route('add.product')}}" class="btn btn-sm btn-success"
                    >Add NEW</a>
                <p class="mg-b-20 mg-sm-b-30">Searching, ordering and paging goodness will be immediately added to the
                    table, as shown in this example.</p>

                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th class="wd-10p">Product Code</th>
                                <th class="wd-20p">Product Name</th>
                                <th class="wd-20p">Qty</th>
                                <th class="wd-20p">Product Image</th>
                                <th class="wd-20p">Category</th>
                                <th class="wd-20p">Sub Category</th>
                                <th class="wd-20p">Brand</th>
                                <th class="wd-10p">Status</th>
                                <th class="wd-40p">Action</th>
                            </tr>
                        </thead>
                        {{-- {{dd($index_product)}} --}}
                        <tbody>
                            @foreach ($index_product as $row)
                            <tr>
                                <td>{{$row->product_code}}</td>
                                <td>{{$row->product_name}}</td>
                                <td>{{$row->product_quantity}}</td>

                                <td><img src="{{URL::to($row->image_1)}}" height="50px"></td>
                                <td>{{$row->category_name}}</td>
                                <td>{{$row->sub_category_name}}</td>
                                <td>{{$row->brand_name}}</td>

                                <td>
                                    @if ($row->publication_status == 1)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                                <td style="white-space: nowrap;">
                                    <a href="{{URL::to('edit/product/'.$row->id)}}" class="btn btn-sm btn-info">Edit</a>
                                    <a href="{{URL::to('delete/product/'.$row->id)}}" class="btn btn-sm btn-danger" id="delete">Delete</a>
                                    <a href="{{URL::to('view/product/'.$row->id)}}" class="btn btn-sm btn-warning" title="View"><i class="fa fa-eye"></i></a>
                                    @if ($row->publication_status == 1)
                                        <a href="{{URL::to('inactive/product/'.$row->id)}}" class="btn btn-sm btn-danger" title="Deactivate Product"><i class="fa fa-thumbs-down"></i></a>
                                    @else
                                        <a href="{{URL::to('active/product/'.$row->id)}}" class="btn btn-sm btn-success" title="Activate Product"><i class="fa fa-thumbs-up"></i></a>
                                    @endif
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
