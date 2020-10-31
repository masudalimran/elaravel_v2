@extends('admin.admin_layouts')
@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="index.html">Admin Panel</a>
            <a class="breadcrumb-item" href="index.html">Coupon</a>
            <span class="breadcrumb-item active">Coupon Update</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Coupon Update</h5>

                <p>Here below is the coupon Update</p>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Here you can find all sort of coupon Updates</h6>
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
                <form action="{{ url('update/coupon/'.$coupon->id) }}" method="post">
                    @csrf
                    <div class="modal-body pd-20">
                        <div class="form-group">
                            {{-- <input type="hidden" name="id" value="{{$coupon_id}}"> HIDE url--}}
                            <label for="exampleInputEmail1">Coupon Code</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                value="{{$coupon->coupon}}" name="coupon">
                        </div>
                        <div class="form-group">
                            {{-- <input type="hidden" name="id" value="{{$coupon_id}}"> HIDE url--}}
                            <label for="exampleInputEmail1">Discount</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                value="{{$coupon->discount}}" name="discount">
                        </div>
                    </div><!-- modal-body -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info pd-x-20">Update Coupon</button>
                    </div>
                </form>
            </div>
                </div><!-- table-wrapper -->
            </div><!-- card -->
        </div><!-- sl-pagebody -->

    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
