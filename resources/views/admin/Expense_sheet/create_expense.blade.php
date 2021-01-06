@extends('admin.admin_layouts')
@section('admin_content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css"
        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.css">

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{url('admin/home')}}">Admin Panel</a>
            <a class="breadcrumb-item" href="{{url('admin/create/expense')}}">Expense Sheet</a>
            <span class="breadcrumb-item active">Create Expense Sheet</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Create Expense Sheet here</h5>
                <p>Here below you can Create Expense Sheet</p>
            </div><!-- sl-page-title -->


            <div class="card pd-20 pd-sm-40">
                {{-- start Table Part --}}

                    <div class="card pd-20 pd-sm-40">
                        {{-- <form action="{{ route('store.expense_sheet') }}" method="post" enctype="multipart/form-data"> --}}
                            @csrf

                        <div class="form-layout">
                            <div class="row mg-b-25">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Expense Category Name: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="exp_category_name"
                                            placeholder="Enter Expense Category Name">
                                    </div>
                                </div><!-- col-4 -->


                                <div class="col-lg-6">
                                    <label class="form-control-label"> Category Image <span
                                            class="tx-danger">*</span></label>
                                            <br>
                                    <label class="custom-file">
                                        <input type="file" id="file" class="custom-file-input" name="exp_category_image[]" multiple
                                            onchange="readURL1(this);">
                                        <span class="custom-file-control"></span>
                                    </label><br>
                                    <div id="category_image_section">
                                        {{-- <img src="" id="one"> --}}
                                    </div>
                                </div>


                            </div>
                            <div class="form-layout-footer" style="float: right">
                                <button class="btn btn-info mg-r-5">Create Product</button>
                                <button class="btn btn-secondary">Cancel</button>
                            </div><!-- form-layout-footer -->
                        {{-- </form> --}}
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
                console.log((input.files).length);
                var file_length = (input.files).length;
                var images = " ";

                var files = event.target.files;


                for (let index = 0; index < file_length; index++) {
                    var file = files[index];
                    var src = '';
                    var picReader = new FileReader();

                    picReader.addEventListener("load", function(event) {
                        console.log(event)
                        console.log(event.target)
                        console.log(event.target.result)
                        images += "<img src='"+event.target.result+"'>"
                        document.getElementById('category_image_section').innerHTML += "<img src='"+event.target.result+"'>";
                    });
                    picReader.readAsDataURL(file);
                }
            }
        }

    </script>
    {{-- image script end --}}

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

    {{-- Tags Input script --}}
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"
        integrity="sha512-9UR1ynHntZdqHnwXKTaOm1s6V9fExqejKvg5XMawEMToW4sSw+3jtLrYfZPijvnwnnE8Uol1O9BcAskoxgec+g=="
        crossorigin="anonymous"></script>



@endsection
