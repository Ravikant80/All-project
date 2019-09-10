@extends('layouts.fontEnd')
<!--Style Css-->
<link href="{{ asset('assets/css/mystyle.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/sweetalert.css') }}">
@section('content')
@if (Auth::user()->status != '0')
<div class="row">
    <div class="col-6 ml-auto mr-auto">
        <div class="card text-white bg-dark" style="margin-top:50px;">
            <div class="card-body">
                <h2 style="color: red;">Your account is Deactivated </h2>
            </div>

        </div>
    </div>
</div>
@elseif(Auth::user()->tfver != '1')
<div class="login-section section-padding login-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="main-login main-center">
                    <a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo.png') }}" class="formlogo" alt="Logo Image Will Be Here"></a>
                    <br>
                     @if ($errors->has('code'))
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>{{ $errors->first('code') }}</strong>
                            </div>
                    @endif
                   
                    <form class="form-horizontal myform" method="POST" action="{{ route('g2fa-verify') }}">
                        
                        {{ csrf_field() }}

                        <div class="form-group {{ $errors->has('code') ? ' has-error' : '' }}">
                            <label for="email" class="cols-sm-2 control-label">Enter Your Verification Code</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <input type="text" value="{{ old('code') }}" class="form-control" name="code" placeholder="Enter Google Authenticator Code" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="form-group ">
                            <button type="submit" class="submit-btn btn btn-block">Verify</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endif


@endsection

<script src="{{ asset('assets/dashboard/assets/js/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/sweetalert.min.js') }}"></script>
@if (session('success'))
	<script type="text/javascript">
        $(document).ready(function(){

            swal("Success!", "{{ session('success') }}", "success");

        });
    </script>
@endif

@if (session('alert'))
    <script type="text/javascript">
        $(document).ready(function(){
            swal("Sorry!", "{{ session('alert') }}", "error");
        });

    </script>
@endif 

