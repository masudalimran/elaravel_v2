@php
$category = DB::table('categories')->get();
$language = session()->get('lang');
@endphp

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<!-- Main Navigation -->

<nav class="main_nav">
    <div class="container">
        <div class="row">
            <div class="col">

                <div class="main_nav_content d-flex flex-row">

                    <!-- Categories Menu -->

                    <div class="cat_menu_container">
                        <div class="cat_menu_title d-flex flex-row align-items-center justify-content-start">
                            <div class="cat_burger"><span></span><span></span><span></span></div>
                            <div class="cat_menu_text">categories</div>
                        </div>

                        <ul class="cat_menu">
                            @foreach ($category as $v_category)
                                <li class="hassubs">
                                    <a href="/elaravel_v2/?/#home-cat-{{ $v_category->id }}">{{ $v_category->category_name }}<i
                                            class="fas fa-chevron-right"></i></a>
                                    <ul>
                                        @php
                                            $sub_category = DB::table('sub_categories')
                                                ->where('category_id', $v_category->id)
                                                ->get();
                                        @endphp
                                        @foreach ($sub_category as $v_sub_category)
                                            <li><a href="/elaravel_v2/?/#home-cat-{{ $v_category->id }}">{{ $v_sub_category->sub_category_name }}<i
                                                        class="fas fa-chevron-right"></i></a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Main Nav Menu -->

                    <div class="main_nav_menu ml-auto">
                        <ul class="standard_dropdown main_nav_dropdown">
                            <li><a href="/elaravel_v2/?/#home-cat-hot_best_sellers">Best Sellers<i
                                        class="fas fa-chevron-down"></i></a></li>
                            <li><a href="/elaravel_v2/?/#home-cat-hot_new_arrivals">New Arrivals<i
                                        class="fas fa-chevron-down"></i></a></li>
                            <li><a href="/elaravel_v2/?/#home-cat-popular-categories">Brands<i
                                        class="fas fa-chevron-down"></i></a></li>
                            <li><a href="/elaravel_v2/?/#home-cat-buy-one-get-one">Buy 1 Get 1<i
                                        class="fas fa-chevron-down"></i></a></li>
                            <li><a href="{{ route('blog.post') }}">Blogs<i class="fas fa-chevron-down"></i></a></li>
                            <li><a href="contact.html">Contact<i class="fas fa-chevron-down"></i></a></li>
                        </ul>
                    </div>

                    <!-- Menu Trigger -->

                    {{-- <div class="menu_trigger_container ml-auto">
                        <div class="menu_trigger d-flex flex-row align-items-center justify-content-end">
                            <div class="menu_burger">
                                <div class="menu_trigger_text">Menu</div>
                                <div class="cat_burger menu_burger_inner"><span></span><span></span><span></span></div>
                            </div>
                        </div>
                    </div> --}}

                    <div class="dropdown" id="dropdownMenuButton_menu" style="margin-left:auto; margin-top:2px; margin-right:8%;" >
                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                            {{-- ({{Auth::user()->name}}) --}}
                            {{-- <a href="{{route('home')}}" style="color: white">@if ($language == 'bangla') প্রোফাইল  @else Profile @endif
                                ({{Auth::user()->name}})</a> --}}
                                {{-- menu --}}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{route('home')}}" style="color: green">Profile</a>
                            <a class="dropdown-item" href="{{route('show.wishlist')}}">Wishlist</a>
                            <a class="dropdown-item" href="{{route('show.cart')}}">Cart</a>
                            <a class="dropdown-item" href="{{route('user.logout')}}" style="color: red">logout</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Menu Mobile Screen -->

<div class="page_menu">
    <div class="container">
        <div class="row">
            <div class="col">

                <div class="page_menu_content">

                    <div class="page_menu_search">
                        <form action="#">
                            <input type="search" required="required" class="page_menu_search_input"
                                placeholder="Search for products...">
                        </form>
                    </div>
                    <ul class="page_menu_nav">
                        <li class="page_menu_item has-children">
                            <a href="#">Language<i class="fa fa-angle-down"></i></a>
                            <ul class="page_menu_selection">
                                <li><a href="#">English<i class="fa fa-angle-down"></i></a></li>
                                <li><a href="#">Italian<i class="fa fa-angle-down"></i></a></li>
                            </ul>
                        </li>
                        {{-- <li class="page_menu_item has-children">
									@if ($language == 'bangla')
                                            <a href="#">ভাষা <span style="text-transform: capitalize">({{$language}})</span><i class="fas fa-chevron-down"></i></a>
                                    @else
                                        <a href="#">Language <span style="text-transform: capitalize">(ENGLISH)<i class="fas fa-chevron-down"></i></a>
                                    @endif
                                    <ul>
                                        <li style="padding-left: 15px; padding-right: 15px"><a href="{{route('language.english')}}">English<i class="fas fa-chevron-down"></i></a></li>
                                        <li style="padding-left: 15px; padding-right: 15px"><a href="{{route('language.bangla')}}">বাংলা<i class="fas fa-chevron-down"></i></a></li>
                                        <li style="padding-left: 15px; padding-right: 15px" ><a href="#"><del> Russian1 (OFFLINE) </del><i class="fas fa-chevron-down"></i></a></li>
                                    </ul>
								</li> --}}
                        <li class="page_menu_item">
                            <a href="#">Home<i class="fa fa-angle-down"></i></a>
                        </li>
                        <li class="page_menu_item has-children">
                            <a href="#">Super Deals<i class="fa fa-angle-down"></i></a>
                            <ul class="page_menu_selection">
                                <li><a href="#">Super Deals<i class="fa fa-angle-down"></i></a></li>
                                <li class="page_menu_item has-children">
                                    <a href="#">Menu Item<i class="fa fa-angle-down"></i></a>
                                    <ul class="page_menu_selection">
                                        <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                        <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                        <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                        <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                            </ul>
                        </li>
                        <li class="page_menu_item has-children">
                            <a href="#">Featured Brands<i class="fa fa-angle-down"></i></a>
                            <ul class="page_menu_selection">
                                <li><a href="#">Featured Brands<i class="fa fa-angle-down"></i></a></li>
                                <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                            </ul>
                        </li>
                        <li class="page_menu_item has-children">
                            <a href="#">Trending Styles<i class="fa fa-angle-down"></i></a>
                            <ul class="page_menu_selection">
                                <li><a href="#">Trending Styles<i class="fa fa-angle-down"></i></a></li>
                                <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                            </ul>
                        </li>
                        <li class="page_menu_item"><a href="blog.html">blog<i class="fa fa-angle-down"></i></a></li>
                        <li class="page_menu_item"><a href="contact.html">contact<i class="fa fa-angle-down"></i></a>
                        </li>
                    </ul>

                    <div class="menu_contact">
                        <div class="menu_contact_item">
                            <div class="menu_contact_icon"><img
                                    src="{{ asset('public/frontend/images/phone_white.png') }}" alt=""></div>+38 068
                            005
                            3570
                        </div>
                        <div class="menu_contact_item">
                            <div class="menu_contact_icon"><img
                                    src="{{ asset('public/frontend/images/mail_white.png') }}" alt=""></div><a
                                href="mailto:fastsales@gmail.com">fastsales@gmail.com</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</header>

@php
$slider = DB::table('products')
    ->leftjoin('brands', 'products.brand_id', '=', 'brands.id')
    ->select('products.*', 'brands.brand_name')
    ->where('products.main_slider', 1)
    ->orderBy('id', 'DESC')
    ->first();
@endphp
<!-- Banner -->

<div class="banner">
    <div class="banner_background"
        style="background-image:url({{ asset('public/frontend/images/banner_background.jpg') }})"></div>
    <div class="container fill_height">
        <div class="row fill_height">
            <div class="banner_product_image"><img src="{{ asset($slider->image_1) }}"></div>
            <div class="col-lg-5 offset-lg-4 fill_height">
                <div class="banner_content">
                    <h1 class="banner_text">{{ $slider->product_name }}</h1>
                    <div class="banner_price">
                        <span>৳{{ $slider->selling_price }}</span>৳{{ $slider->selling_price - $slider->discount_price }}
                    </div>
                    <div class="banner_product_name">Brand: {{ $slider->brand_name }}</div>
                    <div class="banner_product_name">Available In: {{ $slider->product_color }}</div>
                    <div class="banner_product_name">Available Sizes: {{ $slider->product_size }}</div>
                    <div class="button banner_button"><a onclick="add_to_cart({{ $slider->id }})">Buy Now</a></div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>

<style>
    @media (min-width: 768px) {
        #dropdownMenuButton_menu {
            display: none;
        }
    }

</style>
