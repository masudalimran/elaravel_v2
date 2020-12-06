@extends('layouts.app')
@section('content')

@php
    $language = session()->get('lang');
@endphp

<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/bootstrap4/bootstrap.min.css')}}">
<link href="{{asset('public/frontend/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/plugins/OwlCarousel2-2.2.1/owl.theme.default.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/plugins/OwlCarousel2-2.2.1/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/blog_single_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/blog_single_responsive.css')}}">
    <!-- Home -->

	<div class="home">
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="{{asset($blog_details->post_image)}}" data-speed="0.8"></div>
	</div>

	<!-- Single Blog Post -->

	<div class="single_post">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2">
                    @if ($language == 'bangla')
                        <div class="single_post_title" style="text-align: center"><b>{!!$blog_details->post_title_bn!!}</b></div>
                    @elseif($language == 'english')
                        <div class="single_post_title" style="text-align: center">{!!$blog_details->post_title_en!!}</div>
                    @endif
					<div class="single_post_text">
                        @if ($language == 'bangla')
                            <div class="single_post_text">{!!$blog_details->details_bn!!}</div>
                        @elseif($language == 'english')
                            <div class="single_post_text">{!!$blog_details->details_en!!}</div>
                        @endif

						<div class="single_post_quote text-center">
							<div class="quote_image"><img src="{{asset('public/frontend/images/quote.png')}}" alt=""></div>
							<div class="quote_text">
                                @if ($language == 'bangla')
                                    {!!$blog_details->details_bn!!}
                                @elseif($language == 'english')
                                    {!!$blog_details->details_en!!}
                                @endif
                            </div>
							<div class="quote_name">
                                @if ($language == 'bangla')
                                    <h4>{!!$blog_details->author_bn!!}</h4>
                                @elseif($language == 'english')
                                    <h4>{!!$blog_details->author_en!!}</h4>
                                @endif
                            </div>
						</div>

						<p>
                        @if ($language == 'bangla')
                            <h6>{!!$blog_details->details_bn!!}</h6>
                        @elseif($language == 'english')
                            <h6>{!!$blog_details->details_en!!}</h6>
                        @endif
                        </p>
					</div>
				</div>
			</div>
		</div>
	</div>
    <h1 style="text-align: center">Related Posts</h1>
	<div class="blog">
		<div class="container">
			<div class="row" >
				<div class="col">
					<div class="blog_posts d-flex flex-row align-items-start justify-content-between" >

                        @foreach ($post as $item)
						<!-- Blog post -->
						<div class="blog_post"  style="min-height: 390px;">
                            <div class="blog_image" style="background-image:url({{asset($item->post_image)}})"></div><br>
                            {{-- {{dd($item->post_image)}} --}}
                            @if ($language == 'bangla')
                                <div style="align-content: center"><h5 style="text-align: center">{{$item->post_title_bn}}</h5></div>
                            @else
                                <div style="align-content: center"><h5 style="text-align: center">{{$item->post_title_en}}</h5></div>
                            @endif
                            @if ($language == 'bangla')
                                {{-- <div class="blog_text">{!!substr($item->details_bn, 0, 220)!!} .......................</div> --}}
                                <div class="blog_text" id="translated-{{$item->id}}">
                                    {!!substr($item->details_bn, 0, 280)!!}
                                    <span>.......................</span>
                                    <i onclick="change_lang_bn('{{$item->details_bn}}',{{$item->id}})" class="fas fa-align-right fa-language" title="Translate To English"></i>
                                </div>
                            @elseif($language == 'english')
                                <div class="blog_text" id="translated-{{$item->id}}">
                                    {!!substr($item->details_en, 0, 120)!!}
                                    <span>.......................</span>
                                    <i onclick="change_lang_en('{{$item->details_en}}',{{$item->id}})" class="fas fa-align-right fa-language" title="Translate To Bengali"></i>
                                </div>
                            @endif
                            @if ($language == 'bangla')
                                <div class="blog_button"><a href="{{route('blog.details',[$item->id])}}">আরো পড়ুন</a></div>
                            @else
                                <div class="blog_button"><a href="{{route('blog.details',[$item->id])}}">Continue Reading</a></div>
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
<script src="{{asset('public/frontend/js/blog_single_custom.js')}}"></script>

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
