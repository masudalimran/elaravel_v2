@extends('layouts.app')
@section('content')

{{-- css --}}
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/bootstrap4/bootstrap.min.css')}}">
<link href="{{asset('public/frontend/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/plugins/OwlCarousel2-2.2.1/owl.theme.default.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/plugins/OwlCarousel2-2.2.1/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/blog_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/blog_responsive.css')}}">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

{{-- css --}}

@php
    $language = session()->get('lang');
    // dd($language);

@endphp

<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="{{asset('public/frontend/images/shop_background.jpg')}}"></div>
    <div class="home_overlay"></div>
    <div class="home_content d-flex flex-column align-items-center justify-content-center">
        @if ($language == 'bangla')
        <h2 class="home_title">বিস্ মিব ব্লগ</h2>
        @else
        <h2 class="home_title">BISMIB BLOG</h2>
        @endif
    </div>
</div>
<!-- Blog -->

	<div class="blog">
		<div class="container">
			<div class="row" >
				<div class="col">
					<div class="blog_posts d-flex flex-row align-items-start justify-content-between" >

                        @foreach ($post as $item)
						<!-- Blog post -->
						<div class="blog_post"  style="min-height: 500px;">
                            <div class="blog_image" style="background-image:url({{asset($item->post_image)}})"></div><br>
                            {{-- {{dd($item->post_image)}} --}}
                            @if ($language == 'bangla')
                                <div style="align-content: center"><h5 style="text-align: center">{{$item->post_title_bn}}</h5></div>
                            @else
                                <div style="align-content: center"><h5 style="text-align: center">{{$item->post_title_en}}</h5></div>
                            @endif
                            @if ($language == 'bangla')
                                {{-- <div class="blog_text">{!!substr($item->details_bn, 0, 220)!!} .......................</div> --}}
                                <div class="blog_text" id="translated-{{$item->id}}" >
                                    {!!substr($item->details_bn, 0, 320)!!}
                                    <span>.......................</span>
                                    <i onclick="change_lang_bn('{{$item->details_bn}}',{{$item->id}})" class="fas fa-align-right fa-language" title="Translate To English"></i>
                                </div>
                            @else
                                <div class="blog_text" id="translated-{{$item->id}}" >
                                    {!!substr($item->details_en, 0, 120)!!}
                                    <span>.......................</span>
                                    <i onclick="change_lang_en('{{$item->details_en}}',{{$item->id}})" class="fas fa-align-right fa-language" title="Translate To Bengali"></i>
                                </div>
                            @endif
                            @if ($language == 'bangla')
                                <div class="blog_button"><a href="{{route('blog.details',[app()->getLocale(), $item->id])}}">আরো পড়ুন </a></div>
                            @else
                                <div class="blog_button"><a href="{{route('blog.details',[app()->getLocale(), $item->id], )}}">Continue Reading</a></div>
                            @endif
                        </div>
                        @endforeach


					</div>
				</div>

			</div>
		</div>
    </div>

    <script src="{{asset('public/frontend/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('public/frontend/styles/bootstrap4/popper.js')}}"></script>
    <script src="{{asset('public/frontend/styles/bootstrap4/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/frontend/plugins/greensock/TweenMax.min.js')}}"></script>
    <script src="{{asset('public/frontend/plugins/greensock/TimelineMax.min.js')}}"></script>
    <script src="{{asset('public/frontend/plugins/scrollmagic/ScrollMagic.min.js')}}"></script>
    <script src="{{asset('public/frontend/plugins/greensock/animation.gsap.min.js')}}"></script>
    <script src="{{asset('public/frontend/plugins/greensock/ScrollToPlugin.min.js')}}"></script>
    <script src="{{asset('public/frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.js')}}"></script>
    <script src="{{asset('public/frontend/plugins/parallax-js-master/parallax.min.js')}}"></script>
    <script src="{{asset('public/frontend/plugins/easing/easing.js')}}"></script>
    <script src="{{asset('public/frontend/js/blog_custom.js')}}"></script>

    <script>
        function change_lang_en(source_lang,id){
            console.log(source_lang);
            console.log(id);
            $.ajax({
            url: "{{  url('change/source/language/en') }}/"+source_lang,
            type:"GET",
            dataType:"json",
            success:function(data) {
                console.log("translated String: "+ data.a);
                sub_a = (data.a).substring(0, 500);
                console.log("translated String sub a: "+ sub_a);
                // // console.log("translated String: "+ sub_a);
                // // var content = sub_a;
                // // console.log("translated String: "+ content);
                // // var text = $(content).text();
                // // console.log("translated String: "+ text);

                // $("#translated-"+id).remove();
                // document.getElementById(translated-id).innerHTML = "";
                // $("#translated-"+id).removeData();
                // $("#translated-"+id).text(sub_a);
                document.getElementById("translated-"+id).innerHTML = sub_a+'.............';
            }

        });
        }
        function change_lang_bn(source_lang,id){
            console.log(source_lang);
            console.log(id);
            $.ajax({
            url: "{{  url('change/source/language/bn') }}/"+source_lang,
            type:"GET",
            dataType:"json",
            success:function(data) {
                console.log("translated String: "+ data.a);
                sub_a = (data.a).substring(0, 500);
                console.log("translated String sub a: "+ sub_a);
                // // console.log("translated String: "+ sub_a);
                // // var content = sub_a;
                // // console.log("translated String: "+ content);
                // // var text = $(content).text();
                // // console.log("translated String: "+ text);

                // $("#translated-"+id).remove();
                // document.getElementById(translated-id).innerHTML = "";
                // $("#translated-"+id).removeData();
                // $("#translated-"+id).text(sub_a);
                document.getElementById("translated-"+id).innerHTML = sub_a+'.............';
            }

        });
        }
    </script>

@endsection
