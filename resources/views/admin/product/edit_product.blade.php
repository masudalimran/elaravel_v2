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
            <a class="breadcrumb-item" href="index.html">Admin Panel</a>
            <a class="breadcrumb-item" href="index.html">Product</a>
            <span class="breadcrumb-item active">Edit Product</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Edit Products here</h5>
                <p>Here below you can edit products</p>
            </div><!-- sl-page-title -->


            <div class="card pd-20 pd-sm-40">
                {{-- start Table Part --}}

                    <div class="card pd-20 pd-sm-40">
                        <form action="{{url('update/product/without_photo/'.$product->id)}}" method="post" >
                            @csrf
                            <div class="form-layout">
                                <div class="row mg-b-25">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Product Name: <span
                                                    class="tx-danger">*</span></label>
                                            <input class="form-control" type="text" name="product_name"
                                                value="{{ $product->product_name }}">
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Product Code: <span
                                                    class="tx-danger">*</span></label>
                                            <input class="form-control" type="text" name="product_code"
                                            value="{{ $product->product_code }}">
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Quantity: <span class="tx-danger">*</span></label>
                                            <input class="form-control" type="text" name="product_quantity"
                                            value="{{ $product->product_quantity }}">
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Discount: <span class="tx-danger">*</span></label>
                                            <input class="form-control" type="text" name="discount_price"
                                            value="{{ $product->discount_price }}">
                                        </div>
                                    </div><!-- col-4 -->

                                    <div class="col-lg-4">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
                                            <select class="form-control select2" data-placeholder="Choose country"
                                                name="category_id" >
                                                <option label="Choose Category"></option>
                                                @foreach ($category as $v_category)
                                                    <option value="{{ $v_category->id }}"
                                                    <?php
                                                        if($v_category->id == $product->category_id){
                                                            echo "selected";
                                                        }
                                                    ?>
                                                    >{{ $v_category->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">Sub Category: <span
                                                    class="tx-danger">*</span></label>
                                            <select class="form-control select2"
                                                name="subcategory_id">
                                                <option label="Choose Sub Category"></option>
                                            @foreach ($sub_category as $v_sub_category)
                                                <option value="{{ $v_category->id }}"
                                                    <?php
                                                    if($v_sub_category->id == $product->subcategory_id){
                                                        echo "selected";
                                                    }
                                                    ?>
                                                >{{ $v_sub_category->sub_category_name }}
                                                </option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div><!-- col-4 -->

                                    <div class="col-lg-4">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">Brand: <span class="tx-danger">*</span></label>
                                            <select class="form-control select2"
                                                name="brand_id">
                                                <option label="Choose Brand"></option>
                                                @foreach ($brand as $v_brand)
                                                    <option value="{{ $v_brand->id }}"
                                                        <?php
                                                            if ($product->brand_id == $v_brand->id) {
                                                            echo "selected";
                                                            }
                                                        ?>
                                                        >{{ $v_brand->brand_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">Product Size: <span
                                                    class="tx-danger">*</span></label>
                                            <input class="form-control" type="text" name="product_size" id="size" value="{{$product->product_size}}"
                                                data-role="tagsinput">
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">Product Color: <span
                                                    class="tx-danger">*</span></label>
                                            <input class="form-control" name="product_color" id="color" value="{{$product->product_color}}" data-role="tagsinput">
                                        </div>
                                    </div><!-- col-4 -->

                                    <div class="col-lg-4">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">Selling Price: <span
                                                    class="tx-danger">*</span></label>
                                            <input class="form-control" type="text" name="selling_price"
                                            value="{{$product->selling_price}}">
                                        </div>
                                    </div><!-- col-4 -->

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label">Product Details: <span
                                                    class="tx-danger">*</span></label>
                                            <textarea id="mytextarea" name="product_details"
                                            >{{$product->product_details}}</textarea>
                                        </div>
                                    </div><!-- col-4 -->

                                    <div class="col-lg-12">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">Video Link: <span
                                                    class="tx-danger">*</span></label>
                                            <input class="form-control" value="{{$product->video_link}}" name="video_link">
                                        </div>
                                    </div><!-- col-4 -->
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <label class="ckbox">
                                            <input type="checkbox" name="main_slider" value="1"
                                            <?php
                                                if ($product->main_slider == 1) {
                                                    echo "checked";
                                                }
                                            ?>
                                            >
                                            <span>Main Slider</span>
                                        </label>
                                    </div><!-- col-4 -->

                                    <div class="col-lg-4">
                                        <label class="ckbox">
                                            <input type="checkbox" name="hot_deal" value="1"
                                            <?php
                                                if ($product->hot_deal == 1) {
                                                    echo "checked";
                                                }
                                            ?>
                                            >
                                            <span>Hot deal</span>
                                        </label>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <label class="ckbox">
                                            <input type="checkbox" name="best_rated" value="1"
                                            <?php
                                                if ($product->best_rated == 1) {
                                                    echo "checked";
                                                }
                                            ?>
                                            >
                                            <span>Best Rated</span>
                                        </label>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <label class="ckbox">
                                            <input type="checkbox" name="trend" value="1"
                                            <?php
                                                if ($product->trend == 1) {
                                                    echo "checked";
                                                }
                                            ?>
                                            >
                                            <span>Trend Product</span>
                                        </label>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <label class="ckbox">
                                            <input type="checkbox" name="mid_slider" value="1"
                                            <?php
                                                if ($product->mid_slider == 1) {
                                                echo "checked";
                                                }
                                            ?>
                                            >
                                            <span>Mid Slider</span>
                                        </label>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <label class="ckbox">
                                            <input type="checkbox" name="hot_new" value="1"
                                            <?php
                                                if ($product->hot_new == 1) {
                                                echo "checked";
                                                }
                                            ?>
                                            >
                                            <span>Hot New</span>
                                        </label>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <label class="ckbox">
                                            <input type="checkbox" name="buy_1_get_1" value="1"
                                            <?php
                                                if ($product->buy_1_get_1 == 1) {
                                                echo "checked";
                                                }
                                            ?>
                                            >
                                            <span>Buy One Get One</span>
                                        </label>
                                    </div><!-- col-4 -->
                                </div><!-- row -->



                                <div class="form-layout-footer">
                                    <button class="btn btn-info mg-r-5" type="submit">Update Product</button>
                                </div><!-- form-layout-footer -->
                            </div><!-- form-layout -->
                        </form>


                    </div>
                    {{-- End Table Part --}}
            <!-- card -->

        </div><!-- sl-pagebody -->

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Edit Products Images here</h5><br>
                <form action="{{url('update/product/photo/'.$product->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <label class="form-control-label"> Image 1 (Main Thumbnail) <span
                                    class="tx-danger">*</span></label>
                            <label class="custom-file">
                                <input type="file" id="file" class="custom-file-input" name="image_1"
                                    onchange="readURL1(this);" accept="image">
                                <input type="hidden" name="old_1" value="{{$product->image_1}}">
                                <span class="custom-file-control"></span>
                            </label><br>
                            <img src="{{URL::to($product->image_1)}}" id="one" style="height: 120px; width: 140px">
                        </div>
                        <div class="col-lg-4">
                            <label class="form-control-label"> Image 2 <span class="tx-danger">*</span></label>
                            <label class="custom-file">
                                <input type="file" id="file" class="custom-file-input" name="image_2"
                                    onchange="readURL2(this);" accept="image">
                                <input type="hidden" name="old_2" value="{{$product->image_2}}">
                                <span class="custom-file-control"></span>
                            </label><br>
                            <img src="{{URL::to($product->image_2)}}" id="two" style="height: 120px; width: 140px">
                        </div>
                        <div class="col-lg-4">
                            <label class="form-control-label"> Image 3 <span class="tx-danger">*</span></label>
                            <label class="custom-file">
                                <input type="file" id="file" class="custom-file-input" name="image_3"
                                    onchange="readURL3(this);" accept="image">
                                <input type="hidden" name="old_3" value="{{$product->image_3}}">
                                <span class="custom-file-control"></span>
                            </label><br>
                            <img src="{{URL::to($product->image_3)}}" id="three" style="height: 120px; width: 140px">
                        </div>
                    </div><!-- col-4 -->
                    <div class="form-layout-footer">
                        <button class="btn btn-warning mg-r-5" type="submit">Update Product With Image</button>
                    </div><!-- form-layout-footer -->
                </form>
            </div>
        </div>


    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

    {{-- Ajax --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="category_id"]').on('change', function() {
                var category_id = $(this).val();
                if (category_id) {
                    $.ajax({
                        url: "{{ url('/get/subcategory/') }}/" + category_id,
                        type: "GET",
                        datatype: "json",
                        success: function(data) {
                            var d = $('select[name="subcategory_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="subcategory_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .sub_category_name + '</option>');
                            });
                        },
                    });
                } else {
                    alert('Please select a category');
                }
            });
        });

    </script>{{--Ajax End--}}

    {{-- image script --}}
    <script type="text/javascript">
        function readURL1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#one')
                        .attr('src', e.target.result)
                        .width(100)
                        .height(100);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>
    <script type="text/javascript">
        function readURL2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#two')
                        .attr('src', e.target.result)
                        .width(100)
                        .height(100);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>
    <script type="text/javascript">
        function readURL3(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#three')
                        .attr('src', e.target.result)
                        .width(100)
                        .height(100);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>{{-- image script end --}}

    <script src="{{ asset('public/backend/lib/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('public/backend/lib/medium-editor/medium-editor.js') }}"></script>
    <script>
        $(function() {
            'use strict';

            //Inline Editor
            var editor = new MediumEditor('.editable');

            //Summernote editor
            $('#summernote').summernote({
                height: 150,
            })
        });
    </script>

    {{-- Text editor TinyMCE --}}
    <script src='https://cdn.tiny.cloud/1/cyp4451ez2g9vhdc0u89uzajq3vp782nk3i4zbkebko0cda2/tinymce/5/tinymce.min.js'
        referrerpolicy="origin">
    </script>
    <script>
        tinymce.init({
            selector: '#mytextarea'
        });

    </script>
    {{-- end Text editor TinyMCE --}}


    {{-- Color picker Spectrum --}}

    {{-- <script src="https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.js"></script>
    <script type="text/javascript">
        $('#color-picker').spectrum({
            type: "color",
            showPalette: "false",
            showPaletteOnly: "true",
            hideAfterPaletteSelect: "true",
            showInitial: "true",
            showAlpha: "false",
            showButtons: "false",
            allowEmpty: "false"
        });
    </script>
    <script type="text/javascript">
        $('#color-picker2').spectrum({
            type: "color",
            showPalette: "false",
            showPaletteOnly: "true",
            hideAfterPaletteSelect: "true",
            showInitial: "true",
            showAlpha: "false",
            showButtons: "false",
            allowEmpty: "false"
        });
    </script>
    <script type="text/javascript">
        $('#color-picker3').spectrum({
            type: "color",
            showPalette: "false",
            showPaletteOnly: "true",
            hideAfterPaletteSelect: "true",
            showInitial: "true",
            showAlpha: "false",
            showButtons: "false",
            allowEmpty: "false"
        });
    </script> --}}
    {{-- color picker spectrum End --}}





    {{-- Tags Input script --}}
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"
        integrity="sha512-9UR1ynHntZdqHnwXKTaOm1s6V9fExqejKvg5XMawEMToW4sSw+3jtLrYfZPijvnwnnE8Uol1O9BcAskoxgec+g=="
        crossorigin="anonymous"></script>



@endsection
