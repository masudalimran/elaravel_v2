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

{{-- styles --}}
@php
    $userId = Auth::id();
    $sum_total =  0;
@endphp

<div class="cart_section" >
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
                            {{-- @if($coupon_minus != Null) --}}
                            <div class="order_total_amount" id="cart-subtotal-with-coupon">{{numberFormat(($sum_total)- ($coupon_minus))}}</div>
                            {{-- @else --}}
                            {{-- <div class="order_total_amount">{{numberFormat($sum_total)}}</div> --}}
                            {{-- @endif --}}
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

    <!-- Modal -->
    <div class="modal fade" id="checkout_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Checkout</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">

                <form>
                    {{-- imported from auth --}}
                    <div class="form-group">
                        <label for="exampleInputEmail1">User Name</label>
                        <input type="text" class="form-control" id="checkout_username" aria-describedby="emailHelp" value="{{Auth::user()->name}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="text" class="form-control" id="checkout_email" aria-describedby="emailHelp" value="{{Auth::user()->email}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Phone</label>
                        <input type="text" class="form-control" id="checkout_phone" aria-describedby="emailHelp" value="{{Auth::user()->phone}}">
                    </div>
                    {{-- imported from auth --}}

                    <div class="form-group">
                      <label for="exampleInputEmail1">Shipping Address</label>
                      <input type="text" class="form-control" id="checkout_shipping_address" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Distrcit</label>
                      <input type="text" class="form-control" id="checkout_district" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Postal Code</label>
                      <input type="text" class="form-control" id="checkout_postal_code" aria-describedby="emailHelp">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>

                <div class="order_total">
                    <div class="order_total_content text-md-right">
                        <div class="order_total_title">Order Total</div>
                        <div class="order_total_amount" id="checkout_order_total">{{numberFormat($sum_total)}}</div><br>
                    </div>
                </div>

                <div class="order_total">
                    <div class="order_total_content text-md-right">
                        <div class="order_total_title">Vat (15%)</div>
                        <div class="order_total_amount" id="checkout_vat">{{numberFormat($sum_total)}}</div><br>
                    </div>
                </div>

                <div class="order_total">
                    <div class="order_total_content text-md-right">
                        <div class="order_total_title">Shipping Cost</div>
                        <div class="order_total_amount" id="checkout_shipping_cost">{{numberFormat($sum_total)}}</div><br>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
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


{{-- sweetalert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
{{-- sweetalert2 --}}

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

    function checkout(order_total, order_total_cart_init){
      let order_total_for_checkout
      console.log("order total", order_total)
      if(this.order_total_cart_init){
        order_total_for_checkout = this.order_total_cart_init
          console.log("Inside Checkout if", order_total_for_checkout)
        }else{
            order_total_for_checkout = order_total
            console.log("Inside Checkout else", order_total_for_checkout)
        }
        $("#checkout_order_total").text(order_total_for_checkout);
        let vat
        vat  = (order_total_for_checkout * 15)/100
        console.log("Checkout Vat", vat)
      $("#checkout_vat").text(vat);

      $("#checkout_shipping_cost").text(order_total_for_checkout);


    }

</script>

@endsection
