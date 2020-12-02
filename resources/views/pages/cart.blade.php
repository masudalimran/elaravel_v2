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

{{-- strip css --}}
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
{{-- strip css --}}

{{-- styles --}}
@php
    $userId = Auth::id();
    $sum_total =  0;
    @endphp

<div class="cart_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 offset-lg-0">
                <div class="cart_container">

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
            <div class="cart_item_image">
                <a href="{{url('product/details/'.$item->id.'/'.$item->product_name)}}">
                    <img src="{{asset($item->image)}}" alt="">
                </a>
            </div>
                                <div class="cart_item_info d-flex flex-sm-row flex-column justify-content-between">
                                    <div class="cart_item_name cart_info_col" style="max-width: 10%; min-width:10%;">
                                        <div class="cart_item_title">Product Name</div>
                                        <div class="cart_item_text" >{{$item->product_name}}</div>
                                    </div>
                                    <div class="cart_item_name cart_info_col" style="max-width: 7%; min-width:7%;">
                                        <div class="cart_item_title">Product ID: </div>
                                        <div class="cart_item_text"><h5>{{$item->product_id}}</h5></div>
                                    </div>
                                    <div class="cart_item_color cart_info_col" style="max-width: 10%; min-width:10%;">
                                        <div class="cart_item_title" style="text-align: center">Color</div>
                                        <div class="cart_item_text">
                                            <select onchange="change_color({{$item->product_id}}, this.value)" class="form-control input-sm" id="cart_product_color">
                                                @foreach($product_color as $colors)
                                                    <option value="{{ $colors }}">{{ $colors }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <div class="cart_item_color cart_info_col" style="max-width: 7%; min-width:7%;">
                                        <div class="cart_item_title" style="text-align: center">Size</div>
                                        <div class="cart_item_text" >
                                            <select onchange="change_size({{$item->product_id}}, this.value)" class="form-control input-lg" id="exampleFormControlSelect1">
                                                @foreach($product_size as $sizes)
                                                    <option value="{{ $sizes }}">{{ $sizes }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    {{-- QUANTIY --}}
                                    <div class="cart_item_quantity cart_info_col" style="max-width: 8%; min-width:8%;">
                                        <div class="cart_item_title">Quantity</div>
                                        <div class="cart_item_text" >
                                            <input onchange="qty_change({{$item->id}},this.value, {{$item->price}}, {{$userId}})" class="form-control" type="number" pattern="[0-9]*" value="{{$item->qty}}" name="qty">
                                        </div>
                                    </div>
                                    {{-- QUANTIY --}}

                                    <div class="cart_item_price cart_info_col" style="max-width: 10%; min-width:10%;">
                                        <div class="cart_item_title" style="text-align: right">Price</div>
                                        <div class="cart_item_text">{{numberFormat($item->price)}}</div>
                                    </div>
                                    <div class="cart_item_total cart_info_col" style="max-width: 10%; min-width:10%;">
                                        <div class="cart_item_title" style="text-align: right">Total</div>
                                        <div class="cart_item_text" id="product-subtotal-{{$item->id}}">{{numberFormat($item->price * $item->qty)  }}</div>
                                    </div>
                                    <div class="cart_item_name cart_info_col" style="max-width: 5%; min-width:5%;">
                                        <div class="cart_item_title" style="text-align: center">Action</div>
                                        <div class="cart_item_text" style="text-align: center">
                                                <button onclick="remove_cart_item({{$item->product_id}},{{$item->price}})" class="btn btn-sm btn-danger">X</button>
                                        </div>

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
                                <span class="badge badge-pill badge-success" id="coupon_name"></span>
                                 <span class="badge badge-pill badge-warning" id="coupon_percentage"></span>
                                  (-)</div>
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
    <div class="modal fade" id="checkout_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false" >
        <div class="modal-dialog modal-xl" role="document">
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
                    <div class="form-group">
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
                      <label for="exampleInputEmail1">Shipping Address*</label>
                      <input onchange="shipping_district({{($sum_total)- ($coupon_minus)}})" type="text" class="form-control" name="checkout_shipping_address_n" id="checkout_shipping_address" aria-describedby="emailHelp" required>
                    </div>
                    {{-- <div class="form-group">
                      <label for="exampleInputEmail1">District*</label> --}}
                      {{-- <input onchange="shipping_district({{($sum_total)- ($coupon_minus)}})" type="text" class="form-control" name="checkout_district_n" id="checkout_district" aria-describedby="emailHelp" required> --}}
                    <div class="form-group">
                    <label for="exampleFormControlSelect1">District*</label>
                        <select onchange="shipping_district({{($sum_total)- ($coupon_minus)}})" class="form-control" name="checkout_district_n" id="checkout_district">
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
                            <li class="list-group-item " ><input type="radio" name="selected" value="stripe"> <img src="{{asset('public\media\Payment_system_images\stripe.png')}}" style="height: 70px; width: 180px"><br><br>
                            <h5 style="text-align: center; color: violet">Pay With Stripe</h5></li>
                            <li class="list-group-item " ><input type="radio" name="selected" value="paypal"> <img src="{{asset('public\media\Payment_system_images\paypal.png')}}" style="height: 70px; width: 180px"><br><br>
                            <h5 style="text-align: center; color: blue">Pay With Paypal</h5></li>
                            <li class="list-group-item " ><input type="radio" name="selected" value="mollie"> <img src="{{asset('public\media\Payment_system_images\mollie.png')}}" style="height: 70px; width: 180px"><br><br>
                            <h5 style="text-align: center; color: red">Pay With Mollie</h5></li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button onclick="payment_method_selection()" type="button" class="btn btn-primary">Proceed</button>
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
        <div class="modal-body">
            <form action="/charge" method="post" id="payment-form">
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
                <button class="btn btn-primary">Submit Payment</button>
            </form>
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

    let coupon_minus_init = 0
    let coupon_percentage_init = 0
    let coupon_input_init = 0
    let total_init = 0
    let order_total_cart_init
    order_total_cart_init = 0

    // function when_site_load(order_total_cart){
    //     this.order_total_cart_init = order_total_cart

    //     console.log("order_total_cart_init:   "+this.order_total_cart_init)
    // }


    function qty_change(productId , qty, price, userId) {
        // $("#cart-subtotal").text(0)
        let subtotal = qty * price;
        console.log(subtotal)
        $('#product-subtotal-'+productId).text(subtotal)



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
                $("#cart-subtotal-in-cart-page").text(total)
                $("#cart-subtotal").text(total);
                console.log("coupon percentage init:  "+ _this.coupon_percentage_init)
                let coupon_add_when_qty_change
                if(_this.coupon_percentage_init){
                    coupon_add_when_qty_change  = (total * _this.coupon_percentage_init)/100
                }else{
                    coupon_add_when_qty_change = 0
                }
                console.log("coupon percentage init:  "+ _this.coupon_percentage_init)
                $('#updated_coupon').text(coupon_add_when_qty_change)
                let order_total = total - coupon_add_when_qty_change
                $('#cart-subtotal-with-coupon').text(order_total)
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
                $('#updated_coupon').text(data.coupon_minus)
                _this.coupon_minus_init = data.coupon_minus
                let cart_total = total - data.coupon_minus
                _this.total_init = total;
                console.log("Updated cart total =======================================================================:", cart_total)
                $('#cart-subtotal-with-coupon').text(cart_total)
                _this.order_total_cart_init = cart_total
                $('#coupon_name').text(data.coupon_input)
                $('#coupon_percentage').text(data.coupon_percentage+'%')
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
                    $('#cart-subtotal-in-cart-page').text(_this.total_init)
                    $('#cart-subtotal-with-coupon').text(_this.total_init)
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
        $("#checkout_order_total").text(order_total_for_checkout);
        let vat
        vat  = (order_total_for_checkout * 15)/100
        console.log("Checkout Vat", vat)
        $("#checkout_vat").text(vat);
        this.js_grand_total_init = order_total_for_checkout + vat
        $("#checkout_grand_total").text(this.js_grand_total_init);
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
        $("#checkout_grand_total").text(this.js_grand_total_init);
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

        var js_district_name

        if(js_district.value == 'Select Shipping District'){
            alert('Please Select District');
        }else {
            if(js_shipping_address){
                console.log("INSIDE NOT NULL (if)")


                if((js_district.value) == 'Dhaka (৳50)'){
                    js_district_name = 'Dhaka';
                    console.log("shipping charge: "+district_shipping_charge)
                }
                else if((js_district.value) == 'Chittagong (৳350)'){
                    js_district_name = 'Chittagong';
                    console.log("shipping charge: "+district_shipping_charge)
                }
                else if((js_district.value) == 'Barisal (৳300)'){
                    js_district_name = 'Barisal';
                    console.log("shipping charge: "+district_shipping_charge)
                }
                else if((js_district.value) == 'Jessore (৳350)'){
                    js_district_name = 'Jessore';
                    console.log("shipping charge: "+district_shipping_charge)
                }
                else if((js_district.value) == 'Rajshahi (৳450)'){
                    js_district_name = 'Rajshahi';
                    console.log("shipping charge: "+district_shipping_charge)
                }
                else if((js_district.value) == 'Rangpur (৳400)'){
                    js_district_name = 'Rangpur';
                    console.log("shipping charge: "+district_shipping_charge)
                }
                else if((js_district.value) == 'Khulna (৳350)'){
                    js_district_name = 'Khulna';
                    console.log("shipping charge: "+district_shipping_charge)
                }
                else if((js_district.value) == 'Sylhet (৳300)'){
                    js_district_name = 'Sylhet';
                    console.log("shipping charge: "+district_shipping_charge)
                }
                    // event.preventDefault();
                $.ajax({
                    url: "{{  url('update/shipping/info') }}/"+js_district_name+'/'+js_shipping_address,
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
                console.log("INSIDE NULL (else)")
                alert('Please Type Your Shipping Address');
            }
        }

    }

    function payment_method_selection(){
        console.log("inside payment method selection")
        selected_payment_method = $("input[name='selected']:checked").val();
        console.log("inside payment method selection value of selected: "+ selected_payment_method)

        if(selected_payment_method == 'stripe'){
            $("button").attr("data-toggle","modal");
            $("button").attr("data-dismiss","modal");
            $("button").attr("data-target","#payment_stripe");
        }else if(selected_payment_method == 'paypal'){
            $("button").attr("data-toggle","modal");
            $("button").attr("data-dismiss","modal");
            $("button").attr("data-target","#payment_paypal");
        }else if(selected_payment_method == 'mollie'){
            $("button").attr("data-toggle","modal");
            $("button").attr("data-dismiss","modal");
            $("button").attr("data-target","#payment_mollie");
        }
    }
</script>

{{-- Payment script --}}
<script>
        // Create a Stripe client.
        var stripe = Stripe('pk_live_51HtX6kENsc8UGICBHgXiHGGO2CFozsOTN4STTj4blT1nlEtNEiTjnPUxtul8uqyuKUkGQ2ShUSwgwGEW7iitfwJb00WFBGyMNq');

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

@endsection

