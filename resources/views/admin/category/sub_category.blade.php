@extends('admin.admin_layouts')
@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="index.html">Admin Panel</a>
            <a class="breadcrumb-item" href="index.html"> Sub Category</a>
            <span class="breadcrumb-item active">Sub Category List</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Sub Category List</h5>

                <p>Here below is the Sub category list</p>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Here you can find all sort of Sub category listrings</h6>
                <a style="position:absolute; right:5%;" href="#" class="btn btn-sm btn-success" data-toggle="modal"
                    data-target="#modaldemo3">Add NEW</a>
                <p class="mg-b-20 mg-sm-b-30">Searching, ordering and paging goodness will be immediately added to the
                    table, as shown in this example.</p>

                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive mw-100 nowrap">
                        <thead>
                            <tr>
                                <th class="wd-10p">ID</th>
                                <th class="wd-40p">Sub Categpry Name</th>
                                <th class="wd-40p">Category Name</th>
                                <th class="wd-10p">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sub_category as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->sub_category_name}}</td>
                                <td>{{$row->category_name}}</td>
                                <td>
                                    <a href="{{URL::to('edit/sub_category/'.$row->id)}}" class="btn btn-sm btn-info">Edit</a>
                                <a href="{{URL::to('delete/sub_category/'.$row->id)}}" class="btn btn-sm btn-danger" id="delete">delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- table-wrapper -->
            </div><!-- card -->
        </div><!-- sl-pagebody -->

        {{-- Modal start--}}
        <!-- Modal -->
        <div id="modaldemo3" class="modal fade">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content tx-size-sm">
                    <div class="modal-header pd-x-20">
                        <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Category Add</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('store.sub_category') }}" method="post">
                        @csrf
                        <div class="modal-body pd-20">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Sub Category Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                    placeholder="Sub Category Name" name="sub_category_name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Category Name</label>
                                <select class="form-control" name="category_id">
                                    @foreach ($category as $row)
                                        <option value="{{$row->id}}">{{$row->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- modal-body -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info pd-x-20">Create Sub Category</button>
                            <button type="button" class="btn btn-danger pd-x-20" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div><!-- modal-dialog -->
        </div><!-- modal -->
        {{-- Modal end --}}

    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
