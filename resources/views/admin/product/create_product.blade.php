@extends('admin.admin_layouts')
@section('admin_content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css"
        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.css">

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{url('admin/home')}}">Admin Panel</a>
            <a class="breadcrumb-item" href="{{url('all.product')}}">Product</a>
            <span class="breadcrumb-item active">Add Product</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Create Products here</h5>
                <p>Here below you can add products</p>
            </div><!-- sl-page-title -->


            <div class="card pd-20 pd-sm-40">
                {{-- start Table Part --}}

                    <div class="card pd-20 pd-sm-40">
                        <form action="{{ route('store.product') }}" method="post" enctype="multipart/form-data">
                            @csrf

                        <div class="form-layout">
                            <div class="row mg-b-25">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Product Name: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="product_name"
                                            placeholder="Enter First Name">
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Product Code: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="product_code"
                                            placeholder="Enter Last Name">
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Quantity: <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="product_quantity"
                                            placeholder="Enter Quantity">
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
                                        <select class="form-control select2" data-placeholder="Choose country"
                                            name="category_id">
                                            <option label="Choose Category"></option>
                                            @foreach ($category as $v_category)
                                                <option value="{{ $v_category->id }}">{{ $v_category->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Sub Category: <span
                                                class="tx-danger">*</span></label>
                                        <select class="form-control select2" data-placeholder="Choose country"
                                            name="subcategory_id">
                                            <option label="Choose Sub Category"></option>

                                        </select>
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Brand: <span class="tx-danger">*</span></label>
                                        <select class="form-control select2" data-placeholder="Choose country"
                                            name="brand_id">
                                            <option label="Choose Brand"></option>
                                            @foreach ($brand as $v_brand)
                                                <option value="{{ $v_brand->id }}">{{ $v_brand->brand_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Product Size: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="product_size" id="size"
                                            data-role="tagsinput">
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Product Color: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" name="product_color" id="color" data-role="tagsinput">
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Selling Price: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="selling_price"
                                            placeholder="Selling Price">
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Product Details: <span
                                                class="tx-danger">*</span></label>
                                        <textarea id="mytextarea" name="product_details"
                                            placeholder="Product details..."></textarea>
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-12">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Video Link: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" placeholder="Video Link" name="video_link">
                                    </div>
                                </div><!-- col-4 -->
                            </div>
                            <div class="row mg-b-25">
                                <div class="col-lg-4">
                                    <label class="form-control-label"> Image 1 (Main Thumbnail) <span
                                            class="tx-danger">*</span></label>
                                    <label class="custom-file">
                                        <input type="file" id="file" class="custom-file-input" name="image_1"
                                            onchange="readURL1(this);" required>
                                        <span class="custom-file-control"></span>
                                    </label><br>
                                    <img src="" id="one">
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-control-label"> Image 2 <span class="tx-danger">*</span></label>
                                    <label class="custom-file">
                                        <input type="file" id="file" class="custom-file-input" name="image_2"
                                            onchange="readURL2(this);">
                                        <span class="custom-file-control"></span>
                                    </label><br>
                                    <img src="" id="two">
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-control-label"> Image 3 <span class="tx-danger">*</span></label>
                                    <label class="custom-file">
                                        <input type="file" id="file" class="custom-file-input" name="image_3"
                                            onchange="readURL3(this);">
                                        <span class="custom-file-control"></span>
                                    </label><br>
                                    <img src="" id="three">
                                </div>
                            </div><!-- col-4 -->
                            <div class="row">
                                <div class="col-lg-4">
                                    <label class="ckbox">
                                        <input type="checkbox" name="main_slider" value="1">
                                        <span>Main Slider</span>
                                    </label>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <label class="ckbox">
                                        <input type="checkbox" name="hot_deal" value="1">
                                        <span>Hot deal</span>
                                    </label>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <label class="ckbox">
                                        <input type="checkbox" name="best_rated" value="1">
                                        <span>Best Rated</span>
                                    </label>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <label class="ckbox">
                                        <input type="checkbox" name="trend" value="1">
                                        <span>Trend Product</span>
                                    </label>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <label class="ckbox">
                                        <input type="checkbox" name="mid_slider" value="1">
                                        <span>Mid Slider</span>
                                    </label>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <label class="ckbox">
                                        <input type="checkbox" name="hot_new" value="1">
                                        <span>Hot New</span>
                                    </label>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <label class="ckbox">
                                        <input type="checkbox" name="buy_1_get_1" value="1">
                                        <span>Buy One Get One</span>
                                    </label>
                                </div><!-- col-4 -->
                            </div><!-- row -->



                            <div class="form-layout-footer">
                                <button class="btn btn-info mg-r-5">Create Product</button>
                                <button class="btn btn-secondary">Cancel</button>
                            </div><!-- form-layout-footer -->
                        </form>
                        </div><!-- form-layout -->
                    </div><!-- card -->
                    {{-- End Table Part --}}

            </div><!-- card -->
        </div><!-- sl-pagebody -->


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
