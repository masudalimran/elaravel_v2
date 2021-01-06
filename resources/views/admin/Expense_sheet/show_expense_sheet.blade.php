@extends('admin.admin_layouts')
@section('admin_content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css"
        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.css">

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{url('admin/home')}}">Admin Panel</a>
            <a class="breadcrumb-item" href="{{url('admin/view/expense')}}">Expense Sheet</a>
            <span class="breadcrumb-item active">View Expense Sheet</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>View Expense Sheet here</h5>
                <p>Here below you can view Expense Sheet</p>
            </div><!-- sl-page-title -->


            <div class="card pd-20 pd-sm-40">
                {{-- start Table Part --}}

                    <div class="card pd-20 pd-sm-40">

                        <div class="form-layout">
                            <div class="row mg-b-25">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Product Name: <span
                                                class="tx-danger">*</span></label><br>
                                        <strong >{{$product->product_name}}</strong>
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Product Code: <span
                                                class="tx-danger">*</span></label><br>
                                                <strong>{{$product->product_code}}</strong>
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Quantity: <span class="tx-danger">*</span></label><br>
                                        <strong>{{$product->product_quantity}}</strong>
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Category: <span class="tx-danger">*</span></label><br>
                                        <strong>{{$product->category_name}}</strong>
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Sub Category: <span
                                                class="tx-danger">*</span></label><br>
                                                <strong>{{$product->sub_category_name}}</strong>
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Brand: <span class="tx-danger">*</span></label><br>
                                        <strong>{{$product->brand_name}}</strong>
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Product Size: <span
                                                class="tx-danger">*</span></label><br>
                                                <strong>{{$product->product_size}}</strong>
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Product Color: <span
                                                class="tx-danger">*</span></label><br>
                                                <strong>{{$product->product_color}}</strong>
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Selling Price: <span
                                                class="tx-danger">*</span></label><br>
                                                <strong>{{$product->selling_price}} $</strong>
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-12">
                                    <div class="form-group"  style="border: 1px solid black; padding: 10px;">
                                        <label class="form-control-label">Product Details: <span
                                                class="tx-danger">*</span></label><br>
                                                <p>{!!$product->product_details!!}</p>
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-12">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Video Link: <span
                                                class="tx-danger">*</span></label><br>
                                                <strong>{{$product->video_link}}</strong>
                                    </div>
                                </div><!-- col-4 -->
                            </div>
                            <div class="row mg-b-25">
                                <div class="col-lg-4">
                                    <label class="form-control-label"> Image 1 (Main Thumbnail) <span
                                            class="tx-danger">*</span></label><br>
                                    <label class="custom-file">
                                        <img src="{{URL::to($product->image_1)}}" style="height: 60px; width: 60px;">
                                    </label>
                                    <br>
                                    <br>
                                    <br>

                                </div>
                                <div class="col-lg-4">
                                    <label class="form-control-label"> Image 2 <span class="tx-danger">*</span></label>
                                    <br>
                                    <label class="custom-file">
                                        <img src="{{URL::to($product->image_2)}}" style="height: 60px; width: 60px;">
                                    </label>
                                    <br>
                                    <br>
                                    <br>
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-control-label"> Image 3 <span class="tx-danger">*</span></label>
                                    <br>
                                    <label class="custom-file">
                                        <img src="{{URL::to($product->image_3)}}" style="height: 60px; width: 60px;">
                                    </label>
                                    <br>
                                    <br>
                                    <br>
                                </div>
                            </div><!-- col-4 -->
                            <div class="row">
                                <div class="col-lg-4">
                                    <label class="">
                                        @if ($product->main_slider == 1)
                                        <span class="badge badge-success">Active</span>
                                        @else
                                        <span class="badge badge-danger">Inactive</span>
                                        @endif
                                        <span>Main Slider</span>
                                    </label>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <label class="">
                                        @if ($product->hot_deal == 1)
                                        <span class="badge badge-success">Active</span>
                                        @else
                                        <span class="badge badge-danger">Inactive</span>
                                        @endif
                                        <span>Hot deal</span>
                                    </label>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <label class="">
                                        @if ($product->best_rated == 1)
                                        <span class="badge badge-success">Active</span>
                                        @else
                                        <span class="badge badge-danger">Inactive</span>
                                        @endif
                                        <span>Best Rated</span>
                                    </label>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <label class="">
                                        @if ($product->trend == 1)
                                        <span class="badge badge-success">Active</span>
                                        @else
                                        <span class="badge badge-danger">Inactive</span>
                                        @endif
                                        <span>Trend Product</span>
                                    </label>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <label class="">
                                        @if ($product->mid_slider == 1)
                                        <span class="badge badge-success">Active</span>
                                        @else
                                        <span class="badge badge-danger">Inactive</span>
                                        @endif
                                        <span>Mid Slider</span>
                                    </label>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <label class="">
                                        @if ($product->hot_new == 1)
                                        <span class="badge badge-success">Active</span>
                                        @else
                                        <span class="badge badge-danger">Inactive</span>
                                        @endif
                                        <span>Hot New</span>
                                    </label>
                                </div><!-- col-4 -->
                            </div><!-- row -->
                        </div><!-- form-layout -->
                    </div><!-- card -->
                    {{-- End Table Part --}}

            </div><!-- card -->
        </div><!-- sl-pagebody -->


    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
