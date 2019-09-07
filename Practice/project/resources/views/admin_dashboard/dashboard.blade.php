<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Admin</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>

    <!-- ASSETS -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/admin/css/font-awesome.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/admin/css/simple-line-icons.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/admin/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/admin/css/uniform.default.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/admin/css/components-rounded.min.css')}}" rel="stylesheet" id="style_components"
          type="text/css"/>
    <link href="{{ asset('assets/admin/css/jquery.fileupload.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/admin/css/jquery.fileupload-ui.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/css/plugins.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/admin/css/layout.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/admin/css/darkblue.min.css')}}" rel="stylesheet" type="text/css"
          id="style_color"/>
    <link href="{{asset('assets/admin/css/custom.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/admin/css/datatables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/admin/css/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/admin/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css"/>

    <!-- END ASSETS -->

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/sweetalert.css') }}">

    <link rel="shortcut icon" href="{{asset('assets/images/logo/foody.png')}}"/>


    <style>
        .page-title{
            font-weight:bold;
            text-transform: uppercase;
        }
        td,th{
            font-weight: bold;
        }
        .panel-body.no-side-padding{
            padding-left: 0;
            padding-right: 0;
        }
        .dashboard-stat .desc.small14, .small14{
            font-size: 14px;
        }
        .dashboard-stat .desc.small13, .small13{
            font-size: 13px;
        }
        .small12{
            font-size: 12px;
        }
    </style>
    @yield('style')

</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo">

<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <div class="page-header-inner ">


        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="#">
                <img src="{{asset('assets/img/logo/fllag.jpg')}}" class="logo-default" alt="-"
                style="width: 150px;height: 45px" />

            </a>

            <div class="menu-toggler sidebar-toggler"></div>
        </div>
        <!-- END LOGO -->


        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
           data-target=".navbar-collapse"> </a>

        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                       data-close-others="true">
                        <span class="username"> Welcome, {!! Auth::guard('admin')->user()->name !!}  </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    
                    <ul class="dropdown-menu dropdown-menu-default">

                        <li><a href="#"><i class="fa fa-cogs"></i> Change Password </a></li>
                        
                        <li><a href="{{url('admin/logout')}}"><i class="fa fa-sign-out"></i> Log Out </a></li>

                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- END HEADER -->


<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"></div>
<div class="page-container">
    <div class="page-sidebar-wrapper">
        <div class="page-sidebar navbar-collapse collapse">


            <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true"
                data-slide-speed="200" style="padding-top: 20px">
                <li class="sidebar-toggler-wrapper hide">
                    <div class="sidebar-toggler"></div>
                </li>


                <li class="nav-item start">
                    <a href="{{url('/admin-dashboard')}}" class="nav-link ">
                        <i class="icon-home"></i><span class="title">Dashboard</span>
                    </a>
                </li>

                <!-- <li class="nav-item start">
                    <a href="#" class="nav-link ">
                        <i class="fa fa-first-order"></i><span class="title">Orders</span>
                    </a>
                </li> -->
             
                     
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle"><i class="fa fa-user-circle-o" aria-hidden="true"></i>
                        <span class="title">Hod</span><span class="arrow"></span></a>
                        
                    <ul class="sub-menu">

                        <li class="nav-item">
                            <a href="#" class="nav-link nav-toggle"><i class="fa fa-desktop"></i>
                            <span class="title">View Hod</span></a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link nav-toggle"><i class="fa fa-desktop"></i>
                             <span class="title">Register Hod</span></a>
                        </li>
                       
                    </ul>
                </li>   
               
       
            </ul>
            <!-- END SIDEBAR MENU -->
        </div>
    </div>
    <!-- END SIDEBAR -->

    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper" >
        <div class="page-content">
           <div class="col-md-12" style="display: flex;">
            <div class="col-md-12"><h3 class="page-title">{!! $page_title  !!} </h3></div>
         
            </div>
            <hr style="width: 100%!important">


            <!--  ==================================VALIDATION ERRORS==================================  -->
            @if($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {!!  $error !!}
                    </div>
                @endforeach
            @endif
            <!--  ==================================SESSION MESSAGES==================================  -->

            @yield('content')


        </div>
    </div>
    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->


<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner"> <?php echo date("Y")?> All Copyright &copy; Reserved. </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<!-- END FOOTER -->


<!-- BEGIN SCRIPTS -->
<script src="{{ asset('assets/admin/js/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js/bootstrap-hover-dropdown.min.js')}}"type="text/javascript"></script>
<script src="{{ asset('assets/admin/js/jquery.slimscroll.min.js')}}"type="text/javascript"></script>
<script src="{{ asset('assets/admin/js/jquery.blockui.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js/app.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js/layout.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js/demo.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js/quick-sidebar.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js/datatable.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js/datatables.bootstrap.js')}}"type="text/javascript"></script>
<script src="{{ asset('assets/admin/js/table-datatables-buttons.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js/sweetalert.min.js') }}"></script>
<!--<script>-->
    @if(session()->has('message'))
    <script>
        swal({
            title: "{!! session()->get('title')  !!}",
            text: "{!! session()->get('message')  !!}",
            type: "{!! session()->get('type')  !!}",
            confirmButtonText: "OK"
        });
    </script>
        @php session()->forget('message') @endphp
    @endif

<!--</script>-->

@yield('scripts')


</body>
</html>

