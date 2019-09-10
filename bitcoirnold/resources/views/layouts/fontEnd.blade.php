<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $site_title }} | {{ $page_title }}</title>
    <!--Favicon add-->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">

    <!--bootstrap Css-->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <!--font-awesome Css-->
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <!--owl.carousel Css-->
    <link href="{{ asset('assets/css/owl.carousel.css') }}" rel="stylesheet">
    <!--Slick Nav Css-->
    <link href="{{ asset('assets/css/slicknav.min.css') }}" rel="stylesheet">
    <!-- rangeslider Css-->
    <link href="{{ asset('assets/css/asRange.css') }}" rel="stylesheet">
    <!--Style Css-->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <!--Responsive Css-->
    <link href="{{ asset('assets/css/color.php?color='.$basic->color) }}" rel="stylesheet">
    <!--Responsive Css-->
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/select2.css') }}" />


    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet">
	<link rel='stylesheet' id='ls-google-fonts-css' href='https://fonts.googleapis.com/css?family=Lato:100,300,regular,700,900%7COpen+Sans:300%7CIndie+Flower:regular%7COswald:300,regular,700&#038;subset=latin%2Clatin-ext' type='text/css' media='all' />
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel='stylesheet' id='google-font-api-special-1-css' href='https://fonts.googleapis.com/css?family=Lato%3A100italic%2C200italic%2C300italic%2C400italic%2C500italic%2C600italic%2C700italic%2C800italic%2C900italic%2C100%2C200%2C300%2C400%2C500%2C600%2C700%2C800%2C900&#038;ver=4.9.6' type='text/css' media='all' />
	<link rel='stylesheet' id='google-font-api-special-2-css' href='https://fonts.googleapis.com/css?family=Lato%3A100italic%2C200italic%2C300italic%2C400italic%2C500italic%2C600italic%2C700italic%2C800italic%2C900italic%2C100%2C200%2C300%2C400%2C500%2C600%2C700%2C800%2C900&#038;ver=4.9.6' type='text/css' media='all' />

    @yield('style')

</head>
<style>
	.footer-menu li a {
		color: #ADAFB2;
		font-size: 14px;		
		text-transform: none;
		transition: .5s;		
	}
	
	.footer-menu li a:hover {
		color: #0868DB;
	}
</style>
<body>
<!--Preloader start-->
<div class="preloader">
    <div class="spinner">
        <div class="cube1"></div>
        <div class="cube2"></div>
    </div>
</div>
<!--Preloader end-->
<div class="site"><!--for boxed Layout start-->

    <!--Scroll to top start-->
    <div class="scroll-to-top">
        <a href=""><i class="fa fa-caret-up scrolltop"></i></a>
    </div><!--Scroll to top end-->
    <!--mobile logo -->
    <div class="mobile-logo">
        <a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo.png') }}" alt="Logo"></a>
    </div>

    <!--main menu start-->
    <nav class="main-menu">
        <div class="container">
            <div class="row">
                <div class="col-md-1">
                    <div class="logo">
                        <a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo.png') }}" alt="Logo" width="60px" title="CT-PAY Logo"></a>
                    </div>
                </div>
                <div class="col-md-10 text-right defaultMenu">
				
					<ul id="menu-bar">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('about') }}">About CT-Pay</a></li>
						<li><a href="#">Crypto Currency<i class="fa fa-caret-down"></i></a>
							<ul class="sub-menu">
								<li><a href="javascript:void(0);">Buy Bitcoin</a></li>
								<li><a href="javascript:void(0);">Sell Bitcoin</a></li>
                            <li><a href="{{'bitcoin-price-chart'}}">Bitcoin Price Chart</a></li>
							</ul>
                        </li>
                        <!--@foreach($menu as $m)
                            <li><a href="javascript:void(0);">{{ $m->name }}</a></li>
                        @endforeach-->
                       <li><a href="#">Knowledge Center<i class="fa fa-caret-down"></i></a>
							<ul class="sub-menu">
								<li><a href="{{url('news')}}">News & Press Release</a></li>
								<li><a href="javascript:void(0);">Cash In/Cash Out</a></li>
                                <li><a href="javascript:void(0);">Earn Reward</a></li>
                            <li><a href="{{url('faqs')}}">FAQ</a></li>
							</ul>
                        </li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                        @if(Auth::check())
                            <li><a href="#">Hi. {{ Auth::user()->name }} <i class="fa fa-caret-down"></i></a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('user/wallet') }}">Wallet</a></li>
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="">Log Out</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <!--<li><a href="#">Account <i class="fa fa-caret-down"></i></a>
                                <ul class="sub-menu">-->
                                    <li><a href="{{ route('login') }}">Login</a></li>
                                    <li><a href="{{ route('register') }}">Register</a></li>
                                <!--</ul>
                            </li>-->
                        @endif
                    </ul>
					
                    <!--<ul id="menu-bar">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        @foreach($menu as $m)
                            <li><a href="{{ url('menu') }}/{{ $m->id }}/{{ urldecode(strtolower(str_slug($m->name))) }}">{{ $m->name }}</a></li>
                        @endforeach
                        <li><a href="{{ route('faqs') }}">Faq</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                        @if(Auth::check())
                            <li><a href="#">Hi. {{ Auth::user()->name }} <i class="fa fa-caret-down"></i></a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('user-dashboard') }}">Dashboard</a></li>
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="">Log Out</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li><a href="#">Account <i class="fa fa-caret-down"></i></a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('login') }}">Login</a></li>
                                    <li><a href="{{ route('register') }}">Register</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>-->
                </div>
<?php
/*
$blockchain = file_get_contents('https://bitpay.com/api/rates');

$btc_array = json_decode($blockchain, true);
//print_r($btc_array);
$usd_buy  = $btc_array['USD']['buy'];
$usd_sell = $btc_array['USD']['sell'];
*/
$page = file_get_contents('https://bitpay.com/api/rates');
$my_array = json_decode($page, true);
@$bit_coin = $my_array[0]["rate"];
@$bit_code = $my_array[0]["code"];
@$usd_code = $my_array[2]["code"];
@$usd_rate = $my_array[2]["rate"];

$url='https://bitpay.com/api/rates';
$json=json_decode( file_get_contents( $url ) );
$dollar=$btc=0;

foreach( $json as $obj ){
    if( $obj->code=='USD' )$btc=$obj->rate;
}
$dollar=1 / $btc;




?>
                
				<div id="price-quoter" class="price-quoter" style="display:none;"><span>Buy: {{btcBuyValue()}} CFA &nbsp;&nbsp; | &nbsp;&nbsp; Sell: {{btcSellValue()}} CFA</span></div>
				
            </div>
        </div>
    </nav><!--main menu end-->

    <!--Support Bar Start-->
    <!--<div class="support-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12 support-wrapper">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="support-info">
                                <a href="{{ route('support-open') }}"><p><i class="fa fa-comment"></i> Get Support</p></a>
                                <p><i class="fa fa-calendar"></i> Days Online: {{ \Carbon\Carbon::parse($basic->start_date)->diffInDays() }} </p>
                            </div>
                        </div>
                        <div class="col-md-6 text-right">
                            <div class="support-info">
                                <p><i class="fa fa-phone"></i> {{ $basic->phone }}</p>
                                <a href="#"><p><i class="fa fa-envelope"></i> {{ $basic->email }}</p></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>--><!--Support Bar End-->


@yield('content')


<!--pament method section start-->
    <!--<section class="section-padding payment-method" style="background-color:#2ecc71;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-center">
                        <h2>payment method we accept</h2>
                    </div>
                </div>
            </div>
            <div class="row">

                @foreach($pay as $key => $p)
                    <div class="col-md-2 {{ $key==0? 'col-md-offset-2' : '' }} col-sm-6">
                        <div class="payment-logo">
                            <img style="width: 190px" src="{{ asset('assets/images') }}/{{ $p->image }}"  alt="Payment Method Logo">
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>-->
    
    <!--pament method section end-->
<!--footer section start-->
    <footer class="footer-section section-padding padding-bottom-0 text-center">
        <div class="container">
            <div class="row">
				<div class="col-lg-12">
					<div class="col-md-3">
						<div style="text-transform: uppercase; font-weight:700; font-size:18px;">About CT-Pay</div>
						<p>&nbsp;</p>
						<p></p>                 
					</div>
					<div class="col-md-3">
						<div style="text-transform: uppercase; font-weight:700; font-size:18px;">Digital Currency</div>
						<p>&nbsp;</p>
						<ul id="menu-bar" class="footer-menu" style="list-style:none; line-height: 25px; text-align:left;">
							<li><a href="javascript:void(0);">Buy</a></li>
							<li><a href="javascript:void(0);">Sell</a></li>
							<li><a href="javascript:void(0);">Receive</a></li>
							<li><a href="javascript:void(0);">Send</a></li>
							<li><a href="javascript:void(0);">Bitcoin Price Chart</a></li>
						</ul>
					</div>
					<div class="col-md-3">
						<div style="text-transform: uppercase; font-weight:700; font-size:18px;">Knowledge Center</div>
						<p>&nbsp;</p>
						<ul id="menu-bar" class="footer-menu" style="list-style:none; line-height: 25px; text-align:left;">
							<li><a href="{{ route('faqs') }}">FAQ</a></li>
							<li><a href="javascript:void(0);">News & Press Release</a></li>
							<li><a href="javascript:void(0);">How to Cash In/Cash Out</a></li>
							<li><a href="javascript:void(0);">How to Earn Reward</a></li>						
						</ul>                 
					</div>
					<div class="col-md-3">
						<div style="text-transform: uppercase; font-weight:700; font-size:16px;">Connect With Us</div>
						<p>&nbsp;</p>
						<ul id="menu-bar" class="footer-menu" style="list-style:none; line-height: 25px; padding-left:50px; text-align:left;">
							<li><a href="javascript:void(0);">CT Pay Inc</a></li>
							<li><a href="javascript:void(0);">Phone</a></li>
							<li><a href="javascript:void(0);">Email id</a></li>
							<li><a href="javascript:void(0);">Address</a></li>						
						</ul>                 
					</div>
				</div>
				<div class="col-md-12">
					<div class="social-link" style="padding-top:20px;">
						@foreach($social as $s)
							<a href="{{ $s->link }}">{!!  $s->code  !!}</a>
						@endforeach
					</div>
				</div>
            </div>
            <!--<div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="footer-social-link">
                        <h3>Follow Us on</h3>
                        <div class="social-link">
                            @foreach($social as $s)
                                <a href="{{ $s->link }}">{!!  $s->code  !!}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>-->
            <!--<p>{!! $basic->copy_text !!}</p>-->
        </div>
    </footer><!--footer section end-->
</div><!--for boxed Layout end-->
<!--jquery script load-->
<script src="{{ asset('assets/js/jquery.js') }}"></script>
<!--Owl carousel script load-->
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<!--Bootstrap v3 script load here-->
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<!--Slick Nav Js File Load-->
<script src="{{ asset('assets/js/jquery.slicknav.min.js') }}"></script>
<!-- rangeslider Js File Load-->
<script src="{{ asset('assets/js/jquery-asRange.min.js') }}"></script>

<script src="{{ asset('assets/js/select2.js') }}"></script>

<!--Main js file load-->
<script src="{{ asset('assets/js/main.js') }}"></script>

<script>
$(document).ready(function() {
    $("#convert-from").select2();
	$("#convert-to").select2();
});
</script>
@yield('script')
</body>
</html>
