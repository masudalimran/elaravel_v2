@extends('layouts.app')
@section('content')

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

						<form>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Email address</label>
                              <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Phone Number</label>
                              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Phone">
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Password</label>
                              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Password">
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Confirm Password</label>
                              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Re-type Password">
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                          </form>


					</div>
				</div>
			</div>
		</div>
		<div class="panel"></div>
    </div>

    <form>
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="form-group form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
@endsection
