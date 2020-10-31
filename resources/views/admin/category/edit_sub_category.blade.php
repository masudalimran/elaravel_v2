@extends('admin.admin_layouts')
@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="index.html">Admin Panel</a>
            <a class="breadcrumb-item" href="index.html">Category</a>
            <span class="breadcrumb-item active">Sub Category Update</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Sub Category Update</h5>

                <p>Here below is the sub category Update</p>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Here you can find all sort of sub category Updates</h6>
                <a style="position:absolute; right:5%;" href="#" class="btn btn-sm btn-success" data-toggle="modal"
                    data-target="#modaldemo3">Add NEW</a>
                <p class="mg-b-20 mg-sm-b-30">Searching, ordering and paging goodness will be immediately added to the
                    table, as shown in this example.</p>

                <div class="table-wrapper">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ url('update/sub_category/'.$sub_category->id) }}" method="post">
                    @csrf
                    <div class="modal-body pd-20">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Sub Category Name</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                value="{{$sub_category->sub_category_name}}" name="sub_category_name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Category Name</label>
                            <select class="form-control" name="category_id">
                                @foreach ($category as $row)
                                    <option value="{{$row->id}}" <?php if($row->id == $sub_category->category_id) {
                                        echo "selected";
                                    }?>>{{$row->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div><!-- modal-body -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info pd-x-20">Update Category</button>
                    </div>
                </form>
            </div>
                </div><!-- table-wrapper -->
            </div><!-- card -->
        </div><!-- sl-pagebody -->

    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
