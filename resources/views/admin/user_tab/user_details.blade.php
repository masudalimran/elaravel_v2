@extends('admin.admin_layouts')
@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{url('admin/home')}}">Admin Panel</a>
            <a class="breadcrumb-item" href="{{route('all.user')}}">User</a>
            <a class="breadcrumb-item" href="#">User Details</a>
            <span class="breadcrumb-item active">USer details Page</span>
        </nav>
        <div class="sl-pagebody" style="  overflow-x: scroll !important; display: table; width: 100%; height: 100vh">
            <div class="sl-page-title">
                <h5>User Details</h5>
                <p>Here below is the User Details</p>
            </div><!-- sl-page-title -->
            <div class="card">
                <div class="card-header" style="text-align: center">
                  <h3 style="color:red; display:inline"> User name : </h3><h3 style="display: inline">{{$user_details->name}}<h3>
                </div>
                <div class="card-body">
                    <h5 class="card-text" style="text-align: left; color:black">phone: {{$user_details->phone}}</h5><br>
                    <h5 class="card-text" style="text-align: left; color:black">email : {{$user_details->email}}</h5><br>
                    <h5 class="card-text" style="text-align: left; color:black">email_verified_at: {{$user_details->email_verified_at}}</h5><br>
                    <h5 class="card-text" style="text-align: left; color:black">password : {{$user_details->password}}</h5><br>
                    <h5 class="card-text" style="text-align: left; color:black">shipping_district : {{$user_details->shipping_district}}</h5><br>
                    <h5 class="card-text" style="text-align: left; color:black">shipping_address : {{$user_details->shipping_address}}</h5><br>
                    <h5 class="card-text" style="text-align: left; color:black">provider : {{$user_details->provider}}</h5><br>
                    <h5 class="card-text" style="text-align: left; color:black">provider_id : {{$user_details->provider_id}}</h5><br>
                    <h5 class="card-text" style="text-align: left; color:black">remember_token : {{$user_details->remember_token}}</h5><br>
                    <h5 class="card-text" style="text-align: left; color:black">created_at : {{$user_details->created_at}}</h5><br>
                    <h5 class="card-text" style="text-align: left; color:black">updated_at : {{$user_details->updated_at}}</h5>

                    <h5 class="card-title" style="text-align: center">yo yo yo </h5>
                </div>
              </div>


        </div><!-- sl-pagebody -->


    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
