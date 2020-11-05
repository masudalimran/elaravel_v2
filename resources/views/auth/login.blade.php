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

						<form action="#" method="post">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Enter your email or phone number</label>
                              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Email or Phone">
                            </div>

                            <div class="form-group">
                              <label for="exampleInputPassword1">Password</label>
                              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="*************">
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                          </form><br><br>
                          <button type="submit" class="btn btn-info btn-block">Login With Facebook</button>
                          <button type="submit" class="btn btn-danger btn-block">Login With google</button>

					</div>
				</div>
				<div class="col-lg-5 offset-lg-1">
					<div class="contact_form_container">
						<div class="contact_form_title text-center">Sign In</div>

						<form action="{{route('register')}}" id="contact_form" method="post">
                            @csrf

                            <div class="form-group">
                              <label for="exampleInputEmail1">Username</label>
                              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Username" name="username" required>
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Phone Number</label>
                              <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('email') }}" placeholder="Phone" name="phone" required>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" id="exampleInputEmail1" placeholder="Email Address" required>
                              </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Password</label>
                              <input type="password" class="form-control" id="exampleInputEmail1" placeholder="Password" name="password" required>
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Confirm Password</label>
                              <input type="password" class="form-control" id="exampleInputEmail1" placeholder="Re-type Password" name="password_confirmation" required>
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
