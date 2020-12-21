@extends('admin.admin_layouts')
@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{url('admin/home')}}">Admin Panel</a>
            <a class="breadcrumb-item" href="{{route('all.cart')}}">Cart</a>
            <a class="breadcrumb-item" href="#">Browse Cart Info By User</a>
            <span class="breadcrumb-item active">Browse Cart Info By User</span>
        </nav>

        <div class="sl-pagebody" style="  overflow-x: scroll !important; display: table; width: 100%; height: 100vh">
            <div class="sl-page-title">
                <h5>Browse Cart Info By User</h5>
                <p>Here below you can Browse Cart Info By User</p>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Here you can Browse Cart Info By User</h6>

                <p class="mg-b-20 mg-sm-b-30">All the information is here you will just have to look for it</p>

                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th class="wd-5p">ID</th>
                                <th class="wd-80p">User</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart_by_user as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->name}}</td>
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
