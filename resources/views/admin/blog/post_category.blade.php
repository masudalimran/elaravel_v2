@extends('admin.admin_layouts')
@section('admin_content')

{{-- css --}}
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
{{-- css --}}

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
                        <form action="{{ route('store.blogpost.category') }}" method="post">
                            @csrf

                        <div class="form-layout">
                            <div class="row mg-b-25">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Post Category Name (ENG): <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="post_category_en"
                                            placeholder="Enter Post Category Name" required>
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Post Category Name (BN): <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="post_category_bn"
                                            placeholder="Enter Post Category Name" required>
                                    </div>
                                </div><!-- col-4 -->
                            <div class="form-layout-footer">
                                <button class="btn btn-info mg-r-5" type="submit">Add Post Category</button>
                            </div>
                            <!-- form-layout-footer -->
                        </form>
                        </div><!-- form-layout -->
                    </div><!-- card -->
                    {{-- End Table Part --}}

            </div><!-- card -->
        </div><!-- sl-pagebody -->


    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        @if(Session::has('messege'))
          var type="{{Session::get('alert-type','info')}}"
          switch(type){
              case 'info':
                   toastr.info("{{ Session::get('messege') }}");
                   break;
              case 'success':
                  toastr.success("{{ Session::get('messege') }}");
                  break;
              case 'warning':
                 toastr.warning("{{ Session::get('messege') }}");
                  break;
              case 'error':
                  toastr.error("{{ Session::get('messege') }}");
                  break;
          }
        @endif
     </script>

@endsection
