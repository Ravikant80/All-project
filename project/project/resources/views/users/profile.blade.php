@extends('layouts.frontend')
@push('styles')

@endpush

@section('content')
<link rel="stylesheet" href="{{asset('ecommerce/assets/css/profile.css')}}">
<div class="container">
     @if(session()->has('success_message'))
    <div class="alert alert-success">
        {{session()->get('success_message')}}
    </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="row profile">
        <div class="col-md-3">
            <div class="profile-sidebar">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    @if(Auth::user()->avatar)
                    <img src="{{asset('ecommerce/assets/user_profile/'.Auth::user()->avatar)}}" class="img-responsive" alt=""> 
                    @else
                    <img src="{{asset('ecommerce/assets/user_profile/avatar.jpg')}}" class="img-responsive" alt=""> 
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
                                                                                    <form action="{{url('my/profile/update')}}" method="post" id="contactFrm" name="contactFrm">
                                                                                        <input type="text" required="" placeholder="Name" value="{{Auth::user()->name}}" name="name" class="txt" readonly="" disabled>
                                                                                        <input type="text" required="" placeholder="Email" value="{{Auth::user()->email}}" name="email" class="txt" readonly="" disabled>
                                                                                        <input type="text" required="" placeholder="Phone Number" value="{{Auth::user()->phone_number}}" name="phone_number" class="txt">
                                                                                        <input type="text" required="" placeholder="Address" value="{{Auth::user()->address}}" name="address" class="txt">
                                                                                        <input type="text" required="" placeholder="City" value="{{Auth::user()->city}}" name="city" class="txt">
                                                                                        <input type="text" required="" placeholder="State" value="{{Auth::user()->state}}" name="state" class="txt">
                                                                                        <input type="text" required="" placeholder="Pincode" value="{{Auth::user()->pincode}}" name="pincode" class="txt">
                                                                                        <br/>
                                                                                        @csrf
<!--                                                                                        <input type="password" required="" placeholder="Change Pwd" value="" name="password" class="txt"><br> -->
                                                                                        <button type="submit" class="btn btn-round">Update</button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>

                                                                        </div>


                                                                        </div>
                                                                        </div>

 @endsection
 @push('scripts')

 @endpush


