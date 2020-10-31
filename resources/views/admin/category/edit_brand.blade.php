@extends('admin.admin_layouts')
@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="index.html">Admin Panel</a>
            <a class="breadcrumb-item" href="index.html">brand</a>
            <span class="breadcrumb-item active">Brand Update</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>brand Update</h5>

                <p>Here below is the brand Update</p>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Here you can find all sort of brand Updates</h6>
                <a style="position:absolute; right:5%;" href="#" class="btn btn-sm btn-success" data-toggle="modal"
                    data-target="#modaldemo3">Add NEW</a>
                <p class="mg-b-20 mg-sm-b-30">Searching, ordering and paging goodness will be immediately added to the
                    table, as shown in this example.</p>

                <div class="table-wrapper">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ url('update/brand/'.$brand->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body pd-20">
                        <div class="form-group">
                            {{-- <input type="hidden" name="id" value="{{$brand_id}}"> HIDE url--}}
                            <label for="exampleInputEmail1">Brand Name</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                value="{{$brand->brand_name}}" name="brand_name" required="">
                        </div>
                        <div class="form-group">
                            {{-- <input type="hidden" name="id" value="{{$brand_id}}"> HIDE url--}}
                            <label for="exampleInputEmail1">Brand Logo</label>
                            <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                name="brand_logo">
                        </div>
                        <div class="form-group">
                            {{-- <input type="hidden" name="id" value="{{$brand_id}}"> HIDE url--}}
                        <img src="{{URL::to($brand->brand_logo)}}" style="height: 70px; width:90px;">
                        <input type="hidden" name="old_logo" value="{{$brand->brand_logo}}">
                        <br>
                        <label for="exampleInputEmail1" style="padding-left:.5%">OLD LOGO</label>
                    </div>
                    </div><!-- modal-body -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info pd-x-20">Update Brand</button>
                    </div>
                </form>
            </div>
                </div><!-- table-wrapper -->
            </div><!-- card -->
        </div><!-- sl-pagebody -->

    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
