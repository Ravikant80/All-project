@extends('layouts.user-frontend.dashboard')

@section('style')

@endsection
<?php
$page = file_get_contents('https://bitpay.com/api/rates');
$my_array = json_decode($page, true);
@$bit_coin = $my_array[0]["rate"];
@$bit_code = $my_array[0]["code"];
@$usd_code = $my_array[2]["code"];
@$usd_rate = $my_array[2]["rate"];

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
  $usdBuyVal = usdBuyValue();
  $usdSellVal = usdSellValue();
  
?>
@section('content')
<style type="text/css">
      .l-body {
      -webkit-box-flex: 1;
      -ms-flex: 1 1 auto;
      flex: 1 1 auto;
      padding: 30px 20px;
      position: relative;
      }

      .c-flash-messages {
    text-align: center;
  }
  .box-outline {
    box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 1px 5px 0 rgba(0,0,0,.12), 0 3px 1px -2px rgba(0,0,0,.2);
    border-radius: 3px;
    background-color: #fff;
  }
  .exchange {
    font-family: Roboto,sans-serif;
    font-size: 16px;
    position: relative;
    padding-top: 20px;
    padding-bottom: 30px;
    margin-left: 23%;
}
.exchange__amount-title {
    font-family: inherit;
    font-size: 16px;
    text-align: left;
    font-weight: 300;
}
.exchange__input-group {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
    -ms-flex-direction: row;
    flex-direction: row;
    position: relative;
}
.md-form-group, .md-form-radio {
    position: relative;
    margin-top: 1.15rem;
    margin-bottom: 1.15rem;
}
.exchange__currency-select {
    min-width: 5em;
}

.exchange__currency-select.md-form-group select {
    font-size: 26px;
    height: 30px;
    line-height: 26px;
    font-weight: 300;
    color: #424242;
}

.md-form-group select {
    width: 100%;
    font-size: 1rem;
    height: 1.6rem;
    padding: .125rem .6em .0625rem .125rem;
    border: none;
    line-height: 1.6;
    box-shadow: none;
    background-color: transparent;
    /*background-image: url('assets/images/downarrow.png');*/
    background-image:url(http://nextversion.imperialit.in/assets/images/downarrow.png);
    background-repeat: no-repeat;
    background-position: right center;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-size: .5em auto;
}

.exchange__input-group-flex {
    -webkit-box-flex: 1;
    -ms-flex: 1;
    flex: 1;
}

.exchange__amount-input {
    border: none;
    color: #47baeb;
}

.md-form-group input:focus, .md-form-group select:focus, .md-form-group textarea:focus {
    outline: 0;
}

.exchange__amount-input, .exchange__amount-preview {
    font-family: inherit;
    font-size: 26px;
    width: 290px;
    text-align: right;
    font-weight: 700;
    height: 53px;
    line-height: 53px;
}

.exchange__wallet-balance {
    float: right;
    color: #757575;
    font-size: 12px;
    font-weight: 300;
}

.exchange__separator {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    width: 100%;
}

.exchange__amount-title {
    font-family: inherit;
    font-size: 16px;
    text-align: left;
    font-weight: 300;
}

.button--new.button-primary {
    color: #fff;
    background: #0b5999;
    text-transform: uppercase;
}

.prompt__copy {
    font-size: 16px;
    font-weight: 300;
    padding: 10px 0;
}

.button--new.button-block {
    margin: auto;
    display: block;
    max-width: 320px;
    width: 100%;
}

.button--new {
    display: inline-block;
    height: 48px;
    line-height: 48px;
    min-width: 100px;
    padding: 0;
    text-align: center;
    font-family: Roboto,sans-serif;
    font-weight: 300;
    font-size: 18px;
}

.exchange__rate {
    margin: 30px auto 20px;
    text-align: center;
}

.exchange__rate-progress {
    height: 1px;
    background-color: #ccc;
    width: 100%;
    max-width: 300px;
    margin: 10px auto;
}

.exchange__rate-value {
    color: #00bea4;
}

.exchange__separator-button {
    margin: 0 14px 0 0;
    background-color: transparent;
    border: none;
    outline: 0;
    height: 19px;
}

.exchange__separator-line {
    -webkit-box-flex: 1;
    -ms-flex: 1;
    flex: 1;
    background-color: #bdbdbd;
    height: 1px;
    width: 100%;
}

hr {
    margin-top: 20px;
    margin-bottom: 20px;
    border-top: 1px solid #eee;
}

.exchange__amount-preview {
    color: #00bea4;
    background: #fff;
    position: absolute;
    right: 0;
}
hr {
    height: 0;
    box-sizing: content-box;
}

.exchange__separator {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    width: 100%;
}

button, html input[type=button], input[type=reset], input[type=submit] {
    -webkit-appearance: button;
    cursor: pointer;
}

.exchange__separator-icon {
    width: 19px;
    height: 19px;
}
.swipe-image{
  position: relative;
    bottom: 8px;
}
   </style>

   <div class="l-body">
         <!---->
         <div id="ember1081" class="ember-view">
            <div class="c-flash-messages">
               <div id="ember1131" class="ember-view liquid-container">
                  <!---->
               </div>
            </div>
         </div>
         <div class="box-outline col-sm-8 col-sm-offset-2 col-lg-6 col-lg-offset-3 exchange">
            <div class="col-lg-offset-1 col-lg-10" style="margin-left: 23px;">
               <div id="ember1835" class="ember-view">
                  <!---->
               </div>
               <h2 class="exchange__amount-title">You are converting from:</h2>
               <div id="ember1352" class="ember-view">  <div class="exchange__input-group">
            <div class="md-form-group exchange__currency-select">
              <select id="ember1365" class="ember-view ember-select first" ><!---->
                <option  class="" value="CFA">CFA</option>
                <!-- <option  class="second" value="BTC">BTC</option> -->
               
            </select>
            <select id="ember1365" class="ember-view ember-select second"><!---->
               <!--  <option  class="first" value="CFA">CFA</option> -->
                <option  class="second" value="BTC">BTC</option>
               
            </select>

            </div>

            <div class="exchange__input-group-flex"></div>
              <div class="exchange__amount-preview" data-ember-action="1415">
                <input type="text" class="form-control exchange__amount-input" name="from_amount" id="cfa_amount" autocomplete="off" value="{{Auth::user()->balance}}" placeholder="Enter CFA Amount">

                <input type="text" class="form-control exchange__amount-input" name="from_amount" id="cfa_amount2" autocomplete="off" value="{{Auth::user()->bitcoin}}" placeholder="Enter CFA Amount">
              </div>
            <!-- <input id="id_exchange_source_amount" class="ember-view ember-text-field exchange__amount-input" max="0" min="0" step="100" type="number"> -->
          </div>
          <div class="exchange__wallet-balance cfaBalance">Wallet balance:
            {{Auth::user()->balance}} CFA
          </div>
          <div class="exchange__wallet-balance btcBalance">Wallet balance:
            {{Auth::user()->bitcoin}} BTC
          </div>
        <!---->
        </div>

             <!-- ===================== Conversion Button ==================== -->

               <div class="exchange__separator">
                  <button class="exchange__separator-button" title="Swap currencies" data-ember-action="1849" onclick="SwapDivsWithClick()">
                     <svg class="exchange__separator-icon">
                        <use xlink:href="#icon-exchange-convert"><img src="{{asset('assets/images/repeat.png')}}" class="swipe-image"></use>
                     </svg>
                  </button>
                  <hr class="exchange__separator-line">
               </div>
           
             <!-- ===================== End Conversion Section ==================== -->


               <h2 class="exchange__amount-title">You will receive:</h2>

               <div id="ember1851" class="ember-view">
                  <div class="exchange__input-group">
                     <div class="md-form-group exchange__currency-select">
                        <select id="ember1877" class="ember-view ember-select first">
                           <!---->
                        <option   value="BTC">BTC</option>
                       <!--  <option  class="second" value="CFA">CFA</option> -->
                         
                        </select>
                         <select id="ember1877" class="ember-view ember-select second">
                           <!---->
                       <!--  <option  class="first" value="BTC">BTC</option> -->
                        <option   value="CFA">CFA</option>
                         
                        </select>
                     </div>
                     <div class="exchange__input-group-flex"></div>
                     <div class="exchange__amount-preview" data-ember-action="1885">
                        <input type="text" class="form-control exchange__amount-input" name="to_amount" id="btc_amount" autocomplete="off"  placeholder="Enter an amount"   value="<?php echo (Auth::user()->balance/$cfa);?>">

                        <input type="text" class="form-control exchange__amount-input" name="to_amount" id="btc_amount2" autocomplete="off"  placeholder="Enter an amount"   value="<?php echo (Auth::user()->bitcoin*$btc*$cfavalue);?>">
                     </div>
                    <!--  <input id="id_exchange_target_amount" class="ember-view ember-text-field exchange__amount-input" min="0" step="0.0001" type="number"> -->
                  </div>
                  <div class="exchange__wallet-balance cfaBalance">Wallet balance:
                     {{Auth::user()->bitcoin}} BTC
                  </div>
                  <div class="exchange__wallet-balance btcBalance" >Wallet balance:
                   {{Auth::user()->balance}} CFA
                  </div>
                  <!---->
               </div>
               <div class="exchange__rate">
                  <div class="exchange__rate-title">
                     Current rate
                  </div>
                  <div class="exchange__rate-progress">
                     <div class="exchange__rate-progress-active" style="width: 38.64%"></div>
                  </div>
                  <div class="exchange__rate-value"><span>1 BTC</span><span>~</span>
                     <span id="change-usd-rates"><?php echo $usdBuyVal;?></span>
                     <span id="change-usd-rates2"><?php echo $usdSellVal;?></span>
                                  USD
                  </div>
                  <!---->
               </div>
               <!----><!---->
               <button class="button--new button-block button-primary buyDisp" >
                  <a href="{{url('user/buy-bitcoin')}}" class="btn btn-primary btn-block">Convert</a>
               </button>
               <button class="button--new button-block button-primary sellDisp" >
               <a href="{{url('user/sell-coin')}}" class="btn btn-primary btn-block">Convert</a>
               </button>
              
               <div class="prompt__copy">
                  Please keep in mind that the prices of digital currencies are volatile. Prices may go up or down at any time.
               </div>
            </div>
         </div>
      </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- <script src="{{ asset('assets/dashboard/assets/js/jquery-1.12.4.min.js') }}"></script> -->
  <script type="text/javascript">

                  $('.second').hide();
                  $('.btcBalance').hide();
                  $('.sellDisp').hide();
                  $('#cfa_amount2').hide();
                  $('#btc_amount2').hide();
                  $('#change-usd-rates2').hide();
                  $('.first').show();
                  $('.cfaBalance').show();
                  $('.buyDisp').show();
                  $('#change-usd-rates').show();
                  $('#cfa_amount').show();
                  $('#btc_amount').show();

                  
                  function SwapDivsWithClick() {
                   
                   if($('.first').is(":visible")){
                     $('.first').hide();
                     $('.cfaBalance').hide();
                     $('.buyDisp').hide();
                     $('#change-usd-rates').hide();
                     $('#cfa_amount').hide();
                     $('#btc_amount').hide();
                     
                     $('.second').show();
                     $('.btcBalance').show();
                     $('.sellDisp').show();
                     $('#change-usd-rates2').show();
                     $('#cfa_amount2').show();
                     $('#btc_amount2').show();

                   }else{
                     $('.first').show();
                     $('.cfaBalance').show();
                     $('#change-usd-rates').show();
                     $('.buyDisp').show();
                     $('#cfa_amount').show();
                     $('#btc_amount').show();

                     $('.second').hide();
                     $('.btcBalance').hide();
                     $('.sellDisp').hide();
                     $('#change-usd-rates2').hide();
                    $('#cfa_amount2').hide();
                    $('#btc_amount2').hide();

                   }
 }


// ================= Buy Conversion   ==============//

$("#cfa_amount").change(function() {
 $("#btc_amount").val($("#cfa_amount").val()/<?php echo $cfa;?>);
});

$("#btc_amount").change(function() {
  $("#cfa_amount").val($("#btc_amount").val()*<?php echo $cfa;?> );
});

$("#cfa_amount").keyup(function() {
  $("#btc_amount").val($("#cfa_amount").val()/<?php echo $cfa;?>);
  
 // $("#change-usd-rates").text($("#cfa_amount").val()*<?php echo (1/$cfavalue);?>);   
});

$("#btc_amount").keyup(function() {
  $("#cfa_amount").val($("#btc_amount").val() *<?php echo $cfa;?>);
 // $("#change-usd-rates").text($("#btc_amount").val()*<?php echo ($btc);?>);
});


// ================= Sell Conversion   ==============//




$("#cfa_amount2").change(function() {
 $("#btc_amount2").val($("#cfa_amount2").val()*<?php echo $cfa2;?>);
});

$("#btc_amount2").change(function() {
  $("#cfa_amount2").val($("#btc_amount2").val()/<?php echo $cfa2;?> );
});

$("#cfa_amount2").keyup(function() {
  $("#btc_amount2").val($("#cfa_amount2").val()*<?php echo $cfa2;?>);
  
 // $("#change-usd-rates2").text($("#cfa_amount2").val()*<?php echo $btc;?>);
  


});

$("#btc_amount2").keyup(function() {
  $("#cfa_amount2").val($("#btc_amount2").val() /<?php echo $cfa2;?>);
 // $("#change-usd-rates2").text($("#btc_amount2").val()*<?php echo (1/$cfavalue);?>);
});

/*
function SwapDivsWithClick() {
   $('.swapIt:last').insertBefore($('.swapIt:first'));
   // $('.swapper-first, .swapper-other').first().before(function(){
   //     return $(this).next();
 //   });
}
   */                                                             



   </script>
    
@endsection

     
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

