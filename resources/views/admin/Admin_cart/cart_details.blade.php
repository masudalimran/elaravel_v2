@extends('admin.admin_layouts')
@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{url('admin/home')}}">Admin Panel</a>
            <a class="breadcrumb-item" href="{{route('all.cart')}}">Cart</a>
            <a class="breadcrumb-item" href="#">Cart_details</a>
            <span class="breadcrumb-item active">Cart Information</span>
        </nav>

        <div class="sl-pagebody" style="  overflow-x: scroll !important; display: table; width: 100%; height: 100vh">
            <div class="sl-page-title">
                <h5>Cart</h5>
                <p>Here below is the Cart Information</p>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Here you can find all sort of Cart information</h6>

                <p class="mg-b-20 mg-sm-b-30">All the information is here you will just have to look for it</p>

                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th class="wd-5p">ID</th>
                                <th class="wd-20p">User</th>
                                <th class="wd-10p">Cart ID</th>
                                <th class="wd-10p">Product ID</th>
                                <th class="wd-20p">Product Name</th>
                                <th class="wd-5p">Qty</th>
                                <th class="wd-10p">Size</th>
                                <th class="wd-10p">Color</th>
                                <th class="wd-8p">Asking Price</th>
                                <th class="wd-8p">Discount</th>
                                <th class="wd-8p">Sub Total</th>
                                <th class="wd-8p">Image</th>
                                <th class="wd-8p">Created At</th>
                                <th class="wd-8p">Updated At</th>
                                <th class="wd-20p">Action</th>
                            </tr>
                        </thead>
                        {{-- {{dd($index_product)}} --}}
                        <tbody>
                            @foreach ($cart_details as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->cart_id}}</td>
                                <td>{{$row->product_id}}</td>
                                <td>{{$row->product_name}}</td>
                                <td>{{$row->qty}}</td>
                                <td>{{$row->product_size}}</td>
                                <td>{{$row->product_color}}</td>
                                <td>{{numberformat($row->asking_price)}}</td>
                                <td>{{numberformat($row->discount_price)}}</td>
                                <td>{{numberformat($row->price)}}</td>
                                <td><img src="{{asset($row->image)}}" style="height:60px; width:80px"></td>
                                <td>{{$row->created_at}}</td>
                                <td>{{$row->updated_at}}</td>

                                <td style="white-space: nowrap;">
                                    <a href="{{URL::to('edit/cart/item'.$row->id)}}" class="btn btn-sm btn-info">Edit</a>
                                    <a href="{{URL::to('delete/cart/item'.$row->id)}}" class="btn btn-sm btn-danger" id="delete">delete</a>
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
