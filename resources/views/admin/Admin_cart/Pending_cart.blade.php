@extends('admin.admin_layouts')
@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{url('admin/home')}}">Admin Panel</a>
            <a class="breadcrumb-item" href="{{route('all.cart')}}">Cart</a>
            <span class="breadcrumb-item active">Pending Order</span>
        </nav>


        {{dd($pending_order_var)}}
        <div class="sl-pagebody" style="  overflow-x: scroll !important; display: table; width: 100%; height: 100vh">
            <div class="sl-page-title">
                <h5>Pending Order</h5>
                <p>These are the order that are pending.</p>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Here you can find all sort of Pending Order information</h6>

                <p class="mg-b-20 mg-sm-b-30">All the information is here you will just have to look for it</p>

                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th class="wd-5p">ID</th>
                                <th class="wd-20p">User</th>
                                <th class="wd-5p">Cart ID</th>
                                <th class="wd-5p">Coupon Discount</th>
                                <th class="wd-5p">Shipping Cost</th>
                                <th class="wd-5p">Vat</th>
                                <th class="wd-5p">Total Cost</th>
                                <th class="wd-8p">Paid With</th>
                                <th class="wd-5p">Is Paid</th>
                                <th class="wd-5p">Created At</th>
                                <th class="wd-20p">Action</th>
                            </tr>
                        </thead>
                        {{-- {{dd($index_product)}} --}}
                        <tbody>
                            @foreach ($pending_order_var as $row)
                            <tr>

                                <td>
                                    @if ($row->cart_id == Null)
                                        {{$row->id}}
                                    @else
                                        <a href="{{route('all.cart.details',(int) $row->cart_id)}}">{{$row->id}}</a>
                                    @endif
                                </td>
                                {{-- {{dd($row->cart_id)}} --}}
                                <td><a href="{{route('browse.cart.by.single_user',$row->user_id)}}">{{$row->name}}</a></td>
                                <td><a href="{{route('all.cart.details',(int) $row->cart_id)}}">{{$row->cart_id}}</a></td>
                                <td>{{numberformat($row->coupon_discount)}}</td>
                                <td>{{numberformat($row->shipping_cost)}}</td>
                                <td>{{numberformat($row->vat)}}</td>
                                <td><span class="badge badge-warning">{{numberformat($row->total_cost)}}</span></td>
                                <td>{{$row->paid_with}}</td>
                                <td>
                                    @if ($row->is_checkout == 1)
                                        <span class="badge badge-success">Paid</span>
                                    @else
                                        <span class="badge badge-danger">Pending</span>
                                    @endif
                                </td>
                                <td>{{YmdTodmYPmdMyPM($row->created_at)}}</td>
                                <td style="white-space: nowrap;">
                                    <a href="{{URL::to('delete/cart/'.$row->id)}}" class="btn btn-sm btn-danger" id="delete">Delete</a>
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
