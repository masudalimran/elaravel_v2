@extends('layouts.app')
@section('content')

{{-- styles --}}
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/bootstrap4/bootstrap.min.css')}}">
<link href="{{asset('public/frontend/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/cart_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/cart_responsive.css')}}">

{{-- Sweetalert --}}
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">

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
                                            <select class="form-control input-sm" id="exampleFormControlSelect1" name="color">
                                                @foreach($product_color as $color)
                                                <option value="{{ $item->product_color }}">{{ $color }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <div class="cart_item_color cart_info_col" style="max-width: 7%; min-width:7%;">
                                        <div class="cart_item_title" style="text-align: center">Size</div>
                                        <div class="cart_item_text" >
                                            <select class="form-control input-lg" id="exampleFormControlSelect1" name="color">
                                                @foreach($product_size as $size)
                                                <option value="{{ $item->product_size }}">{{ $size }}</option>
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
                                            {{-- <a href="{{url('remove/item/'.$item->product_id.'/'.$coupon_minus.'/'.$active_coupon)}}"> --}}
                                                <button onclick="remove_cart_item({{$item->product_id}},{{$item->price}})" class="btn btn-sm btn-danger">X</button>
                                            {{-- </a> --}}
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
                            <div class="order_total_amount" id="cart-subtotal">{{numberFormat($sum_total)}}</div><br>
                        </div>
                    </div>
                    <div class="order_total">
                        <div class="order_total_content text-md-right">
                            <div class="order_total_title">Coupon Discount
                                <span class="badge badge-pill badge-success" id="coupon_name"></span>
                                 <span class="badge badge-pill badge-warning" id="coupon_percentage"></span>
                                  (-)</div>
                            <div class="order_total_amount" id="updated_coupon">{{numberFormat($coupon_minus ?? '0')}}</div><br>
                        </div>
                    </div>

                    <div class="order_total">
                        <div class="order_total_content text-md-right">
                            <div class="order_total_title">Order Total:</div>
                            {{-- @if($coupon_minus != Null) --}}
                            <div class="order_total_amount" id="cart-subtotal-with-coupon">{{numberFormat(($sum_total)- ($coupon_minus ?? ''))}}</div>
                            {{-- @else --}}
                            {{-- <div class="order_total_amount">{{numberFormat($sum_total)}}</div> --}}
                            {{-- @endif --}}
                        </div>
                    </div>

                    <div class="cart_buttons">
                        <a href="{{url('remove/cart/'.$userId.'/'.$active_coupon)}}"><button type="button" class="button cart_button_clear" style="color: red">Cancel Cart</button></a>
                        <button onclick="checkout()" type="submit" class="button cart_button_checkout">Checkout</button>
                    </div>
                </div>
            {{-- </form> --}}
            </div>
        </div>
    </div>
</div>
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

{{-- <script type="text/javascript" ></script>
<script ></script> --}}



<script type="text/javascript">
src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"

src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"

    let coupon_minus_init = 0
    let coupon_percentage_init = 0
    let coupon_input_init = 0
    let total_init = 0


    function qty_change(productId , qty, price, userId) {
        let subtotal = qty * price;
        console.log(subtotal)
        $('#product-subtotal-'+productId).text(subtotal)

        console.log('===============================================', productId, qty)
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
                console.log(total)
                $("#cart-subtotal").text(total);
                _this.function2(userId, total);

            }

        });
    }
    function function1(userId, total){
        console.log("=======================================================================:", userId)
        event.preventDefault();
        this.function2(userId, total)

    }

    function function2(userId, total){
        console.log("=======================================================================:", userId)
        // event.preventDefault();
        let _this = this
        $.ajax({
            url: "{{  url('cart/coupon/add/') }}/"+userId+'/'+total,
            type:"POST",
            data: $('#coupon_update').serialize(),
            dataType:"json",
            success:function(data) {
                console.log("Updated Coupon =======================================================================:", data.coupon_minus)
                console.log("Updated Coupon =======================================================================:", data.coupon_input)
                $('#updated_coupon').text(data.coupon_minus)
                let cart_total = total - data.coupon_minus
                $('#cart-subtotal-with-coupon').text(cart_total)
                $('#coupon_name').text(data.coupon_input)
                $('#coupon_percentage').text(data.coupon_percentage+'%')

                _this.total_init = total

                _this.coupon_minus_init = parseInt(data.coupon_minus)
                console.log("updating coupon minus internally "+_this.coupon_minus_init)

                _this.coupon_percentage_init = parseInt(data.coupon_percentage)
                console.log("updating coupon percentage internally "+ _this.coupon_percentage_init)

                _this.coupon_input_init = parseInt(data.coupon_input)
                console.log("updating coupon percentage internally "+ _this.coupon_input_init)
            }
        });
    }

    function remove_cart_item(product_id, price, coupon_minus_init, coupon_percentage_init, coupon_input_init, ){
        console.log("remove cart item = "+product_id+"  "+price+"  "+ this.coupon_minus_init +"   "+ this.coupon_percentage_init +"   "+ this.coupon_input_init)
        let _this = this
        $.ajax({
            url: "{{  url('remove/cart/item') }}/"+product_id+'/'+price+'/'+_this.coupon_minus_init+'/'+_this.coupon_percentage_init+'/'+_this.coupon_input_init,
            type:"GET",
            dataType:"json",
            success:function(data) {
                console.log("product_id=======================================================================:", data.product_id)
                console.log("coupon_minus =======================================================================:", data.coupon_minus)
                console.log("active_coupon_percentage =======================================================================:", data.active_coupon_percentage)
                console.log("coupon_input =======================================================================:", data.coupon_input)
                if(_this.coupon_minus_init){
                    $('#updated_coupon').text(data.coupon_minus)
                    let cart_total = _this.total_init - data.coupon_minus
                    $('#cart-subtotal-with-coupon').text(cart_total)
                    $('#coupon_name').text(data.coupon_input)
                    $('#coupon_percentage').text(data.active_coupon_percentage+'%')
                    $('#remove-cart-item-'+data.product_id).remove()
                }else{
                    $('#remove-cart-item-'+_this.product_id).remove()

                }
            }
        });
    }

    function checkout(){
        // event.preventDefault();
        console.log("Inside Checkout")
    }

</script>

@endsection
