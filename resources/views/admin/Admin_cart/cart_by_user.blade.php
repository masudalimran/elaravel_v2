@extends('admin.admin_layouts')
@section('admin_content')

<script src="{{asset('public/frontend/js/jquery-3.3.1.min.js')}}"></script>
<script type="text/javascript">
    $(function(){
        $('#exampleModalLong').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) ;

            var userId = button.data('userid') ;
            var userName = button.data('username') ;
            // var cart_id = button.data('cart_id');
            // console.log("cart id ===========");
            // var _this = this;

            $('#modal-username').text(userName)



            $.ajax({
                url: "{!! URL::to('show_orders_by_user_id') !!}/"+userId,
                type:"GET",
                dataType:"json",
                success:function(data) {
                    console.log(data);
                    console.log(data.data);

                    var markup ="";

                    $(data.data).each(function(index, el) {

                        var isPaid = "";
                        if (el.is_checkout*1 === 1*1) {
                            isPaid = '<span class="badge badge-success">Paid</span>';
                        } else {
                            isPaid = '<span class="badge badge-danger">Not Paid</span>';
                        }
                        console.log(el.cart_id);

                        markup = markup
                                +"<tr>"
                                    + "<td>"+"<a target='_blank' href='{{URL::to('admin/cart/details/')}}/"+el.cart_id+"'>"+el.id+"</td>"

                                    +"<td>"+"<a target='_blank' href='{{URL::to('admin/browse/cart/by/single_user')}}/"+userId+"'>"+el.name+"</a>"+"</td>"

                                    + "<td>"+"<a target='_blank' href='{{URL::to('admin/cart/details/')}}/"+el.cart_id+"'>"+el.cart_id+"</td>"
                                    + "<td>"+el.coupon_discount+"</td>"
                                    + "<td>"+el.shipping_cost+"</td>"
                                    + "<td>"+el.vat+"</td>"
                                    + "<td>"+el.total_cost+"</td>"
                                    + "<td>"+el.paid_with+"</td>"
                                    + "<td>"+isPaid+"</td>"
                                    + "<td>"+el.created_at+"</td>"
                                    + "<td style='white-space: nowrap;' > "
                                        +"<a href='{{URL::to('delete/cart/')}}/"+el.id+"' class='btn btn-sm btn-danger' id='delete'>Delete</a>"
                                    +"</td>"
                                +"</tr>";
                    });

                    $("#individual_user_orders tbody").empty();
                    // console.log("markup    :"+markup);
                    $("#individual_user_orders tbody").append(markup);

                },
                complete: function(){
                    // $('#loader').css("visibility", "hidden");
                }
            });


            var modal = $(this);

            modal.find('.modal-title #modal-userid').text(userId);
        });
    });
</script>


    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{url('admin/home')}}">Admin Panel</a>
            <a class="breadcrumb-item" href="{{route('all.cart')}}">Cart</a>
            <a class="breadcrumb-item" href="#">Browse Cart Info By User</a>
            <span class="breadcrumb-item active">Browse Cart Info By User</span>
        </nav>

        <div class="sl-pagebody" style="  overflow-x: scroll !important; display: table; width: 100%; height: 100vh">
            <div class="sl-page-title">
                <h5>Browse Cart Info By User</h5>
                <p>Here below you can Browse Cart Info By User</p>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Here you can Browse Cart Info By User</h6>

                <p class="mg-b-20 mg-sm-b-30">All the information is here you will just have to look for it</p>

                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th class="wd-5p">ID</th>
                                <th class="wd-20p">User</th>
                                <th class="wd-10p">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart_by_user as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td><a href="#">{{$row->name}}</a></td>
                                <td>
                                <button data-userid="{{$row->id}}" data-username="{{strtoupper($row->name)}}" type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModalLong">
                                    View Carts
                                </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div><!-- table-wrapper -->
            </div><!-- card -->
        </div><!-- sl-pagebody -->

        {{-- MODAL start --}}
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog mw-100 w-75" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  {{-- <p class="modal-title w-100 text-center" id="modal-userid1">USER NAME</p> --}}
                  <span class="modal-title  w-100 text-center" style="font-size: 40px;" for="" id="modal-username"></span>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                     <table id="individual_user_orders" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th class="wd-5p">ID</th>
                                <th class="wd-20p">User</th>
                                <th class="wd-5p">Cart ID</th>
                                <th class="wd-5p">Coupon Discount</th>
                                <th class="wd-5p">Shipping Cost</th>
                                <th class="wd-5p">Vat</th>
                                <th class="wd-5p">Total Cost</th>
                                <th class="wd-8p">Paid With</th>
                                <th class="wd-5p">Is Paid</th>
                                <th class="wd-5p">Created At</th>
                                <th class="wd-20p">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>


                </div>
              </div>
            </div>
          </div>
          {{-- Modal end --}}


    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->


<script type="text/javascript">
    function show_cart_by_user(){
        console.log("You you asdjihadskjghakdsgja")
    }
</script>


@endsection
