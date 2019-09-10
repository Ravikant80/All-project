@extends('layouts.user-frontend.dashboard')

@section('style')

@endsection
<?php
$url='https://bitpay.com/api/rates';
$json=json_decode( file_get_contents( $url ) );
$dollar=$btc=0;

foreach( $json as $obj ){
if( $obj->code=='USD' )$btc=$obj->rate;
}
//echo "btc".$btc;
$dollar=1 / $btc;

$cfa      =btcBuyValue();
$cfa2     =btcSellValue();
$cfavalue =getCfaValues();


?>
@section('content')
<style type="text/css">
.modal-content{
    border-radius: 15px;
}
label {
    color: #555 !important;
font-weight: 600;
font-family: 'Open Sans',sans-serif;
font-size: 14px;
}

.form-control:disabled, .form-control[readonly] {
background-color: #f9f9f9;
opacity: 1;
border: 1px solid #ccc;
padding: 10px;
}

form .form-group {
margin-bottom: 0.5rem;
}

form .form-control {
border: 1px solid #cacfe7;
color: #3b4781;
line-height: 1.5rem;
padding: 10px;
}
select.form-control:not([size]):not([multiple]) {
height: calc(3.0rem + 2px);
}

.btn-default {
color: #777;
background-color: #fff;
border-color: #ddd;
}

.c-panel__btn {
padding: 8px 30px;
min-width: 128px;
font-size: 16px;
margin-right: 18px;
}

.c-panel__buttons {
text-align: center;
margin-top: 15px;
margin-bottom: 30px;
}

.modal-body {
position: relative;
-webkit-box-flex: 1;
-ms-flex: 1 1 auto;
flex: 1 1 auto;
padding: 2rem;
padding-top: 0px;
}

.has-danger{
margin-bottom: 1.5rem !important;
}
</style>

<!--<div class="content-header row">
    <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block">Wallet</h3>
        <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('user-dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Wallet</li>
                </ol>
            </div>
        </div>
    </div>        
</div>-->


        <div class="sidebar-detached sidebar-left">
          <div class="sidebar">
            <div id="wallet-sidebar" class="sidebar-content">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title" style="display: inline;">CT-Pay Wallet</h6> 
                        
                        <h6 style="float:right;"> 
                            <i class="fa fa-2x fa-qrcode"  title="Wallet Address"  data-toggle="modal" data-target="#walletAddressModal"></i>         
                        </h6>
                        
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <h3 class="text-center " id="changebitcoin">{{ round(Auth::user()->bitcoin,8) }}</h3>
                            <h1 class="text-center" id="currency-value-btc">BTC</h1>
                            <h3 class="text-center " id="changebalance">{{ round(Auth::user()->balance,8) }} </h3>
                            <h1 class="text-center" id="currency-value-cfa">{{ $basic->symbol }}</h1>
                        </div>
                         <div class="table-responsive">
                              <table border="0" class="table table-de mb-0">                    
                                <tbody>
                                  <tr>
                                  <!-- <td><a href="javascript:;" class="text-center btn btn-default"><i class="fa fa-download"></i> Request</a></td>
                                    <td><a href="javascript:;" class="text-center btn btn-default"><i class="fa fa-paper-plane"></i> Send</a></td>  -->  
                                 <td id="showReceiveSect">
                                     <a href="javascript:;" class="text-center btn btn-default" style="font-size: 12px !important; color: #000;" data-toggle="modal" data-target="#walletAddressModal">
                                        <i class="fa fa-money"></i> Receive
                                     </a>
                                 </td>
<!--                                     <td id="showReceiveSect"><a href="javascript:;" class="text-center btn btn-default" style="font-size: 12px !important;" data-toggle="modal" data-target="#sellCoinModal"><i class="fa fa-money"></i> Sell</a></td>-->
                                 <td id="showSendSect">
                                     <a href="javascript:;" class="text-center btn btn-default" style="font-size: 12px !important;color: #000;"  data-toggle="modal" data-target="#exampleModal">
                                         <i class="fa fa-send-o"></i> Send 
                                     </a>
                                 </td>
                                 <td id="showcfaCashIn"><a href="{{url('payment/dashboard')}}" class="text-center btn btn-default" style="font-size: 12px !important; color: #000;" ><i class="fa fa-money"></i> Cash In </a></td>
                                 <!-- <td id="showBuySect"><a href="javascript:;" class="text-center btn btn-default" style="font-size: 12px !important; color: #000;"  data-toggle="modal" data-target="#buybtcModel" ><i class="fa fa-shopping-cart"></i> Buy Btc</a></td> -->
                                 <td id="showBuySect"><a href="{{url('user/buy-bitcoin')}}" class="text-center btn btn-default" style="font-size: 12px !important; color: #000;"><i class="fa fa-shopping-cart"></i> Buy Btc</a></td>
                                 
                                </tr>
                                </tbody>
                              </table>
                        </div> 
                     </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title text-center">All Wallets</h6>            
                    </div>
                    <div class="card-content collapse show">
                        <!--<div class="card-body">
                            
                        </div>-->
                        <div class="table-responsive">
                              <table class="table table-de mb-0">                    
                                <tbody>
                                  <tr>
                                    <td id="btcidbtc" style="cursor: pointer;">BTC</td>
                                    <td><i class="fa fa-btc"></i> {{ round(Auth::user()->bitcoin,8) }}</td>                        
                                  </tr>
                                  <tr>
                                    <td id="cfaidcfa" style="cursor: pointer;">{{ $basic->symbol }}</td>
                                    <td> {{ round(Auth::user()->balance,8) }} {{ $basic->symbol }}</td>                        
                                  </tr> 
                                  <tr>
<!--                                          <td align="center" colspan="2" ><a href="javascript:;" style="color:#000000;" data-toggle="modal" data-target="#CurConversionModal"><i class="fa fa-exchange"></i> Convert</a></td>-->
                                       <td align="center" colspan="2" ><a href="{{url('user/exchange')}}" style="color:#000000;" ><i class="fa fa-exchange"></i> Convert</a></td>
                                  </tr>                     
                                </tbody>
                              </table>
                        </div>
                     </div>
                </div>
                <div class="card">
                    <div class="card-content collapse show">
                    <a href="{{url('/user/reference-user')}}"  style="color: #000;" class="btn btn-default btn-block"><i class="fa fa-gift"></i> Referal users : {{$refer}}</a>
                    </div>
                </div>
                
                <div class="card">
                        <div class="card-content collapse show" style="padding: 7px;text-align: center;">
 
                                <!--<td class="text-center btn btn-default">Referal users : {{$refer}}</td>-->
                                <td class="text-center btn btn-default" style="color: #000;"><i class="fa fa-money"></i> Bonus Amount : {{round($amountsum,8)}} {{ $basic->symbol }} </td>
                          
                        </div>
                </div>

                    
                </div>
            </div>
        </div>


        
<div class="content-detached content-right">
   <div class="content-body">
      <div id="wallet">
        <div class="card">
            <div class="card-content collapse show">
                <div class="col-xl-12 col-lg-12">
                    <h6 class="my-2">Get started with Coins!</h6>
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="card-text">
                                    <section class="cd-horizontal-timeline">
                                        <div class="timeline">
                                            <div class="events-wrapper">
                                                <div class="events">
                                                    <ol>
                                                        <li><a href="#0" data-date="16/01/2018" class="selected"><i class="fa fa-thumbs-up fa-lg"></i></a></li>
                                                        <li><a href="#0" data-date="28/06/2018"><i class="fa fa-user fa-lg"></i></a></li>
                                                        <li><a href="#0" data-date="20/03/2019"><i class="fa fa-envelope fa-lg"></i></a></li>
                                                    </ol>
                                                    <span class="filling-line" aria-hidden="true"></span>
                                                </div>
                                                <!-- .events -->
                                            </div>
                                            <!-- .events-wrapper -->
                                            <ul class="cd-timeline-navigation">
                                                <li><a href="#0" class="prev inactive">Prev</a></li>
                                                <li><a href="#0" class="next">Next</a></li>
                                            </ul>
                                            <!-- .cd-timeline-navigation -->
                                        </div>
                                        <!-- .timeline -->
                                        <div class="events-content">
                                            <ol>
                                                <li class="selected" data-date="16/01/2018">
                                                    <blockquote class="blockquote border-0">
                                                        <p class="text-bold-600">Connect to facebook</p>
                                                    </blockquote>
                                                    <p class="lead mt-2">
                                                        Easily send and receive money from friends.
                                                    </p>
                                                </li>
                                                <li data-date="28/06/2018">
                                                    <blockquote class="blockquote border-0">
                                                        <p class="text-bold-600">Submit Your Verification</p>
                                                    </blockquote>
                                                    <p class="lead mt-2">
                                                        Get higher limits and make your account more secure.
                                                    </p>
                                                </li>
                                                <li data-date="20/10/2018">
                                                    <blockquote class="blockquote border-0">
                                                        <p class="text-bold-600">Add Funds</p>
                                                    </blockquote>
                                                    <p class="lead mt-2">
                                                        Cash in instantly 7-Eleven, then use your funds to make payments.
                                                    </p>
                                                </li>
                                                <li data-date="20/03/2019">
                                                    <blockquote class="blockquote border-0">
                                                        <p class="text-bold-600">Earn 50 CFA per friend</p>
                                                    </blockquote>
                                                    <p class="lead mt-2">
                                                        Share your promo code and get a 50 CFA bonus for each
verified referral.                                               </p>
                                                </li>
                                            </ol>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-content collapse show">
                <div class="large-12 columns">
                      <div class="owl-carousel owl-theme">
                            <div class="item">
                              <img src="{{ asset('assets/images/logo.png') }}" />
                            </div>
                            <div class="item">
                              <img src="{{ asset('assets/images/logo.png') }}" />
                            </div>
                            <div class="item">
                             <img src="{{ asset('assets/images/logo.png') }}" />
                            </div>
                            <div class="item">
                              <img src="{{ asset('assets/images/logo.png') }}" />
                            </div>
                            <div class="item">
                              <img src="{{ asset('assets/images/logo.png') }}" />
                            </div>
                      </div>
                  </div>
            </div>
        </div>
    </div>
</div>
</div>

<br/>
<br/>
<br/>
<div class="content-body">
<div class="row" style="">
<div id="recent-transactions" class="col-12">
    <h6 class="my-2">Recent Transactions</h6>
    <div class="card">
        <div class="card-content">
            <div class="table-responsive">
                <table id="recent-orders" class="table table-hover table-xl mb-0">
                <thead>
                    <tr>
                        <th>ID#</th>
                        <th>Date</th>
                        <th>Transaction ID</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <!--<th>Post Balance</th>-->
                        <th width="30%">Details</th>
                    </tr>
                </thead>

                <tbody>
                @php $i=0;@endphp
                @if(isset($log))
                @foreach($log as $p)
                    @php $i++;@endphp
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ date('d-F-Y h:i A',strtotime($p->created_at))  }}</td>
                        <td>{{ $p->transaction_id }}</td>
                        <td>
                            @if($p->amount_type == 1)
                                <span class="label bold label-primary"><i class="fa fa-cloud-download"></i> Deposit</span>
                            @elseif($p->amount_type == 2)
                                <span class="label bold label-danger"><i class="fa fa-minus"></i> Active</span>
                            @elseif($p->amount_type == 3)
                                <span class="label bold label-success"><i class="fa fa-plus"></i> Reference</span>
                            @elseif($p->amount_type == 4)
                                <span class="label bold label-success"><i class="fa fa-exchange"></i> Repeat</span>
                            @elseif($p->amount_type == 5)
                                <span class="label bold label-primary"><i class="fa fa-cloud-upload"></i> Withdraw</span>
                            @elseif($p->amount_type == 6)
                                <span class="label bold label-warning"><i class="fa fa-cloud-download"></i> Refund</span>
                            @elseif($p->amount_type == 8)
                                <span class="label bold label-success"><i class="fa fa-plus"></i> Add </span>
                            @elseif($p->amount_type == 9)
                                <span class="label bold label-danger"><i class="fa fa-minus"></i> Convert </span>
                            @elseif($p->amount_type == 10)
                                <span class="label bold label-danger"><i class="fa fa-bolt"></i> Charge </span>
                            @elseif($p->amount_type == 15)
                                <span class="label bold label-success"><i class="fa fa-recycle"></i> Cash-in </span>
                            @elseif($p->amount_type == 14)
                                <span class="label bold label-info"><i class="fa fa-cloud-upload"></i> Cash-out </span>
                            @endif
                        </td>
                        <td>
                            {{ $p->amount }}
                        </td>
                       <!-- <td>
                            {{ $p->post_bal }} - {{ $basic->symbol }}
                        </td>-->
                        <td width="30%">
                            {{ $p->description }}
                        </td>
                    </tr>
                @endforeach
                @endif

                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div> 
</div>
<!-- =========================== Verification Model =========================== -->

<div class="modal fade" id="mySuccessModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
          <div align="center"><i class="fa fa-id-card" style="font-size:85px;color:green;margin-bottom:5%;"></i></div>
          <h5 align="center" style="margin-bottom:5%;">Success!</h5>
          <div style="width: 50%;margin: 2% 25%;text-align: -webkit-center;">
          <p style="margin-bottom:20%;">Please allow up to 3 business days for our team to review your ID submission<br><br>We will update you on the status of your verification by email and on your account limits page</p>
          
          </div>
        </div>
        <div class="modal-footer">
            <div style="float:left;">
                  <button type="button" class="btn btn-primary model_ok_btn">Skip ID Verification For Now!</button>
            </div>
            <div style="float:right;">
                     <a href="{{ route('investment-verify-general') }}" class="btn btn-warning btn-sm bold uppercase">Continue<i class="fa fa-arrow-right"></i></a>
            </div>
        </div>
      </div>
      
    </div>
</div>
<!-- =========================== Send Btc Model =========================== -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
  <div class="modal-header">
    {{-- <h5 class="modal-title" id="exampleModalLabel" align="center" style="margin-left: 37%;"><i class="fa fa-id-card" style="font-size:85px;color:green;margin-bottom:5%;"></i></h5> --}}
    <h5  style="margin-top:20%;margin-top: 3%;margin-left: 208px;text-transform: capitalize;text-align: center;font-size: 26px;color: #333;">Send BitCoin </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    
  </div>
  <div class="modal-body">
             <div>
                  <i class="text-danger" id="amount_less_error"></i>
              </div>
        <form action="{{ route('cash-out') }}" id="myForm" role="form" data-toggle="validator" method="post" accept-charset="utf-8" style="width:100%;">
                {{ csrf_field() }}
                <input type="hidden" name="from_wallet_address" id="from_wallet_address" value="{{ Auth::user()->wallet_address }}">
               
            <div id="step-1"  class="">
                <div id="form-step-0" role="form" data-toggle="validator">
                    <p>&nbsp;</p>
                    <div class="col-md-12" style="display: -webkit-box;">
                        <div class="row">
                            <div class="col-md-5 send-1">
                                <div class="">
                                    <div class="form-group" style="margin-left: -14px">
                                            <label for="name">BTC  Balance</label>
                                                <input type="text" class="form-control text-right" name="btc_amount" id="btc_amount" value="{{ Auth::user()->bitcoin }}" readonly>
                                            <div class="help-block with-errors"></div>
                                    </div>  
                                </div>
                            </div>
                            <div class="col-md-7 send-2" style="display: -webkit-box;">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="form-group">
                                                <label for="name">Send Btc </label>
                                                    <input type="text" class="form-control text-right" autocomplete="off" name="amount" id="amount" placeholder="0" required>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="form-group">
                                                <label for="name" style="opacity: 0;margin-top: 0px;">Send Btc </label>
                                                      <select class="form-control text-right" onchange="getval(this);">
                                                          <option value="BTC">BTC</option>
                                                          <option value="USD">USD</option>
                                                        </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div id="usdval2"></div> -->

                                    <span id="disp-usdval" style="display: -webkit-inline-box; margin-left: 40%;">
                                        <p><span>~</span> <span id="usdval2">0</span> USD</p>
                                
                                    </span>

                                    <span id="disp-btcval" style="display: -webkit-inline-box; margin-left: 40%;">
                                        <p ><span>~</span> <span id="btcvaldisp">0</span> BTC</p>
                                 
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="form-group">
                        <label for="name">Wallet Balance</label>
                           <input type="text" class="form-control text-right" name="wallet_balance" id="wallet_balance" readonly>
                    </div>
                </div> 
            </div>
                      <input type="hidden" class="form-control" name="recipient_name" id="recipient_name" placeholder="Recipient name." required value="Test">
                      <!--   <div class="form-group">
                            <label for="address">Recipient Name</label>
                            <input type="text" class="form-control" name="recipient_name" id="recipient_name" placeholder="Recipient name." required>
                            <div class="help-block with-errors"></div>
                        </div> 
                        <div class="form-group">
                            <label for="address">Recipient Wallet Address</label>
                            <input type="text" class="form-control" name="recipient_wallet_address" id="recipient_wallet_address" placeholder="Recipient wallet address..." required>
                            <div class="help-block with-errors"></div>
                        </div> -->
                         <div class="co-md-12 " style="">
                                <div class="row">
                                    <div class="col-md-11 col-lg-11 col-sm-11" >
                                         <div class="form-group">
                                            <label for="address">Recipient Wallet Address</label>
                                            <input type="text" class="form-control" name="recipient_wallet_address" id="recipient_wallet_address" placeholder="Recipient wallet address..." required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                
                               
                                    <div class="col-md-1 col-lg-1 col-sm-1">
                                         <div class="form-group">
                                            <button class="btn" onclick="" style="padding: 8px 18px 2px;border-radius: 0 5px 5px 0px!important; margin-left: -41px; margin-top: 28px; background: #fff; border: 1px solid #c8c7c7">
                                                <i class="fa fa-2x fa-qrcode "></i>    
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                  
                        <div class="form-group">
                            <label for="address">Message</label>
                            <textarea class="form-control" name="message" id="message" rows="3" placeholder="Write your message..."></textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                   
      {{-- <div class="form-group">
        <label for="recipient-name" class="col-form-label">Recipient:</label>
        <input type="text" class="form-control" id="recipient-name">
      </div>
      <div class="form-group">
        <label for="message-text" class="col-form-label">Message:</label>
        <textarea class="form-control" id="message-text"></textarea>
      </div> --}}
   
  </div>
  <div class="">
    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Closesdfsf</button> -->
    <div class="c-panel__buttons">
        <button class="btn btn-default c-panel__btn" data-dismiss="modal">Close</button>
          <button class="btn btn-primary c-panel__btn" data-ember-action="2652">Continue</button>
    </div>
    <!-- <input type='submit' name='final' id='final' class='btn btn-primary' value='Send'> -->
    {{-- <button type="button" class="btn btn-primary">Continue</button> --}}
  </div>
</form>
</div>
</div>
</div>

<!-- =========================== Buy Btc Model =========================== -->

<div class="modal fade" id="buybtcModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
  <div class="modal-header">
    {{-- <h5 class="modal-title" id="exampleModalLabel" align="center" style="margin-left: 37%;"><i class="fa fa-id-card" style="font-size:85px;color:green;margin-bottom:5%;"></i></h5> --}}
    <h5  style="margin-top:20%;margin-top: 3%;margin-left: 227px;text-transform: capitalize;text-align: center;font-size: 26px;color: #333;">Buy Bitcoin</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    
  </div>
  <div class="modal-body">
   
        <form action="{{ url('user/bitcoin-request') }}" id="myFormbuycoin" role="form" data-toggle="validator" method="post" accept-charset="utf-8" style="width:100%;">
                {{ csrf_field() }}
                
               
            <div id="step-1" style="height:284px; width:100%;" class="">
                <div id="form-step-0" role="form" data-toggle="validator">
                    <p>&nbsp;</p>
                     <div class="row">
                    
                    <div class="col-sm-6">
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon" data-currency-symbol="true">CFA</span>
                            
                            <input id="A1" class="form-control nomargin text-right disableButton" data-currency-calc="true" type="text" value="5000" placeholder="Enter amount" data-original-title="" title="">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group input-group-lg">
                            <input  id="B1" class="form-control nomargin disableButton" type="text" value="<?php echo (5000/$cfa);?>" placeholder="Enter amount" data-original-title="" title="" >
                            <span class="input-group-addon"><img width="20px" height="20px" src="https://assets.coinmama.com/bitcoin.png">&nbsp;BTC</span>
                        </div>
                    </div>
                    <div>
                  <i class="text-danger" id="amount_less_error"></i>
              </div>
                    <p align="center" style=" margin-left: 42% !important;"><span>~</span> <span id="usdval1"><?php echo (5000/$cfavalue);?></span>USD</p>
                   
                </div>
                    <p>&nbsp;</p>
                    <div class="form-group">
                            <label for="cfa">CFA  Balance</label>
                                <input type="text" class="form-control text-right" name="cfa_amount_bal" id="cfa_amount_bal" value="{{ Auth::user()->balance }}" readonly>
                            <div class="help-block with-errors"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="name">Send CFA </label>
                            <input type="text" class="form-control text-right" autocomplete="off" name="cfa_amounts" id="cfa_amounts" placeholder="0" required>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="cashout">BTC Value</label>
                               <input type="hidden" class="form-control text-right" autocomplete="off" name="cash_out_commision" id="cash_out_commision" placeholder="0"  value="{{ $basic->btc_buy_commision * $cfavalue}}" readonly>

                              <input type="text" class="form-control text-right" autocomplete="off" name="btc_amounts" id="btc_amounts" placeholder="0" readonly >

                        <div class="help-block with-errors"></div>
                    </div>
                    
                        
                     
                        <input type="hidden" class="form-control text-right" name="wallet_balances" id="wallet_balance" readonly>
                   
                </div> 
            </div>
       
  </div>
  <br/><br/>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <input type='submit' id='buyBtcConfModelId' class='btn btn-primary' value='Buy'>
    {{-- <button type="button" class="btn btn-primary">Continue</button> --}}
  </div>
</form>
</div>
</div>
</div>


<!-- ========= Conversion model ================= -->

<div class="modal fade" id="CurConversionModal" tabindex="-1" role="dialog" aria-labelledby="CurConversionModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
  <div class="modal-header">
    {{-- <h5 class="modal-title" id="exampleModalLabel" align="center" style="margin-left: 37%;"><i class="fa fa-id-card" style="font-size:85px;color:green;margin-bottom:5%;"></i></h5> --}}
    <h5  style="margin-top:20%; margin-top: 3%; margin-left: 142px;"> Conversion</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    
  </div>
  <div class="modal-body">
      <div class="row">
                    
                    <div class="col-sm-6">
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon" data-currency-symbol="true">CFA</span>
                            
                            <input id="A2" class="form-control nomargin text-right disableButton" data-currency-calc="true" type="text" value="1" placeholder="Enter amount" data-original-title="" title="">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group input-group-lg">
                            <input  id="B2" class="form-control nomargin disableButton" type="text" value="<?php echo $cfa;?>" placeholder="Enter amount" data-original-title="" title="" >
                            <span class="input-group-addon"><img width="20px" height="20px" src="https://assets.coinmama.com/bitcoin.png">&nbsp;BTC</span>
                        </div>
                    </div>
                </div>
  </div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    
    {{-- <button type="button" class="btn btn-primary">Continue</button> --}}
  </div>

</div>
</div>
</div>

<!-- ========= Wallet Address ================= -->

<div class="modal fade" id="walletAddressModal" tabindex="-1" role="dialog" aria-labelledby="CurConversionModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        {{-- <h5 class="modal-title" id="exampleModalLabel" align="center" style="margin-left: 37%;"><i class="fa fa-id-card" style="font-size:85px;color:green;margin-bottom:5%;"></i></h5> --}}
        <center>
        <h5  style="margin-top:20%;margin-top: 3%;margin-left: 205px;text-transform: capitalize;text-align: center;font-size: 26px;color: #333;">BTC Wallet Address</h5></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        
      </div>
      <div class="modal-body">
           <div class="form-group">
                <label for="name"> </label>
                <p style="text-align: center;;"> Share this address to receive money form your friends. Or use it to transfer money from another BTC service.</p>
                
                    <div class="col-md-12" style="display: -webkit-inline-box;">
                        <div class="col-sm-11 col-lg-11 col-sm-11">
                            <div class="row">
                                <input  type="text" class="form-control text-right" autocomplete="off" name="uwallet_address" id="uwallet_address" required readonly="" value="{{ Auth::user()->wallet_address }}" style="box-shadow: none!important;">
                            </div>
                        </div>
                        <div class="col-md-1 col-lg-1 col-sm-1">
                            <div class="row">
                                <button class="btn" onclick="copytextFunc()" style="padding: 10px; border-radius: 0 5px 5px 0px!important; background-color: #f9f9f9;border: 1px solid #c0bbbb;">
                                    <i class="fa fa-copy "></i>    
                                </button>
                            </div>
                        </div>
                     </div>
                     <div class="" style="text-align: center; margin-top: 40px;" >
                        <img src="{{asset('assets/img/b-code.png')}}">
                     </div>
             </div>          
      </div>
 <div class="modal-footer">
        <!--<button class="btn btn-success" onclick="copytextFunc()">Copy text</button>-->
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
        {{-- <button type="button" class="btn btn-primary">Continue</button> --}}
      </div>
  
    </div>
  </div>
</div>

<!-- ========= Sell  Bitcoin ================= -->

<div class="modal fade" id="sellCoinModal" tabindex="-1" role="dialog" aria-labelledby="CurConversionModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
  <div class="modal-header">
    {{-- <h5 class="modal-title" id="exampleModalLabel" align="center" style="margin-left: 37%;"><i class="fa fa-id-card" style="font-size:85px;color:green;margin-bottom:5%;"></i></h5> --}}
    <h5  style="margin-top:20%; margin-top: 3%; margin-left: 142px;">Sell Coin</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    
  </div>
  <div class="modal-body">
        <form action="{{ url('user/sellbtc-request') }}" id="myFormSellcoin" role="form" data-toggle="validator" method="post" accept-charset="utf-8" style="width:100%;">
                {{ csrf_field() }}
                
     
                   <div class="form-group">
                            <label for="cfa">Bitcoin  Balance</label>
                                <input type="text" class="form-control text-right" name="btc_balance" id="btc_balance_sell" value="{{ Auth::user()->bitcoin }}" readonly>
                            <div class="help-block with-errors"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="name">Send Btc </label>
                            <input type="text" class="form-control text-right" autocomplete="off" name="sendbtcamounts" id="sendbtcamounts" placeholder="0" required>
                        <div class="help-block with-errors"></div>
                    </div>
     
                    <div class="form-group">
                        <label for="cashout">Sell BTC Commission (in BTC)</label>
                               <input type="text" class="form-control text-right" autocomplete="off" name="cash_in_commision" id="cash_in_commision" placeholder="0"  value="{{ $dollar*$basic->btc_sell_commision }}" readonly>
                        <div class="help-block with-errors"></div>
                    </div>
     
                   
  </div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <input type='submit' id='final' class='btn btn-primary' value='Sell'>
    {{-- <button type="button" class="btn btn-primary">Continue</button> --}}
  </div>
</form>
</div>
</div>
</div>

<style type="text/css">
.modal-dialog {
max-width: 600px !important;
margin-top: 70px;
}
.input-group-addon {
background-color: #ECEFF1;
border-color: #BABFC7;
padding: 10px;
}
</style>

<script src="{{ asset('assets/dashboard/assets/js/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/assets/js/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/assets/js/highcharts.js') }}"></script>
<script src="{{ asset('assets/dashboard/assets/js/exporting.js') }}"></script>
<script src="{{ asset('assets/dashboard/assets/js/export-data.js') }}"></script>

@if(( Auth::user()->identity_verify_status != 1) && Auth::user()->idverify_skip == 1)
<script type="text/javascript">
$(document).ready(function() {
jQuery("#mySuccessModal").modal('show');
});
</script>
@endif

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
<script>
$(document).ready(function(e) {
 $(document).on('click','.model_ok_btn',function(){
    jQuery("#mySuccessModal").modal('hide');
    var skip = 0;
    $.ajax({
        method: 'POST',         
        url: "{{ url('/user/updateidverify') }}", 
        data: "skip="+skip,
        headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') },
        success: function(response){ 
            //alert(response);              
            location.reload(true);
        },
        error: function(jqXHR, textStatus, errorThrown) { 
            console.log(JSON.stringify(jqXHR));
            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
            alert(JSON.stringify(jqXHR));
            alert("AJAX error: " + textStatus + ' : ' + errorThrown);
        }
    });
});
});
</script>

<script>
        $('#exampleModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('whatever') // Extract info from data-* attributes
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)
      modal.find('.modal-title').text('New message to ' + recipient)
      modal.find('.modal-body input').val(recipient)
    });
    
     $('#buybtcModel').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('whatever') // Extract info from data-* attributes
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)
      modal.find('.modal-title').text('New message to ' + recipient)
      modal.find('.modal-body input').val(recipient)
    });
    
     $('#CurConversionModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('whatever') // Extract info from data-* attributes
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)
      modal.find('.modal-title').text('New message to ' + recipient)
      modal.find('.modal-body input').val(recipient)
    });
    
    $('#walletAddressModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('whatever') // Extract info from data-* attributes
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)
      modal.find('.modal-title').text('New message to ' + recipient)
      modal.find('.modal-body input').val(recipient)
    });
    
     $('#sellCoinModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('whatever') // Extract info from data-* attributes
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)
      modal.find('.modal-title').text('New message to ' + recipient)
      modal.find('.modal-body input').val(recipient)
    });
    
</script>
<script type="text/javascript">
$(document).ready(function(){
    var mmval = $("#btc_amount").val();
    
    $("#myForm").validate({
        rules: {                            
            // amount: {
            //     required: true,                 
            //     max: mmval
            // },
            recipient_name: {
                required: true,
            },
            recipient_wallet_address: {
                required: true,
            },
            // message: {
            //     required: true,
            // },
            
        },
        messages: {                     
            // amount: {
            //     required: "Please enter an amount",
            // },
            recipient_name: {
                required: "Please provide a receipient name",
            },
            recipient_wallet_address: {
                required: "Please provide a receipient wallet address",
            },
            // message: {
            //     required: "Please enter a your message",
            // }
        } 
    });
    
    $("#amount").keyup(function(){
        var amount = $(this).val();
        //alert(amount);
        
        var btc = $("#btc_amount").val();
        $('#disp-btcval').hide();
       $('#disp-usdval').show();
        $("#usdval2").text($("#amount").val()*<?php echo ($btc);?>);
        //alert(btc);
        if($(this).val() > <?=Auth::user()->bitcoin;?>)
        {   
            $("#amount_less_error").text("Please enter an amount within your current wallet balance of <?=Auth::user()->bitcoin;?>  BTC");

         
           // swal("Sorry!", "Your Request Amount is Larger Than Your Current Balance.", "error");
        }
        else
        {
             $("#amount_less_error").text("");
            var due = parseFloat(btc) - parseFloat(amount);
            $("#wallet_balance").val(due);
        }
    
    }); 
    /*
    $(document).on('click','.sw-btn-next',function(){
        var pageURL = $(location).attr("href");
        var url_solit       = pageURL.split("#");
        var current_step    = url_solit[1];
        
        if(current_step == 'step-3'){
            //$(".sw-btn-next").removeAttr('disabled');
            $(".sw-btn-next").hide();
            var btn_field   = "<input type='submit' name='final' id='final' class='btn btn-success done-btn' value='Done'>";
            $(".sw-btn-prev").hide();
            $(".sw-btn-group").append(btn_field);
        } else {
            $(".sw-btn-next").show();
            $(".sw-btn-prev").show();
            $(".done-btn").hide();
        }
    });
    
    $(document).on('click','.sw-btn-prev, .nav-link',function(){
        $(".sw-btn-next").show();
        $(".done-btn").hide();
    });*/
});
   $('#disp-btcval').hide();
   $('#disp-usdval').hide();
 function getval(sel){
   $('#disp-btcval').hide();
    $('#disp-usdval').hide();
  // $("#usdval2").val()=0; 
if(sel.value =='USD'){
     $('#disp-btcval').show();
     $("#btcvaldisp").text($("#amount").val()*<?php echo (1/$btc);?>);
    $("#amount").keyup(function(){
        var amount = $(this).val();
        //alert(amount);
       $('#disp-btcval').show();
       $('#disp-usdval').hide();

         $("#btcvaldisp").text($("#amount").val()*<?php echo (1/$btc);?>);
        
        var btc = $("#btc_amount").val();
       if($("#btcvaldisp").text() > <?=Auth::user()->bitcoin;?>)
        {   
            $("#amount_less_error").text("Please enter an amount within your current wallet balance of <?=Auth::user()->bitcoin;?>  BTC");

         
           // swal("Sorry!", "Your Request Amount is Larger Than Your Current Balance.", "error");
        }
        else
        {
             $("#amount_less_error").text("");
            var due = parseFloat(btc) - parseFloat(amount);
            $("#wallet_balance").val(due);
        }
    });

}
else if(sel.value =='BTC'){
    $('#disp-usdval').show();
      $("#usdval2").text($("#amount").val()*<?php echo ($btc);?>);
    $("#amount").keyup(function(){
        var amount = $(this).val();
        //alert(amount);
       $('#disp-usdval').show();
       $('#disp-btcval').hide();
       
          $("#usdval2").text($("#amount").val()*<?php echo ($btc);?>);

       var btc = $("#btc_amount").val();
     if($(this).val() > <?=Auth::user()->bitcoin;?>)
        {   
            $("#amount_less_error").text("Please enter an amount within your current wallet balance of <?=Auth::user()->bitcoin;?>  BTC");

         
           // swal("Sorry!", "Your Request Amount is Larger Than Your Current Balance.", "error");
        }
        else
        {
             $("#amount_less_error").text("");
            var due = parseFloat(btc) - parseFloat(amount);
            $("#wallet_balance").val(due);
        }
    });
}
}
</script>
<script>
$(document).ready(function(){
    $("#changebalance").hide();
    $("#currency-value-cfa").hide();
    $("#showBuySect").hide();
    $("#showcfaCashIn").hide();
$("#btcidbtc").click(function(){
    $("#changebitcoin").show();
    $("#currency-value-btc").show();
    $("#showSendSect").show();
    $("#showReceiveSect").show();
    $("#changebalance").hide();
    $("#currency-value-cfa").hide();
    $("#showBuySect").hide();
    $("#showcfaCashIn").hide();
});
$("#cfaidcfa").click(function(){
    $("#changebalance").show();
    $("#currency-value-cfa").show();
    $("#showBuySect").show();
    $("#showcfaCashIn").show();
    $("#changebitcoin").hide();
    $("#currency-value-btc").hide();
    $("#showSendSect").hide();
    $("#showReceiveSect").hide();
});
});

</script> 


<!--===============  Buy Bitcoin  Section ======================-->

<script type="text/javascript">
$(document).ready(function(){
    var mmval = $("#cfa_amount_bal").val();
    $('#buyBtcConfModelId').hide();
    
    $("#myFormbuycoin").validate({
        rules: {                            
            cfa_amounts: {
                required: true,                 
                max: mmval
            }
                     
        },
        messages: {                     
            cfa_amounts: {
                required: "Please enter an amount",
            }
            
        }
    });
    
    $("#cfa_amounts").keyup(function(){
  
        if($(this).val() > <?=Auth::user()->balance;?>)
        {
            swal("Sorry!", "Your Request Amount is Larger Than Your Current Balance.", "error");
            $('#buyBtcConfModelId').hide();
        }
        else
        {   $('#buyBtcConfModelId').show();
            // var due = parseFloat(btc) - parseFloat(amount);
            // $("#wallet_balances").val(due);
        }
    
    });  
 });

$("#cfa_amounts").change(function() {
$("#btc_amounts").val($("#cfa_amounts").val()/<?php echo $cfa;?>);
});

$("#cfa_amounts").keyup(function() {
$("#btc_amounts").val($("#cfa_amounts").val()/<?php echo $cfa;?>);
});

// --------     buy  currency conversion Section ------- //

$("#A1").change(function() {
$("#B1").val($("#A1").val()/<?php echo $cfa;?>);
});

$("#B1").change(function() {
$("#A1").val($("#B1").val() *<?php echo $cfa;?> );
});

$("#A1").keyup(function() {
$("#B1").val($("#A1").val()/<?php echo $cfa;?>);
$("#usdval1").text($("#A1").val()*<?php echo (1/$cfavalue);?>); 
 if($(this).val() < 5000)
        $("#amount_less_error").text("Minimum amount should not less then 5000 in CFA");
    else
        $("#amount_less_error").text("");
});

$("#B1").keyup(function() {
$("#A1").val($("#B1").val() * <?php echo $cfa;?>);
$("#usdval1").text($("#B1").val()*<?php echo ($btc);?>); 

});

</script>

<!--===============  END Buy Bitcoin  Section ======================-->


<script type="text/javascript">
                                                             
$("#A2").change(function() {
$("#B2").val($("#A2").val()*<?php echo $cfa;?>);
});

$("#B2").change(function() {
$("#A2").val($("#B2").val() /<?php echo $cfa;?> );
});

$("#A2").keyup(function() {
$("#B2").val($("#A2").val()*<?php echo $cfa;?>);
});

$("#B2").keyup(function() {
$("#A2").val($("#B2").val() / <?php echo $cfa;?>);
});
</script>
<script>
function copytextFunc() {
var copyText = document.getElementById("uwallet_address");
copyText.select();
document.execCommand("copy");

}
</script>
@endsection

@section('script')

@endsection