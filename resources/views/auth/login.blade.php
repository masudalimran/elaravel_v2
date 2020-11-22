@extends('layouts.app')
@section('content')

{{-- contact form --}}
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/contact_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/contact_responsive.css')}}">

	<div class="contact_form">
		<div class="container">
			<div class="row">
				<div class="col-lg-5 offset-lg-1">
					<div class="contact_form_container">
						<div class="contact_form_title text-center">Sign In</div>

                        <form action="{{route('login')}}" method="post" id="contact_form">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email Address" required>
                                @if ($errors->has('email'))
                                        <strong style="color: red">{{$errors->first('email')}}</strong>
                                @endif
                              </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="password" class="form-control" placeholder="Password" name="password" required>
                                @if ($errors->has('password'))
                                {{-- {{dd($errors->first('password'))}} --}}
                                <strong style="color: red">{{$errors->first('password')}}</strong>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        <a href="{{route('password.request')}}">Forgot password</a>
                        <br><br>

                            <a href="{{ URL::to('/auth/redirect/google') }}" type="submit" class="btn btn-danger btn-block">Login With google</a>
                            <a href="{{ URL::to('/auth/redirect/facebook') }}" type="submit" class="btn btn-info btn-block">Login With Facebook</a>

					</div>
				</div>
				<div class="col-lg-5 offset-lg-1">
					<div class="contact_form_container">
						<div class="contact_form_title text-center">Sign In</div>

						<form action="{{route('register')}}" id="contact_form" method="post">
                            @csrf

                            <div class="form-group">
                              <label for="exampleInputEmail1">Username</label>
                              <input type="text" class="form-control" placeholder="Username" name="username" required>
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Phone Number</label>
                              <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" placeholder="Phone" name="phone" required>
                              @if ($errors->has('phone'))
                                        <strong style="color: red">{{$errors->first('phone')}}</strong>
                              @endif
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email Address" required>
                                @if ($errors->has('email'))
                                        <strong style="color: red">{{$errors->first('email')}}</strong>
                                @endif
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Password</label>
                              <input type="password" class="form-control" placeholder="Password" name="password" required>
                              @if ($errors->has('password'))
                              {{-- {{dd($errors->first('password'))}} --}}
                              <strong style="color: red">{{$errors->first('password')}}</strong>
                              @endif
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Confirm Password</label>
                              <input type="password" class="form-control" placeholder="Re-type Password" name="password_confirmation" required>
                              @if ($errors->has('password_confirmation'))
                              <strong style="color: red">{{$errors->first('password_confirmation')}}</strong>
                              @endif
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>


					</div>
				</div>
			</div>
		</div>
		<div class="panel"></div>
    </div>

@endsection
