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
                        @if (session()->has('message'))
                            <div class="alert alert-{{ session()->get('type') }} alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        @if (session()->has('status'))
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session()->get('status') }}
                            </div>
                        @endif
                        <form class="form-horizontal myform" method="POST" action="{{ route('login') }}">
							<div align="center" class="signup-form__title">Welcome back!</div>
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="email" class="cols-sm-2 control-label">User Name</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <!--<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>-->
                                        <input type="text" class="form-control md-input__input" name="username" id="username" required placeholder="Enter your User Name"/>
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
                                <div class="cols-sm-10 cols-sm-offset-2">
                                    <div class="col-sm-6">
                                        <div class="checkbox">
                                            <label style="font-size: 13px;">
                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 text-right">
                                        <a class="btn btn-link" style="font-size: 13px;" href="{{ route('password.request') }}">
                                            Forgot Your Password?
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group ">
                                <button type="submit" class="submit-btn btn btn-block">Login</button>
                            </div>
							
							<div class="signup-form__footer" align="center">
							<span>
							Don't have an account?<a href="{{ asset('register') }}"> Sign Up</a>
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