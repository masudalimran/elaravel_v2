@extends('admin.admin_layouts')
@section('admin_content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css"
        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/bootstrap4/bootstrap.min.css')}}"> --}}

    @php
        $employee = DB::table('bismib_employee')->get();
    @endphp

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ url('admin/home') }}">Admin Panel</a>
            <a class="breadcrumb-item" href="{{ url('admin/create/employee') }}">Give attendance</a>
            <span class="breadcrumb-item active">Create Employee Here</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Create Employee here</h5>
                <p>Here below you can Create Employee</p>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h1 style="text-align: center; text-decoration: underline; color: black; margin-bottom: 4%"><b>Employee Creation</b></h1>
                    <form action="{{ route('store.attendance') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-layout">

                            <div class="col-md-6" style="margin: auto; width: 80%; padding: 0px;">
                                <div class="form-group">
                                    <label class="form-control-label">Who are you <span
                                            class="tx-danger">*</span></label>
                                    <select class="form-control select2" data-placeholder="Who are you"
                                            name="selected_employee">
                                        <option label="Select Yourself"></option>
                                            @foreach ($employee as $v_employee)
                                                <option value="{{ $v_employee->id }}">{{ $v_employee->emp_name }}</option>
                                            @endforeach
                                    </select>
                                    {{-- <input class="form-control" type="text" name="exp_name"
                                        placeholder="Enter Expense Name" required> --}}
                                </div>
                            </div><!-- col-4 -->


                            <div class="form-layout-footer" style="margin-left:45%;">
                                <button class="btn btn-success mg-r-5">I am In</button>
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
