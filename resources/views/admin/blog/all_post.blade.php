@extends('admin.admin_layouts')
@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="index.html">Admin Panel</a>
            <a class="breadcrumb-item" href="index.html">Blogs</a>
            <span class="breadcrumb-item active">Post List</span>
        </nav>

        <div class="sl-pagebody" style="  overflow-x: scroll !important; display: table; width: 100%; height: 100vh">
            <div class="sl-page-title">
                <h5>Post List</h5>
                <p>Here below is the Post list</p>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Here you can find all sort of Post listrings</h6>
                <a style="position:absolute; right:5%;" href="{{route('add.product')}}" class="btn btn-sm btn-success"
                    >Add NEW</a>
                <p class="mg-b-20 mg-sm-b-30">Searching, ordering and paging goodness will be immediately added to the
                    table, as shown in this example.</p>

                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th class="wd-10p">Title (ENG)</th>
                                <th class="wd-10p">Title (BN)</th>
                                <th class="wd-20p">Category (ENG)</th>
                                <th class="wd-20p">Category (BN)</th>
                                <th class="wd-20p">Image</th>
                                <th class="wd-40p">Action</th>
                            </tr>
                        </thead>
                        {{-- {{dd($index_product)}} --}}
                        <tbody>
                            @foreach ($all_post as $v_all_post)
                            <tr>
                                <td>{{$v_all_post->post_title_en}}</td>
                                <td>{{$v_all_post->post_title_bn}}</td>
                                <td>{{$v_all_post->category_name_en}}</td>
                                <td>{{$v_all_post->category_name_bn}}</td>
                                <td><img src="{{URL::to($v_all_post->post_image)}}" height="50px" width="80px"></td>
                                <td style="white-space: nowrap;">
                                    <a href="{{URL::to('edit/post/'.$v_all_post->id)}}" class="btn btn-sm btn-info">Edit</a>
                                    <a href="{{URL::to('delete/post/'.$v_all_post->id)}}" class="btn btn-sm btn-danger" id="delete">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- table-wrapper -->
            </div><!-- card -->
        </div><!-- sl-pagebody -->


    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
