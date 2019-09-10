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
    <!--coloruser Css-->
    <link href="{{ asset('assets/css/color.php?color='.$basic->color) }}" rel="stylesheet">
    <!--Responsive Css-->
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet">

    {{--admin template assets--}}

    <!-- ASSETS -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css"/>
    {{--<link href="{{asset('assets/admin/css/simple-line-icons.min.css')}}" rel="stylesheet"--}}
          {{--type="text/css"/>--}}
    {{--<link href="{{asset('assets/admin/css/uniform.default.css')}}" rel="stylesheet" type="text/css"/>--}}
    <link href="{{asset('assets/admin/css/components-rounded.min.css')}}" rel="stylesheet" id="style_components"
          type="text/css"/>
    <link href="{{asset('assets/admin/css/plugins.min.css')}}" rel="stylesheet" type="text/css"/>
{{--    <link href="{{asset('assets/admin/css/layout.min.css')}}" rel="stylesheet" type="text/css"/>--}}
    {{--<link href="{{asset('assets/admin/css/darkblue.min.css')}}" rel="stylesheet" type="text/css"--}}
          {{--id="style_color"/>--}}
{{--    <link href="{{asset('assets/admin/css/custom.min.css')}}" rel="stylesheet" type="text/css"/>--}}
    <link href="{{asset('assets/admin/css/datatables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/admin/css/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css"/>
    <!-- END ASSETS -->

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/sweetalert.css') }}">

    {{--ends admin template assets--}}
    <style>
        .form-control{
            border: 1px solid #ccc !important;
        }
        .main-menu.nav-fixed{
            z-index: 10000;
        }
        .page_title{
            font-weight: bold;
            color: #555;
        }
        .page_title + hr {
            width: 100%;
        }
    </style>
    @yield('style')

</head>
<body >
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
        <a href=""><i class="fa fa-caret-up"></i></a>
    </div><!--Scroll to top end-->
    <!--mobile logo -->
    <div class="mobile-logo">
        <a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo.png') }}" alt="Logo"></a>
    </div>

    <!--main menu start-->
    <nav class="main-menu">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <div class="logo">
                        <a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo.png') }}" width="80px" alt="Logo"></a>
                    </div>
                </div>
                <div class="col-md-10 text-right">
                    <ul id="menu-bar">

                        <li class="nav-item start">
                            <a href="{!! route('user-dashboard') !!}" class="nav-link ">
                                <span class="title">Dashboard</span>
                            </a>
                        </li>

                        <li><a href="#">Investment <i class="fa fa-caret-down"></i></a>
                            <ul class="sub-menu">


                                    <li class="nav-item">
                                        <a href="{!! route('investment-new') !!}" class="nav-link ">
                                            <span class="title">New Investment</span>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{!! route('investment-history') !!}" class="nav-link ">
                                            <span class="title">Investment History</span>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{!! route('user-repeat-history') !!}" class="nav-link ">
                                            <span class="title">Repeat History</span>
                                        </a>
                                    </li>


                            </ul>
                        </li>

                        <li><a href="#">transaction <i class="fa fa-caret-down"></i></a>
                            <ul class="sub-menu">


                                <li class="nav-item">
                                    <a href="{!! route('withdraw-request') !!}" class="nav-link ">
                                        <span class="title"> Withdraw Fund</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{!! route('withdraw-log') !!}" class="nav-link ">
                                        <span class="title"> Withdraw History</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{!! route('deposit-fund') !!}" class="nav-link ">
                                        <span class="title">Deposit Fund</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{!! route('deposit-history') !!}" class="nav-link ">
                                        <span class="title">Deposit History</span>
                                    </a>
                                </li>



                                <li class="nav-item">
                                    <a href="{!! route('user-activity') !!}" class="nav-link ">
                                        <span class="title">Transaction Log</span>
                                    </a>
                                </li>

                            </ul>
                        </li>


                        @if(Auth::check())
                            <li><a href="#">Hi. {{ Auth::user()->name }} <i class="fa fa-caret-down"></i></a>
                                <ul class="sub-menu">
                                    <li><a href="{!! route('edit-profile') !!}">Edit Profile </a></li>
                                    <li><a href="{!! route('change-password') !!}">Change Password </a></li>

                                    <li class="nav-item">
                                        <a href="{!! route('support-all') !!}" class="nav-link nav-toggle">
                                            <span class="title">Get Support</span></a>
                                    </li>

                                    <li>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"></i> Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>

                                    {{--<li><a href="{{ route('user-dashboard') }}">Dashboard</a></li>--}}
                                    {{--<li>--}}
                                        {{--<a href="{{ route('logout') }}" onclick="event.preventDefault();--}}
                                                     {{--document.getElementById('logout-form').submit();" class="">Log Out</a>--}}
                                        {{--<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
                                            {{--{{ csrf_field() }}--}}
                                        {{--</form>--}}
                                    {{--</li>--}}
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
                    </ul>
                </div>
            </div>
        </div>
    </nav><!--main menu end-->

    <div class="content_padding">
        <div class="container">
            @yield('content')
        </div>
    </div>


    <!--footer section start-->
    <footer class="footer-section section-padding padding-bottom-0 text-center">
        <div class="container">
            <div class="row ">
                <div class="col-md-8 col-md-offset-2">
                    <div class="footer-logo">
                        <a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo.png') }}" alt="Footer Logo"></a>
                    </div>
                    <p class="footer-text">{{ $basic->footer_text }}</p>
                </div>
            </div>
            <div class="row">
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
            </div>
            <p>{!! $basic->copy_text !!}</p>
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
<!--Main js file load-->


{{--admin template scripts--}}
<script src="{{asset('assets/admin/js/datatable.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/js/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/js/datatables.bootstrap.js')}}"type="text/javascript"></script>
<script src="{{asset('assets/admin/js/table-datatables-buttons.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js/sweetalert.min.js') }}"></script>
{{--ends admin template scripts--}}


<script src="{{ asset('assets/js/main.js') }}"></script>
@yield('script')
</body>
</html>
