<link rel="stylesheet" href="{{asset('ecommerce/assets/css/profile.css')}}">
<div class="container">
    <div class="row profile">
        <div class="col-md-3">
            <div class="profile-sidebar">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    @if(Auth::user()->avatar)
                    <img src="{{asset('assets/user_profile/'.Auth::user()->avatar)}}" class="img-responsive" alt=""> 
                    @else
                        <img src="{{asset('assets/user_profile/avatar.jpg')}}" class="img-responsive" alt=""> 
                    @endif

                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name">
                        <span class="hidden-xs">{{Auth::user()->name}}</span>
                    </div>
                    <div class="profile-usertitle-job">
                    </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR MENU -->
                <div class="profile-usermenu">
                    <ul class="nav">
                        <li class="active">
                            <a href="{{url('my/profile')}}">
                                <i class="glyphicon glyphicon-home"></i>
                                <span class="hidden-xs">Personal<span> </a>
                                        </li>
<!--                                        <li>
                                            <a href="javascript:void(0);">
                                                <i class="glyphicon glyphicon-user"></i>
                                                <span class="hidden-xs">Delivery Address<span> </a>
                                                        </li>-->
                                                        <li>
                                                            <a href="{{url('my/orders')}}">
                                                                <i class="glyphicon glyphicon-ok"></i>
                                                                <span class="hidden-xs">Orders <span></a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="{{url('my/wishlist')}}">
                                                                                <i class="glyphicon glyphicon-flag"></i>
                                                                                <span class="hidden-xs">My Wishlist <span></a>
                                                                                        </li>
<!--                                                                                        <li>
                                                                                            <a href="javascript:void(0);">
                                                                                                <i class="glyphicon glyphicon-shopping-cart"></i>
                                                                                                <span class="hidden-xs">Shopping Bag<span> </a>

                                                                                                        </li>-->

                                                                                                        </ul>
                                                                                                        </div>
                                                                                                        <!-- END MENU -->
                                                                                                        </div>
                                                                                                        </div>
                                                                                                         
                                                                                                        <div class="col-md-9 order-content">

                                                                                                            <div class="form_main col-md-4 col-sm-5 col-xs-7">
                                                                                                                <h4 class="heading"><strong>Personal </strong> Contact <span></span></h4>
                                                                                                                <div class="form">
                                                                                                                    <form action="" method="" id="contactFrm" name="contactFrm">
                                                                                                                        <input type="text" required="" placeholder="Name" value="" name="name" class="txt">
                                                                                                                        <input type="text" required="" placeholder="Email" value="" name="email" class="txt">
                                                                                                                        <input type="password" required="" placeholder="Change Pwd" value="" name="password" class="txt"><br>
                                                                                                                        <button type="button" class="btn btn-default">Update</button>
                                                                                                                    </form>
                                                                                                                </div>
                                                                                                            </div>

                                                                                                        </div>


                                                                                                        </div>
                                                                                                        </div>