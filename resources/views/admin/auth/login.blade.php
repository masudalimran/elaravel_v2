@extends('admin.admin_layouts')

@section('admin_content')
    <div class="d-flex align-items-center justify-content-center bg-sl-primary ht-100v">

        <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
            <div class="signin-logo tx-center tx-24 tx-bold tx-inverse"> Created By <span class="tx-info tx-normal">
                    Imon</span></div>
            <div class="tx-center mg-b-60">Admin Login Page</div>
            <form action="{{ route('admin.login') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                        placeholder="Email Address">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div><!-- form-group -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password"
                        class="form-control @error('password') is-invalid @enderror" name="password" required
                        autocomplete="current-password" placeholder="Password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <a href="{{ route('admin.password.request') }}" class="text-white">I forgot my password</a>
                </div><!-- form-group -->
                <button type="submit" class="btn btn-info btn-block">Sign In</button>
            </form>
        </div><!-- login-wrapper -->
    </div><!-- d-flex -->
@endsection
