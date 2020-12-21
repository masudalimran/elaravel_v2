@extends('admin.admin_layouts')
@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{url('admin/home')}}">Admin Panel</a>
            <a class="breadcrumb-item" href="{{route('all.user')}}">User</a>
            <span class="breadcrumb-item active">Users Information </span>
        </nav>

        <div class="sl-pagebody" style="  overflow-x: scroll !important; display: table; width: 100%; height: 100vh">
            <div class="sl-page-title">
                <h5>User</h5>
                <p>Here below is the User Information</p>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Here you can find all sort of User information</h6>

                <p class="mg-b-20 mg-sm-b-30">All the information is here you will just have to look for it</p>

                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th class="wd-5p">ID</th>
                                <th class="wd-15p">Name</th>
                                <th class="wd-5p">Phone</th>
                                <th class="wd-5p">Email</th>
                                <th class="wd-15p">Email Verification</th>
                                <th class="wd-5p">Password</th>
                                <th class="wd-20p">Shipping District</th>
                                <th class="wd-40p">Shipping Address</th>
                                <th class="wd-5p">Provider</th>
                                <th class="wd-10p">Provider Id</th>
                                <th class="wd-10p">Remember Token</th>
                                <th class="wd-10p">Created At</th>
                                <th class="wd-10p">Updated At</th>
                                <th class="wd-5p">Action</th>
                            </tr>
                        </thead>
                        {{-- {{dd($index_product)}} --}}
                        <tbody>
                            @foreach ($index_user as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td><a href="{{route('user.details',$row->id)}}">{{$row->name}}</a></td>
                                <td>{{$row->phone}}</td>
                                <td>{{$row->email}}</td>
                                <td>{{$row->email_verified_at}}</td>
                                <td>
                                    @if($row->password == NULL)
                                        <span class="badge badge-danger">No Password Set</span>
                                    @else
                                        {{substr($row->password, 0, 10)}}.............
                                    @endif
                                </td>
                                <td>{{$row->shipping_district}}</td>
                                <td>{{$row->shipping_address}}</td>
                                <td>
                                    @if($row->provider == NULL)
                                        <span class="badge badge-warning">Login Through Website</span>
                                    @else
                                        <span class="badge badge-success">{{$row->provider}}</span>
                                    @endif

                                </td>
                                <td>
                                    @if($row->provider == NULL)
                                        <span class="badge badge-danger">Not available</span>
                                    @else
                                        <span class="badge badge-success">{{$row->provider_id}}</span>
                                    @endif
                                </td>
                                <td>{{$row->remember_token}}</td>
                                <td>{{YmdTodmYPmdMyPM($row->created_at)}}</td>
                                <td>{{YmdTodmYPmdMyPM($row->updated_at)}}</td>
                                <td style="white-space: nowrap;">
                                    <a href="#" class="btn btn-sm btn-danger" id="delete">delete</a>
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
