@extends('admin.admin_layouts')
@section('admin_content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css"
        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/bootstrap4/bootstrap.min.css')}}"> --}}

    @php
        $expense_category = DB::table('expense_category')->get();
        $image=$expense_table_data->exp_document;
        if($image == NULL){
            $exp_image = NULL;
        }else{
            $exp_image = explode('::::', $image);
        }
    @endphp


    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ url('admin/home') }}">Admin Panel</a>
            <a class="breadcrumb-item" href="{{ url('admin/create/expense') }}">Expense Sheet</a>
            <span class="breadcrumb-item active">Edit Expense Sheet</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Edit Expense Sheet here</h5>
                <p>Here below you can Edit Expense Sheet</p>
            </div><!-- sl-page-title -->


            <div class="card pd-20 pd-sm-40">
                {{-- start Table Part --}}
                {{-- <h1 style="text-align: center; text-decoration: underline; color: black"><b>Create Expense Category Here</b></h1> --}}
            </div><!-- card -->

            <div class="card pd-20 pd-sm-40">
                <h1 style="text-align: center; text-decoration: underline; color: black; margin-bottom: 4%"><b>Update Expense</b></h1>
                    <form action="{{ url('update/expense/'.$expense_table_data->id) }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-layout">
                            <div class="row mg-b-25">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="form-control-label">Expense Name: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="exp_name"
                                            value={{$expense_table_data->exp_name}} >
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="form-control-label">Select category <span
                                                class="tx-danger">*</span></label>
                                        <select class="form-control select2" data-placeholder="Choose country"
                                                name="exp_category" >
                                            <option label="Choose Category"></option>
                                            @foreach ($expense_category as $v_expense_category)
                                                <option value="{{ $v_expense_category->id }}"
                                                    <?php
                                                        if($v_expense_category->id == $expense_table_data->exp_category){
                                                            echo "selected";
                                                        }
                                                    ?>
                                                    >{{ $v_expense_category->exp_category }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="form-control-label">Amount: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="exp_amount"
                                            value={{$expense_table_data->exp_amount}}>
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="form-control-label">Date: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" id="datepicker" name="exp_date"
                                            value={{YmdTodmY($expense_table_data->exp_date)}}>
                                        {{-- <input type="text" id="datepicker" name="exp_date"> --}}
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Comments (if any): </label>
                                        <textarea id="mytextarea1" name="exp_comment"
                                        >{{$expense_table_data->exp_comment}}</textarea>
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-12">
                                    <label class="form-control-label"> Upload Document <span
                                            class="tx-danger">*</span></label>
                                    <br>
                                    @if($exp_image)
                                    <label class="custom-file">
                                        <input type="file" id="file" class="custom-file-input" name="exp_document[]"
                                        multiple onchange="readURL2(this);">
                                        {{--  --}}
                                        <span class="custom-file-control"></span>
                                    </label><br><br>
                                    <div id="exp_document_section">
                                        <h3 style="color: black;text-align: center" >Previous Images</h3>
                                        <br>
                                        @foreach($exp_image as $v_exp_image)
                                        <div class="text-center" style='display:inline-block; max-height:150px; max-width:150px;'>
                                            <img src="{{asset($v_exp_image)}}" style="max-height:100px; max-width:100px;padding:10px">
                                            <a href="{{url('admin/delete/expense/image',[$expense_table_data->id,$loop->index])}}">
                                            <span class="badge badge-pill badge-danger" style="z-index: 1; position: absolute; margin-left:5px">X</span></a>
                                            <p style="font-size:12px; color:black; padding:3%;">{{$v_exp_image}}</p>
                                            {{-- <button class="btn btn-sm btn-danger">X</button> --}}
                                        </div>
                                        @endforeach
                                        @endif
                                        <hr>
                                    </div>
                                </div>
                                <br>
                            </div>
                            <div class="form-layout-footer" style="float: right">
                                <button class="btn btn-success mg-r-5">Update Expense</button>
                                {{-- <button class="btn btn-danger"><a href="{{ url('admin/create/expense') }}"></a>Cancel</button> --}}
                            </div><!-- form-layout-footer -->
                    </form>
                </div><!-- form-layout -->
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

                var files = event.target.files;

                for (let index = 0; index < file_length; index++) {
                    var file = files[index];
                    var file_name = files[index].name;
                    var src = '';
                    var picReader = new FileReader();

                    picReader.addEventListener("load", function(event) {
                        console.log(event)
                        console.log("files:   ")
                        console.log(files[index].name)
                        console.log(event.target)
                        console.log(event.target.result)
                        document.getElementById('category_image_section').innerHTML +=
                            "<div style='display:inline-block;'><img src='" + event.target.result +
                            "' style='max-height:100px; max-width:100px; padding:10%;'><p style='font-size:12px; color:black; padding:10%;'>" +
                            files[index].name + "</p>";
                    });
                    picReader.readAsDataURL(file);
                }
            }
        }

    </script>

    <script type="text/javascript">
        function readURL2(input) {
            if (input.files && input.files[0]) {
                console.log((input.files).length);
                var file_length = (input.files).length;

                var files = event.target.files;

                for (let index = 0; index < file_length; index++) {
                    var file = files[index];
                    var file_name = files[index].name;
                    var src = '';
                    var picReader = new FileReader();

                    picReader.addEventListener("load", function(event) {
                        console.log(event)
                        console.log("files:   ")
                        console.log(files[index].name)
                        console.log(event.target)
                        console.log(event.target.result)
                        document.getElementById('exp_document_section').innerHTML +=
                            "<div style='display:inline-block;'><img src='" + event.target.result +
                            "' style='max-height:100px; max-width:100px; padding:10%;'><p style='font-size:12px; color:black; padding:10%;'>" +
                            files[index].name + "</p>";
                    });
                    picReader.readAsDataURL(file);
                }
            }
        }

</script>
    {{-- image script end --}}

    <script src="{{ asset('public/backend/lib/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('public/backend/lib/medium-editor/medium-editor.js') }}"></script>

    {{-- Text editor TinyMCE --}}
    <script src='https://cdn.tiny.cloud/1/cyp4451ez2g9vhdc0u89uzajq3vp782nk3i4zbkebko0cda2/tinymce/5/tinymce.min.js'
        referrerpolicy="origin">
    </script>
    <script>
        tinymce.init({
            selector: '#mytextarea'
        });

    </script>
    <script>
        tinymce.init({
            selector: '#mytextarea1'
        });

    </script>
    {{-- end Text editor TinyMCE --}}

    {{-- Datepicker --}}
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>

        $( function() {
            $( "#datepicker" ).datepicker({
                dateFormat: 'dd-mm-yy'
            });
        } );
        </script>
    {{-- Datepicker --}}

    {{-- Tags Input script --}}
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"
        integrity="sha512-9UR1ynHntZdqHnwXKTaOm1s6V9fExqejKvg5XMawEMToW4sSw+3jtLrYfZPijvnwnnE8Uol1O9BcAskoxgec+g=="
        crossorigin="anonymous"></script>



@endsection
