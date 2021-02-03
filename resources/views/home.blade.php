@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/contact_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/contact_responsive.css')}}">

    <div class="contact_form">
        <div class="container">
            <h1 style="text-align:center; text-decoration: underline;">Order History</h1>
            <div class="row">
                <div class="col-8 card" id="cart_info_web" style="display: none">
                    <table class="table table-response">
                        <thead>
                            <tr>
                                <th class="wd-5p">Cart ID</th>
                                <th class="wd-5p">Coupon Discount</th>
                                <th class="wd-5p">Shipping Cost</th>
                                <th class="wd-5p">Vat</th>
                                <th class="wd-5p">Total Cost</th>
                                <th class="wd-8p">Paid With</th>
                                <th class="wd-5p">Created At</th>
                                <th class="wd-10p">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user_cart_info as $row)
                            <tr>
                                <td>
                                    <a href="{{route('home.all.cart.details',[app()->getLocale(), (int) $row->cart_id])}}">{{$row->cart_id}}</a>
                                </td>
                                <td>{{numberformat($row->coupon_discount)}}</td>
                                <td>{{numberformat($row->shipping_cost)}}</td>
                                <td>{{numberformat($row->vat)}}</td>
                                <td><span class="badge badge-warning">{{numberformat($row->total_cost)}}</span></td>
                                <td>{{$row->paid_with}}</td>
                                <td>{{YmdTodmYPmdMyPM($row->created_at)}}</td>
                                <td style="white-space: nowrap;">
                                    <a href="{{URL::to('/'.app()->getLocale().'home/delete/cart/'.$row->id)}}" class="btn btn-sm btn-danger" id="delete">Delete</a>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="col-4" id="profile_info_web">
                    <div class="card" style="width: 18rem;">
                        <img src="{{asset('public/yo.webp')}}" class="card-img-top" style="height: 50%; width: 80%; margin-left: 10%; margin-top: 5%;">
                        <div class="card-body">
                            <h5 class="card-title text-left">
                                @php
                                    echo strtoupper(Auth::user()->name."<br>");
                                    echo ("Email:".Auth::user()->email."<br>");
                                    if(Auth::user()->phone){
                                        echo ("Phone: ".Auth::user()->phone."<br>");
                                    }
                                    if(Auth::user()->provider){
                                    echo strtoupper("Provider : ".Auth::user()->provider."<br>");
                                    }
                                    if(Auth::user()->provider_id){
                                    echo strtoupper("ID : ".substr(Auth::user()->provider_id,-4));
                                    }
                                    echo strtoupper("District : ".Auth::user()->shipping_district."<br>");
                                    echo strtoupper("Address : ".Auth::user()->shipping_address."<br>");
                                @endphp
                            </h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"> <a href="{{route('password.change',app()->getLocale())}}"> Change Password</a></li>
                            <li class="list-group-item"> <a href="{{route('show.cart',app()->getLocale())}}"> Show Cart</a></li>
                            <li class="list-group-item"> <a href="{{route('show.wishlist',app()->getLocale())}}"> Go to Wishlist</a></li>
                        </ul>
                        <div class="card-body">
                            <a href="{{route('user.logout',app()->getLocale())}}" class="btn btn-danger btn-sm btn-block">Logout</a>
                        </div>
                    </div>
                </div>
                <h1 id="cart_info_title_mobile" style="text-align: center;text-decoration: underline">Order History</h1>
                <hr>
                @foreach ($user_cart_info as $row)
                <div id="cart_info_mobile" class="card" style="width: 18rem; margin-left:5%; margin-bottom: 2%">
                    {{-- <img src="..." class="card-img-top" alt="..."> --}}
                    <div class="card-body">
                        <h5>Cart ID:  <a href="{{route('home.all.cart.details',[app()->getLocale(),(int) $row->cart_id])}}" style="width: 100%"> {{$row->cart_id}}</a> </h5>
                        <h5> Coupon Discount: <h5 class="card-text"> {{numberformat($row->coupon_discount)}}</h5></h5>
                        <h5>Shipping Cost: <p class="card-text"> {{numberformat($row->shipping_cost)}}</p></h5>
                        <h5>Vat: <p class="card-text">{{numberformat($row->vat)}}</p></h5>
                        <h5>Total Cost: <p class="card-text"><span class="badge badge-warning"> {{numberformat($row->total_cost)}}</span></p></h5>
                        <h5>Paid With: <p class="card-text">{{$row->paid_with}}</p></h5>
                        <h5>Created At: <p class="card-text">{{YmdTodmYPmdMyPM($row->created_at)}}</p></h5>
                        <a href="{{URL::to('/'.app()->getLocale().'home/delete/cart/'.$row->id)}}" class="btn btn-sm btn-danger" id="delete">Delete</a>
                      {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                    </div>
                  </div>
                @endforeach


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

    {{-- Mobiling stuff --}}
    <style>
        @media (min-width: 768px) {
        #cart_info_web {
            display:inline !important;
            /* background: red; */
        }
        #cart_info_mobile {
            visibility:hidden;
            /* background: red; */
        }
        #cart_info_title_mobile{
            visibility:hidden;
        }
    }
    </style>
    {{-- Mobiling stuff --}}
    @endsection
