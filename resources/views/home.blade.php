@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/contact_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/contact_responsive.css')}}">

    {{-- <a href="{{route('user.logout')}}" class="btn btn-info">Logout</a> --}}
    <div class="contact_form">
        <div class="container">
            <div class="row">
                <div class="col-8 card">
                    <table class="table table-response">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">first</th>
                                <th scope="col">second</th>
                                <th scope="col">handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <th>first</th>
                                <th>second</th>
                                <th>@mdo</th>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <th>first</th>
                                <th>second</th>
                                <th>handle</th>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <th>first</th>
                                <th>second</th>
                                <th>handle</th>
                            </tr>
                            <tr>
                                <th scope="row">4</th>
                                <th>first</th>
                                <th>second</th>
                                <th>handle</th>
                            </tr>
                            <tr>
                                <th scope="row">5</th>
                                <th>first</th>
                                <th>second</th>
                                <th>handle</th>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-4">
                    <div class="card" style="width: 18rem;">
                        <img src="{{asset('public/yo.webp')}}" class="card-img-top" style="height: 50%; width: 80%; margin-left: 10%; margin-top: 5%; ">
                        <div class="card-body">
                            <h5 class="card-title text-left">
                                @php
                                    echo strtoupper(Auth::user()->name."<br>");
                                    echo ("Email:".Auth::user()->email."<br>");
                                    echo strtoupper("Provider : ".Auth::user()->provider."<br>");
                                    echo strtoupper("ID : ".substr(Auth::user()->provider_id,-4));
                                @endphp
                            </h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"> <a href="{{route('password.change')}}"> Change Password</a></li>
                            <li class="list-group-item">Cras justo odio</li>
                            <li class="list-group-item">Cras justo odio</li>
                        </ul>
                        <div class="card-body">
                            <a href="{{route('user.logout')}}" class="btn btn-danger btn-sm btn-block">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
