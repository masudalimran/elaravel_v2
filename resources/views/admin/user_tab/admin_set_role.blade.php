@extends('admin.admin_layouts')
@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{url('admin/home')}}">Admin Panel</a>
            <a class="breadcrumb-item" href="{{route('all.admin')}}">Admin</a>
            <span class="breadcrumb-item active">Admins Set Role </span>
        </nav>
        {{-- {{dd($set_role)}} --}}

        <div class="sl-pagebody" style="  overflow-x: scroll !important; display: table; width: 100%; height: 100vh">
            <div class="sl-page-title">
                <h5>Admin Set Role</h5>
                <p>Here below is the Admin Information</p>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Here you can set all sort of Admin roles</h6>

                <p class="mg-b-20 mg-sm-b-30">All the information is here you will just have to look for it</p>

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
                <form action="{{ url('update/set_role/'.$set_role->id) }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" name="product_manage" value="1"
                                <?php
                                    if ($set_role->product_manage == 1) {
                                        echo "checked";
                                    }
                                ?>
                                >
                                <span>Product Manage</span>
                            </label>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" name="order_manage" value="1"
                                <?php
                                    if ($set_role->order_manage == 1) {
                                        echo "checked";
                                    }
                                ?>
                                >
                                <span>Order Manage</span>
                            </label>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" name="user_role_manage" value="1"
                                <?php
                                    if ($set_role->user_role_manage == 1) {
                                        echo "checked";
                                    }
                                ?>
                                >
                                <span>User Role Manage</span>
                            </label>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" name="blog_manage" value="1"
                                <?php
                                    if ($set_role->blog_manage == 1) {
                                        echo "checked";
                                    }
                                ?>
                                >
                                <span>Blog Manage</span>
                            </label>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" name="others_manage" value="1"
                                <?php
                                    if ($set_role->others_manage == 1) {
                                        echo "checked";
                                    }
                                ?>
                                >
                                <span>Others Manage</span>
                            </label>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" name="bismib_expense_manage" value="1"
                                <?php
                                    if ($set_role->bismib_expense_manage == 1) {
                                        echo "checked";
                                    }
                                ?>
                                >
                                <span>Bismib Expense Manage</span>
                            </label>
                        </div><!-- col-4 -->
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info pd-x-20">Update Role</button>
                    </div>
                </form>
            </div>
        </div><!-- table-wrapper -->
    </div><!-- card -->
</div><!-- sl-pagebody -->

    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
