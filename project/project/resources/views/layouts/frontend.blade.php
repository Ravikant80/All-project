<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

<meta name="csrf-token" content="{{ csrf_token() }}">

<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="author" content="M_Adnan" />
<!-- Document Title -->
<title>ETW Shopping Mall Online Ecommerce Marketing Website</title>

<!-- Favicon -->
<link rel="shortcut icon" href="{{asset('ecommerce/assets/images/favicon.ico')}}" type="image/x-icon">
<link rel="icon" href="{{asset('ecommerce/assets/images/favicon.ico')}}" type="image/x-icon">

<!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
<link rel="stylesheet" type="text/css" href="{{asset('ecommerce/assets/rs-plugin/css/settings.css')}}" media="screen" />

<!-- StyleSheets -->
<link rel="stylesheet" href="{{asset('ecommerce/assets/css/ionicons.min.css')}}">
<link rel="stylesheet" href="{{asset('ecommerce/assets/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('ecommerce/assets/css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{asset('ecommerce/assets/css/main.css')}}">
<link rel="stylesheet" href="{{asset('ecommerce/assets/css/style.css')}}">
<link rel="stylesheet" href="{{asset('ecommerce/assets/css/responsive.css')}}">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


<!-- Fonts Online -->
<link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
<script src="{{asset('ecommerce/assets/js/vendors/modernizr.js')}}"></script>

 @stack('styles')
<!-- JavaScripts -->


</head>
<body>

<!-- Page Wrapper -->
<div id="wrap" class="layout-1">

  <!-- Top bar -->
  

 <!-- Header -->
  @include("layouts.nav")
 <!-- END Header -->

  <!-- Slid Sec -->
 @yield('content')
  <!-- End Content -->

    @include('layouts.footer')


  <!-- Rights -->
  <div class="rights">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <p>Copyright © <?php echo date("Y");?> <a href="#." class="ri-li"> ETW </a>Shopping Mall All rights reserved</p>
        </div>
       <!--  <div class="col-sm-6 text-right"> <img src="{{asset('ecommerce/assets/images/card-icon.png')}}" alt=""> </div> -->
      </div>
    </div>
  </div>

  <!-- End Footer -->

  <!-- GO TO TOP  -->
  <a href="#" class="cd-top"><i class="fa fa-angle-up"></i></a>
  <!-- GO TO TOP End -->
</div>
<!-- End Page Wrapper -->

<!-- JavaScripts -->
<script src="{{asset('ecommerce/assets/js/vendors/jquery/jquery.min.js')}}"></script>
<script src="{{asset('ecommerce/assets/js/vendors/wow.min.js')}}"></script>
<script src="{{asset('ecommerce/assets/js/vendors/bootstrap.min.js')}}"></script>
<script src="{{asset('ecommerce/assets/js/vendors/own-menu.js')}}"></script>
<script src="{{asset('ecommerce/assets/js/vendors/jquery.sticky.js')}}"></script>
<script src="{{asset('ecommerce/assets/js/vendors/owl.carousel.min.js')}}"></script>

<!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
<script type="text/javascript" src="{{asset('ecommerce/assets/rs-plugin/js/jquery.tp.t.min.js')}}"></script>
<script type="text/javascript" src="{{asset('ecommerce/assets/rs-plugin/js/jquery.tp.min.js')}}"></script>
<script src="{{asset('ecommerce/assets/js/main.js')}}"></script>
<script src="{{asset('ecommerce/assets/js/vendors/jquery.nouislider.min.js')}}"></script>
<script>
    
//         jQuery(document).ready(function($) {
//         
//           
//         
//    
//         
//             $("#price-range").noUiSlider({
//         
//             range: {
//         
//               'min': [ 0 ],
//         
//               'max': [ 5000 ]
//         
//             },
//         
//             start: [100, 5000],
//         
//                 connect:true,
//         
//                 serialization:{
//         
//                     lower: [
//         
//                 $.Link({
//         
//                   target: $("#price-min")
//         
//                 })
//         
//               ],
//         
//               upper: [
//         
//                 $.Link({
//         
//                   target: $("#price-max")
//         
//                 })
//         
//               ],
//         
//               format: {
//         
//           
//         
//                 decimals: 0,
//         
//                 prefix: 'Rs '
//         
//               }
//         
//                 }
//              
//            
//         
//           })
//         
//         })
//         
//         
//         
      </script>
 @stack('scripts')
</body>

<!-- Mirrored from event-theme.com/themes/html/smarttech/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 03 Jan 2019 04:40:29 GMT -->
</html>
