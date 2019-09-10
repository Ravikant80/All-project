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
                   {!! Form::model($identityproof,['route'=>['submit-proofupdate',$identityproof->id],'method'=>'PUT','role'=>'form','class'=>'form-horizontal','files'=>true]) !!}
                    <div class="form-body">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12"><strong>Proof Name</strong></label>
                                    <div class="col-sm-12">
                                         <input class="form-control input-lg" name="name" value="{{ $identityproof->name }}" required type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12"><strong>Proof Status</strong></label>
                                    <div class="col-sm-12">
                                      	<select name="status" id="status" class="form-control">
                                            <option value="">----Proof Status----</option>
                                            <option value="1" {{ $identityproof->status == '1' ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ $identityproof->status == '0' ? 'selected' : '' }}>In Active</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <button class="btn green-haze btn-block btn-lg">Update Proof</button>
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