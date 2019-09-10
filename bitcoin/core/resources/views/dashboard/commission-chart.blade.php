@extends('layouts.dashboard')
@section('content')
<div class="row">
        <div class="col-md-12">

            <div class="portlet box blue">
                <div class="portlet-title">
                    
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <form method="POST" action="{{url('admin/commission-chart/'.$getcommision->id)}}" accept-charset="UTF-8" role="form" class="form-horizontal" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                        
                    <div class="form-body">

                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">

                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Reference Bonus</strong></label>
                                    <div class="col-md-12">
                                        <input name="reference_bonus" class="form-control input-lg"  placeholder="Enter USD Values" required="" value="{{$getcommision->reference_bonus}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Reference Percent</strong></label>
                                    <div class="col-md-12">
                                        <input name="reference_percent" class="form-control input-lg"  placeholder="Enter USD Values" required="" value="{{$getcommision->reference_percent}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Cashin Commission</strong></label>
                                    <div class="col-md-12">
                                        <input name="cashin_commission" class="form-control input-lg"  placeholder="Enter USD Values" required="" value="{{$getcommision->cashin_commission}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">CashOut Commission</strong></label>
                                    <div class="col-md-12">
                                        <input name="cashout_commission" class="form-control input-lg"  placeholder="Enter USD Values" required="" value="{{$getcommision->cashout_commission}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Exchange Commission</strong></label>
                                    <div class="col-md-12">
                                        <input name="exchange_commission" class="form-control input-lg"  placeholder="Enter USD Values" required="" value="{{$getcommision->exchange_commission}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">With Draw Commission</strong></label>
                                    <div class="col-md-12">
                                        <input name="withdraw_commission" class="form-control input-lg"  placeholder="Enter USD Values" required="" value="{{$getcommision->withdraw_commission}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">BTC Buy Commission</strong></label>
                                    <div class="col-md-12">
                                        <input name="btc_buy_commision" class="form-control input-lg"  placeholder="Enter USD Values" required="" value="{{$getcommision->btc_buy_commision}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">BTC Sell Commission</strong></label>
                                    <div class="col-md-12">
                                        <input name="btc_sell_commision" class="form-control input-lg"  placeholder="Enter CFA Values" required="" value="{{$getcommision->btc_sell_commision}}">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn blue btn-block bold btn-lg uppercase"><i class="fa fa-send"></i> Update</button>
                                    </div>
                                </div>
                            </div>
                        </div><!-- row -->
                    </div>
                    </form>
                  

                </div>
            </div>
        </div>
</div>

@endsection
