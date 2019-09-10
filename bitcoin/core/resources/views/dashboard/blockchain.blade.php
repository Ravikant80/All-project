@extends('layouts.dashboard')
@section('style')

    <link href="{{ asset('assets/admin/css/bootstrap-toggle.min.css') }}" rel="stylesheet">


@endsection
@section('content')


    <div class="row">
        <div class="col-md-12">

            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <strong><i class="fa fa-info-circle"></i> {{ $page_title }}</strong>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                    </div>
                </div>
                <div class="portlet-body" style="overflow: hidden">
                   {!! Form::model($blockchain,['route'=>['blockchain-update',$blockchain->id],'method'=>'PUT','role'=>'form','class'=>'form-horizontal','files'=>true]) !!}
                    <div class="form-body">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">API Code</strong></label>
                                    <div class="col-sm-12">
                                         <input class="form-control input-lg bold" name="api_code" value="{{ $blockchain->api_code }}" required type="text" placeholder="API Code.">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">APP ID </strong></label>
                                    <div class="col-sm-12">
                                         <input class="form-control input-lg bold" name="app_id" value="{{ $blockchain->app_id }}" required type="text" placeholder="APP ID.">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Main Password </strong></label>
                                    <div class="col-sm-12">
                                         <input class="form-control input-lg bold" name="main_password" value="{{ $blockchain->password }}" required type="password" placeholder="Main Password.">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Second Password</strong></label>
                                    <div class="col-sm-12">
                                         <input class="form-control input-lg bold" name="second_password" value="{{ $blockchain->password2 }}" type="password" placeholder="Second Password">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <button class="btn btn-primary btn-block uppercase btn-lg"><i class="fa fa-send"></i> Update</button>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')

@if(session('success'))
	<script type="text/javascript">
        $(document).ready(function(){
            swal("Success!", "{{ session('success') }}", "success");
        });
    </script>
@endif

@if(session('alert'))
    <script type="text/javascript">
        $(document).ready(function(){
            swal("Sorry!", "{!! session('alert') !!}", "error");
        });
    </script>
@endif

    <script src="{{ asset('assets/admin/js/bootstrap-toggle.min.js') }}"></script>

@endsection