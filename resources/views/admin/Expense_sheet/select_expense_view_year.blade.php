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
            {{-- <button class="btn btn-primary">2020</button> --}}

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Here you can find all sort of expense by month</h6>
                <a style="position:absolute; right:5%;" href="{{URL::to('admin/create/expense')}}" class="btn btn-sm btn-success"
                    >Add NEW</a>
                <p class="mg-b-20 mg-sm-b-30">Searching, ordering and paging goodness will be immediately added to the
                    table, as shown in this example.</p>

                <div style="display:inline-block; margin:5px;">
                    @foreach ($year as $item)
                        <a href="{{URL::to('admin/view/expense/by/month').'/'.$item}}"><button class="btn btn-primary">{{$item}}</button></a>
                    @endforeach
                </div>


            </div><!-- card -->
        </div><!-- sl-pagebody -->


    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
