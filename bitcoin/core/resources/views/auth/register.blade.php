@extends('layouts.fontEnd')
<!--Style Css-->
<link href="{{ asset('assets/css/mystyle.css') }}" rel="stylesheet">
@section('content')

    <!--header section start-->
    <!--<section style="background-image: url('{{ asset('assets/images') }}/{{ $basic->breadcrumb }}')" class="breadcrumb-section contact-bg section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>{{ $page_title}}</h1>
                </div>
            </div>
        </div>
    </section>--><!--Header section end-->


    <!--login section start-->
    <div class="login-section section-padding login-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="main-login main-center">
                        <a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo.png') }}" class="formlogo" alt="Logo Image Will Be Here"></a>
                        <br>
                        @if($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {!!  $error !!}
                                </div>
                            @endforeach
                        @endif
						<form class="form-horizontal myform" method="POST" action="{{ route('register') }}">
                            <div align="center" class="signup-form__title"><span class="blue" style="color: #30a2f3;">Sign up</span> for a free account!</div>
							{{ csrf_field() }}
                            @if($reference == '0')
                            <div class="form-group" style="display:none;">
                                <label for="name" class="cols-sm-2 control-label">Reference ID</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-code fa" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="under_reference" id="under_reference" value="@if($reference){{ $reference }}@endif" placeholder="Reference ID"/>
                                    </div>
                                </div>
                            </div>
                            @else
                                <input type="hidden" class="form-control" name="under_reference" id="under_reference" value="@if($reference){{ $reference }}@endif" placeholder="Reference ID"/>
                            @endif
                            <div class="form-group">
                                <label for="name" class="cols-sm-2 control-label">Name</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <!--<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>-->
                                        <input type="text" class="form-control md-input__input" name="name" id="name" required placeholder="Enter your Name"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="username" class="cols-sm-2 control-label">Username</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <!--<span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>-->
                                        <input type="text" class="form-control md-input__input" name="username" id="username" required placeholder="Enter your Username"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="cols-sm-2 control-label">Email</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <!--<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>-->
                                        <input type="text" class="form-control md-input__input" name="email" id="email" required placeholder="Enter your Email"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="cols-sm-2 control-label">Phone</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <!--<span class="input-group-addon"><i class="fa fa-phone fa" aria-hidden="true"></i></span>-->
                                        <input type="text" class="form-control md-input__input" name="phone" id="phone" required placeholder="Enter your Phone Number"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="cols-sm-2 control-label">Password</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <!--<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>-->
                                        <input type="password" class="form-control md-input__input" name="password" id="password" required placeholder="Enter your Password"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="confirm" class="cols-sm-2 control-label">Confirm Password</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <!--<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>-->
                                        <input type="password" class="form-control md-input__input" name="password_confirmation" id="password_confirmation" required placeholder="Confirm your Password"/>
                                    </div>
                                </div>
                            </div>

                            @if($basic->google_recap == 1)
                            <div class="form-group">
                                <div class="cols-sm-10">
                                    {!! app('captcha')->display() !!}
                                </div>
                            </div>
                            @endif

                            <div class="form-group ">
                                <button type="submit" class="submit-btn btn btn-lg btn-block login-button">Register</button>
                            </div>
							
							<div class="signup-form__footer" align="center">
							<span>
							<!-- react-text: 147 -->Already have an account?<!-- /react-text --><!-- react-text: 148 --> <!-- /react-text --><a href="{{ asset('login') }}">Sign in</a>
							</span>
							</div>
							
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--login section end-->
	
	<!--header section start-->
    <section style="background-image: url('{{ asset('assets/images') }}/{{ $basic->breadcrumb }}')" class="breadcrumb-section contact-bg section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>{{ $page_title}}</h1>
                </div>
            </div>
        </div>
    </section><!--Header section end-->

@endsection

<script src="{{ asset('assets/dashboard/assets/js/jquery-1.12.4.min.js') }}"></script>
<script type="text/javascript" language="javascript">
$(document).ready(function(){
	$('.price-quoter').show();
});
</script>