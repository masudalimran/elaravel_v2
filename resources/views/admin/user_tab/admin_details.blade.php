@extends('admin.admin_layouts')
@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{url('admin/home')}}">Admin Panel</a>
            <a class="breadcrumb-item" href="{{route('all.admin')}}">Admin</a>
            <a class="breadcrumb-item" href="{{url('admin/admin/details/'.$admin_details->id)}}">Admin Details</a>
            <span class="breadcrumb-item active">Admin details Page</span>
        </nav>
        <div class="sl-pagebody" style="  overflow-x: scroll !important; display: table; width: 100%; height: 100vh">
            <div class="sl-page-title">
                <h5>Admin Details</h5>
                <p>Here below is the Admin Details</p>
            </div><!-- sl-page-title -->
            <div class="card">
                <div class="card-header" style="text-align: center">
                  <h3 style="color:red; display:inline"> Admin name : </h3><h3 style="display: inline; text-transform: capitalize">{{$admin_details->name}}<h3>
                </div>
                <div class="card-body">
                    <table id="datatable1" class="table display responsive nowrap">
                        <tr>
                            <th>Phone</th>
                            <td>{{$admin_details->phone}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{$admin_details->email}}</td>
                        </tr>
                        <tr>
                            <th>Email Verified At</th>
                            <td>{{$admin_details->email_verified_at}}</td>
                        </tr>
                        <tr>
                            <th>Password</th>
                            <td>{{$admin_details->password}}</td>
                        </tr>
                        <tr>
                            <th>Remember Token</th>
                            <td>{{$admin_details->remember_token}}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{$admin_details->created_at}}</td>
                        </tr>
                        <tr>
                            <th>Updated At</th>
                            <td>{{$admin_details->updated_at}}</td>
                        </tr>
                    </table>
                </div>
              </div>


        </div><!-- sl-pagebody -->


    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
