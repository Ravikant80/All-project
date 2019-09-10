@extends('layouts.user-frontend.user-dashboard')
@section('style')
    <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>

    <script type="text/javascript">
        bkLib.onDomLoaded(function() { new nicEditor({fullPanel : true}).panelInstance('area1'); });
    </script>

@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <h3 class="page_title">Deposit Fund Preview </h3>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-sm-12 text-center">

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 style="font-size: 28px;"><b>
                            @if($fund->payment_type == 1)
                                Paypal
                            @elseif($fund->payment_type == 2)
                                Perfect Money
                            @elseif($fund->payment_type == 3)
                                BTC - ( BlockChain )
                            @elseif($fund->payment_type == 4)
                                Credit Card
                            @else
                                @foreach($bank as $b)
                                    @if($b->id == $fund->payment_type)
                                        {{ $b->name }}
                                    @endif
                                @endforeach
                            @endif
                        </b></h3>
                </div>
                <div style="font-size: 18px;padding: 18px;" class="panel-body text-center">
                    @if($fund->payment_type == 1)
                        @php $img = $paypal->image @endphp
                    @elseif($fund->payment_type == 2)
                        @php $img = $perfect->image @endphp
                    @elseif($fund->payment_type == 3)
                        @php $img = $btc->image @endphp
                    @elseif($fund->payment_type == 4)
                        @php $img = $stripe->image @endphp
                    @else
                        @foreach($bank as $b)
                            @if($b->id == $fund->payment_type)
                                @php $img = $b->image @endphp
                            @endif
                        @endforeach
                    @endif
                    <img width="100%" class="image-responsive" src="{{ asset('assets/images') }}/{{ $img }}" alt="">
                </div>
                <div class="panel-footer">
                    <a href="{{ route('deposit-fund') }}" class="btn btn-primary btn-block btn-icon icon-left"><i
                                class="fa fa-arrow-left"></i> Back to Payment Method Page</a>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-12">
            <div class="panel panel-primary panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->

                <!-- panel head -->
                <div class="panel-heading">
                    <div class="panel-title"><i class="fa fa-money"></i> <strong>{{ $page_title }}</strong></div>
                </div>
                <!-- panel body -->
                <div class="panel-body">

                    @php $redst=''; @endphp
                    @if($fund->payment_type == 1 or $fund->payment_type == 2 or $fund->payment_type == 3 or $fund->payment_type == 4)

                        <div class="row">
                            <div class="form-group">
                                <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 col-sm-offset-1 text-right control-label"><strong>Deposit Amount : </strong></label>

                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="text" value="{{ $fund->amount }}" readonly name="amount" id="amount" class="form-control bold" placeholder="Enter Deposit Amount" required>
                                        <span class="input-group-addon red">&nbsp;<strong> {{ $basic->currency }} </strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 col-sm-offset-1 text-right control-label"><strong>Charge : </strong></label>

                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="text" value="{{ $fund->charge }}" readonly name="charge" id="charge" class="form-control bold" placeholder="Enter Deposit Amount" required>
                                        <span class="input-group-addon red">&nbsp;<strong> {{ $basic->currency }} </strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 col-sm-offset-1 text-right control-label"><strong>Total Send : </strong></label>

                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="text" value="{{ $fund->amount + $fund->charge }}" readonly name="" id="" class="form-control bold" placeholder="Enter Deposit Amount" required>
                                        <span class="input-group-addon red">&nbsp;<strong> {{ $basic->currency }} </strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 col-sm-offset-1 text-right control-label"><strong>Conversion Rate : </strong></label>

                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="text" value="1 USD = {{ $fund->payment->rate }}" readonly name="charge" id="charge" class="form-control bold" placeholder="Enter Deposit Amount" required>
                                        <span class="input-group-addon red">&nbsp;<strong> {{ $basic->currency }} </strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 col-sm-offset-1 text-right control-label"><strong>Total Amount : </strong></label>

                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="text" value="{{ round($fund->net_amount / $fund->payment->rate, $basic->deci)  }}" readonly name="charge" id="charge" class="form-control bold" placeholder="Enter Deposit Amount" required>
                                        <span class="input-group-addon red">&nbsp;<strong> USD </strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <hr>
                        @if($fund->payment_type == 1)
                            <div class="row">
                                <form action="https://secure.paypal.com/uk/cgi-bin/webscr" method="post" name="paypal" id="paypal">
                                    <input type="hidden" name="cmd" value="_xclick" />
                                    <input type="hidden" name="business" value="{{ $paypal->val1 }}" />
                                    <input type="hidden" name="cbt" value="{{ $site_title }}" />
                                    <input type="hidden" name="currency_code" value="USD" />
                                    <input type="hidden" name="quantity" value="1" />
                                    <input type="hidden" name="item_name" value="Add Fund to {{ $site_title }}" />

                                    <!-- Custom value you want to send and process back in the IPN -->
                                    <input type="hidden" name="custom" value="{{ $fund->custom }}" />

                                    <input name="amount" type="hidden" value="{{ $fund->usd  }}">
                                    <input type="hidden" name="return" value="{{ route('deposit-fund') }}"/>
                                    <input type="hidden" name="cancel_return" value="{{ route('deposit-fund') }}" />
                                    <!-- Where to send the PayPal IPN to. -->
                                    <input type="hidden" name="notify_url" value="{{ route('paypal-ipn') }}" />

                                    <div class="form-group">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <button class="btn btn-primary btn-block btn-icon bold icon-left"><i
                                                        class="fa fa-send"></i> Add Fund Now</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @elseif($fund->payment_type == 2)
                            <div class="row">
                                <form action="https://perfectmoney.is/api/step1.asp" method="POST" id="myform">
                                    <input type="hidden" name="PAYEE_ACCOUNT" value="{{ $perfect->val1 }}">
                                    <input type="hidden" name="PAYEE_NAME" value="{{ $site_title }}">
                                    <input type='hidden' name='PAYMENT_ID' value='{{ $fund->custom }}'>
                                    <input type="hidden" name="PAYMENT_AMOUNT"  value="{{ round(($fund->usd),2)  }}">
                                    <input type="hidden" name="PAYMENT_UNITS" value="USD">
                                    <input type="hidden" name="STATUS_URL" value="{{ route('perfect-ipn') }}">
                                    <input type="hidden" name="PAYMENT_URL" value="{{ route('deposit-fund') }}">
                                    <input type="hidden" name="PAYMENT_URL_METHOD" value="GET">
                                    <input type="hidden" name="NOPAYMENT_URL" value="{{ route('deposit-fund') }}">
                                    <input type="hidden" name="NOPAYMENT_URL_METHOD" value="GET">
                                    <input type="hidden" name="SUGGESTED_MEMO" value="{{ $site_title }}">
                                    <input type="hidden" name="BAGGAGE_FIELDS" value="IDENT"><br>

                                    <div class="form-group">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <button class="btn btn-primary btn-block bold btn-icon icon-left"><i
                                                        class="fa fa-send"></i>Add Fund Now</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @elseif($fund->payment_type == 3)

                            <div class="row">
                                {!! Form::open(['route'=>'btc-preview']) !!}
                                <input type="hidden" name="amount" value="{{ round(($fund->usd),3)  }}">
                                <input type="hidden" name="fund_id" value="{{ $fund->id }}">
                                <input type="hidden" name="custom" value="{{ $fund->custom }}">
                                <div class="form-group">
                                    <div class="col-sm-6 col-sm-offset-3">
                                        <button class="btn btn-primary btn-block bold btn-icon icon-left"><i
                                                    class="fa fa-send"></i>Add Fund Now</button>
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </div>
                        @elseif($fund->payment_type == 4)
                            <div class="row">
                                {!! Form::open(['route'=>'stripe-preview']) !!}
                                <input type="hidden" name="amount" value="{{ round(($fund->usd),2)  }}">
                                <input type="hidden" name="fund_id" value="{{ $fund->id }}">
                                <input type="hidden" name="custom" value="{{ $fund->custom }}">
                                <input type="hidden" name="url" value="{{ route('deposit-fund') }}">
                                <div class="form-group">
                                    <div class="col-sm-6 col-sm-offset-3">
                                        <button class="btn btn-primary btn-block bold btn-icon icon-left"><i
                                                    class="fa fa-send"></i>Add Fund Now</button>
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </div>
                        @endif
                    @else

                        <div class="row">
                            <div class="form-group">
                                <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 col-sm-offset-1 text-right control-label"><strong>Deposit Amount : </strong></label>

                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="text" value="{{ $fund->amount }}" readonly name="amount" id="amount" class="form-control bold" placeholder="Enter Deposit Amount" required>
                                        <span class="input-group-addon red">&nbsp;<strong> {{ $basic->currency }} </strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 col-sm-offset-1 text-right control-label"><strong>Deposit Charge : </strong></label>

                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="text" value="{{ $fund->charge }}" readonly name="charge" id="charge" class="form-control bold" placeholder="Enter Deposit Amount" required>
                                        <span class="input-group-addon red">&nbsp;<strong> {{ $basic->currency }} </strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 col-sm-offset-1 text-right control-label"><strong>Total Amount : </strong></label>

                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="text" value="{{ $fund->amount + $fund->charge }}" readonly name="" id="" class="form-control bold" placeholder="Enter Deposit Amount" required>
                                        <span class="input-group-addon red">&nbsp;<strong> {{ $basic->currency }} </strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>


                        @if($fund->payment_type == 5)
                            <div class="row">
                                <div class="form-group">
                                    <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 col-sm-offset-1 text-right control-label"><strong>1 {{ $fund->payment->currency }} : </strong></label>

                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <input type="text" value=" {{ $fund->payment->rate }}" readonly name="charge" id="charge" class="form-control bold" placeholder="Enter Deposit Amount" required>
                                            <span class="input-group-addon red">&nbsp;<strong> {{ $basic->currency }} </strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="form-group">
                                    <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 col-sm-offset-1 text-right control-label"><strong>Total Send : </strong></label>

                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <input type="text" value="{{ round($fund->net_amount / $fund->payment->rate, $basic->deci) }}" readonly name="" id="" class="form-control bold" placeholder="Enter Deposit Amount" required>
                                            <span class="input-group-addon red">&nbsp;<strong> {{ $fund->payment->currency }} </strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                        @else
                            <div class="row">
                                <div class="form-group">
                                    <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 col-sm-offset-1 text-right control-label"><strong>1 {{ $basic->currency }} : </strong></label>

                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <input type="text" value=" {{ $fund->payment->rate }}" readonly name="charge" id="charge" class="form-control bold" placeholder="Enter Deposit Amount" required>
                                            <span class="input-group-addon red">&nbsp;<strong> {{ $fund->payment->currency }} </strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="form-group">
                                    <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 col-sm-offset-1 text-right control-label"><strong>Total Send : </strong></label>

                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <input type="text" value="{{ $fund->net_amount * $fund->payment->rate }}" readonly name="" id="" class="form-control bold" placeholder="Enter Deposit Amount" required>
                                            <span class="input-group-addon red">&nbsp;<strong> {{ $fund->payment->currency }} </strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                        @endif

                        <hr>

                        <div class="row">
                            <div class="form-group">

                                <div class="col-sm-8 col-md-offset-2 text-center">
                                    <div class="text-center">
                                        <h4 class="bold" style="font-size: 24px;border-bottom: 2px dotted ;padding-bottom: 15px;text-transform: uppercase">Sending Details</h4>
                                    </div>
                                    @if($fund->payment->id == 5)

                                        @php

                                            $redst = "color:red;";
                                           // $u = round($fund->net_amount / $fund->payment->rate, $basic->deci);
                                             //   $api = "https://blockchain.info/tobtc?currency=USD&value=".$u;
                                              //  $usd = file_get_contents($api);

    $usd = 50;

                                        foreach($bank as $b) {
                                           if($b->id == $fund->payment_type){
                                              $sendto = $b->val1;
                                              }
                                        }

                                           $var = "bitcoin:$sendto?amount=$usd";
                                          $scan =  "<div class='text-center'><img src=\"https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$var&choe=UTF-8\" title='' style='width:300px;'  /> </div>";
                                        @endphp

                                        <strong style="font-size: 20px;">Send Amount : {{ $usd }} BTC <br>TO </strong>
                                    @else
                                        <strong style="font-size: 20px;">Send Amount : {{ $fund->net_amount * $fund->payment->rate }} {{ $fund->payment->currency }}</strong><br>
                                    @endif





                                    @foreach($bank as $b)
                                        @if($b->id == $fund->payment_type)
                                            <strong style="font-size: 20px; {{ $redst }}">
                                                {!! $b->val1 !!}
                                            </strong>
                                        @endif
                                    @endforeach
                                </div>
                            </div>




                            @if($fund->payment->id == 5)

                                {!! $scan !!}
                                <h2 class="text-center bold">Scan to send</h2>
                            @endif

                        </div>
                        <hr>

                        <div class="row">
                            {!! Form::open(['route'=>'manual-deposit-submit','class'=>'form-horizontal','files'=>true]) !!}


                            <input type="hidden" name="fund_id" value="{{ $fund->id }}">

                            <div class="form-group">

                                <div class="col-sm-8 col-md-offset-2">
                                    <div class="text-center">
                                        <h4 class="bold" style="font-size: 24px;border-bottom: 2px dotted ;padding-bottom: 15px;text-transform: uppercase">Deposit Proof</h4>
                                    </div>

                                    <br>
                                    <br>
                                </div>
                            </div>
                            <br>
                            <br>
                            <br>

                            <div class="row">
                                <div class="form-group">
                                    <label style="margin-top: 5px;font-size: 14px;" class="col-sm-3 col-sm-offset-1 text-right control-label"><strong>Select Multiple Image : </strong></label>

                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <input type="file" value="" name="image[]" multiple class="form-control bold" required>
                                            <span class="input-group-addon red">&nbsp;<strong> <i class="fa fa-picture-o"></i> </strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="form-group">
                                    <label style="margin-top: 5px;font-size: 14px;" class="col-sm-3 col-sm-offset-1 text-right control-label"><strong>Meessage : </strong></label>

                                    <div class="col-sm-6">
                                                    <textarea name="message" id="area1" cols="30" rows="3"
                                                              class="input-lg form-control"></textarea>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-sm-6 col-sm-offset-4">
                                        <button class="btn-primary btn-block bold btn-lg"><i class="fa fa-send"></i> Submit Now</button>
                                    </div>
                                </div>
                            </div>



                            {!! Form::close() !!}
                        </div>


                    @endif
                </div>
            </div>
        </div>
    </div>


@endsection
