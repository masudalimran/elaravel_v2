@extends('admin.admin_layouts')
@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{url('admin/home')}}">Admin Panel</a>
            <a class="breadcrumb-item" href="{{route('all.user')}}">User</a>
            <a class="breadcrumb-item" href="{{url('admin/user/details/'.$user_details->id)}}">User Details</a>
            <span class="breadcrumb-item active">User details Page</span>
        </nav>
        <div class="sl-pagebody" style="  overflow-x: scroll !important; display: table; width: 100%; height: 100vh">
            <div class="sl-page-title">
                <h5>User Details</h5>
                <p>Here below is the User Details</p>
            </div><!-- sl-page-title -->
            <div class="card">
                <div class="card-header" style="text-align: center">
                  <h3 style="color:red; display:inline"> User name : </h3><h3 style="display: inline; text-transform: capitalize">{{$user_details->name}}<h3>
                </div>
                <div class="card-body">
                    <table id="datatable1" class="table display responsive nowrap">
                        <tr>
                            <th>Phone</th>
                            <td>{{$user_details->phone}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{$user_details->email}}</td>
                        </tr>
                        <tr>
                            <th>Email Verified At</th>
                            <td>{{$user_details->email_verified_at}}</td>
                        </tr>
                        <tr>
                            <th>Password</th>
                            <td>{{$user_details->password}}</td>
                        </tr>
                        <tr>
                            <th>Shipping District</th>
                            <td>{{$user_details->shipping_district}}</td>
                        </tr>
                        <tr>
                            <th>Shipping Address</th>
                            <td>{{$user_details->shipping_address}}</td>
                        </tr>
                        <tr>
                            <th>Provider</th>
                            <td>{{$user_details->provider}}</td>
                        </tr>
                        <tr>
                            <th>Provider ID</th>
                            <td>{{$user_details->provider_id}}</td>
                        </tr>
                        <tr>
                            <th>Remember Token</th>
                            <td>{{$user_details->remember_token}}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{$user_details->created_at}}</td>
                        </tr>
                        <tr>
                            <th>Updated At</th>
                            <td>{{$user_details->updated_at}}</td>
                        </tr>
                    </table>
                </div>
              </div>


        </div><!-- sl-pagebody -->


    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
