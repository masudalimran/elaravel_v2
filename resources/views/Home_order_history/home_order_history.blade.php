@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/contact_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/contact_responsive.css')}}">

{{-- {{dd($forntend_cart_details)}} --}}

    <div class="contact_form">
        <div class="container">
            <h1 style="text-align:center; text-decoration: underline;">Cart Details</h1>
            <div class="row">
                <div class="col-12 card">
                    <table class="table table-response">
                        <thead>
                            <tr>
                                <th class="wd-5p">ID</th>
                                <th class="wd-20p">User</th>
                                <th class="wd-10p">Cart ID</th>
                                <th class="wd-10p">Product ID</th>
                                <th class="wd-20p">Product Name</th>
                                <th class="wd-5p">Qty</th>
                                <th class="wd-10p">Size</th>
                                <th class="wd-10p">Color</th>
                                <th class="wd-8p">Asking Price</th>
                                <th class="wd-8p">Discount</th>
                                <th class="wd-8p">Sub Total</th>
                                <th class="wd-8p">Image</th>
                                <th class="wd-8p">Created At</th>
                                <th class="wd-8p">Updated At</th>
                            </tr>
                        </thead>
                        {{-- {{dd($index_product)}} --}}
                        <tbody>
                            @foreach ($forntend_cart_details as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->cart_id}}</td>
                                <td>{{$row->product_id}}</td>
                                <td>{{$row->product_name}}</td>
                                <td>{{$row->qty}}</td>
                                <td>{{$row->product_size}}</td>
                                <td>{{$row->product_color}}</td>
                                <td>{{numberformat($row->asking_price)}}</td>
                                <td>{{numberformat($row->discount_price)}}</td>
                                <td>{{numberformat($row->price)}}</td>
                                <td><img src="{{asset($row->image)}}" style="height:60px; width:80px"></td>
                                <td>{{YmdTodmYPmdMyPM($row->created_at)}}</td>
                                <td>{{YmdTodmYPmdMyPM($row->updated_at)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                    <div class="card">
                        <div class="card-header" style="text-align: center; color:red">
                            <h3> Paid With {{$row->paid_with}}</h3>
                        </div>
                        <div class="card-body">
                            <h5 class="card-text" style="text-align: center; color:black">Coupon Discount: {{numberformat($row->coupon_discount)}}</h5>
                            <h5 class="card-text" style="text-align: center; color:black">Shipping Cost: {{numberformat($row->shipping_cost)}}</h5>
                            <h5 class="card-text" style="text-align: center; color:black">Vat: {{numberformat($row->vat)}}</h5>
                            <h4 class="card-title" style="text-align: center; color:Blue">Total Cost: {{numberformat($row->total_cost)}}</h4>
                            <h5 class="card-title" style="text-align: center"></h5>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
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

<script>
    $(document).on("click", "#delete", function(e){
        e.preventDefault();
        var link = $(this).attr("href");
           swal({
             title: "Do you Want to delete?",
             text: "Once Deleted, You Cannot Go Back!",
             icon: "warning",
             buttons: true,
             dangerMode: true,
           })
           .then((willDelete) => {
             if (willDelete) {
                  window.location.href = link;
             } else {
               swal("Canceled Delete");
             }
           });
       });
</script>
@endsection
