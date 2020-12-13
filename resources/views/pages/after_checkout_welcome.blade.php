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
@php
    $userId = Auth::id();
    $payments = DB::table('payments')
    ->where('user_id',$userId)
    ->orderBy('id','desc')
    ->first();

@endphp

<div class="cart_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="cart_container">
                    <div class="cart_title text-center">Thank You Shopping With BISMIB FASHION</div>
                    <h4 style="text-align: center; color: red">Your Payment Has Been Received Successfully</h4>

                    <div class="card text-center">
                        <div class="card-header">
                          Paid With Stripe
                        </div>
                        <div class="card-body">
                          <h5 class="card-title">{{strtoupper(Auth::user()->name)}}</h5>
                          <p class="card-text">Email: {{Auth::user()->email}}</p>
                          <p class="card-text">Phone: {{Auth::user()->phone}}</p>
                          <p class="card-text">Shipping Distrcit: {{Auth::user()->shipping_district}}</p>
                          <p class="card-text">Shipping Address: {{Auth::user()->shipping_address}}</p>
                          <p class="card-text">{{(numberFormat(($charge->amount)/100))}} BDT Paid Successfully</p>
                          <p class="card-text">Token: {{($charge->balance_transaction)}}</p>
                          <a href="{{url('/')}}" class="btn btn-primary">Go To Home Page</a>
                        </div>
                        <div class="card-footer text-muted">
                            Created At: {{YmdTodmYPmdMyPM($payments->created_at)}}
                        </div>
                    </div>

                </div>
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

<script src="https://js.stripe.com/v3/"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

{{-- Sweetalert 2 --}}

{{-- bootstrap --}}
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
{{-- bootstrap --}}

@endsection
