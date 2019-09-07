@extends('admin_dashboard.dashboard')

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
                                             <span data-counter="counterup" data-value="">0</span>
                                        </div>
                                        <div class="desc bold uppercase"> Total User Balance</div>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ url('repeat-history') }}">
                                <div class="col-md-3">
                                    <div class="dashboard-stat purple">
                                        <div class="visual">
                                            <i class="fa fa-recycle"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                 <span data-counter="counterup" data-value="">0</span>
                                            </div>
                                            <div class="desc  bold uppercase "> Total Repeat </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="{{ url('user-deposit-history') }}">
                                <div class="col-md-3">
                                    <div class="dashboard-stat blue">
                                        <div class="visual">
                                            <i class="fa fa-money"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                  <span data-counter="counterup" data-value="">0</span>
                                            </div>
                                            <div class="desc  bold uppercase"> Total Deposit </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="{{ url('admin/withdraw-request-all') }}">
                                <div class="col-md-3">
                                    <div class="dashboard-stat red">
                                        <div class="visual">
                                            <i class="fa fa-money"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                 <span data-counter="counterup" data-value="">0</span>
                                            </div>
                                            <div class="desc bold uppercase"> Total Withdraw </div>
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

