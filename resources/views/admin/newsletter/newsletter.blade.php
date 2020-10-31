@extends('admin.admin_layouts')
@section('admin_content')
<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Admin Panel</a>
        <a class="breadcrumb-item" href="index.html">Subscriber</a>
        <span class="breadcrumb-item active">Subscriber List</span>
    </nav>

    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Subscriber List</h5>

            <p>Here below is the Subscriber list</p>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Here you can find all sort of Subscriber listrings</h6>
            <a style="position:absolute; right:5%;" href="#" class="btn btn-sm btn-danger" id="delete">Delete All</a>
            <p class="mg-b-20 mg-sm-b-30">Searching, ordering and paging goodness will be immediately added to the
                table, as shown in this example.</p>

            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                        <tr>
                            <th class="wd-10p">ID</th>
                            <th class="wd-40p">Email</th>
                            <th class="wd-40p">Subscribing Time</th>
                            <th class="wd-10p">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($newsletter as $row)
                        <tr>
                            <td><input type="checkbox"> {{$row->id}}</td>
                            <td>{{$row->email}}</td>
                            <td>{{ \Carbon\Carbon::parse($row->created_at)->diffForhumans() }}</td>
                            <td>
                                <a href="{{URL::to('delete/newsletter/'.$row->id)}}" class="btn btn-sm btn-danger" id="delete">delete</a>
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

