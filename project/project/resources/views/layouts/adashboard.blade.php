<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>{{ $site_title }} - {{ $page_title }}{{--{{ $site_title .' - '. $page_title }}--}}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>

    <!-- ASSETS -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('ecommerce/assets/admin/css/font-awesome.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('ecommerce/assets/admin/css/simple-line-icons.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('ecommerce/assets/admin/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('ecommerce/assets/admin/css/uniform.default.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('ecommerce/assets/admin/css/components-rounded.min.css')}}" rel="stylesheet" id="style_components"
          type="text/css"/>
    <link href="{{ asset('ecommerce/assets/admin/css/jquery.fileupload.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('ecommerce/assets/admin/css/jquery.fileupload-ui.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{asset('ecommerce/assets/admin/css/plugins.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('ecommerce/assets/admin/css/layout.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('ecommerce/assets/admin/css/darkblue.min.css')}}" rel="stylesheet" type="text/css"
          id="style_color"/>
    <link href="{{asset('ecommerce/assets/admin/css/custom.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('ecommerce/assets/admin/css/datatables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('ecommerce/assets/admin/css/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('ecommerce/assets/admin/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css"/>

    <!-- END ASSETS -->

    <link rel="stylesheet" type="text/css" href="{{ asset('ecommerce/assets/admin/css/sweetalert.css') }}">

    <link rel="shortcut icon" href="{{asset('ecommerce/assets/images/favicon.png')}}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('ecommerce/assets/admin/css/custom.css') }}">

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
            <a href="{{--{{  }}--}}">
                <img src="{!! asset('ecommerce/assets/images/logo.png') !!}" class="logo-default" alt="-"
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


                        <span class="username"> Welcome, {!! Auth::guard('admin')->user()->name !!} </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">

                        <li><a href="{{ url('/') }}" target="_blank"><i class="fa fa-globe"></i> View Website </a>
                        </li>
                        <li><a href="{{ url('admin/admin-profile') }}"><i class="fa fa-cogs"></i> View Profile </a>
                        </li>

                        <li><a href="{{ url('admin-change-password') }}"><i class="fa fa-cogs"></i> Change Password </a>
                        </li>
                      
                        <li><a href="{{ url('admin-logout') }}"><i class="fa fa-sign-out"></i> Log Out </a></li>

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
                    <a href="{!! route('dashboard') !!}" class="nav-link ">
                        <i class="icon-home"></i><span class="title">Dashboard</span>
                    </a>
                </li>
            
                
               
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle"><i class="fa fa-money"></i>
                        <span class="title">Catalog</span><span class="arrow"></span></a>
                    <ul class="sub-menu">

                        <li class="nav-item">
                            <a href="{{ url('admin/category')  }}" class="nav-link nav-toggle"><i class="fa fa-plus"></i>
                                <span class="title">Categories</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/product')  }}" class="nav-link nav-toggle"><i class="fa fa-desktop"></i>
                                <span class="title">Products</span></a>
                        </li>
                       <!-- <li class="nav-item">
                            <a href="{{ url('admin/attribute')  }}" class="nav-link nav-toggle"><i class="fa fa-check"></i>
                                <span class="title">Product Attributes</span></a>
                        </li> -->
                        
                    </ul>
                </li>
        
                 <!--    Customer Section -->
                <li class="nav-item">
                        <a href="{{ url('admin/customers')  }}" class="nav-link nav-toggle"><i class="fa fa-desktop"></i>
                             <span class="title">Customer</span></a>
                </li>
                
                
<!--                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle"><i class="fa fa-money"></i>
                        <span class="title">Content</span><span class="arrow"></span></a>
                    <ul class="sub-menu">

                        <li class="nav-item">
                            <a href="{{ url('withdraw-method')  }}" class="nav-link nav-toggle"><i class="fa fa-plus"></i>
                                <span class="title">Page</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('withdraw-method')  }}" class="nav-link nav-toggle"><i class="fa fa-desktop"></i>
                                <span class="title">Menu</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/banner_settings')  }}" class="nav-link nav-toggle"><i class="fa fa-check"></i>
                                <span class="title">Banner</span></a>
                        </li> 
                        
                    </ul>
                </li>   -->
               
                
                
                
        <!--
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle"><i class="fa fa-money"></i>
                        <span class="title">Orders</span><span class="arrow"></span></a>
                    <ul class="sub-menu">

                        <li class="nav-item">
                            <a href="{{ url('withdraw-method')  }}" class="nav-link nav-toggle"><i class="fa fa-plus"></i>
                                <span class="title">Overview</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('withdraw-method')  }}" class="nav-link nav-toggle"><i class="fa fa-desktop"></i>
                                <span class="title">Order Return Request</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('withdraw-method')  }}" class="nav-link nav-toggle"><i class="fa fa-check"></i>
                                <span class="title">Order Status</span></a>
                        </li> 
                        
                    </ul>
                </li>
                -->
                <!--
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle"><i class="fa fa-money"></i>
                        <span class="title">Setting</span><span class="arrow"></span></a>
                    <ul class="sub-menu">

                        <li class="nav-item">
                            <a href="{{ url('withdraw-method')  }}" class="nav-link nav-toggle"><i class="fa fa-plus"></i>
                                <span class="title">Configuration</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('withdraw-method')  }}" class="nav-link nav-toggle"><i class="fa fa-desktop"></i>
                                <span class="title">Currencies</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('withdraw-method')  }}" class="nav-link nav-toggle"><i class="fa fa-check"></i>
                                <span class="title">Country</span></a>
                        </li> 
                        <li class="nav-item">
                            <a href="{{ url('withdraw-method')  }}" class="nav-link nav-toggle"><i class="fa fa-check"></i>
                                <span class="title">State</span></a>
                        </li> 
                        <li class="nav-item">
                            <a href="{{ url('withdraw-method')  }}" class="nav-link nav-toggle"><i class="fa fa-check"></i>
                                <span class="title">Location</span></a>
                        </li> 
                        <li class="nav-item">
                            <a href="{{ url('withdraw-method')  }}" class="nav-link nav-toggle"><i class="fa fa-check"></i>
                                <span class="title">Module</span></a>
                        </li> 
                        <li class="nav-item">
                            <a href="{{ url('withdraw-method')  }}" class="nav-link nav-toggle"><i class="fa fa-check"></i>
                                <span class="title">Staff</span></a>
                        </li> 
                        <li class="nav-item">
                            <a href="{{ url('withdraw-method')  }}" class="nav-link nav-toggle"><i class="fa fa-check"></i>
                                <span class="title">Roles/ Permission</span></a>
                        </li> 
                        
                    </ul>
                </li>
                -->
            


            </ul>
            <!-- END SIDEBAR MENU -->
        </div>
    </div>
    <!-- END SIDEBAR -->


    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper" >
        <div class="page-content">
            <div class="col-md-12" style="display: -webkit-inline-box;">
            <div class="col-md-4"><h3 class="page-title">{!! $page_title  !!} </h3></div>
            <div class="col-md-8">
            </div>
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
<script src="{{ asset('ecommerce/assets/admin/js/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('ecommerce/assets/admin/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('ecommerce/assets/admin/js/bootstrap-hover-dropdown.min.js')}}"type="text/javascript"></script>
<script src="{{ asset('ecommerce/assets/admin/js/jquery.slimscroll.min.js')}}"type="text/javascript"></script>
<script src="{{ asset('ecommerce/assets/admin/js/jquery.blockui.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('ecommerce/assets/admin/js/app.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('ecommerce/assets/admin/js/layout.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('ecommerce/assets/admin/js/demo.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('ecommerce/assets/admin/js/quick-sidebar.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('ecommerce/assets/admin/js/datatable.js')}}" type="text/javascript"></script>
<script src="{{ asset('ecommerce/assets/admin/js/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('ecommerce/assets/admin/js/datatables.bootstrap.js')}}"type="text/javascript"></script>
<script src="{{ asset('ecommerce/assets/admin/js/table-datatables-buttons.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('ecommerce/assets/admin/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('ecommerce/assets/admin/js/sweetalert.min.js') }}"></script>
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
  <script type='text/javascript' src="{{ asset('ecommerce/assets/admin/js/bootbox.min.js') }}"></script> 
<!--</script>-->

@yield('scripts')


</body>
</html>