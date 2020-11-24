@extends('layouts.app')
@section('content')
{{-- @include('layouts.menubar') --}}

{{-- sweetalert2 css --}}
<link rel="stylesheet" href="sweetalert2.min.css">
{{-- sweetalert2 css --}}

   <!-- wishlist -->

   <div class="trends" id="home-cat-buy-one-get-one">
    <div class="trends_background"
        style="background-image:url({{asset('public/frontend/images/trends_background.jpg')}})"></div>
    <div class="trends_overlay"></div>
    <div class="container">
        <div class="row">

            <!-- Trends Content -->
            <div class="col-lg-3">
                <div class="trends_container">
                    <h2 class="trends_title">WISHLIST</h2>
                    <div class="trends_text">
                        <p>Make Your Wish Come True</p>
                    </div>
                    <div class="trends_slider_nav">
                        <div class="trends_prev trends_nav" style="background: black"><i class="fas fa-angle-left ml-auto"></i></div>
                        <div class="trends_next trends_nav" style="background: black"><i class="fas fa-angle-right ml-auto"></i></div>
                    </div>
                </div>
            </div>


            <!-- Trends Slider -->
            <div class="col-lg-9">
                <div class="trends_slider_container">

                    <!-- Trends Slider -->

                    <div class="owl-carousel owl-theme trends_slider" id="carousal-refresh">
                      @foreach ($wishlist as $item)
                        <!-- Trends Slider Item -->
                        <div class="owl-item" id="remove-wishlist-{{$item->product_id}}">
                              <a href="{{url('product/details/'.$item->product_id.'/'.$item->product_name)}}">
                              <div class="trends_item is_new">
                                  <div
                                      class="trends_image d-flex flex-column align-items-center justify-content-center">
                                      <img src="{{asset($item->image_1)}}" style="height: 200px; width: 220px"></div>
                                  <div class="trends_content">
                                      <div class="trends_category"><a href="#">{{$item->category_name}}</a></div>
                                      <div class="trends_info clearfix">
                                          <div class="trends_name"><a href="product.html">{{$item->product_name}}</a></div>
                                          <div class="trends_price">৳ {{numberFormat($item->selling_price)}}</div>
                                      </div>
                                  </div>

                                  <ul class="trends_marks">
                                      @if($item->discount_price == NULL)
                                      @else
                                      <li class="trends_mark trends_new" style="background: red;">
                                          -{{round(($item->discount_price/$item->selling_price)*100)}}%</li>
                                      @endif
                                      @if($item->hot_new == NULL)
                                      @else
                                      <li class="trends_mark trends_new" style="background: #10b529;">New
                                      </li>
                                      @endif
                                  </ul>
                                  <div style="margin-top: 10px; text-align: center;"><a onclick="remove_wishlist({{$item->product_id}})" class="btn btn-warning btn-sm" >Remove From Wishlist</a></div>
                                  <div style="margin-top: 10px; text-align: center;"><a onclick="add_to_cart({{$item->product_id}})" class="btn btn-primary btn-md" >Add to Cart</a></div>
                              </div>
                          </a>
                          </div>
                      @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


{{-- sweetalert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
{{-- sweetalert2 --}}

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

{{-- Sweetalert 2 --}}

<script type="text/javascript">
    function add_to_cart(id) {
        console.log(id);
        if(id) {
               $.ajax({
                   url: "{{  url('/addtocart/') }}/"+id,
                   type:"GET",
                   dataType:"json",
                   success:function(data) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                        })
                        Toast.fire({
                        icon: 'success',
                        title: data.msg
                        })
                        // console.log("asddddddddddddddddddddddddddddddddddddddddddd = "+ data.cart_count)
                        $("#cart-count").text(data.cart_count);
                   },

                   error:function(data) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                        })
                        Toast.fire({
                        icon: 'error',
                        title: data.responseJSON.msg
                        })
                   },
               });
        } else {
            alert('danger');
           }
    }

    function remove_wishlist(id) {
        console.log(id);
        if(id) {
               $.ajax({
                   url: "{{  url('/remove/wishlist/') }}/"+id,
                   type:"GET",
                   dataType:"json",
                   success:function(data) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                        })
                        Toast.fire({
                        icon: 'warning',
                        title: data.msg
                        })
                        $('#remove-wishlist-'+data.product_id).remove()
                        $('#carousal-refresh').trigger('remove.owl.carousel',0).trigger('refresh.owl.carousel');

                   },

                   error:function(data) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                        })
                        Toast.fire({
                        icon: 'error',
                        title: data.responseJSON.msg
                        })
                   },
               });
        } else {
            alert('danger');
           }
    }
</script>

@endsection
