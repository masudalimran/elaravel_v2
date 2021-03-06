  @extends('layouts.app')
  @section('content')

  @include('layouts.menubar')
    {{-- sweetalert2 css --}}
    <link rel="stylesheet" href="sweetalert2.min.css">
    {{-- sweetalert2 css --}}

  <!-- Characteristics -->

  {{-- {{dd(  )}} --}}
  {{-- {{ app()->setLocale( getLocaleFromUrl( Request::url() ) ) }} --}}
  {{-- {{ dd( getLocaleFromUrl( Request::url() ) ) }} --}}
  {{-- {{dd(app()->getLocale())}} --}}
  @php
  $featured_product=DB::table('products')
  ->where('publication_status',1)
  ->orderBy('id','desc')
  ->limit(16)
  ->get();

  $trending_product=DB::table('products')
  ->where('publication_status',1)
  ->where('trend',1)
  ->orderBy('id','desc')
  ->limit(16)
  ->get();

  $Best_rated=DB::table('products')
  ->where('publication_status',1)
  ->where('best_rated',1)
  ->orderBy('id','desc')
  ->limit(16)
  ->get();

  $hot_deal=DB::table('products')
  ->leftjoin('brands','products.brand_id','=','brands.id')
  ->leftjoin('categories','products.category_id','=','categories.id')
  ->select('brands.brand_name','categories.category_name','products.*')
  ->where('products.publication_status',1)
  ->where('hot_deal',1)
  ->orderBy('id','desc')
  ->limit(4)
  ->get();

  $hot_best_sellers=DB::table('products')
  ->where('publication_status',1)
  ->get();

  $hot_new_arrivals=DB::table('products')
  ->leftjoin('brands','products.brand_id','=','brands.id')
  ->leftjoin('categories','products.category_id','=','categories.id')
  ->select('brands.brand_name','categories.category_name','products.*')
  ->where('publication_status',1)
  ->where('hot_new',1)
  ->orderBy('id','desc')
  ->limit(16)
  ->get();

  $b1g1=DB::table('products')
  ->leftjoin('brands','products.brand_id','=','brands.id')
  ->leftjoin('categories','products.category_id','=','categories.id')
  ->select('brands.brand_name','categories.category_name','products.*')
  ->where('publication_status',1)
  ->where('buy_1_get_1',1)
  ->orderBy('id','desc')
  ->limit(12)
  ->get();


  $category=DB::table('categories')
  ->get();



  $brand=DB::table('brands')
  ->get();
  @endphp

  <div class="characteristics">
      <div class="container">
          <div class="row">

              <!-- Char. Item -->
              <div class="col-lg-3 col-md-6 char_col">

                  <div class="char_item d-flex flex-row align-items-center justify-content-start">
                      <div class="char_icon"><img src="{{asset('public/frontend/images/char_1.png')}}" alt=""></div>
                      <div class="char_content">
                          <div class="char_title">{{__('index._free_delivery')}}</div>
                          <div class="char_subtitle">{{__('index._from_2,000_taka')}}</div>
                      </div>
                  </div>
              </div>

              <!-- Char. Item -->
              <div class="col-lg-3 col-md-6 char_col">

                  <div class="char_item d-flex flex-row align-items-center justify-content-start">
                      <div class="char_icon"><img src="{{asset('public/frontend/images/char_2.png')}}" alt=""></div>
                      <div class="char_content">
                          <div class="char_title">{{__('index._easy_refund')}}</div>
                          <div class="char_subtitle">{{__('index._within_5_days')}}</div>
                      </div>
                  </div>
              </div>

              <!-- Char. Item -->
              <div class="col-lg-3 col-md-6 char_col">

                  <div class="char_item d-flex flex-row align-items-center justify-content-start">
                      <div class="char_icon"><img src="{{asset('public/frontend/images/char_3.png')}}" alt=""></div>
                      <div class="char_content">
                          <div class="char_title">{{__('index._special_coupon')}}</div>
                          <div class="char_subtitle">{{__('index._redeem_them_now')}}</div>
                      </div>
                  </div>
              </div>

              <!-- Char. Item -->
              <div class="col-lg-3 col-md-6 char_col">

                  <div class="char_item d-flex flex-row align-items-center justify-content-start">
                      <div class="char_icon"><img src="{{asset('public/frontend/images/char_4.png')}}" alt=""></div>
                      <div class="char_content">
                          <div class="char_title">{{__('index._bookmark_our_website')}}</div>
                          <div class="char_subtitle">{{__('index._please_bookmark')}}</div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <!-- Deals of the week -->

  <div class="deals_featured">
      <div class="container">
          <div class="row">
              <div class="col d-flex flex-lg-row flex-column align-items-center justify-content-start">

                  <!-- Deals -->

                  <div class="deals">
                      <div class="deals_title">{{__('index._deals_of_the_week')}}</div>
                      <div class="deals_slider_container">

                          <!-- Deals Slider -->
                          <div class="owl-carousel owl-theme deals_slider">
                            @foreach ($hot_deal as $row)
                              <!-- Deals Item -->

                              <div class="owl-item deals_item" >
                                  <div class="deals_image">
                                      <a href="{{url('/'.app()->getLocale().'product/details/'.$row->id.'/'.$row->product_name)}}"><img src="{{asset($row->image_1)}}"
                                          style="height: 200px; width: 230px">
                                        </a>
                                </div>
                                  <div class="deals_content">
                                      <div class="deals_info_line d-flex flex-row justify-content-start">
                                          <div class="deals_item_category"><a href="{{url('/'.app()->getLocale().'product/details/'.$row->id.'/'.$row->product_name)}}">{{$row->category_name}}</a></div>
                                          @if($row->discount_price == NULL)

                                            @else
                                              <div class="deals_item_price_a ml-auto">
                                                  <del>৳{{numberFormat($row->selling_price)}}</del></span>
                                              </div>
                                          @endif
                                      </div>
                                      <div class="deals_item_brand"><a href="{{url('/'.app()->getLocale().'product/details/'.$row->id.'/'.$row->product_name)}}">{{$row->brand_name}}</a></div>
                                      <div class="deals_info_line d-flex flex-row justify-content-start">
                                          <div class="deals_item_name">{{$row->product_name}}</div>
                                          <div class="deals_item_price ml-auto">৳{{numberFormat($row->selling_price - $row->discount_price)}}<span
                                            ></div>
                                      </div>
                                      <div style="margin-top: 5px; text-align: right;">
                                        <a onclick="add_to_cart({{$row->id}})" class="btn btn-primary btn-sm">{{__('index._add_to_cart')}}</a>
                                    </div>
                                      <div class="available">
                                          <div class="available_line d-flex flex-row justify-content-start">
                                              <div class="available_title">{{__('index._available')}}<span>{{$row->product_quantity}}</span></div>
                                              <div class="sold_title ml-auto">{{__('index._already_sold')}} <span>{{__('index._pore_add_hobe')}}</span></div>
                                          </div>
                                          <div class="available_bar"><span style="width:17%"></span></div>
                                      </div>
                                      <div class="deals_timer d-flex flex-row align-items-center justify-content-start">
                                          <div class="deals_timer_title_container">
                                              <div class="deals_timer_title">{{__('index._hurry_up')}}</div>
                                              <div class="deals_timer_subtitle">{{__('index._offer_ends_in')}}</div>
                                          </div>
                                          <div class="deals_timer_content ml-auto">
                                              <div class="deals_timer_box clearfix" data-target-time="">
                                                  <div class="deals_timer_unit">
                                                      <div id="deals_timer1_hr" class="deals_timer_hr"></div>
                                                      <span style="font-size: small">{{__('index._hours')}}</span>
                                                  </div>
                                                  <div class="deals_timer_unit">
                                                      <div id="deals_timer1_min" class="deals_timer_min"></div>
                                                      <span style="font-size: small">{{__('index._mins')}}</span>
                                                  </div>
                                                  <div class="deals_timer_unit">
                                                      <div id="deals_timer1_sec" class="deals_timer_sec"></div>
                                                      <span style="font-size: small">{{__('index._secs')}}</span>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>

                            @endforeach
                              {{-- Deals Item end   --}}

                          </div>

                      </div>

                      <div class="deals_slider_nav_container">
                          <div class="deals_slider_prev deals_slider_nav"><i class="fas fa-chevron-left ml-auto"></i>
                          </div>
                          <div class="deals_slider_next deals_slider_nav"><i class="fas fa-chevron-right ml-auto"></i>
                          </div>
                      </div>
                  </div>

                  <!-- Featured -->
                  <div class="featured">
                      <div class="tabbed_container">
                          <div class="tabs">
                              <ul class="clearfix">
                                  <li class="active">{{__('index._featured')}}</li>
                                  <li>{{__('index._trending_now')}}</li>
                                  <li>{{__('index._best_rated')}}</li>
                              </ul>
                              <div class="tabs_line"><span></span></div>
                          </div>

                          <!-- Product Panel Featured  -->
                          <div class="product_panel panel active">
                              <div class="featured_slider slider">
                                  @foreach($featured_product as $row)
                                  <!-- Slider Item -->
                                  <div class="featured_slider_item">
                                      <div class="border_active"></div>
                                      <a href="{{url('product/details/'.$row->id.'/'.$row->product_name)}}">
                                      <div

                                          class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                          <div
                                              class="product_image d-flex flex-column align-items-center justify-content-center">
                                              <img src="{{URL::to($row->image_2)}}" style="height: 130px; width: 150px">
                                          </div>
                                          <div class="product_content">
                                              @if($row->discount_price == NULL)
                                              <div class="product_price discount">৳ {{numberFormat($row->selling_price)}}</div>
                                              @else
                                              <div class="product_price discount">৳
                                                  {{numberFormat($row->selling_price - $row->discount_price)}}<span
                                                      class="text-info"><del>৳ {{numberFormat($row->selling_price)}}</del></span>
                                              </div>
                                              @endif
                                              <div class="product_name">
                                                  <div><a href="#">{{$row->product_name}}</a></div>
                                              </div>
                                              <div class="product_extras">
                                                  <p>{{$row->product_color}}</p>
                                                  {{-- <a onclick="add_to_cart({{$row->id}})" >
                                                    <div class="product_cart_button">Add to Cart</div>
                                                  </a> --}}
                                                  <a onclick="add_to_cart({{$row->id}})" >
                                                    <div class="product_cart_button">{{__('index._add_to_cart')}}</div>
                                                </a>

                                              </div>
                                          </div>


                                            <a onclick="addwishlist({{$row->id, }})" >
                                                @if(Auth::check())
                                                <div class="product_fav"><i class="fas fa-heart"></i></div>
                                                @else
                                                <div class="product_fav" style="pointer-events: none;"><i class="fas fa-heart"></i></div>
                                                @endif
                                            </a>

                                          <ul class="product_marks">
                                              @if($row->discount_price == NULL)
                                              @else
                                              <li class="product_mark product_discount">
                                                  -{{round(($row->discount_price/$row->selling_price)*100)}}%</li>
                                              @endif
                                              @if($row->hot_new == NULL)
                                              @else
                                              <li class="product_mark product_discount" style="background: #10b529;">{{__('index._new')}}
                                              </li>
                                              @endif

                                          </ul>
                                      </div>
                                    </a>
                                  </div>
                                  @endforeach

                              </div>
                              <div class="featured_slider_dots_cover"></div>
                          </div>

                          <!-- Product Panel trending-->

                          <div class="product_panel panel">
                              <div class="featured_slider slider">

                                  @foreach($trending_product as $row)
                                  <!-- Slider Item -->
                                  <div class="featured_slider_item">
                                    <div class="border_active"></div>
                                    <a href="{{url('/'.app()->getLocale().'product/details/'.$row->id.'/'.$row->product_name)}}">
                                    <div
                                        class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                        <div
                                            class="product_image d-flex flex-column align-items-center justify-content-center">
                                            <img src="{{URL::to($row->image_2)}}" style="height: 130px; width: 150px">
                                        </div>
                                        <div class="product_content">
                                            @if($row->discount_price == NULL)
                                            <div class="product_price discount">৳ {{numberFormat($row->selling_price)}}</div>
                                            @else
                                            <div class="product_price discount">৳
                                                {{numberFormat($row->selling_price - $row->discount_price)}}<span
                                                    class="text-info"><del>৳ {{numberFormat($row->selling_price)}}</del></span>
                                            </div>
                                            @endif
                                            <div class="product_name">
                                                <div><a href="#">{{$row->product_name}}</a></div>
                                            </div>
                                            <div class="product_extras">
                                                <p>{{$row->product_color}}</p>
                                                <a onclick="add_to_cart({{$row->id}})" >
                                                <button class="product_cart_button">{{__('index._add_to_cart')}}</button>
                                                </a>
                                            </div>
                                        </div>


                                          <a onclick="addwishlist({{$row->id}})" >
                                              @if(Auth::check())
                                              <div class="product_fav"><i class="fas fa-heart"></i></div>
                                              @else
                                              <div class="product_fav" style="pointer-events: none;"><i class="fas fa-heart"></i></div>
                                              @endif
                                          </a>

                                        <ul class="product_marks">
                                            @if($row->discount_price == NULL)
                                            @else
                                            <li class="product_mark product_discount">
                                                -{{round(($row->discount_price/$row->selling_price)*100)}}%</li>
                                            @endif
                                            @if($row->hot_new == NULL)
                                            @else
                                            <li class="product_mark product_discount" style="background: #10b529;">{{__('index._new')}}
                                            </li>
                                            @endif

                                        </ul>
                                    </div>
                                    </a>
                                </div>
                                  @endforeach



                              </div>
                              <div class="featured_slider_dots_cover"></div>
                          </div>

                          <!-- Product Panel best rated-->

                          <div class="product_panel panel">
                              <div class="featured_slider slider">
                                  @foreach($Best_rated as $row)
                                  <!-- Slider Item -->
                                  <div class="featured_slider_item">
                                    <div class="border_active"></div>
                                    <a href="{{url('/'.app()->getLocale().'product/details/'.$row->id.'/'.$row->product_name)}}">
                                    <div
                                        class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                        <div
                                            class="product_image d-flex flex-column align-items-center justify-content-center">
                                            <img src="{{URL::to($row->image_2)}}" style="height: 130px; width: 150px">
                                        </div>
                                        <div class="product_content">
                                            @if($row->discount_price == NULL)
                                            <div class="product_price discount">৳ {{numberFormat($row->selling_price)}}</div>
                                            @else
                                            <div class="product_price discount">৳
                                                {{numberFormat($row->selling_price - $row->discount_price)}}<span
                                                    class="text-info"><del>৳ {{numberFormat($row->selling_price)}}</del></span>
                                            </div>
                                            @endif
                                            <div class="product_name">
                                                <div><a href="#">{{$row->product_name}}</a></div>
                                            </div>
                                            <div class="product_extras">
                                                <p>{{$row->product_color}}</p>
                                                <a onclick="add_to_cart({{$row->id}})" >
                                                <button class="product_cart_button">{{__('index._add_to_cart')}}</button>
                                                </a>
                                            </div>
                                        </div>


                                          <a onclick="addwishlist({{$row->id}})" >
                                              @if(Auth::check())
                                              <div class="product_fav"><i class="fas fa-heart"></i></div>
                                              @else
                                              <div class="product_fav" style="pointer-events: none;"><i class="fas fa-heart"></i></div>
                                              @endif
                                          </a>

                                        <ul class="product_marks">
                                            @if($row->discount_price == NULL)
                                            @else
                                            <li class="product_mark product_discount">
                                                -{{round(($row->discount_price/$row->selling_price)*100)}}%</li>
                                            @endif
                                            @if($row->hot_new == NULL)
                                            @else
                                            <li class="product_mark product_discount" style="background: #10b529;">{{__('index._new')}}
                                            </li>
                                            @endif

                                        </ul>
                                    </div>
                                </a>
                                </div>
                                  @endforeach


                              </div>
                              <div class="featured_slider_dots_cover"></div>
                          </div>

                      </div>
                  </div>

              </div>
          </div>
      </div>
  </div>

  <!-- Popular Categories -->

  @php
      $brands=DB::table('brands')
      ->get();
  @endphp



  <div class="popular_categories" id="home-cat-popular-categories">
      <div class="container">
          <div class="row">
              <div class="col-lg-3">
                  <div class="popular_categories_content">
                      <div class="popular_categories_title">{{__('index._popular_brands')}}</div>
                      <div class="popular_categories_slider_nav">
                          <div class="popular_categories_prev popular_categories_nav"><i
                                  class="fas fa-angle-left ml-auto"></i></div>
                          <div class="popular_categories_next popular_categories_nav"><i
                                  class="fas fa-angle-right ml-auto"></i></div>
                      </div>
                  </div>
              </div>

              <!-- Popular Categories Slider -->

              <div class="col-lg-9">
                  <div class="popular_categories_slider_container">
                      <div class="owl-carousel owl-theme popular_categories_slider">
                        @foreach ($brands as $row)
                          <!-- Popular Categories Item -->
                          <div class="owl-item">
                              <div
                                  class="popular_category d-flex flex-column align-items-center justify-content-center">
                                  <div class="popular_category_image"><img
                                          src="{{asset($row->brand_logo)}}"></div>
                                  <div class="popular_category_text">{{$row->brand_name}}</div>
                              </div>
                          </div>
                        @endforeach

                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <!-- Banner -->
  @php
  $mid_slider =DB::table('products')
              ->leftjoin('categories','products.category_id','=','categories.id')
              ->leftjoin('brands','products.brand_id','=','brands.id')
              ->select('products.*','brands.brand_name','categories.category_name')
              ->where('products.mid_slider',1)
              ->orderBy('id','DESC')
              ->limit(4)
              ->get();
    @endphp
<div class="banner_2">
    <div class="banner_2_background"
        style="background-image:url({{asset('public/frontend/images/banner_2_background.jpg')}})"></div>
    <div class="banner_2_container">
        <div class="banner_2_dots"></div>
        <!-- Banner 2 Slider -->

        <div class="owl-carousel owl-theme banner_2_slider">
        @foreach ($mid_slider as $row)
            <!-- Banner 2 Slider Item -->
            <div class="owl-item">
                <div class="banner_2_item">
                    <a href="{{url('product/details/'.$row->id.'/'.$row->product_name)}}">
                        <div class="container fill_height">
                            <div class="row fill_height">
                                <div class="col-lg-4 col-md-6 fill_height">
                                    <div class="banner_2_content">
                                        <div class="banner_2_category">{{$row->category_name}}</div>
                                        <div class="banner_2_title">{{$row->product_name}}</div>
                                        <div class="banner_2_text">{{$row->brand_name}}<br>
                                            {{__('index._product_id')}} {{$row->product_code}}.
                                        </div>
                                        <div class="button banner_2_button"><a href="{{url('/'.app()->getLocale().'product/details/'.$row->id.'/'.$row->product_name)}}">{{__('index._explore')}}</a></div>
                                    </div>

                                </div>
                                <div class="col-lg-8 col-md-6 fill_height">
                                    <div class="banner_2_image_container">
                                        <div class="banner_2_image"><img src="{{ asset($row->image_1) }}" style="height: 300px; width: 320px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach

        </div>
    </div>
</div>

  <!-- Hot Best Sellers -->

  <div class="new_arrivals">
      <div class="container">
          <div class="row">
              <div class="col">
                  <div class="tabbed_container">
                      <div class="tabs clearfix tabs-right" id="home-cat-hot_best_sellers">
                          <div class="new_arrivals_title">{{__('index._hot_best_sellers')}}</div>
                          <ul class="clearfix">
                              <li class="active">{{__('index._most_viewed')}}</li>
                              <li>{{__('index._most_sold')}}</li>
                          </ul>
                          <div class="tabs_line"><span></span></div>
                      </div>
                      <div class="row">
                          <div class="col-lg-9" style="z-index:1;">

                              <!-- Product Panel most viewed-->
                              <div class="product_panel panel active">
                                  <div class="arrivals_slider slider">
                                      @foreach ($hot_best_sellers as $v_hot_best_sellers)

                                        @if ($v_hot_best_sellers->product_quantity >= 50)

                                            <!-- Slider Item -->
                                            <a href="{{url('/'.app()->getLocale().'product/details/'.$v_hot_best_sellers->id.'/'.$v_hot_best_sellers->product_name)}}">
                                                <div class="arrivals_slider_item">
                                                    <div class="border_active"></div>
                                                    <div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                                                            <div class="product_image d-flex flex-column align-items-center justify-content-center">
                                                            <img src="{{URL::to($v_hot_best_sellers->image_1)}}" style="height: 130px; width: 150px">
                                                            </div>

                                                        <div class="product_content">
                                                            <div class="product_price">৳ {{numberFormat($v_hot_best_sellers->selling_price)}}</div>
                                                            <div class="product_name">
                                                                <div><a href="#">{{($v_hot_best_sellers->product_name)}}</a></div>
                                                            </div>
                                                            <div class="product_extras">
                                                                <p>{{$v_hot_best_sellers->product_color}}</p>
                                                                <a onclick="add_to_cart({{$v_hot_best_sellers->id}})" >
                                                                <button class="product_cart_button">{{__('index._add_to_cart')}}</button>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <a onclick="addwishlist({{$v_hot_best_sellers->id}})" >
                                                            @if(Auth::check())
                                                            <div class="product_fav"><i class="fas fa-heart"></i></div>
                                                            @else
                                                            <div class="product_fav" style="pointer-events: none;"><i class="fas fa-heart"></i></div>
                                                            @endif
                                                        </a>

                                                    <ul class="product_marks">
                                                        @if($v_hot_best_sellers->discount_price == NULL)
                                                        @else
                                                        <li class="product_mark product_new" style="background: red;">
                                                            -{{round(($v_hot_best_sellers->discount_price/$v_hot_best_sellers->selling_price)*100)}}%</li>
                                                        @endif
                                                        @if($v_hot_best_sellers->hot_new == NULL)
                                                        @else
                                                        <li class="product_mark product_new">{{__('index._new')}}
                                                        </li>
                                                        @endif
                                                    </ul>
                                                    </div>
                                                </div>
                                            </a>
                                        @endif

                                      @endforeach

                                  </div>
                                  <div class="arrivals_slider_dots_cover"></div>
                              </div>

                              <!-- Product Panel most sold-->
                              <div class="product_panel panel">
                                  <div class="arrivals_slider slider">

                                    @foreach ($hot_best_sellers as $v_hot_best_sellers)

                                    @if ($v_hot_best_sellers->product_quantity >= 100)

                                    <!-- Slider Item -->
                                    <a href="{{url('/'.app()->getLocale().'product/details/'.$v_hot_best_sellers->id.'/'.$v_hot_best_sellers->product_name)}}">
                                        <div class="arrivals_slider_item">
                                            <div class="border_active"></div>
                                            <div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center">
                                                <img src="{{URL::to($v_hot_best_sellers->image_1)}}" style="height: 130px; width: 150px">
                                                </div>

                                                <div class="product_content">
                                                    <div class="product_price">৳ {{numberFormat($v_hot_best_sellers-> selling_price)}}</div>
                                                    <div class="product_name">
                                                        <div><a href="#">{{$v_hot_best_sellers-> product_name}}</a></div>
                                                    </div>
                                                    <div class="product_extras">
                                                    <p>{{$v_hot_best_sellers->product_color}}</p>
                                                    <a onclick="add_to_cart({{$v_hot_best_sellers->id}})" >
                                                        <button class="product_cart_button">{{__('index._add_to_cart')}}</button>
                                                    </a>
                                                    </div>
                                                </div>
                                                <a onclick="addwishlist({{$v_hot_best_sellers->id}})" >
                                                @if(Auth::check())
                                                <div class="product_fav"><i class="fas fa-heart"></i></div>
                                                @else
                                                <div class="product_fav" style="pointer-events: none;"><i class="fas fa-heart"></i></div>
                                                @endif
                                            </a>

                                            <ul class="product_marks">
                                                @if($v_hot_best_sellers->discount_price == NULL)
                                                @else
                                                <li class="product_mark product_new" style="background: red;">
                                                    -{{round(($v_hot_best_sellers->discount_price/$v_hot_best_sellers->selling_price)*100)}}%</li>
                                                @endif
                                                @if($v_hot_best_sellers->hot_new == NULL)
                                                @else
                                                <li class="product_mark product_new" >{{__('index._new')}}
                                                </li>
                                                @endif
                                            </ul>
                                            </div>
                                        </div>
                                    </a>
                                    @endif

                                    @endforeach

                                  </div>
                                  <div class="arrivals_slider_dots_cover"></div>
                              </div>

                          </div>

                          <div class="col-lg-3">
                            <a href="{{url('/'.app()->getLocale().'product/details/'.$hot_deal[1]->id.'/'.$hot_deal[1]->product_name)}}">
                                <div class="arrivals_single clearfix">
                                    <div class="d-flex flex-column align-items-center justify-content-center">
                                        <div class="arrivals_single_image"><img src="{{URL::to($hot_deal[1]->image_1)}}" style="height: 200px; width: 200px"></div>
                                        <div class="arrivals_single_content">
                                            <div class="arrivals_single_category"><a href="#">{{$hot_deal[1]->category_name}}</a></div>
                                            <div class="arrivals_single_name_container clearfix">
                                                <div class="arrivals_single_name"><a href="#">{{$hot_deal[1]->product_name}}</a></div>
                                                <div class="arrivals_single_price text-right">৳ {{numberFormat($hot_deal[1]->selling_price)}}</div>
                                            </div>
                                                <a onclick="add_to_cart({{$hot_deal[1]->id}})" >
                                                    <button class="arrivals_single_button">{{__('index._add_to_cart')}}</button>
                                                </a>
                                        </div>

                                        <a onclick="addwishlist({{$hot_deal[1]->id}})" >
                                            @if(Auth::check())
                                            <div class="arrivals_single_fav product_fav"><i class="fas fa-heart"></i></div>
                                            @else
                                            <div class="arrivals_single_fav product_fav" style="pointer-events: none;"><i class="fas fa-heart"></i></div>
                                            @endif
                                        </a>
                                        <ul class="arrivals_single_marks product_marks">
                                            @if($hot_deal[1]->discount_price == NULL)
                                            @else
                                            <li class="arrivals_single_mark product_mark product_new" style="background: red;">
                                                -{{round(($hot_deal[1]->discount_price/$hot_deal[1]->selling_price)*100)}}%</li>
                                            @endif
                                            @if($hot_deal[1]->hot_new == NULL)
                                            @else
                                            <li class="arrivals_single_mark product_mark product_new" >{{__('index._new')}}
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </a>
                          </div>

                      </div>

                  </div>
              </div>
          </div>
      </div>
  </div>

  <!-- Hot New Arrivals -->

  <div class="best_sellers">
      <div class="container">
          <div class="row">
              <div class="col" id="home-cat-hot_new_arrivals" >
                  <div class="tabbed_container">
                      <div class="tabs clearfix tabs-right">
                          <div class="new_arrivals_title">{{__('index._hot_new_arrivals')}}</div>
                          <ul class="clearfix">
                              <li class="active">{{__('index._hot_new')}}</li>
                              {{-- <li>Audio & Video</li>
                              <li>Laptops & Computers</li> --}}
                          </ul>
                          <div class="tabs_line"><span></span></div>
                      </div>

                      <div class="bestsellers_panel panel active">

                          <!-- Best Sellers Slider -->

                          <div class="bestsellers_slider slider">

                            @foreach ($hot_new_arrivals as $item)
                              <!-- Best Sellers Item -->
                              <a href="{{url('/'.app()->getLocale().'product/details/'.$item->id.'/'.$item->product_name)}}">
                                <div class="bestsellers_item discount">
                                    <div
                                        class="bestsellers_item_container d-flex flex-row align-items-center justify-content-start">
                                        <div class="bestsellers_image"><img
                                                src="{{asset($item->image_1)}}" style="height: 200px; width: 220px"></div>
                                        <div class="bestsellers_content">
                                            <div class="bestsellers_category"><a href="#">{{$item->category_name}}</a></div>
                                            <div class="bestsellers_name"><a href="#">{{$item->product_name}}</a>
                                            </div>
                                            <div class="bestsellers_price discount">৳{{$item->selling_price - $item->discount_price}}<span>৳ {{$item->selling_price}}</span></div>
                                        </div>
                                    </div>

                                    <ul class="bestsellers_marks">
                                        @if($item->discount_price == NULL)
                                        @else
                                        <li class="bestsellers_mark bestsellers_discount">
                                            -{{round(($item->discount_price/$item->selling_price)*100)}}%</li>
                                        @endif
                                        @if($item->hot_new == NULL)
                                        @else
                                        <li class="bestsellers_mark bestsellers_discount" style="background: #10b529;">{{__('index._new')}}
                                        </li>
                                        @endif

                                    </ul>
                                </div>
                              </a>
                              @endforeach



                          </div>
                      </div>
                  </div>

              </div>
          </div>
      </div>
  </div>


  <!-- Product By Categories -->
  <div class="new_arrivals">
    <div class="container">
        @foreach ($category as $cat)
        @php
            $category_id=$cat->id;
            $product_by_category = DB::table('products')
            ->where('category_id',$category_id)
            ->where('publication_status',1)
            ->orderBy('id','desc')
            ->get();
        @endphp

        <div class="row">
            <div class="col">
                <div class="tabbed_container">
                    <div class="tabs clearfix tabs-right">
                        <div class="new_arrivals_title" id="home-cat-{{$cat->id}}">{{$cat->category_name}}</div>
                        <ul class="clearfix">
                            @php
                                $product_by_subcategory = DB::table('products')
                                ->leftjoin('sub_categories','products.subcategory_id','=','sub_categories.id')
                                ->select('sub_categories.*','products.*')
                                ->where('sub_categories.category_id',$category_id)
                                ->where('publication_status',1)
                                ->get();
                            @endphp
                            @foreach ($product_by_subcategory->unique('sub_category_name') as $sub_cat)
                                <li>{{$sub_cat->sub_category_name}}</li>
                            @endforeach


                        </ul>
                        <div class="tabs_line"><span></span></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-9" style="z-index:1;">
                            <!-- Product Panel most viewed-->
                            @foreach ($product_by_subcategory as $sub_cat1)
                            {{-- {{dd($product_by_subcategory[0])}} --}}
                            <div class="{{($product_by_subcategory[0]->id == $sub_cat1->id)?'product_panel panel active':'product_panel panel'}}" >
                                <div class="arrivals_slider slider ">
                                    @php
                                        $product_show_by_subcategory = DB::table('products')
                                        ->where('subcategory_id',$sub_cat1->subcategory_id)
                                        ->where('publication_status',1)
                                        ->get();
                                    @endphp
                                    @foreach ($product_show_by_subcategory as $item)

                                    <!-- Slider Item -->
                                    <a href="{{url('/'.app()->getLocale().'product/details/'.$item->id.'/'.$item->product_name)}}">
                                        <div class="arrivals_slider_item">
                                            <div class="border_active"></div>
                                            <div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center">
                                                <img src="{{URL::to($item->image_1)}}" style="height: 130px; width: 150px">
                                                </div>

                                                <div class="product_content">
                                                    <div class="product_price">৳ {{numberFormat($item-> selling_price)}}</div>
                                                    <div class="product_name">
                                                        <div><a href="#">{{$item-> product_name}}</a></div>
                                                    </div>
                                                    <div class="product_extras">
                                                    <p>{{$item->product_color}}</p>
                                                    <a onclick="add_to_cart({{$item->id}})" >
                                                        <button class="product_cart_button">{{__('index._add_to_cart')}}</button>
                                                    </a>
                                                    </div>
                                                </div>
                                                <a onclick="addwishlist({{$item->id}})" >
                                                @if(Auth::check())
                                                <div class="product_fav"><i class="fas fa-heart"></i></div>
                                                @else
                                                <div class="product_fav" style="pointer-events: none;"><i class="fas fa-heart"></i></div>
                                                @endif
                                            </a>

                                            <ul class="product_marks">
                                                @if($item->discount_price == NULL)
                                                @else
                                                <li class="product_mark product_new" style="background: red;">
                                                    -{{round(($item->discount_price/$item->selling_price)*100)}}%</li>
                                                @endif
                                                @if($item->hot_new == NULL)
                                                @else
                                                <li class="product_mark product_new" >{{__('index._new')}}
                                                </li>
                                                @endif
                                            </ul>
                                            </div>
                                        </div>
                                    </a>
                                    @endforeach


                                </div>
                                <div class="arrivals_slider_dots_cover"></div>

                            </div>

                            @endforeach

                        </div>

                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

  <!-- Adverts -->

  <div class="adverts">
      <div class="container">
          <div class="row">

              <div class="col-lg-4 advert_col">

                  <!-- Advert Item -->

                  <div class="advert d-flex flex-row align-items-center justify-content-start">
                      <div class="advert_content">
                          <div class="advert_title"><a href="#">{{__('index._trends_2021')}}</a></div>
                          <div class="advert_text">{{__('index._loren_ipsum')}}</div>
                      </div>
                      <div class="ml-auto">
                          <div class="advert_image"><img src="{{asset('public/frontend/images/adv_1.png')}}" alt="">
                          </div>
                      </div>
                  </div>
              </div>

              <div class="col-lg-4 advert_col">

                  <!-- Advert Item -->

                  <div class="advert d-flex flex-row align-items-center justify-content-start">
                      <div class="advert_content">
                          <div class="advert_subtitle">{{__('index._trends_2021')}}</div>
                          <div class="advert_title_2"><a href="#">{{__('index._sale_45')}}</a></div>
                          <div class="advert_text">{{__('index._loren_ipsum')}}</div>
                      </div>
                      <div class="ml-auto">
                          <div class="advert_image"><img src="{{asset('public/frontend/images/adv_2.png')}}" alt="">
                          </div>
                      </div>
                  </div>
              </div>

              <div class="col-lg-4 advert_col">

                  <!-- Advert Item -->

                  <div class="advert d-flex flex-row align-items-center justify-content-start">
                      <div class="advert_content">
                          <div class="advert_title"><a href="#">{{__('index._trends_2021')}}</a></div>
                          <div class="advert_text">{{__('index._loren_ipsum')}}</div>
                      </div>
                      <div class="ml-auto">
                          <div class="advert_image"><img src="{{asset('public/frontend/images/adv_3.png')}}" alt="">
                          </div>
                      </div>
                  </div>
              </div>

          </div>
      </div>
  </div>

   <!-- Buy One Get One -->

  <div class="trends" id="home-cat-buy-one-get-one">
      <div class="trends_background"
          style="background-image:url({{asset('public/frontend/images/trends_background.jpg')}})"></div>
      <div class="trends_overlay"></div>
      <div class="container">
          <div class="row">

              <!-- Trends Content -->
              <div class="col-lg-3">
                  <div class="trends_container">
                      <h2 class="trends_title">{{__('index._buy_one_get_one')}}</h2>
                      <div class="trends_text">
                          <p>{{__('index._grab_on_the_special')}}</p>
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

                      <div class="owl-carousel owl-theme trends_slider">
                        @foreach ($b1g1 as $item)
                          <!-- Trends Slider Item -->


                            <div class="owl-item">
                                <a href="{{url('/'.app()->getLocale().'product/details/'.$item->id.'/'.$item->product_name)}}">
                                <div class="trends_item is_new">
                                    <div
                                        class="trends_image d-flex flex-column align-items-center justify-content-center">
                                        <img src="{{asset($item->image_1)}}" style="height: 200px; width: 220px"></div>
                                    <div class="trends_content">
                                        <div class="trends_category"><a href="#">{{$item->category_name}}</a></div>
                                        <div class="trends_info clearfix">
                                            <div class="trends_name"><a href="#">{{$item->product_name}}</a></div>
                                            <div class="trends_price">৳ {{numberFormat($item->selling_price)}}</div>
                                        </div>
                                    </div>
                                        <a onclick="addwishlist({{$item->id}})" >
                                            @if(Auth::check())
                                            <div class="trends_fav"><i class="fas fa-heart"></i></div>
                                            @else
                                            <div class="trends_fav" style="pointer-events: none;"><i class="fas fa-heart"></i></div>
                                            @endif
                                        </a>

                                    <ul class="trends_marks">
                                        @if($item->discount_price == NULL)
                                        @else
                                        <li class="trends_mark trends_new" style="background: red;">
                                            -{{round(($item->discount_price/$item->selling_price)*100)}}%</li>
                                        @endif
                                        @if($item->hot_new == NULL)
                                        @else
                                        <li class="trends_mark trends_new" style="background: #10b529;">{{__('index._new')}}
                                        </li>
                                        @endif
                                    </ul>
                                    <div style="margin-top: 10px; text-align: center;"><a onclick="add_to_cart({{$item->id}})" class="btn btn-primary btn-sm" >{{__('index._add_to_cart')}}</a></div>
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

  <!-- Reviews -->

  <div class="reviews">
      <div class="container">
          <div class="row">
              <div class="col">

                  <div class="reviews_title_container">
                      <h3 class="reviews_title">{{__('index._latest_reviews')}}</h3>
                      <div class="reviews_all ml-auto"><a href="#">{{__('index._view_all')}}<span>{{__('index._reviews')}}</span></a></div>
                  </div>

                  <div class="reviews_slider_container">

                      <!-- Reviews Slider -->
                      <div class="owl-carousel owl-theme reviews_slider">

                          <!-- Reviews Slider Item -->
                          <div class="owl-item">
                              <div class="review d-flex flex-row align-items-start justify-content-start">
                                  <div>
                                      <div class="review_image"><img
                                              src="{{asset('public/frontend/images/review_1.jpg')}}" alt=""></div>
                                  </div>
                                  <div class="review_content">
                                      <div class="review_name">{{__('index._roberto_sanchez')}}</div>
                                      <div class="review_rating_container">
                                          <div class="rating_r rating_r_4 review_rating">
                                              <i></i><i></i><i></i><i></i><i></i></div>
                                          <div class="review_time">{{__('index._2_day_ago')}}</div>
                                      </div>
                                      <div class="review_text">
                                          <p>{{__('index._loren_ipsum')}}</p>
                                      </div>
                                  </div>
                              </div>
                          </div>

                          <!-- Reviews Slider Item -->
                          <div class="owl-item">
                              <div class="review d-flex flex-row align-items-start justify-content-start">
                                  <div>
                                      <div class="review_image"><img
                                              src="{{asset('public/frontend/images/review_2.jpg')}}" alt=""></div>
                                  </div>
                                  <div class="review_content">
                                      <div class="review_name">{{__('index._roberto_sanchez')}}</div>
                                      <div class="review_rating_container">
                                          <div class="rating_r rating_r_4 review_rating">
                                              <i></i><i></i><i></i><i></i><i></i></div>
                                          <div class="review_time">{{__('index._2_day_ago')}}</div>
                                      </div>
                                      <div class="review_text">
                                          <p>{{__('index._loren_ipsum')}}</p>
                                      </div>
                                  </div>
                              </div>
                          </div>

                          <!-- Reviews Slider Item -->
                          <div class="owl-item">
                              <div class="review d-flex flex-row align-items-start justify-content-start">
                                  <div>
                                      <div class="review_image"><img
                                              src="{{asset('public/frontend/images/review_3.jpg')}}" alt=""></div>
                                  </div>
                                  <div class="review_content">
                                      <div class="review_name">{{__('index._roberto_sanchez')}}</div>
                                      <div class="review_rating_container">
                                          <div class="rating_r rating_r_4 review_rating">
                                              <i></i><i></i><i></i><i></i><i></i></div>
                                          <div class="review_time">{{__('index._2_day_ago')}}</div>
                                      </div>
                                      <div class="review_text">
                                          <p>{{__('index._loren_ipsum')}}</p>
                                      </div>
                                  </div>
                              </div>
                          </div>

                          <!-- Reviews Slider Item -->
                          <div class="owl-item">
                              <div class="review d-flex flex-row align-items-start justify-content-start">
                                  <div>
                                      <div class="review_image"><img
                                              src="{{asset('public/frontend/images/review_1.jpg')}}" alt=""></div>
                                  </div>
                                  <div class="review_content">
                                      <div class="review_name">{{__('index._roberto_sanchez')}}</div>
                                      <div class="review_rating_container">
                                          <div class="rating_r rating_r_4 review_rating">
                                              <i></i><i></i><i></i><i></i><i></i></div>
                                          <div class="review_time">{{__('index._2_day_ago')}}</div>
                                      </div>
                                      <div class="review_text">
                                          <p>{{__('index._loren_ipsum')}}</p>
                                      </div>
                                  </div>
                              </div>
                          </div>

                          <!-- Reviews Slider Item -->
                          <div class="owl-item">
                              <div class="review d-flex flex-row align-items-start justify-content-start">
                                  <div>
                                      <div class="review_image"><img
                                              src="{{asset('public/frontend/images/review_2.jpg')}}" alt=""></div>
                                  </div>
                                  <div class="review_content">
                                      <div class="review_name">{{__('index._roberto_sanchez')}}</div>
                                      <div class="review_rating_container">
                                          <div class="rating_r rating_r_4 review_rating">
                                              <i></i><i></i><i></i><i></i><i></i></div>
                                          <div class="review_time">{{__('index._2_day_ago')}}</div>
                                      </div>
                                      <div class="review_text">
                                          <p>{{__('index._loren_ipsum')}}</p>
                                      </div>
                                  </div>
                              </div>
                          </div>

                          <!-- Reviews Slider Item -->
                          <div class="owl-item">
                              <div class="review d-flex flex-row align-items-start justify-content-start">
                                  <div>
                                      <div class="review_image"><img
                                              src="{{asset('public/frontend/images/review_3.jpg')}}" alt=""></div>
                                  </div>
                                  <div class="review_content">
                                      <div class="review_name">{{__('index._roberto_sanchez')}}</div>
                                      <div class="review_rating_container">
                                          <div class="rating_r rating_r_4 review_rating">
                                              <i></i><i></i><i></i><i></i><i></i></div>
                                          <div class="review_time">{{__('index._2_day_ago')}}</div>
                                      </div>
                                      <div class="review_text">
                                          <p>{{__('index._loren_ipsum')}}</p>
                                      </div>
                                  </div>
                              </div>
                          </div>

                      </div>
                      <div class="reviews_dots"></div>
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
                      <h3 class="viewed_title">{{__('index._recently_viewed')}}</h3>
                      <div class="viewed_nav_container">
                          <div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
                          <div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
                      </div>
                  </div>

                  <div class="viewed_slider_container">

                      <!-- Recently Viewed Slider -->

                      <div class="owl-carousel owl-theme viewed_slider">

                          <!-- Recently Viewed Item -->
                          <div class="owl-item">
                              <div
                                  class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                  <div class="viewed_image"><img src="{{asset('public/frontend/images/view_1.jpg')}}"
                                          alt=""></div>
                                  <div class="viewed_content text-center">
                                      <div class="viewed_price">{{__('index._$225')}}<span>{{__('index._$300')}}</span></div>
                                      <div class="viewed_name"><a href="#">{{__('index._beoplay_h7')}}</a></div>
                                  </div>
                                  <ul class="item_marks">
                                      <li class="item_mark item_discount">{{__('index._-25%')}}</li>
                                      <li class="item_mark item_new">{{__('index._new')}}</li>
                                  </ul>
                              </div>
                          </div>

                          <!-- Recently Viewed Item -->
                          <div class="owl-item">
                              <div
                                  class="viewed_item d-flex flex-column align-items-center justify-content-center text-center">
                                  <div class="viewed_image"><img src="{{asset('public/frontend/images/view_2.jpg')}}"
                                          alt=""></div>
                                  <div class="viewed_content text-center">
                                      <div class="viewed_price">{{__('index._$225')}}</div>
                                      <div class="viewed_name"><a href="#">{{__('index._beoplay_h7')}}</a></div>
                                  </div>
                                  <ul class="item_marks">
                                      <li class="item_mark item_discount">{{__('index._-25%')}}</li>
                                      <li class="item_mark item_new">{{__('index._new')}}</li>
                                  </ul>
                              </div>
                          </div>

                          <!-- Recently Viewed Item -->
                          <div class="owl-item">
                              <div
                                  class="viewed_item d-flex flex-column align-items-center justify-content-center text-center">
                                  <div class="viewed_image"><img src="{{asset('public/frontend/images/view_3.jpg')}}"
                                          alt=""></div>
                                  <div class="viewed_content text-center">
                                      <div class="viewed_price">{{__('index._$225')}}</div>
                                      <div class="viewed_name"><a href="#">{{__('index._beoplay_h7')}}</a></div>
                                  </div>
                                  <ul class="item_marks">
                                      <li class="item_mark item_discount">{{__('index._-25%')}}</li>
                                      <li class="item_mark item_new">{{__('index._new')}}</li>
                                  </ul>
                              </div>
                          </div>

                          <!-- Recently Viewed Item -->
                          <div class="owl-item">
                              <div
                                  class="viewed_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                                  <div class="viewed_image"><img src="{{asset('public/frontend/images/view_4.jpg')}}"
                                          alt=""></div>
                                  <div class="viewed_content text-center">
                                      <div class="viewed_price">{{__('index._$225')}}</div>
                                      <div class="viewed_name"><a href="#">{{__('index._beoplay_h7')}}</a></div>
                                  </div>
                                  <ul class="item_marks">
                                      <li class="item_mark item_discount">{{__('index._-25%')}}</li>
                                      <li class="item_mark item_new">{{__('index._new')}}</li>
                                  </ul>
                              </div>
                          </div>

                          <!-- Recently Viewed Item -->
                          <div class="owl-item">
                              <div
                                  class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                  <div class="viewed_image"><img src="{{asset('public/frontend/images/view_5.jpg')}}"
                                          alt=""></div>
                                  <div class="viewed_content text-center">
                                      <div class="viewed_price">{{__('index._$225')}}$225<span>{{__('index._$300')}}</span></div>
                                      <div class="viewed_name"><a href="#">{{__('index._beoplay_h7')}}</a></div>
                                  </div>
                                  <ul class="item_marks">
                                      <li class="item_mark item_discount">{{__('index._-25%')}}</li>
                                      <li class="item_mark item_new">{{__('index._new')}}</li>
                                  </ul>
                              </div>
                          </div>

                          <!-- Recently Viewed Item -->
                          <div class="owl-item">
                              <div
                                  class="viewed_item d-flex flex-column align-items-center justify-content-center text-center">
                                  <div class="viewed_image"><img src="{{asset('public/frontend/images/view_6.jpg')}}"
                                          alt=""></div>
                                  <div class="viewed_content text-center">
                                      <div class="viewed_price">{{__('index._$225')}}</div>
                                      <div class="viewed_name"><a href="#">{{__('index._beoplay_h7')}}</a></div>
                                  </div>
                                  <ul class="item_marks">
                                      <li class="item_mark item_discount">{{__('index._-25%')}}</li>
                                      <li class="item_mark item_new">{{__('index._new')}}</li>
                                  </ul>
                              </div>
                          </div>

                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <!-- Brands -->

  <div class="brands">
      <div class="container">
          <div class="row">
              <div class="col">
                  <div class="brands_slider_container">

                      <!-- Brands Slider -->

                      <div class="owl-carousel owl-theme brands_slider">

                          <div class="owl-item">
                              <div class="brands_item d-flex flex-column justify-content-center"><img
                                      src="{{asset('public/frontend/images/brands_1.jpg')}}" alt=""></div>
                          </div>
                          <div class="owl-item">
                              <div class="brands_item d-flex flex-column justify-content-center"><img
                                      src="{{asset('public/frontend/images/brands_2.jpg')}}" alt=""></div>
                          </div>
                          <div class="owl-item">
                              <div class="brands_item d-flex flex-column justify-content-center"><img
                                      src="{{asset('public/frontend/images/brands_3.jpg')}}" alt=""></div>
                          </div>
                          <div class="owl-item">
                              <div class="brands_item d-flex flex-column justify-content-center"><img
                                      src="{{asset('public/frontend/images/brands_4.jpg')}}" alt=""></div>
                          </div>
                          <div class="owl-item">
                              <div class="brands_item d-flex flex-column justify-content-center"><img
                                      src="{{asset('public/frontend/images/brands_5.jpg')}}" alt=""></div>
                          </div>
                          <div class="owl-item">
                              <div class="brands_item d-flex flex-column justify-content-center"><img
                                      src="{{asset('public/frontend/images/brands_6.jpg')}}" alt=""></div>
                          </div>
                          <div class="owl-item">
                              <div class="brands_item d-flex flex-column justify-content-center"><img
                                      src="{{asset('public/frontend/images/brands_7.jpg')}}" alt=""></div>
                          </div>
                          <div class="owl-item">
                              <div class="brands_item d-flex flex-column justify-content-center"><img
                                      src="{{asset('public/frontend/images/brands_8.jpg')}}" alt=""></div>
                          </div>

                      </div>

                      <!-- Brands Slider Navigation -->
                      <div class="brands_nav brands_prev"><i class="fas fa-chevron-left"></i></div>
                      <div class="brands_nav brands_next"><i class="fas fa-chevron-right"></i></div>

                  </div>
              </div>
          </div>
      </div>
  </div>

  <!-- Newsletter -->

  <div class="newsletter" id="home-cat-newsletter">
      <div class="container">
          <div class="row">
              <div class="col">
                  <div
                      class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
                      <div class="newsletter_title_container">
                          <div class="newsletter_icon"><img src="{{asset('public/frontend/images/send.png')}}" alt="">
                          </div>
                          <div class="newsletter_title">{{__('index._sign_up_for_newsletter')}}</div>
                          <div class="newsletter_text">
                              <p>{{__('index._receive_20%')}}</p>
                          </div>
                      </div>
                      <div class="newsletter_content clearfix">

                          <form action="{{route('store.newsletter', app()->getLocale() )}}" class="newsletter_form" method="post">
                              @csrf
                              <input type="email" class="newsletter_input" required="required"
                                  placeholder="Enter your email address" name="email">
                              <button class="newsletter_button">{{__('index._subscribe')}}</button>
                          </form>
                          <div class="newsletter_unsubscribe_link"><a href="#">{{__('index._unsubscribe')}} </a></div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
{{-- new --}}
<script src="{{asset('/public/frontend/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('/public/frontend/styles/bootstrap4/popper.js')}}"></script>
<script src="{{asset('/public/frontend/styles/bootstrap4/bootstrap.min.js')}}"></script>
<script src="{{asset('/public/frontend/plugins/greensock/TweenMax.min.js')}}"></script>
<script src="{{asset('/public/frontend/plugins/greensock/TimelineMax.min.js')}}"></script>
<script src="{{asset('/public/frontend/plugins/scrollmagic/ScrollMagic.min.js')}}"></script>
<script src="{{asset('/public/frontend/plugins/greensock/animation.gsap.min.js')}}"></script>
<script src="{{asset('/public/frontend/plugins/greensock/ScrollToPlugin.min.js')}}"></script>
<script src="{{asset('/public/frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.js')}}"></script>
<script src="{{asset('/public/frontend/plugins/slick-1.8.0/slick.js')}}"></script>
<script src="{{asset('/public/frontend/plugins/easing/easing.js')}}"></script>
<script src="{{asset('/public/frontend/js/custom.js')}}"></script>
{{-- <script src="{{asset('/public/backend/lib/jquery-ui/jquery-ui.js')}}"></script> --}}

{{-- new --}}

  {{-- sweetalert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
{{-- sweetalert2 --}}

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>


{{-- Sweetalert 2 --}}

<script type="text/javascript">
    function addwishlist(id) {
        console.log(id);
        if(id) {
               $.ajax({
                   url: "{{  url('/'.app()->getLocale().'/add/wishlist/') }}/"+id,
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
                        console.log("asddddddddddddddddddddddddddddddddddddddddddd = "+ data.wishlist_count)
                        $("#wishlist-count").text(data.wishlist_count);
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

<script type="text/javascript">
    function add_to_cart(id) {
        console.log(id);
        if(id) {
               $.ajax({
                   url: "{{  url('/'.app()->getLocale().'/addtocart/') }}/"+id,
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
                        let arr =  data.cart_subtotal;
                        let total = 0;
                        arr.forEach(element => {
                            total += element.price
                        });

                        console.log("Cart subtotal:          ", (data.cart_subtotal))
                        console.log("total:          ",  total)

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

{{-- <script>
    console.log("sdfasghsxgf")
    $(document).ready(function(){
  $("#toggle").click(function(){
    $("#toggleproduct").removeClass("active");
  });
});
</script> --}}

{{-- smooth scrolling --}}
<script>
    $(document).ready(function(){
      // Add smooth scrolling to all links
      $("a").on('click', function(event) {

        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {
          // Prevent default anchor click behavior
          event.preventDefault();

          // Store hash
          var hash = this.hash;

          // Using jQuery's animate() method to add smooth page scroll
          // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
          $('html, body').animate({
            scrollTop: $(hash).offset().top
          }, 1100, function(){

            // Add hash (#) to URL when done scrolling (default click behavior)
            window.location.hash = hash;
          });
        } // End if
      });
    });
</script>




<style>
    .slick-track{
        margin-bottom: 100px !important;
    }
</style>




    @endsection
