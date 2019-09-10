@extends('layouts.fontEnd')
@section('style')

    <link rel="stylesheet" href="{{ asset('assets/css/ion.rangeSlider.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/ranger-style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/ion.rangeSlider.skinFlat.css') }}">
    <style>
        .price-table {
            margin-bottom: 45px;
        }
        .modal {

    top: 86px !important;
        }
    select:focus {
    outline-offset: -2px;
    border: none!important;
    outline: none!important;
    }
    .modal-header .close {
    margin-top: -37px!important;
    font-size: 37px;
    }

    .modal-header {
    /* padding: 15px; */
    /* border-bottom: 1px solid #e5e5e5; */
    text-align: center!important;
    }
    </style>

@endsection
@section('content')
<section class="header-section ">
    <div class="head-slider">


        @foreach($slider as $s)
            <div class="single-header slider header-bg" style="background-image: url('{{ asset('assets/images/slider') }}/{{ $s->image }}')">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div class="header-slider-wrapper">
                                <h1>{{ $s->title }}</h1>
                                <p>{{ $s->subtitle }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach

    </div>
</section><!--Header section end-->

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

  $usdBuyVal = usdBuyValue();
  $usdSellVal = usdSellValue();
?>
<section class="completed-projcets section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title text-center">
                    <h2>Bitcoin Exchange Rate</h2>
                </div>
            </div>
        </div>
        <div align="center" class="form-body">
            


            <div class="col-md-8 col-md-offset-2 text-center" id="hpsilderbtc" style="margin-top: 5%;">
                <form action="/place_order?" method="get" id="form_btc">

                    <input type="hidden" name="item" value="btc">
                    <input type="hidden" data-input-cur="true" name="cur" value="usd">

                    <input id="slider_btc" value="0.49" onchange="update_('btc', this)" style="display: none;"><span class="jslider jslider_mama jslider-single"><table><tbody><tr><td><div class="jslider-bg"><i class="l"></i><i class="f"></i><i class="r"></i><i class="v"></i></div><div class="jslider-pointer" style="left: 68.3%; z-index: 2;"></div><div class="jslider-pointer jslider-pointer-to"></div><div class="jslider-label" style=""><span>0.01451686</span></div><div class="jslider-label jslider-label-to" style="display: block;"><span>0.71132626</span>&nbsp;btc</div><div class="jslider-value" style="left: 68.3%; margin-left: 0px; right: auto;"><span>0.49</span>&nbsp;btc</div><div class="jslider-value jslider-value-to"><span></span>&nbsp;btc</div><div class="jslider-scale"><span style="left: 0%"><ins style="margin-left: -11.5px;">0.015</ins></span><span style="left: 10%"><ins style="margin-left: -11.5px;">0.087</ins></span><span style="left: 20%"><ins style="margin-left: -11.5px;">0.160</ins></span><span style="left: 30%"><ins style="margin-left: -11.5px;">0.232</ins></span><span style="left: 40%"><ins style="margin-left: -11.5px;">0.305</ins></span><span style="left: 50%"><ins style="margin-left: -11.5px;">0.377</ins></span><span style="left: 60%"><ins style="margin-left: -11.5px;">0.450</ins></span><span style="left: 70%"><ins style="margin-left: -11.5px;">0.523</ins></span><span style="left: 80%"><ins style="margin-left: -11.5px;">0.595</ins></span><span style="left: 90%"><ins style="margin-left: -11.5px;">0.668</ins></span><span style="left: 100%"><ins style="margin-left: -11px;">0.711</ins></span></div></td></tr></tbody></table></span>
                    <br><br><br>
                    <div class="row">
                    <div class="col-sm-6 text-center">
                        <a href="javascript:;" class="text-dark disable-hover" data-toggle="modal" data-target="#btcTocfaModel">
                            <div class="card float-shadow">
                                <!-- <img class="card-img-top" src="" alt=""> -->
                                <div class="card-body p-2 p-md-3">
                                    <small class="span-size">Buy Bitcoin</small>
                                    <br>
                                    <span class="big-text pl-3 pr-3">CFA</span>
                                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                    <span class="big-text pl-3 pr-3">BTC</span>
                              </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6 text-center">
                        <a href="javascript:;" class="text-dark disable-hover" data-toggle="modal" data-target="#cfaTobtcModel">
                            <!-- <img class="img img-fluid" src="../../assets/img/btc-CFA.PNG" alt=""> -->
                            <div class="card float-shadow">
                                <!-- <img class="card-img-top" src="" alt=""> -->
                                <div class="card-body p-2 p-md-3">
                                    <small class="span-size">Sell Bitcoin</small>
                                    <br>
                                    <span class="big-text pl-3 pr-3">BTC</span>
                                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                    <span class="big-text pl-3 pr-3">CFA</span>
                              </div>
                            </div>
                        </a>
                        
                    </div>
                </div>

                    <br>

                        <a href="{{ url('user/buy-bitcoin') }}" class="btn btn-call buyButton formBuy wide">Buy /Sell BTC</a>
                    <br>
                </form>
                <br><br>
            </div>
            
            
            <div style="background:#FFFFFF" class="text-center">
              <img style="max-width:100%; height: auto;" src="https://www.coinmama.com/assets/img/moplogos2.png">
            </div>

        </div>
    </div>
</section>



<!--About community Section Start-->
<section class="section-padding about-community">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!--<div class="section-title text-center">
                    <div class="single-investor-wrapper  ">
                    <h3 style="color: #000000; font-size: 32pt; font-family: Lato,sans-serif;">Instantly Load Your beep™ Card With Your Android Phone!</h3>
                    <p>Easily load your beep™ card from your Coins.ph wallet. It’s instant, available 24/7, and has no fees!</p>
                </div>-->
             
                    <h3 style="color: #000000; font-size: 32pt; font-family: Lato,sans-serif;">Instantly Load Your beep™ Card With Your Android Phone!</h3>
                    <p>Easily load your beep™ card from your CT-PAY wallet. It’s instant, available 24/7, and has no fees!</p>
                   <!-- <p>Pay bills, buy load, buy bitcoin and send money – even without a bank account!</p>
                    <iframe width="640" height="360" src="https://www.youtube.com/embed/FG3cfiEyjBM" frameborder="0" allowfullscreen="true"></iframe>-->
                </div>
            </div>
        </div>
    <!--=============== Model areas  ================ -->
<div class="modal fade" id="btcTocfaModel" tabindex="-1" role="dialog" aria-labelledby="btcTocfaModelLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        {{-- <h5 class="modal-title" id="exampleModalLabel" align="center" style="margin-left: 37%;"><i class="fa fa-id-card" style="font-size:85px;color:green;margin-bottom:5%;"></i></h5> --}}
        <h5  style="margin-top:20%; margin-top: 3%; ">CFA to BTC  Buy Conversion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        
      </div>
      <div class="modal-body">
          <div class="row">
                        
                        <div class="col-sm-6">
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon" data-currency-symbol="true">CFA</span>
                                
                                <input id="B1" class="form-control nomargin text-right disableButton" data-currency-calc="true" type="text" value="5000" placeholder="Enter amount" data-original-title="" title="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                           
                            <div class="input-group input-group-lg">
                                <input  id="A1" class="form-control nomargin disableButton" type="text" value="<?php echo (5000/$cfa);?>" placeholder="Enter amount" data-original-title="" title="" >

                                <input  id="A12" class="form-control nomargin disableButton" type="text" value="<?php echo 1;?>" placeholder="Enter amount" data-original-title="" title="" >
                                <span class="input-group-addon">
                                      <select class="text-right" onchange="getval(this);" style="border: none;background: #ededed;">
                                    <option value="BTC">BTC</option>
                                    <option value="USD">USD</option>
                                    </select>
                                </span>
                            </div>
                        </div>
                    </div>
          
              <div>
                  <i class="text-danger" id="amount_less_error"></i>
              </div>
      </div>
     <div class="modal-footer">
        <div class="col-sm-6">
            <div class="" style=" margin-left: 11px;">
                <span class="data-currency-symbol="true"">~ </span>
                <span id="usdval1" class=" nomargin text-right"> 0 </span> <span class="usdcur">USD</span>
                <span id="btcval1" class=" nomargin text-right"> 0</span> <span class="btccur">BTC</span>
            </div>
        </div>
     <div class="col-sm-6" style="">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
        <button type="button" class="btn btn-primary"><a href="{{ url('user/buy-bitcoin') }}" >Buy BTC</a></button>
     
     </div>
     </div>
    </div>
  </div>
</div>
<div class="modal fade" id="cfaTobtcModel" tabindex="-1" role="dialog" aria-labelledby="#cfaTobtcModelLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        {{-- <h5 class="modal-title" id="exampleModalLabel" align="center" style="margin-left: 37%;"><i class="fa fa-id-card" style="font-size:85px;color:green;margin-bottom:5%;"></i></h5> --}}
        <h5  style="margin-top:20%; margin-top: 3%; ">BTC to CFA Sell Conversion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        
      </div>
      <div class="modal-body">
          <div class="row">
                        
                       
                        <div class="col-sm-6">
                            <div class="input-group input-group-lg">
                                 <span class="input-group-addon">
                                      <select class="text-right" onchange="getval1(this);" style="border: none;background: #ededed;">
                                    <option value="BTC">BTC</option>
                                    <option value="USD">USD</option>
                                    </select>
                                </span>
                                <input  id="A2" class="form-control nomargin disableButton" type="text" value="1" placeholder="Enter amount" data-original-title="" title="" >
                                <input  id="A21" class="form-control nomargin disableButton" type="text" value="<?php echo 1;?>" placeholder="Enter amount" data-original-title="" title="" >
                               
                              <!--   <span class="input-group-addon"><img width="20px" height="20px" src="https://assets.coinmama.com/bitcoin.png">&nbsp;BTC</span> -->
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon" data-currency-symbol="true">CFA</span>
                                
                                <input id="B2" class="form-control nomargin text-right disableButton" data-currency-calc="true" type="text" value="<?php echo ($cfa2);?> " placeholder="Enter amount" data-original-title="" title="">
                            </div>
                        </div>
                    </div>
      </div>
 <div class="modal-footer">
    <div class="col-sm-6">
                            <div class="" style=" margin-left: 11px;">
                                 <span class="" data-currency-symbol="true">~ </span>
                                 <span id="usdval2" class=" nomargin text-right" > 0</span><span class="usdcur2"> USD</span>
                                 <span id="btcval2" class=" nomargin text-right" > 0</span>
                                 <span class="btccur2"> BTC</span>
                            </div>
    </div>
    <div class="col-sm-6" style="">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
        <button type="button" class="btn btn-primary"><a href="{{ url('user/sell-coin') }}" >Sell BTC</a></button>
    </div>
  </div>
  
    </div>
  </div>
</div>
    </div>
</section>

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!--- ============= Buy conversion ------->
<script type="text/javascript">
$("#usdval1").text($("#B1").val()/<?php echo $cfavalue;?>);
 $("#A1").change(function() {
 $("#B1").val($("#A1").val()*<?php echo $cfa;?>);
});

$("#B1").change(function() {
    $("#A1").val($("#B1").val() / <?php echo $cfa;?>);
  
});

$("#A1").keyup(function() {
    $("#B1").val($("#A1").val()*<?php echo $cfa;?>);
     $("#usdval1").text($("#A1").val()*<?php echo $usdBuyVal;?>);
    if($(this).val() < 5000)
        $("#amount_less_error").text("Minimum amount should not less then 5000 in CFA");
    else
        $("#amount_less_error").text("");
});

$("#B1").keyup(function() {
   
    $("#A1").val($("#B1").val() / <?php echo $cfa;?>);
    $("#A12").val($("#B1").val() / <?php echo $cfavalue;?>);
    $("#usdval1").text($("#B1").val()/<?php echo $cfavalue;?>);
    $("#btcval1").text($("#B1").val()/<?php echo $cfa;?>);
});

 $("#A12").keyup(function() {
   
    $("#B1").val($("#A12").val()*<?php echo $cfavalue;?>);
     $("#btcval1").text($("#A12").val()/<?php echo $btc;?>);
});

     
 </script>
 
 <!--- ============= Sell conversion ------->
 
 <script type="text/javascript">
 $("#usdval2").text($("#A2").val()*<?php echo $usdSellVal;?>);

 $("#A2").change(function() {
 $("#B2").val($("#A2").val()*<?php echo $cfa2;?>);
});

$("#B2").change(function() {
    $("#A2").val($("#B2").val() /<?php echo $cfa2;?> );
});

$("#A2").keyup(function() {
    $("#B2").val($("#A2").val()*<?php echo $cfa2;?>);
   
    $("#usdval2").text($("#A2").val()*<?php echo $usdSellVal;?>);
});

$("#B2").keyup(function() {
    $("#A2").val($("#B2").val() / <?php echo $cfa2;?>);
    $("#A21").val($("#B2").val()/<?php echo $cfavalue;?>);
    $("#usdval2").text($("#B2").val()/<?php echo $cfavalue;?>);
    $("#btcval2").text($("#B2").val()/<?php echo $cfa2;?>);
});


$("#A21").keyup(function() {
    $("#B2").val($("#A21").val()*<?php echo $cfavalue;?>);
    $("#btcval2").text($("#A21").val()/<?php echo $btc;?>);
});
   
 </script>


<script type="text/javascript">
    $('#A12').hide();
    $('#btcval1').hide();
    $('#A1').show();
    $('#usdval1').show();
    $('.usdcur').show();
    $('.btccur').hide();
function getval(sel){
   $('#A12').hide();
    $('#btcval1').hide();
    $('#A1').show();
    $('#usdval1').show();
    $('.usdcur').show();
    $('.btccur').hide();
 if(sel.value =='USD'){
  
     $('#A12').show();
     $('#btcval1').show();
     $('#A1').hide();
     $('#usdval1').hide(); 
     $('.usdcur').hide();
     $('.btccur').show();
     $("#B1").val($("#A12").val()* <?php echo $cfavalue;?>);
     $("#btcval1").text($("#A12").val() / <?php echo $btc;?>);
     
 }else if(sel.value =='BTC'){

    $('#A12').hide();
    $('#btcval1').hide();
    $('#A1').show();
    $('#usdval1').show();
    $('.usdcur').show();
    $('.btccur').hide();
    $("#B1").val($("#A1").val()*<?php echo $cfa;?>);
    $("#usdval1").text($("#A1").val()*<?php echo $usdBuyVal;?>);
   
}
}
    $('#A21').hide();
    $('#btcval2').hide();
    $('#A2').show();
    $('#usdval2').show();
    $('.usdcur2').show();
    $('.btccur2').hide();
function getval1(sel){
    $('#A21').hide();
    $('#btcval2').hide();
    $('#A2').show();
    $('#usdval2').show();
    $('.usdcur2').show();
    $('.btccur2').hide();
 if(sel.value =='USD'){
  
       $('#A21').show();
       $('#btcval2').show();
       $('#A2').hide();
       $('#usdval2').hide(); 
      $('.usdcur2').hide();
      $('.btccur2').show();
       $("#B2").val($("#A21").val()* <?php echo $cfavalue;?>);
       $("#btcval2").text($("#A21").val() / <?php echo $btc;?>);
     
 }else if(sel.value =='BTC'){

       $('#A21').hide();
       $('#btcval2').hide();
       $('#A2').show();
       $('#usdval2').show();
       $('.usdcur2').show();
       $('.btccur2').hide();
       $("#B2").val($("#A2").val()*<?php echo $cfa2;?>);
       $("#usdval2").text($("#A2").val()*<?php echo $usdSellVal;?>);
   
  }
}
</script>

@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('assets/js/ion.rangeSlider.js') }}"></script>
    <script>
        $.each($('.slider-input'), function() {
            var $t = $(this),

                    from = $t.data('from'),
                    to = $t.data('to'),

                    $dailyProfit = $($t.data('dailyprofit')),
                    $totalProfit = $($t.data('totalprofit')),

                    $val = $($t.data('valuetag')),

                    perDay = $t.data('perday'),
                    perYear = $t.data('peryear');


            $t.ionRangeSlider({
                input_values_separator: ";",
                prefix: '{{ $basic->symbol }} ',
                hide_min_max: true,
                force_edges: true,
                onChange: function(val) {
                    $val.val( '{{ $basic->symbol }} ' + val.from);

                    var profit = (val.from * perDay / 100).toFixed(1);
                    profit  = '{{ $basic->symbol }} ' + profit.replace('.', '.') ;
                    $dailyProfit.text(profit) ;

                    profit = ( (val.from * perDay / 100)* perYear ).toFixed(1);
                    profit  =  '{{ $basic->symbol }} ' + profit.replace('.', '.');
                    $totalProfit.text(profit);

                }
            });
        });
        $('.invest-type__profit--val').on('change', function(e) {

            var slider = $($(this).data('slider')).data("ionRangeSlider");

            slider.update({
                from: $(this).val().replace('{{ $basic->symbol }} ', "")
            });
        })
    </script>


    
@endsection