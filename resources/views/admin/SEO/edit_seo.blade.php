@extends('admin.admin_layouts')
@section('admin_content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css"
        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.css">

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{url('admin/home')}}">Admin Panel</a>
            <a class="breadcrumb-item" href="{{url('all.product')}}">SEO</a>
            <span class="breadcrumb-item active">Manage SEO Keywords</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Manage SEO Keywords</h5>
                <p>Here below you can manage SEO Keywords</p>
            </div><!-- sl-page-title -->


            <div class="card pd-20 pd-sm-40">
                {{-- start Table Part --}}

                    <div class="card pd-20 pd-sm-40">
                        <form action="{{ route('update.seo') }}" method="post">
                            @csrf

                        <div class="form-layout">
                            <div class="row mg-b-25">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Meta Title En<span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" type="string" name="meta_title_en"
                                            placeholder="{{$seo->meta_title_en}}" value="{{$seo->meta_title_en}}">
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Meta Title Bn  <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" type="string" name="meta_title_bn"
                                            placeholder="{{$seo->meta_title_bn}}" value="{{$seo->meta_title_bn}}">
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Meta Author En<span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" type="string" name="meta_author_en"
                                            placeholder="{{$seo->meta_author_en}}" value="{{$seo->meta_author_en}}">
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Meta Author Bn<span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" type="string" name="meta_author_bn"
                                            placeholder="{{$seo->meta_author_bn}}" value="{{$seo->meta_author_bn}}">
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Meta Tags En<span class="tx-danger">*</span></label>
                                        <input class="form-control" type="string" name="meta_tags_en"
                                            placeholder="{{$seo->meta_tags_en}}" value="{{$seo->meta_tags_en}}">
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Meta Tags bn<span class="tx-danger">*</span></label>
                                        <input class="form-control" type="string" name="meta_tags_bn"
                                            placeholder="{{$seo->meta_tags_bn}}" value="{{$seo->meta_tags_bn}}">
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Meta description En<span class="tx-danger">*</span></label>
                                        <textarea id="mytextarea1" name="meta_description_en"
                                            placeholder="{{$seo->meta_description_en}}" >{!!$seo->meta_description_en!!}</textarea>
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Meta description bn<span class="tx-danger">*</span></label>
                                        <textarea id="mytextarea2" name="meta_description_bn"
                                            placeholder="{{$seo->meta_description_bn}}" >{!!$seo->meta_description_bn!!}</textarea>
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Google Analytics En<span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="google_analytics_en"
                                            placeholder="{{$seo->google_analytics_en}}" value="{{$seo->google_analytics_en}}">
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Google Analytics Bn<span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="google_analytics_bn"
                                            placeholder="{{$seo->google_analytics_bn}}" value="{{$seo->google_analytics_bn}}">
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Bing Analytics En<span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="bing_analytics_en"
                                            placeholder="{{$seo->bing_analytics_en}}" value="{{$seo->bing_analytics_en}}">
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Bing Analytics Bn<span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="bing_analytics_bn"
                                            placeholder="{{$seo->bing_analytics_bn}}" value="{{$seo->bing_analytics_bn}}">
                                    </div>
                                </div><!-- col-4 -->
                            </div>

                            <div class="form-layout-footer" style="float: right">
                                <button class="btn btn-info mg-r-5">Update SEO</button>
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

    </script>
    <script>
        tinymce.init({
            selector: '#mytextarea2'
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
