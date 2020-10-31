@extends('admin.admin_layouts')
@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="index.html">Admin Panel</a>
            <a class="breadcrumb-item" href="index.html">Blogs</a>
            <span class="breadcrumb-item active">Add Post</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Create posts here</h5>
                <p>Here below you can add posts</p>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                {{-- start Table Part --}}

                    <div class="card pd-20 pd-sm-40">
                        <form action="{{ route('store.blogpost') }}" method="post" enctype="multipart/form-data">
                            @csrf

                        <div class="form-layout">
                            <div class="row mg-b-25">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Post Title (ENG): <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="post_title_en"
                                            placeholder="Enter First Name">
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Post Title (BN): <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="post_title_bn"
                                            placeholder="Enter Last Name">
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Category(ENG): <span class="tx-danger">*</span></label>
                                        <select class="form-control select2" data-placeholder="Choose country"
                                            name="category_id">
                                            <option label="Choose Category"></option>
                                            @foreach ($category as $v_category)
                                                <option value="{{ $v_category->id }}">{{ $v_category->category_name_en }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Category(BN): <span class="tx-danger">*</span></label>
                                        <select class="form-control select2" data-placeholder="Choose country"
                                            name="category_id">
                                            <option label="Choose Category"></option>
                                            @foreach ($category as $v_category)
                                                <option value="{{ $v_category->id }}">{{ $v_category->category_name_bn }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Product Details (ENG): <span
                                                class="tx-danger">*</span></label>
                                        <textarea id="mytextarea1" name="details_en"
                                            placeholder="Product details..."></textarea>
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Product Details (BN): <span
                                                class="tx-danger">*</span></label>
                                        <textarea id="mytextarea2" name="details_bn"
                                            placeholder="Product details..."></textarea>
                                    </div>
                                </div><!-- col-4 -->
                            </div>

                            <div class="row mg-b-25">
                                <div class="col-lg-4">
                                    <label class="form-control-label"> Post Image <span
                                            class="tx-danger">*</span></label>
                                    <label class="custom-file">
                                        <input type="file" id="file" class="custom-file-input" name="post_image"
                                            onchange="readURL1(this);" required>
                                        <span class="custom-file-control"></span>
                                    </label><br>
                                    <img src="" id="one">
                                </div>
                            </div><!-- col-4 -->

                            <div class="form-layout-footer">
                                <button class="btn btn-info mg-r-5" type="submit">Create Post</button>
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
            selector: '#mytextarea1'
        });
        tinymce.init({
            selector: '#mytextarea2'
        });

    </script>
    {{-- end Text editor TinyMCE --}}

@endsection
