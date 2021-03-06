@extends('layouts.app')
@section('content')

{{-- styles --}}
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/bootstrap4/bootstrap.min.css')}}">
<link href="{{asset('public/frontend/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/cart_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/cart_responsive.css')}}">

{{-- bootstrap --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
{{-- bootstrap --}}

{{-- sweetalert2 css --}}
<link rel="stylesheet" href="sweetalert2.min.css">
{{-- sweetalert2 css --}}

{{-- stripe css --}}
<style type="text/css">
    /**
    * The CSS shown here will not be introduced in the Quickstart guide, but shows
    * how you can use CSS to style your Element's container.
    */
    .StripeElement {
    box-sizing: border-box;

    height: 40px;
    width: 100%;

    padding: 10px 12px;

    border: 1px solid transparent;
    border-radius: 4px;
    background-color: white;

    box-shadow: 0 1px 3px 0 #e6ebf1;
    -webkit-transition: box-shadow 150ms ease;
    transition: box-shadow 150ms ease;
    }

    .StripeElement--focus {
    box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .StripeElement--invalid {
    border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
    background-color: #fefde5 !important;
    }
</style>
{{-- stripe css --}}

{{-- styles --}}
@php
    $userId = Auth::id();
    $sum_total =  0;
    $total_cost = 0;

    $total_cost = DB::table('payments')
    ->orderBy('id', 'desc')
    ->pluck('total_cost')
    ->first();


@endphp

<div class="cart_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 offset-lg-0">

                <div class="cart_container" id="shopping_cart_content" style="display: block">

                    <div class="cart_title">Shopping Cart</div>

                    {{-- <form action="{{route('user.checkout')}}" method="post" id="checkout_form">
                        @csrf --}}
                        @foreach ($cart as $item)
                        @php
                        $color=$item->product_color;
                        $product_color = explode(',', $color);

                        $size=$item->product_size;
                        $product_size = explode(',', $size);
                        @endphp

                    <div class="cart_items">
                        <ul class="cart_list">
                            <li class="cart_item clearfix" id="remove-cart-item-{{$item->id}}">
                                <div class="cart_item_image" id="product_image_mobile">
                                    <a href="{{url('product/details/'.$item->id.'/'.$item->product_name)}}">
                                        <img src="{{asset($item->image)}}" id="literally_the_product_image">
                                    </a>
                                </div>
                                <div class="cart_item_info d-flex flex-sm-row flex-column justify-content-between">
                                    <div class="cart_item_name cart_info_col" style="max-width: 10%; min-width:10%;" id="product_name_mobile">
                                        <div class="cart_item_title">Product Name: </div>
                                        <div class="cart_item_text" id="product_name_text_mobile">{{$item->product_name}}</div>
                                    </div>
                                    <div class="cart_item_name cart_info_col" style="max-width: 7%; min-width:7%;" id="product_id_mobile">
                                        <div class="cart_item_title">Product ID: </div>
                                        <div class="cart_item_text"><h5>{{$item->product_id}}</h5></div>
                                    </div>
                                    <div class="cart_item_color cart_info_col" style="max-width: 10%; min-width:10%;" id="product_color_mobile">
                                        <div class="cart_item_title" style="text-align: center">Color</div>
                                        <div class="cart_item_text">
                                            <select onchange="change_color({{$item->product_id}}, this.value)" class="form-control input-sm select-100" id="cart_product_color">
                                                @foreach($product_color as $colors)
                                                    <option value="{{ $colors }}">{{ $colors }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <div class="cart_item_color cart_info_col" style="max-width: 7%; min-width:7%;" id="product_size_mobile">
                                        <div class="cart_item_title" style="text-align: center">Size</div>
                                        <div class="cart_item_text" >
                                            <select onchange="change_size({{$item->product_id}}, this.value)" class="form-control input-lg select-100" id="exampleFormControlSelect1">
                                                @foreach($product_size as $sizes)
                                                    <option value="{{ $sizes }}">{{ $sizes }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    {{-- QUANTIY --}}
                                    <div class="cart_item_quantity cart_info_col" style="max-width: 8%; min-width:8%;" id="product_qty_mobile">
                                        <div class="cart_item_title">Quantity</div>
                                        <div class="cart_item_text" id="qty_input_field">
                                            <input  onchange="qty_change({{$item->id}},this.value, {{$item->price}}, {{$userId}})" class="form-control" type="number" pattern="[0-9]*" value="{{$item->qty}}" name="qty">
                                        </div>
                                    </div>
                                    {{-- QUANTIY --}}

                                    <div class="cart_item_price cart_info_col" style="max-width: 10%; min-width:10%;" id="price_mobile">
                                        <div class="cart_item_title" style="text-align: right">Price</div>
                                        <div class="cart_item_text">{{numberFormat($item->price)}}</div>
                                    </div>
                                    <div class="cart_item_total cart_info_col" style="max-width: 10%; min-width:10%;" id="total_mobile">
                                        <div class="cart_item_title" style="text-align: right">Total</div>
                                        <div class="cart_item_text" id="product-subtotal-{{$item->id}}">{{numberFormat($item->price * $item->qty)  }}</div>
                                    </div>
                                    <div class="cart_item_name cart_info_col" style="max-width: 5%; min-width:5%;" id="action_hide_mobile">
                                        <div class="cart_item_title" style="text-align: center">Action</div>
                                        <div class="cart_item_text" style="text-align: center">
                                                <button onclick="remove_cart_item({{$item->product_id}},{{$item->price}})" class="btn btn-sm btn-danger">X</button>
                                        </div>
                                    </div>
                                    <div >
                                        <button id="action_show_mobile" style="display: none" onclick="remove_cart_item({{$item->product_id}},{{$item->price}})" class="btn btn-sm btn-danger">Delete</button>
                                    </div>
                                    @php
                                        $sum_total+=($item->price * $item->qty);
                                    @endphp
                                </div>
                            </li>
                        </ul>
                    </div>
                 @endforeach
                 <br>

                    {{-- Coupon Addition  --}}
                    <div>
                        <form action="{{ url('cart/coupon/add/'.$userId.'/'.$sum_total) }}" method="post" id="coupon_update">
                            @csrf
                            <div class="form-group" >
                              <label for="exampleInputEmail1" style="font-weight: bold; text-align: right;">Coupon Code</label>
                              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Coupon Code" name="coupon_input">
                            </div>
                              <button onclick="function1({{$userId}}, {{$sum_total}})" style="position: absolute; right: 0;" type="submit" class="btn btn-primary">Submit</button>
                          </form>
                    </div>
                    <br>

                    <!-- Order Total -->
                    <div class="order_total">
                        <div class="order_total_content text-md-right">

                            <div class="order_total_title">Sum Total</div>
                            <div class="order_total_amount" id="cart-subtotal-in-cart-page">{{numberFormat($sum_total)}}</div><br>
                        </div>
                    </div>
                    <div class="order_total">
                        <div class="order_total_content text-md-right">
                            <div class="order_total_title">Coupon Discount
                                {{-- <div id="coupon_name_mobile"> --}}
                                    <span class="badge badge-pill badge-success" id="coupon_name"></span>
                                {{-- </div> --}}
                                <span class="badge badge-pill badge-warning" id="coupon_percentage"></span>
                                (-)
                            </div>
                            <div class="order_total_amount" id="updated_coupon">{{numberFormat($coupon_minus)}}</div><br>
                        </div>
                    </div>

                    <div class="order_total">
                        <div class="order_total_content text-md-right">
                            <div class="order_total_title">Order Total:</div>
                            <div class="order_total_amount" id="cart-subtotal-with-coupon">{{numberFormat(($sum_total)- ($coupon_minus))}}</div>
                        </div>
                    </div>

                    <div class="cart_buttons">
                        <a href="{{url('remove/cart/'.$userId.'/'.$active_coupon)}}"><button type="button" class="button cart_button_clear" style="color: red">Cancel Cart</button></a>
                        <button onclick="checkout({{($sum_total)- ($coupon_minus)}})" type="submit" class="button cart_button_checkout" data-toggle="modal" data-target="#checkout_modal">Checkout</button>
                    </div>
                </div>
            {{-- </form> --}}

            </div>
        </div>
    </div>
</div>

    <!-- Modal 1 checkout_modal -->
    <div class="modal fade" id="checkout_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog modal-xl" role="document" style="max-width: 80%; margin-left:auto; margin-right: auto;">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Checkout</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                    {{-- <p style="text-align: center">(*) marked fields are mandatory</p> --}}
                    {{-- imported from auth --}}
                    <div class="form-group" id="shipping_information_div">
                        <label for="exampleInputEmail1">User Name</label>
                        <input onchange="shipping_district({{($sum_total)- ($coupon_minus)}})" type="text" class="form-control" name="checkout_username_n" id="checkout_username" aria-describedby="emailHelp" value="{{Auth::user()->name}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input onchange="shipping_district({{($sum_total)- ($coupon_minus)}})" type="text" class="form-control" name="checkout_email_n" id="checkout_email" aria-describedby="emailHelp" value="{{Auth::user()->email}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Phone</label>
                        <input onchange="shipping_district({{($sum_total)- ($coupon_minus)}})" type="text" class="form-control" name="checkout_phone_n" id="checkout_phone" aria-describedby="emailHelp" value="{{Auth::user()->phone}}">
                    </div>
                    {{-- imported from auth --}}

                    <div class="form-group">
                      <label for="exampleInputEmail1">Shipping Address*</label><p id="shipping_address_error_messege" style="display: none; color: red"><b> Please Enter Your Shipping Address</b></p>
                      <input onchange="shipping_district({{($sum_total)- ($coupon_minus)}})" type="text" class="form-control" name="checkout_shipping_address_n" id="checkout_shipping_address" aria-describedby="emailHelp" required>
                    </div>
                    {{-- <div class="form-group">
                      <label for="exampleInputEmail1">District*</label> --}}
                      {{-- <input onchange="shipping_district({{($sum_total)- ($coupon_minus)}})" type="text" class="form-control" name="checkout_district_n" id="checkout_district" aria-describedby="emailHelp" required> --}}
                    <div class="form-group">
                    <label for="exampleFormControlSelect1">District*</label><p id="shipping_district_error_messege" style="display: none; color: red"><b> Please Select Your Shipping Dsitrict</b></p>
                        <select onchange="shipping_district({{($sum_total)- ($coupon_minus)}})" class="form-control select-100" name="checkout_district_n" id="checkout_district" style="width: 100% !important">
                            <option>Select Shipping District</option>
                            <option>Dhaka (৳50)</option><span></span>
                            <option>Chittagong (৳350)</option>
                            <option>Barisal (৳300)</option>
                            <option>Jessore (৳350)</option>
                            <option>Rajshahi (৳450)</option>
                            <option>Rangpur (৳400)</option>
                            <option>Khulna (৳350)</option>
                            <option>Sylhet (৳300)</option>
                        </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Postal Code</label>
                      <input onchange="shipping_district({{($sum_total)- ($coupon_minus)}})" type="text" class="form-control" name="checkout_postal_code_n" id="checkout_postal_code" aria-describedby="emailHelp">
                    </div>

                <div class="order_total" style="height: auto">
                    <div class="order_total_content text-md-right" >
                        <div class="order_total_title  clearfix" >Order Total</div>
                        <div class="order_total_amount" id="checkout_order_total">{{numberFormat($sum_total)}}</div><br>

                        <div class="order_total_title  clearfix" >Vat (15%)</div>
                        <div class="order_total_amount" id="checkout_vat">{{numberFormat($sum_total)}}</div><br>

                        <div class="order_total_title  clearfix">Shipping Cost</div>
                        <div class="order_total_amount" id="checkout_shipping_cost">0</div><br>

                        <div class="order_total_title  clearfix">Grand Total</div>
                        <div class="order_total_amount" id="checkout_grand_total">0</div><br>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button onclick="check_checkout()"  type="button" class="btn btn-success" >Continue To Payment</button>
            </div>
        </div>
        </div>
    </div>
    {{-- modal 1 --}}

    <!-- Modal 2 Payment_modal-->
    <div class="modal fade" id="Payment_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Select Payment Method</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card" style="width: 100%;">
                        {{-- <div class="card-header">
                        Featured
                        </div> --}}
                        <ul class="list-group list-group-horizontal d-flex justify-content-around mr-auto ml-auto" id="payment">
                            <li class="list-group-item " ><input type="radio" name="selected" value="stripe"> <img id="stripe_image_mobile" src="{{asset('public\media\Payment_system_images\stripe.png')}}" style="height: 70px; width: 180px"><br><br>
                            <h6 style="text-align: center; color: violet">Stripe</h6></li>
                            {{-- <li class="list-group-item text-center" ><img src="{{asset('public\media\Payment_system_images\stripe.png')}}" style="height: 70px; width: 180px"><br><br> --}}
                                <?php
                                    require('show/config.php');
                                ?>

                            <li class="list-group-item " ><input type="radio" name="selected" value="paypal"> <img id="paypal_image_mobile" src="{{asset('public\media\Payment_system_images\paypal.png')}}" style="height: 70px; width: 180px"><br><br>
                            <h6 style="text-align: center; color: blue">Paypal</h6></li>
                            <li class="list-group-item " ><input type="radio" name="selected" value="mollie"> <img id="mollie_image_mobile" src="{{asset('public\media\Payment_system_images\mollie.png')}}" style="height: 70px; width: 180px"><br><br>
                            <h6 style="text-align: center; color: red">Mollie</h6></li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="payment_method_selection_button" onclick="payment_method_selection()" type="button" class="btn btn-primary" data-dismiss="modal">Proceed</button>
                </div>
            </div>
        </div>
    </div>
<!-- Modal 2-->

{{-- modal 3 payment form for stripe --}}
<div class="modal fade" id="payment_stripe" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Pay With Stripe</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
            {{-- form start --}}
            {{-- <form role="form" action="{{route('payment.charge')}}" method="post" id="payment-form">
                @csrf
                <div class="form-row">
                    <label for="card-element">
                        Credit or debit card
                    </label>
                    <div id="card-element">
                        <!-- A Stripe Element will be inserted here. -->
                    </div>

                    <!-- Used to display form errors. -->
                    <div id="card-errors" role="alert"></div>
                </div>
                <button type="submit" class="btn btn-primary">Submit Payment</button>
            </form> --}}
            {{-- form end --}}
        </div>
      </div>
    </div>
  </div>
{{-- modal 3 payment form --}}


{{-- scripts --}}
<script src="{{asset('public/frontend/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('public/frontend/styles/bootstrap4/popper.js')}}"></script>
<script src="{{asset('public/frontend/styles/bootstrap4/bootstrap.min.js')}}"></script>
<script src="{{asset('public/frontend/plugins/greensock/TweenMax.min.js')}}"></script>
<script src="{{asset('public/frontend/plugins/greensock/TimelineMax.min.js')}}"></script>
<script src="{{asset('public/frontend/plugins/scrollmagic/ScrollMagic.min.js')}}"></script>
<script src="{{asset('public/frontend/plugins/greensock/animation.gsap.min.js')}}"></script>
<script src="{{asset('public/frontend/plugins/greensock/ScrollToPlugin.min.js')}}"></script>
<script src="{{asset('public/frontend/plugins/easing/easing.js')}}"></script>
<script src="{{asset('public/frontend/js/cart_custom.js')}}"></script>
{{-- scripts --}}


{{-- sweetalert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
{{-- sweetalert2 --}}

<script src="https://js.stripe.com/v3/"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

{{-- Sweetalert 2 --}}

{{-- bootstrap --}}
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
{{-- bootstrap --}}

<script type="text/javascript">
src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"

src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"

    var coupon_minus_init = 0
    var coupon_percentage_init = 0
    var coupon_input_init = 0
    var total_init = 0
    var order_total_cart_init
    var order_total_cart_init = 0

    function qty_change(productId , qty, price, userId) {
        // $("#cart-subtotal").text(0)
        let subtotal = qty * price;
        console.log(' =================subtotal =================================='+this.numberWithCommas(subtotal))

        $('#product-subtotal-'+productId).text(this.numberWithCommas(subtotal))



        console.log('===============================================', productId, qty, this.coupon_percentage_init)
        event.preventDefault();
        let _this = this
        $.ajax({
            url: "{{  url('update/cart/') }}/"+productId+'/'+qty,
            type:"GET",
            // data: $('#checkout_form').serialize(),
            dataType:"json",
            success:function(data) {
                console.log(data.final_cart)
                let arr =  data.final_cart;
                let total = 0;
                arr.forEach(element => {
                    total += element.price*element.qty
                });
                console.log("quntity change total",total)
                console.log("quntity change coupon minus",coupon_minus_init)
                $("#cart-subtotal-in-cart-page").text(_this.numberWithCommas(total))
                $("#cart-subtotal").text(_this.numberWithCommas(total));
                console.log("coupon percentage init:  "+ _this.coupon_percentage_init)
                let coupon_add_when_qty_change
                if(_this.coupon_percentage_init){
                    coupon_add_when_qty_change  = (total * _this.coupon_percentage_init)/100
                }else{
                    coupon_add_when_qty_change = 0
                }
                console.log("coupon percentage init:  "+ _this.coupon_percentage_init)
                $('#updated_coupon').text(_this.numberWithCommas(coupon_add_when_qty_change))
                let order_total = total - coupon_add_when_qty_change
                $('#cart-subtotal-with-coupon').text(_this.numberWithCommas(order_total))
                _this.order_total_cart_init = order_total
                _this.total_init = total;
                _this.function1(userId, _this.total_init);

            }

        });

    }
    function function1(userId, total){//button click on coupon
        let _this = this
        console.log("function 1 userID, total =======================================================================:", userId, total, this.total_init)
        event.preventDefault();
        this.function2(userId, total)
    }

    function function2(userId, total){
        // event.preventDefault();
        let _this = this
        console.log("function 2 userID, total =======================================================================:", userId, total, this.total_init)
        $.ajax({
            url: "{{  url('cart/coupon/add/') }}/"+userId+'/'+total,
            type:"POST",
            data: $('#coupon_update').serialize(),
            dataType:"json",
            success:function(data) {
                console.log("Updated Coupon =======================================================================:", data.coupon_minus)
                console.log("Updated Coupon =======================================================================:", data.coupon_input)
                $('#updated_coupon').text(_this.numberWithCommas(data.coupon_minus))
                _this.coupon_minus_init = data.coupon_minus
                let cart_total = total - data.coupon_minus
                _this.total_init = total;
                console.log("Updated cart total =======================================================================:", cart_total)
                $('#cart-subtotal-with-coupon').text(_this.numberWithCommas(cart_total))
                _this.order_total_cart_init = cart_total
                $('#coupon_name').text(data.coupon_input)
                $('#coupon_percentage').text(_this.numberWithCommas(data.coupon_percentage)+'%')
                $("#cart-subtotal").text(cart_total);

                _this.total_init = total
                _this.coupon_minus_init = (data.coupon_minus)
                console.log("updating coupon minus internally "+_this.coupon_minus_init)

                _this.coupon_percentage_init = (data.coupon_percentage)
                console.log("updating coupon percentage internally "+ _this.coupon_percentage_init)

                _this.coupon_input_init = (data.coupon_input)
                console.log("updating coupon percentage internally "+ _this.coupon_input_init)
            }
        });
    }

    function remove_cart_item(product_id, price, coupon_minus_init, coupon_percentage_init, coupon_input_init, total_init ){
        console.log("remove cart item = "+product_id+"  "+price+"  "+ this.coupon_minus_init +"   "+ this.coupon_percentage_init +"   "+ this.coupon_input_init+"   "+ this.total_init)
        let _this = this
        if(this.coupon_minus_init){
            _this.manage_item_with_coupon_delete(product_id, price, coupon_minus_init, coupon_percentage_init, coupon_input_init, total_init );
        }else{
            _this.manage_item_without_coupon_delete(product_id, price, total_init);
        }
    }

    function manage_item_with_coupon_delete(product_id, price, coupon_minus_init, coupon_percentage_init, coupon_input_init, total_init ){
        console.log("remove cart item = "+product_id+"  "+price+"  "+ this.coupon_minus_init +"   "+ this.coupon_percentage_init +"   "+ this.coupon_input_init+"   "+ this.total_init)
        let _this = this
        $.ajax({
            url: "{{  url('remove/cart/item/coupon/') }}/"+product_id+'/'+price+'/'+_this.coupon_minus_init+'/'+_this.coupon_percentage_init+'/'+_this.coupon_input_init+'/'+_this.total_init,
            type:"GET",
            dataType:"json",
            success:function(data) {
                console.log("product_id=======================================================================:", data.product_id)
                console.log("coupon_minus =======================================================================:", data.coupon_minus)
                console.log("active_coupon_percentage =======================================================================:", data.active_coupon_percentage)
                console.log("coupon_input =======================================================================:", data.coupon_input)
                // console.log("product_id=======================================================================:", data.product_id)
                console.log(data.final_cart)
                let arr =  data.final_cart;
                let total = 0;
                let number_of_item_in_cart= 0;
                arr.forEach(element => {
                    total += element.price*element.qty
                    number_of_item_in_cart++
                });
                console.log("Total =======================================================================:", total)
                    let coupon_minus = total * (data.active_coupon_percentage/100)
                    _this.coupon_minus_init = coupon_minus;
                    _this.coupon_percentage_init = data.active_coupon_percentage;
                    _this.coupon_input_init = data.coupon_input;
                    // _this.total_init = total;
                    console.log("Coupon to be minus =======================================================================:", coupon_minus)
                    $('#updated_coupon').text(coupon_minus)
                    _this.coupon_minus_init = coupon_minus
                    let cart_total = total - coupon_minus
                    console.log("cart total =======================================================================:",cart_total)
                    $('#cart-subtotal-with-coupon').text(cart_total)
                    _this.order_total_cart_init = cart_total
                    $('#coupon_name').text(data.coupon_input)
                    $('#coupon_percentage').text(data.active_coupon_percentage+'%')
                    $("#cart-subtotal-in-cart-page").text(total);

                    $("#cart-subtotal").text(cart_total);
                    $("#cart-count").text(number_of_item_in_cart);
                    console.log("Cart total:  "+cart_total)
                    console.log("Number Of item in cart:  "+number_of_item_in_cart)

                    $('#remove-cart-item-'+data.product_id).remove()



                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
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
            }
        });
    }
    function manage_item_without_coupon_delete(product_id, price, total_init){
        console.log("Product price = "+ price)
        let _this = this
        $.ajax({
            url: "{{  url('remove/cart/item') }}/"+product_id+'/'+price+'/'+_this.total_init,
            type:"GET",
            dataType:"json",
            success:function(data) {
                console.log("product_id=======================================================================:", data.product_id)
                console.log(data.final_cart)
                let arr =  data.final_cart;
                let total = 0;
                let number_of_item_in_cart = 0;
                arr.forEach(element => {
                    total += element.price*element.qty
                    number_of_item_in_cart++
                });

                    _this.total_init = total;
                    $('#cart-subtotal-in-cart-page').text(_this.numberWithCommas(_this.total_init))
                    $('#cart-subtotal-with-coupon').text(_this.numberWithCommas(_this.total_init))
                    _this.order_total_cart_init = total

                    $("#cart-subtotal").text(total);
                    $("#cart-count").text(number_of_item_in_cart);
                    console.log("Number Of item in cart:  "+number_of_item_in_cart)

                    $('#remove-cart-item-'+data.product_id).remove()

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
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
            }
        });
    }

    var js_grand_total_init = 0
    var js_vat= 0

    function checkout(order_total, order_total_cart_init){
      let order_total_for_checkout
      console.log("order total", order_total)
        if(this.order_total_cart_init){
            order_total_for_checkout = this.order_total_cart_init
            this.js_grand_total_init = order_total_for_checkout
            console.log("Inside Checkout if", order_total_for_checkout)
        }else{
            order_total_for_checkout = order_total
            this.js_grand_total_init = order_total_for_checkout
            console.log("Inside Checkout else", order_total_for_checkout)
        }
        $("#checkout_order_total").text(this.numberWithCommas(order_total_for_checkout));
        let vat
        vat  = (order_total_for_checkout * 15)/100
        console.log("Checkout Vat", vat)
        $("#checkout_vat").text(this.numberWithCommas(vat));
        this.js_vat = vat;
        this.js_grand_total_init = order_total_for_checkout + vat
        $("#checkout_grand_total").text(this.numberWithCommas(this.js_grand_total_init));
    }

    function shipping_district(order_total, order_total_cart_init, js_grand_total_init){
        console.log("grand total js:  "+ this.js_grand_total_init)

        let order_total_for_checkout_modal
        console.log("order total", order_total)
            if(this.order_total_cart_init){
                order_total_for_checkout = this.order_total_cart_init
                console.log("Inside Checkout if", order_total_for_checkout_modal)
            }else{
                order_total_for_checkout = order_total
                console.log("Inside Checkout else", order_total_for_checkout_modal)
            }

        js_username = document.getElementById('checkout_username').value
        console.log("js_username: "+js_username)

        js_email = document.getElementById('checkout_email').value
        console.log("js_email: "+js_email)

        js_phone = document.getElementById('checkout_phone').value
        console.log("js_phone: "+js_phone)

        js_shipping_address = document.getElementById('checkout_shipping_address').value
        console.log("js_shipping_address: "+js_shipping_address)

        js_district = document.getElementById('checkout_district')
        console.log("js_district: "+js_district.value)

        js_postal_code = document.getElementById('checkout_postal_code').value
        console.log("js_postal_code: "+js_postal_code)

        if((js_district.value) == 'Dhaka (৳50)'){
            district_shipping_charge = 50
            $("#checkout_shipping_cost").text(district_shipping_charge);
            console.log("shipping charge: "+district_shipping_charge)
        }
        else if((js_district.value) == 'Chittagong (৳350)'){
            district_shipping_charge = 350
            $("#checkout_shipping_cost").text(district_shipping_charge);
            console.log("shipping charge: "+district_shipping_charge)
        }
        else if((js_district.value) == 'Barisal (৳300)'){
            district_shipping_charge = 300
            $("#checkout_shipping_cost").text(district_shipping_charge);
            console.log("shipping charge: "+district_shipping_charge)
        }
        else if((js_district.value) == 'Jessore (৳350)'){
            district_shipping_charge = 350
            $("#checkout_shipping_cost").text(district_shipping_charge);
            console.log("shipping charge: "+district_shipping_charge)
        }
        else if((js_district.value) == 'Rajshahi (৳450)'){
            district_shipping_charge = 450
            $("#checkout_shipping_cost").text(district_shipping_charge);
            console.log("shipping charge: "+district_shipping_charge)
        }
        else if((js_district.value) == 'Rangpur (৳400)'){
            district_shipping_charge = 400
            $("#checkout_shipping_cost").text(district_shipping_charge);
            console.log("shipping charge: "+district_shipping_charge)
        }
        else if((js_district.value) == 'Khulna (৳350)'){
            district_shipping_charge = 350
            $("#checkout_shipping_cost").text(district_shipping_charge);
            console.log("shipping charge: "+district_shipping_charge)
        }
        else if((js_district.value) == 'Sylhet (৳300)'){
            district_shipping_charge = 300
            $("#checkout_shipping_cost").text(district_shipping_charge);
            console.log("shipping charge: "+district_shipping_charge)
        }
        this.js_grand_total_init += district_shipping_charge
        $("#checkout_grand_total").text(this.numberWithCommas(this.js_grand_total_init));
        console.log("grand total: "+this.js_grand_total_init)

        // document.getElementById('checkout_shipping_address').validity.valid

    }

    function change_color(product_id_color, color){
        console.log(product_id_color);
        console.log(color);
        $.ajax({
            url: "{{  url('change/color/database') }}/"+product_id_color+'/'+color,
            type:"GET",
            dataType:"json",
            success:function(data) {
                const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000,
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
            }
        })
    }
    function change_size(product_id_size, size){
        console.log(product_id_size);
        console.log(size);
        $.ajax({
            url: "{{  url('change/size/database') }}/"+product_id_size+'/'+size,
            type:"GET",
            dataType:"json",
            success:function(data) {
                const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000,
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
            }
        })
    }

    function check_checkout(){
        console.log('required test')
        js_shipping_address = document.getElementById('checkout_shipping_address').value
        console.log("js_shipping_address: "+js_shipping_address)

        js_district = document.getElementById('checkout_district')
        console.log("js_district: "+js_district.value)

        js_coupon_minus = this.coupon_minus_init
        console.log("coupon minus value "+this.coupon_minus_init)
        js_grand_total = this.js_grand_total_init
        console.log("grand_total:   "+this.js_grand_total_init)




        var js_district_name
        var shipping_cost

        if(js_district.value == 'Select Shipping District'){
            // alert('Please Select District');
            $("#shipping_district_error_messege").css("display", "inline");
            document.getElementById('shipping_information_div').scrollIntoView();
        }else {
            $("#shipping_address_error_messege").css("display", "none");
            $("#shipping_district_error_messege").css("display", "none");
            if(js_shipping_address){
                console.log("INSIDE NOT NULL (if)")
                if((js_district.value) == 'Dhaka (৳50)'){
                    js_district_name = 'Dhaka';
                    shipping_cost=50;
                    console.log("shipping charge: "+district_shipping_charge)
                }
                else if((js_district.value) == 'Chittagong (৳350)'){
                    js_district_name = 'Chittagong';
                    shipping_cost=350;
                    console.log("shipping charge: "+district_shipping_charge)
                }
                else if((js_district.value) == 'Barisal (৳300)'){
                    js_district_name = 'Barisal';
                    shipping_cost+=300;
                    console.log("shipping charge: "+district_shipping_charge)
                }
                else if((js_district.value) == 'Jessore (৳350)'){
                    js_district_name = 'Jessore';
                    shipping_cost=350;
                    console.log("shipping charge: "+district_shipping_charge)
                }
                else if((js_district.value) == 'Rajshahi (৳450)'){
                    js_district_name = 'Rajshahi';
                    shipping_cost=450;
                    console.log("shipping charge: "+district_shipping_charge)
                }
                else if((js_district.value) == 'Rangpur (৳400)'){
                    js_district_name = 'Rangpur';
                    shipping_cost=400;
                    console.log("shipping charge: "+district_shipping_charge)
                }
                else if((js_district.value) == 'Khulna (৳350)'){
                    js_district_name = 'Khulna';
                    shipping_cost=350;
                    console.log("shipping charge: "+district_shipping_charge)
                }
                else if((js_district.value) == 'Sylhet (৳300)'){
                    js_district_name = 'Sylhet';
                    shipping_cost=300;
                    console.log("shipping charge: "+district_shipping_charge)
                }
                    // event.preventDefault();
                var _this = this
                console.log("Vat============"+js_vat)
                $.ajax({
                    url: "{{  url('update/shipping/info') }}/"+js_district_name+'/'+js_shipping_address+'/'+js_coupon_minus+'/'+js_vat+'/'+shipping_cost+'/'+js_grand_total,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                        console.log('ajax after shipping address selection successfull');
                        const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
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
                    }
                })
                $("button").attr("data-toggle","modal");
                $("button").attr("data-dismiss","modal");
                $("button").attr("data-target","#Payment_modal");



            }else {
                $("#shipping_address_error_messege").css("display", "inline");
                $("#shipping_district_error_messege").css("display", "none");
                document.getElementById('shipping_information_div').scrollIntoView({behavior: "smooth"});
                console.log("INSIDE NULL (else)")
                // alert('Please Type Your Shipping Address');
            }
        }

    }

    function payment_method_selection(){
        console.log("inside payment method selection")
        selected_payment_method = $("input[name='selected']:checked").val();
        console.log("inside payment method selection value of selected: "+ selected_payment_method)

        if(selected_payment_method == 'stripe'){
            // $("button").attr("data-toggle","modal");
            // $("button").attr("data-target","#payment_stripe");
            // $("#payment_method_selection_button").attr("data-dismiss","modal");

            window.location.href = '/elaravel_v2/pay_with_stripe'

            // $("#payment_stripe").css("display", "block");
            // $("#shopping_cart_content").css("display", "none");
            // document.getElementById('payment_stripe').scrollIntoView({behavior: "smooth", block: "start", inline: "nearest"});
        }else if(selected_payment_method == 'paypal'){
            // $("button").attr("data-toggle","modal");
            // $("button").attr("data-dismiss","modal");
            // $("button").attr("data-target","#payment_paypal");
        }else if(selected_payment_method == 'mollie'){
            // $("button").attr("data-toggle","modal");
            // $("button").attr("data-dismiss","modal");
            // $("button").attr("data-target","#payment_mollie");
        }
    }


    function numberWithCommas(number, decimals=0) {
                var decimalNumbers = '';
                if ((number.toString()).indexOf('.')>=0)  // if string/number has '.' , like 5.5, .56, 0.6
                {
                    decimalNumbers = (number.toString()).substr( (number.toString()).indexOf('.'));
                    decimalNumbers = decimalNumbers.substr( 1, decimals);
                }
                else
                {
                    decimalNumbers = '';
                    for (var i = 2; i <=decimals ; i++)
                    {
                        decimalNumbers = decimalNumbers+'0';
                    }
                }
                // return decimalNumbers;
                number = parseInt(number);
                number = number.toString();
                // // reverse
                number = this.reverseString(number.toString());
                var n = '';
                var stringlength = number.length;
                for (i = 0; i < stringlength; i++)
                {
                    if (i%2==0 && i!=stringlength-1 && i>1)
                    {
                        n = n+number[i]+',';
                    }
                    else
                    {
                        n = n+number[i];
                    }
                }
                number = n;
                // // reverse
                number = this.reverseString(number);
                (decimals!=0)? number=(number+'.'+decimalNumbers) : number ;
                return number;
            }


            function reverseString(str) {
                // Step 1. Use the split() method to return a new array
                var splitString = str.split(""); // var splitString = "hello".split("");
                // ["h", "e", "l", "l", "o"]
                // Step 2. Use the reverse() method to reverse the new created array
                var reverseArray = splitString.reverse(); // var reverseArray = ["h", "e", "l", "l", "o"].reverse();
                // ["o", "l", "l", "e", "h"]
                // Step 3. Use the join() method to join all elements of the array into a string
                var joinArray = reverseArray.join(""); // var joinArray = ["o", "l", "l", "e", "h"].join("");
                // "olleh"
                //Step 4. Return the reversed string
                return joinArray; // "olleh"
            }
            // ====================Number related=============================
            // ====================Number related=============================



</script>

{{-- Payment script --}}
<script>
        // Create a Stripe client.
        var stripe = Stripe('pk_test_51HvdxJBuHtSEnNpzJiI5UWLlMYBJjDhwuCUCu5bTg6ZiOmadkfh6uZEJ1YNpCQK5liQDNy5Vt3Dsa97xoUo2iTux00dUo10b8e');

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };

    // Create an instance of the card Element.
    var card = elements.create('card', {style: style});

    // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.on('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
    }

</script>
{{-- Payment script --}}

{{-- mobile responsive --}}
<style>
    @media (max-width: 768px){
        #product_name_mobile{
            max-width: 100% !important;
            min-width:100% !important;
        }
        #product_name_text_mobile{
            font-size: 12px;
        }
        .cart_item_text {
            float: right;
            margin-top: 2%;
        }
        #product_id_mobile{
            max-width: 100% !important;
            min-width:100% !important;
        }
        #product_color_mobile{
            max-width: 100% !important;
            min-width:100% !important;
        }
        #product_qty_mobile{
            max-width: 100% !important;
            min-width:100% !important;
        }

        #qty_input_field{
            max-width: 25%;
        }
        #product_size_mobile{
            max-width: 100% !important;
            min-width:100% !important;
        }
        #price_mobile{
            max-width: 100% !important;
            min-width:100% !important;
        }
        #total_mobile{
            max-width: 100% !important;
            min-width:100% !important;
        }
        #action_show_mobile{
            /* max-width: 100% !important; */
            margin-left:35%;
            min-width:50% !important;
            display: inline !important;
        }
        #action_hide_mobile{
            display: none;
        }

        #coupon_name{
            display: none;
        }
        #product_image_mobile{
            margin: auto;
            width: 50%;
            border: 2px solid black;
            padding: 0px;
        }
        #literally_the_product_image{
            height: 100%;
            width: 100%;
        }
        .order_total_amount{
            float: right;
        }
        .cart_buttons {
            margin-left: 10%;
        }
        #stripe_image_mobile{
            height: 45px !important;
            width: 50px !important;
        }
        #paypal_image_mobile{
            height: 45px !important;
            width: 50px !important;
        }
        #mollie_image_mobile{
            height: 45px !important;
            width: 50px !important;
        }
    }
</style>
{{-- mobile responsive --}}

@endsection

