@extends('layouts.adashboard')
@section('style')
@endsection
@section('content')



    
<div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">

                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <strong><i class="fa fa-line-chart bold uppercase"></i> Main Statistics</strong>
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse"> </a>
                            </div>
                        </div>
                        <div class="portlet-body" style="overflow: hidden">
                            <div class="col-md-3">
                                <div class="dashboard-stat green">
                                    <div class="visual">
                                        <i class="fa fa-money"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                             <span data-counter="counterup" data-value="{{$total_user}}">{{$total_user}}</span>
                                        </div>
                                        <div class="desc bold uppercase"> Total User</div>
                                    </div>
                                </div>
                            </div>

                            <a href="">
                                <div class="col-md-3">
                                    <div class="dashboard-stat purple">
                                        <div class="visual">
                                            <i class="fa fa-recycle"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                 <span data-counter="counterup" data-value="{{$total_order}}">{{$total_order}}</span>
                                            </div>
                                            <div class="desc  bold uppercase "> Total Order </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="">
                                <div class="col-md-3">
                                    <div class="dashboard-stat blue">
                                        <div class="visual">
                                            <i class="fa fa-money"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="">0</span>
                                            </div>
                                            <div class="desc  bold uppercase"> Monthly Revenue </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="">
                                <div class="col-md-3">
                                    <div class="dashboard-stat red">
                                        <div class="visual">
                                            <i class="fa fa-money"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                 <span data-counter="counterup" data-value="{{$total_order}}">{{$total_order}}</span>
                                            </div>
                                            <div class="desc bold uppercase"> Recent Order </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

   






@endsection
@section('scripts')

    <script src="{{ asset('ecommerce/assets/admin/js/jquery.waypoints.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('ecommerce/assets/admin/js/jquery.counterup.min.js') }}" type="text/javascript"></script>


@endsection