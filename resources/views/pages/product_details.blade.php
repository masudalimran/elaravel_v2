@extends('layouts.app')
@section('content')

<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/bootstrap4/bootstrap.min.css')}}">
<link href="{{asset('public/frontend/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/plugins/OwlCarousel2-2.2.1/owl.theme.default.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/plugins/OwlCarousel2-2.2.1/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/product_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/product_responsive.css')}}">

 {{-- sweetalert2 css --}}
 <link rel="stylesheet" href="sweetalert2.min.css">
 {{-- sweetalert2 css --}}

	<div class="single_product">
		<div class="container">
			<div class="row">

				<!-- Images -->
				<div class="col-lg-2 order-lg-1 order-2">
					<ul class="image_list">
						<li data-image="{{ asset($product->image_1) }}"><img src="{{ asset($product->image_1) }}" alt=""></li>
						<li data-image="{{ asset($product->image_2) }}"><img src="{{ asset($product->image_2) }}" alt=""></li>
						<li data-image="{{ asset($product->image_3) }}"><img src="{{ asset($product->image_3) }}" alt=""></li>
					</ul>
				</div>

				<!-- Selected Image -->
				<div class="col-lg-5 order-lg-2 order-1">
					<div class="image_selected"><img src="{{ asset($product->image_1) }}" alt=""></div>
				</div>

				<!-- Description -->
				<div class="col-lg-5 order-3">
					<div class="product_description">
						<div class="product_category">{{ $product->category_name }} > {{ $product->sub_category_name }}</div>
						<div class="product_name">Brand: {{ $product->brand_name }}</div>
						<div class="product_name">Product: {{ $product->product_name }}</div>
						<div class="product_text"><p>{!!  $product->product_details !!}</p></div>
						<div class="order_info d-flex flex-row">

							<form action="{{ url('cart/product/add/'.$product->id) }}" method="post" id="cart-content">
								@csrf
								<div class="row">
										<div class="col-lg-4">
										 	 <div class="form-group">
											    <label for="exampleFormControlSelect1">Color</label>
											    <select class="form-control input-lg select-100" id="exampleFormControlSelect1" name="color">
											    	@foreach($product_color as $color)
											          <option value="{{ $color }}">{{ $color }}</option>
											      	@endforeach
											    </select>
											  </div>
										 </div>
										 @if($product->product_size == NULL)
										 @else
										 	<div class="col-lg-4">
										 	 <div class="form-group">
											    <label for="exampleFormControlSelect1">Size</label>
											    <select class="form-control input-lg select-100" id="exampleFormControlSelect1" name="size">
											    	@foreach($product_size as $size)
											          <option value="{{ $size }}">{{ $size }}</option>
											      	@endforeach
											    </select>
											  </div>
										 </div>
										 @endif
										 <div class="col-lg-4">
										 	 <div class="form-group">
										    <label for="exampleFormControlSelect1">Quantity</label>
										 		<input class="form-control" type="number" pattern="[0-9]*" value="1" name="qty">
										  </div>
										 </div>
									</div>
								<div class="clearfix" style="z-index: 1000;">
								</div>

								 @if($product->discount_price == NULL)
                                              <div class="product_price"> Price : ৳ {{ numberFormat($product->selling_price) }}</div>
                                            @else
                                            @endif
                                            @if($product->discount_price != NULL)
                                              <div class="product_price">Price: ৳ {{ numberFormat($product->selling_price - $product->discount_price) }}</div>
                                            @else
                                            @endif



								<div class="button_container">
									<button type="submit" onclick="add_to_cart({{$product->id}})" class="button cart_button">Add to Cart</button>
                                    <div class="product_fav"><i class="fas fa-heart"></i></div>
                                    {{-- Insert Share this platform share links here --}}
								</div><br>

								<div class="sharethis-inline-share-buttons"></div>

							</form>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- Recently Viewed -->

	<div class="viewed">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="viewed_title_container">
						<h3 class="viewed_title">Product Details</h3>
						<div class="viewed_nav_container">
							<div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
							<div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
						</div>
					</div>

					<div class="">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Product Details</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Video or Link</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Product Review Or Comment box</a>
                          </li>
                        </ul><br>
                        <div class="tab-content" id="myTabContent">
                          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                  {!! $product->product_details !!}
                          </div>
                          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                               Product Videos : {!! $product->video_link !!}
                          </div>
                          <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">

                              <div class="fb-comments" data-href="{{ Request::url() }}" data-width="" data-numposts="8"></div>
                            {{-- <div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments/comments#configurator" data-width="" data-numposts="8"></div> --}}
                          </div>
                        </div>
                </div>
				</div>
			</div>
		</div>
	</div>
{{-- Facebook comment script --}}
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/em_GB/sdk.js#xfbml=1&version=v5.0"></script>
{{-- Facebook comment script --}}

<script src="{{asset('public/frontend/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('public/frontend/styles/bootstrap4/popper.js')}}"></script>
<script src="{{asset('public/frontend/styles/bootstrap4/bootstrap.min.js')}}"></script>
<script src="{{asset('public/frontend/plugins/greensock/TweenMax.min.js')}}"></script>
<script src="{{asset('public/frontend/plugins/greensock/TimelineMax.min.js')}}"></script>
<script src="{{asset('public/frontend/plugins/scrollmagic/ScrollMagic.min.js')}}"></script>
<script src="{{asset('public/frontend/plugins/greensock/animation.gsap.min.js')}}"></script>
<script src="{{asset('public/frontend/plugins/greensock/ScrollToPlugin.min.js')}}"></script>
<script src="{{asset('public/frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.js')}}"></script>
<script src="{{asset('public/frontend/plugins/easing/easing.js')}}"></script>
<script src="{{asset('public/frontend/js/product_custom.js')}}"></script>

{{-- sweetalert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
{{-- sweetalert2 --}}

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script type="text/javascript">
    function add_to_cart(id) {
        event.preventDefault();
        console.log(id);
        if(id) {
               $.ajax({
                   url: "{{  url('cart/product/details/add/') }}/"+id,
                   type:"POST",
                   data: $('#cart-content').serialize(),
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
                        });
                        $("#cart-subtotal").text(total);
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
</script>

@endsection
