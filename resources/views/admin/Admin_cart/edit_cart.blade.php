@extends('admin.admin_layouts')
@section('admin_content')
    @php
        $category=DB::table('categories')->get();
        $sub_category=DB::table('sub_categories')->get();
        $brand=DB::table('brands')->get();
    @endphp
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css"
        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.css">

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{url('admin/home')}}">Admin Panel</a>
            <a class="breadcrumb-item" href="{{route('all.cart')}}">Cart</a>
            <span class="breadcrumb-item active">Edit Cart</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Edit Cart here</h5>
                <p>Here below you can edit products</p>
            </div><!-- sl-page-title -->


            <div class="card pd-20 pd-sm-40">
                {{-- start Table Part --}}

                    <div class="card pd-20 pd-sm-40">
                        {{-- <form action="{{url('update/cart/'.$product->id)}}" method="post" enctype="multipart/form-data">
                            @csrf --}}
                            <div class="form-layout">
                                <div class="row mg-b-25">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Product Name: </label>
                                            <input class="form-control" type="text" name="product_name"
                                                value="{{ $product->product_name }}">
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-1">
                                        <div class="form-group">
                                            <label class="form-control-label">Qty: </label>
                                            <input class="form-control" type="text" name="qty"
                                                value="{{ $product->qty }}">
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-1">
                                        <div class="form-group">
                                            <label class="form-control-label">Size: </label>
                                            <input class="form-control" type="text" name="product_size"
                                                value="{{ $product->product_size }}">
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="form-control-label">Color: </label>
                                            <input class="form-control" type="text" name="product_color"
                                                value="{{ $product->product_color }}">
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="form-control-label">Asking Price: </label>
                                            <input class="form-control" type="text" name="asking_price"
                                                value="{{ $product->asking_price }}">
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="form-control-label">Discount: </label>
                                            <input class="form-control" type="text" name="discount_price"
                                                value="{{ $product->discount_price }}">
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <label class="form-control-label" style="margin-left: 12%"> Image </label>
                                        <br>
                                        <img src="{{URL::to($product->image)}}" id="cart_image" style="height: 100px; width: 120px; margin-left: 5%">
                                        <p style="margin-left: 10%;color: red">OLD IMAGE</p>
                                        <label class="custom-file" style="display: inline-block">
                                            <input type="file" id="file" class="custom-file-input" name="image"
                                                onchange="readURL1(this);" accept="image">
                                            <input type="hidden" name="old_1" value="{{$product->image}}">
                                            <span class="custom-file-control"></span>
                                        </label><br><br>

                                    </div>

                                <div class="form-layout-footer" style="margin-top:auto; margin-left:auto;">
                                    <button class="btn btn-info mg-r-10" type="submit">Update Cart</button>
                                </div><!-- form-layout-footer -->

                            </div><!-- form-layout -->
                        {{-- </form> --}}


                    </div>
                    {{-- End Table Part --}}
            <!-- card -->

        </div><!-- sl-pagebody -->
@endsection
