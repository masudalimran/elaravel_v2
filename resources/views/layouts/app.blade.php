<!DOCTYPE html>
<html lang="en">
<head>
    @php
        $language = session()->get('lang');
    @endphp
<title>
    @if ($language == 'bangla')
    বিস্ মিব ফ্যাশন
    @else
    BISMIB FASHION
    @endif
</title>
<meta name="csrf" value="{{ csrf_token() }}">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="OneTech shop project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/bootstrap4/bootstrap.min.css')}}">
<link href="{{asset('public/frontend/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/plugins/OwlCarousel2-2.2.1/owl.theme.default.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/plugins/OwlCarousel2-2.2.1/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/plugins/slick-1.8.0/slick.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/main_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/responsive.css')}}">
<link rel="stylesheet" type="text/css" href="'{{asset('public/frontend/styles/product_styles.css')}}'">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/product_responsive.css')}}">





{{-- <style>
    html{
        scroll-behavior: smooth;
    }
</style> --}}



{{--Font Awsome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />

{{-- Sweetalert --}}
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">



</head>

<body>

<div class="super_container">

	<!-- Header -->

	<header class="header">

		<!-- Top Bar -->

		<div class="top_bar">
			<div class="container">
				<div class="row">
					<div class="col d-flex flex-row">
                        @if ($language == 'bangla')
						<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{asset('public/frontend/images/phone.png')}}" alt=""></div>+৮৮০ ১৩১৫৬৮৬১৪৭ </div>
                        @else
						<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{asset('public/frontend/images/phone.png')}}" alt=""></div>+880 1315686147</div>
                        @endif
						<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{asset('public/frontend/images/mail.png')}}" alt=""></div><a href="mailto:masudalimran92@gmail.com">masudalimran92@gmail.com</a></div>
						<div class="top_bar_content ml-auto">
							<div class="top_bar_menu">
								<ul class="standard_dropdown">

									<li>
                                        @guest
                                            @if ($language == 'bangla')
                                                <a href="#">ভাষা <span style="text-transform: capitalize">({{$language}})</span><i class="fas fa-chevron-down"></i></a>
                                            @else
                                                <a href="#">Language <span style="text-transform: capitalize">({{$language}})<i class="fas fa-chevron-down"></i></a>
                                            @endif
                                            <ul>
                                                <li style="padding-left: 15px; padding-right: 15px"><a href="{{route('language.english')}}">English</i></a></li>
                                                <li style="padding-left: 15px; padding-right: 15px"><a href="{{route('language.bangla')}}">বাংলা</i></a></li>
                                                <li style="padding-left: 15px; padding-right: 15px" ><a href="#"><del> Russian (OFFLINE) </del></a>

                                                </li>
                                            </ul>
                                        @else
                                            @if ($language == 'bangla')
                                                <a href="#">ভাষা <span style="text-transform: capitalize">({{$language}})</span><i class="fas fa-chevron-down"></i></a>
                                            @else
                                                <a href="#">Language <span style="text-transform: capitalize">({{$language}})<i class="fas fa-chevron-down"></i></a>
                                            @endif
                                            <ul>
                                                <li style="padding-left: 15px; padding-right: 15px"><a href="{{route('language.english')}}">English</i></a></li>
                                                <li style="padding-left: 15px; padding-right: 15px"><a href="{{route('language.bangla')}}">বাংলা</i></a></li>
                                                <li style="padding-left: 15px; padding-right: 15px" ><a href="#"><del> Russian (OFFLINE) </del></a>

                                                </li>
                                            </ul>
                                        @endguest

									</li>
								</ul>
							</div>
							<div class="top_bar_user">
								<div class="user_icon"><img src="{{asset('public/frontend/images/user.svg')}}" alt=""></div>
                                {{-- guest start --}}
                                @guest
                                    <div><a href="{{route('login')}}">
                                        @if ($language == 'bangla')
                                        লগ ইন । রেজিস্টার
                                        @else
                                        Log in | Register
                                        @endif
                                    </a></div>

                                @else
                                    <div class="top_bar_menu">
                                        <ul class="standard_dropdown top_bar_dropdown">
                                            <li>
                                                <div><a href="{{route('home')}}">@if ($language == 'bangla') প্রোফাইল  @else Profile @endif
                                                    ({{Auth::user()->name}})</a></div>
                                                <ul>
                                                    <li><a href="#">
                                                        @if ($language == 'bangla') চেকআউট @else Checkout @endif
                                                    </a></li>
                                                    <li><a href="{{route('show.wishlist')}}">@if ($language == 'bangla') উইশ লিস্ট @else Wishlist  @endif</a></li>
                                                    <li><a href="{{route('show.cart')}}">@if ($language == 'bangla') কার্ট @else Cart  @endif</a></li>
                                                    <li><a href="{{route('user.logout')}}">@if ($language == 'bangla') লগ আউট @else Logout  @endif</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                @endguest
                                    {{-- guest end --}}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Header Main -->

		<div class="header_main">
			<div class="container">
				<div class="row">

					<!-- Logo -->
					<div class="col-lg-2 col-sm-3 col-3 order-1">
						<div class="logo_container">
                            <div class="logo"><a href="{{url('/')}}">
                                @if ($language == 'bangla')
                                        বিস্ মিব ফ্যাশন
                                        @else
                                        BISMIB FASHION
                                        @endif
                            </a></div>
						</div>
					</div>

					@php
						$category=DB::table('categories')->get();
					@endphp

					<!-- Search -->
					<div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
						<div class="header_search">
							<div class="header_search_content">
								<div class="header_search_form_container">
									<form action="#" class="header_search_form clearfix">
										<input type="search" required="required" class="header_search_input" placeholder="Search for products...">
										<div class="custom_dropdown">
											<div class="custom_dropdown_list">
												<span class="custom_dropdown_placeholder clc">@if ($language == 'bangla') সকল ক্যাটাগরি  @else All Categories @endif</span>
												<i class="fas fa-chevron-down"></i>
												<ul class="custom_list clc">
                                                    <li><a class="clc" href="#">@if ($language == 'bangla') সকল ক্যাটাগরি  @else All Categories  @endif</a></li>

													@foreach($category as $v_category)
														<li>
                                                            <a class="clc" href="#">{{ $v_category->category_name }}</a>
                                                        </li>
                                                    @endforeach

												</ul>
											</div>
										</div>
										<button type="submit" class="header_search_button trans_300" value="Submit"><img src="{{asset('public/frontend/images/search.png')}}" alt=""></button>
									</form>
								</div>
							</div>
						</div>
					</div>

					<!-- Wishlist -->
					<div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
						<div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
                            @guest

                            @else
                            @php
                                $wishlist=DB::table('wishlists')
                                ->where('user_id',Auth::id())
                                ->get();
                            @endphp
                            <div class="wishlist d-flex flex-row align-items-center justify-content-end">
								<div class="wishlist_icon"><img src="images/heart.png" alt=""></div>
								<div class="wishlist_content">
									<div class="wishlist_text"><a href="{{route('show.wishlist')}}">@if ($language == 'bangla') উইশলিস্ট @else Wishlist @endif</a></div>
									<div class="wishlist_count" id="wishlist-count">{{count($wishlist)}}</div>
								</div>
                            </div>
                            @endguest

							<!-- Cart -->
							<div class="cart">
                                @guest

                                @else
                                @php
                                $cart=DB::table('cart')
                                ->where('user_id',Auth::id())
                                ->get();

                                $subtotal_cart = 0;
                                foreach($cart as $v_cart){
                                    $subtotal_cart += ($v_cart->qty) * ($v_cart->price);
                                }
                                @endphp
								<div class="cart_container d-flex flex-row align-items-center justify-content-end">
									<div class="cart_icon">
										<img src="images/cart.png" alt="">
										<div class="cart_count" ><span id="cart-count">{{count($cart)}}</span></div>
									</div>
									<div class="cart_content">
										<div class="cart_text"><a href="{{route('show.cart')}}">@if ($language == 'bangla') কার্ট @else Cart @endif</a></div>
										<div class="cart_price" id="cart-subtotal">৳ {{numberFormat($subtotal_cart)}}</div>
									</div>
                                </div>
                                @endguest
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>

    @yield('content')

	<!-- Footer -->

	<footer class="footer">
		<div class="container">
			<div class="row">

				<div class="col-lg-3 footer_col">
					<div class="footer_column footer_contact">
						<div class="logo_container">
							<div class="logo"><a href="#">@if ($language == 'bangla') বিস্ মিব ফ্যাশন @else BISMIB FASHION  @endif</a></div>
						</div>
						<div class="footer_title">@if ($language == 'bangla') কোনো প্রশ্ন থাকলে জিজ্ঞেস করতে পারেন কল করুন ২৪/৭  @else Got Question? Call Us 24/7 @endif</div>
						<div class="footer_phone">@if ($language == 'bangla') +৮৮০ ১৩১৫৬৮৬১৪৭ @else +880 1315686147 @endif </div>
						<div class="footer_contact_text">
							<p>@if ($language == 'bangla') ঠিকানা: ৭তম ফ্লোর, <br> হাউস নম্বর: ডিসিসি 1, মোমিন স্মরণী রোড, @else Address: 7th Floor,<br> H# DCC 1, Momin Shoroni Road @endif</p>
                            <p>@if ($language == 'bangla') নর্থ ইব্রাহিমপুর ঢাকা - ১২৬০, বাংলাদেশ @else North Ibrahimpur Dhaka-1206, Bangladesh @endif</p>
						</div>
						<div class="footer_social">
							<ul>
								<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
								<li><a href="#"><i class="fab fa-twitter"></i></a></li>
								<li><a href="#"><i class="fab fa-youtube"></i></a></li>
								<li><a href="#"><i class="fab fa-google"></i></a></li>
								<li><a href="#"><i class="fab fa-vimeo-v"></i></a></li>
							</ul>
						</div>
					</div>
				</div>

				<div class="col-lg-2 offset-lg-2">
					<div class="footer_column">
						<div class="footer_title">Find it Fast</div>
						<ul class="footer_list">
							<li><a href="#">Computers & Laptops</a></li>
							<li><a href="#">Cameras & Photos</a></li>
							<li><a href="#">Hardware</a></li>
							<li><a href="#">Smartphones & Tablets</a></li>
							<li><a href="#">TV & Audio</a></li>
						</ul>
						<div class="footer_subtitle">Gadgets</div>
						<ul class="footer_list">
							<li><a href="#">Car Electronics</a></li>
						</ul>
					</div>
				</div>

				<div class="col-lg-2">
					<div class="footer_column">
						<ul class="footer_list footer_list_2">
							<li><a href="#">Video Games & Consoles</a></li>
							<li><a href="#">Accessories</a></li>
							<li><a href="#">Cameras & Photos</a></li>
							<li><a href="#">Hardware</a></li>
							<li><a href="#">Computers & Laptops</a></li>
						</ul>
					</div>
				</div>

				<div class="col-lg-2">
					<div class="footer_column">
						<div class="footer_title">Customer Care</div>
						<ul class="footer_list">
							<li><a href="#">My Account</a></li>
							<li><a href="#">Order Tracking</a></li>
							<li><a href="#">Wish List</a></li>
							<li><a href="#">Customer Services</a></li>
							<li><a href="#">Returns / Exchange</a></li>
							<li><a href="#">FAQs</a></li>
							<li><a href="#">Product Support</a></li>
						</ul>
					</div>
				</div>

			</div>
		</div>
	</footer>

	<!-- Copyright -->

	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col">

					<div class="copyright_container d-flex flex-sm-row flex-column align-items-center justify-content-start">
						<div class="copyright_content"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
</div>
						<div class="logos ml-sm-auto">
							<ul class="logos_list">
								<li><a href="#"><img src="{{asset('public/frontend/images/logos_1.png')}}" alt=""></a></li>
								<li><a href="#"><img src="{{asset('public/frontend/images/logos_2.png')}}" alt=""></a></li>
								<li><a href="#"><img src="{{asset('public/frontend/images/logos_3.png')}}" alt=""></a></li>
								<li><a href="#"><img src="{{asset('public/frontend/images/logos_4.png')}}" alt=""></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="{{asset('public/frontend/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('public/frontend/styles/bootstrap4/popper.js')}}"></script>
<script src="{{asset('public/frontend/styles/bootstrap4/bootstrap.min.js')}}"></script>
<script src="{{asset('public/frontend/plugins/greensock/TweenMax.min.js')}}"></script>
<script src="{{asset('public/frontend/plugins/greensock/TimelineMax.min.js')}}"></script>
<script src="{{asset('public/frontend/plugins/scrollmagic/ScrollMagic.min.js')}}"></script>
<script src="{{asset('public/frontend/plugins/greensock/animation.gsap.min.js')}}"></script>
<script src="{{asset('public/frontend/plugins/greensock/ScrollToPlugin.min.js')}}"></script>
<script src="{{asset('public/frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.js')}}"></script>
<script src="{{asset('public/frontend/plugins/slick-1.8.0/slick.js')}}"></script>
<script src="{{asset('public/frontend/plugins/easing/easing.js')}}"></script>
<script src="{{asset('public/frontend/js/custom.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>




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



{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}







</body>

</html>
