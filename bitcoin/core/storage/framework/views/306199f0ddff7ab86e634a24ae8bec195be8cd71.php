<?php $__env->startSection('style'); ?>

    <link rel="stylesheet" href="<?php echo e(asset('assets/css/ion.rangeSlider.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/ranger-style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/ion.rangeSlider.skinFlat.css')); ?>">
    <style>
        .price-table {
            margin-bottom: 45px;
        }
        .modal {

    top: 86px !important;
        }
    </style>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<section class="header-section ">
    <div class="head-slider">


        <?php $__currentLoopData = $slider; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="single-header slider header-bg" style="background-image: url('<?php echo e(asset('assets/images/slider')); ?>/<?php echo e($s->image); ?>')">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div class="header-slider-wrapper">
                                <h1><?php echo e($s->title); ?></h1>
                                <p><?php echo e($s->subtitle); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>
</section><!--Header section end-->

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
$dollar=1 / $btc;
/*
echo "usd to btc".$dollar;
echo "<br/>";
echo "btc to usd".$btc;
echo "<br/>";
echo "cfa to btc".$dollar/$cfavalues->cfa_value;
echo "<br/>";
echo "btc to cfa".$btc*$cfavalues->cfa_value;
echo "<br/>";
echo "1 btc 20 $ sell commission".($btc-$basic_setting->btc_sell_commision)*$cfavalues->cfa_value;
echo "<br/>";
echo "1 cfa to btc 20$ Buy commission".(($dollar/$cfavalues->cfa_value) +($dollar/($cfavalues->cfa_value*$basic_setting->btc_buy_commision)));
echo "<br/>";
//echo "20 $ commision in btc".($dollar*$basic_setting->btc_buy_commision);
//echo "20 $ usd to cfa ".((1/$cfavalues->cfa_value)*$basic_setting->btc_buy_commision);
$cfa = round((($dollar/$cfavalues->cfa_value) +($dollar/($cfavalues->cfa_value*$basic_setting->btc_buy_commision))),8);
$cfa2 = round(($btc-$basic_setting->btc_sell_commision)*$cfavalues->cfa_value);
//$cfa = round($dollar * ((1/$cfavalues->cfa_value) /$basic_setting->btc_buy_commision),8);

//$cfa2 = round($dollar * (($btc-$basic_setting->btc_sell_commision)*$cfavalues->cfa_value),8);
*/
   $cfa      =btcBuyValue();
   $cfa2     =btcSellValue();
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
<!--                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group input-group-lg">
                                <input name="qty" id="btc" class="form-control nomargin disableButton" type="text" value="1" placeholder="Enter amount" data-original-title="" title="" onkeyup="update_('btc', this)">
                                <span class="input-group-addon"><img width="20px" height="20px" src="https://assets.coinmama.com/bitcoin.png">&nbsp;BTC</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon" data-currency-symbol="true">CFA</span>
                                <input id="usdbtc" class="form-control nomargin text-right disableButton" data-currency-calc="true" type="text" value="<?php //echo $btc *$cfavalues->cfa_value;?>" placeholder="Enter amount" data-original-title="" title="" onkeyup="update_('btc', this)">
                            </div>
                        </div>
                    </div>-->
                    <br>
<!--                    <input type="submit" class="btn btn-call buyButton formBuy wide" style="background-color: #135577; border-color: #0f4561;    width: 30%;" data-type="btc" value="Buy BTC" id="final_btn">-->
						<a href="<?php echo e(route('login')); ?>" class="btn btn-call buyButton formBuy wide">Buy /Sell BTC</a>
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
        
        <h5  style="margin-top:20%; margin-top: 3%; margin-left: 142px;">CFA to BTC  Buy Conversion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        
      </div>
      <div class="modal-body">
          <div class="row">
                        
                        <div class="col-sm-6">
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon" data-currency-symbol="true">CFA</span>
                                
                                <input id="A1" class="form-control nomargin text-right disableButton" data-currency-calc="true" type="text" value="5000" placeholder="Enter amount" data-original-title="" title="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group input-group-lg">
                                <input  id="B1" class="form-control nomargin disableButton" type="text" value="<?php echo (5000*$cfa);?>" placeholder="Enter amount" data-original-title="" title="" >
                                <span class="input-group-addon"><img width="20px" height="20px" src="https://assets.coinmama.com/bitcoin.png">&nbsp;BTC</span>
                            </div>
                        </div>
                    </div>
          
              <div>
                  <i class="text-danger" id="amount_less_error"></i>
              </div>
      </div>
     <div class="modal-footer">
        <div class="col-sm-6">
            <div class="input-group input-group-lg" style=" margin-left: 11px;">
                <span class="input-group-addon" data-currency-symbol="true"><i class="fa fa-usd" aria-hidden="true"></i></span>
                                
                <input id="usdval1" class="form-control nomargin text-right"  type="text"  readonly="">
            </div>
        </div>
     <div class="col-sm-6" style="">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
        <button type="button" class="btn btn-primary"><a href="<?php echo e(route('login')); ?>" >Buy BTC</a></button>
     
     </div>
     </div>
    </div>
  </div>
</div>
<div class="modal fade" id="cfaTobtcModel" tabindex="-1" role="dialog" aria-labelledby="#cfaTobtcModelLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <h5  style="margin-top:20%; margin-top: 3%; margin-left: 142px;">BTC to CFA Sell Conversion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        
      </div>
      <div class="modal-body">
          <div class="row">
                        
                       
                        <div class="col-sm-6">
                            <div class="input-group input-group-lg">
                                <input  id="A2" class="form-control nomargin disableButton" type="text" value="1" placeholder="Enter amount" data-original-title="" title="" >
                                <span class="input-group-addon"><img width="20px" height="20px" src="https://assets.coinmama.com/bitcoin.png">&nbsp;BTC</span>
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
                            <div class="input-group input-group-lg" style=" margin-left: 11px;">
                                 <span class="input-group-addon" data-currency-symbol="true"><i class="fa fa-usd" aria-hidden="true"></i></span>
                                
                                 <input id="usdval2" class="form-control nomargin text-right"  type="text"  readonly="" value="<?php echo $btc;?>">
                            </div>
    </div>
    <div class="col-sm-6" style="">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
        <button type="button" class="btn btn-primary"><a href="<?php echo e(route('login')); ?>" >Sell BTC</a></button>
    </div>
  </div>
  
    </div>
  </div>
</div>
    </div>
</section>






<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script type="text/javascript" src="<?php echo e(asset('assets/js/ion.rangeSlider.js')); ?>"></script>
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
                prefix: '<?php echo e($basic->symbol); ?> ',
                hide_min_max: true,
                force_edges: true,
                onChange: function(val) {
                    $val.val( '<?php echo e($basic->symbol); ?> ' + val.from);

                    var profit = (val.from * perDay / 100).toFixed(1);
                    profit  = '<?php echo e($basic->symbol); ?> ' + profit.replace('.', '.') ;
                    $dailyProfit.text(profit) ;

                    profit = ( (val.from * perDay / 100)* perYear ).toFixed(1);
                    profit  =  '<?php echo e($basic->symbol); ?> ' + profit.replace('.', '.');
                    $totalProfit.text(profit);

                }
            });
        });
        $('.invest-type__profit--val').on('change', function(e) {

            var slider = $($(this).data('slider')).data("ionRangeSlider");

            slider.update({
                from: $(this).val().replace('<?php echo e($basic->symbol); ?> ', "")
            });
        })
    </script>
    
<!--	
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>

<script>
var ember = [];
var usdInput = document.getElementById("usdbtc");
var btcInput = document.getElementById("btc");

ember.btcPrice = <?php echo e($btc); ?>;
ember.socket = io.connect('https://bitpay.com/api/rates');
ember.socket.on('trades', function(data) {
	//alert(JSON.stringify(data));
  var amt = document.getElementById("usdbtc");
    if (data.coin == "BTC") {
        ember.amtUSD = usdInput.value;
        ember.amtBTC = btcInput.value;
        ember.usdCalc = ember.amtBTC * data.msg.price;
        if(data.msg.price > amt.value) {
          $(amt).addClass('increment');
        } else {
          $(amt).addClass('decrement');
        }
        $("#usdbtc").attr("value", ember.usdCalc);
        setTimeout(function () {
            $(amt).removeClass('increment decrement');
        }, 700);
    }
});

$("#btc").bind("change paste keyup", function() {
    ember.usdCalc = $(this).val() * ember.btcPrice;
    $("#usdbtc").attr("value", ember.usdCalc*<?php echo e($cfavalues->cfa_value); ?>);
});



</script>
-->
<!--- ============= Buy conversion ------->
<script type="text/javascript">
 $("#A1").change(function() {
 $("#B1").val($("#A1").val()*<?php echo $cfa;?>);
});

$("#B1").change(function() {
    $("#A1").val($("#B1").val() / <?php echo $cfa;?>);
   // $("#A1").val(<?php //echo $cfa;?>/$("#B1").val() );
});

$("#A1").keyup(function() {
    $("#B1").val($("#A1").val()*<?php echo $cfa;?>);
     $("#usdval1").val($("#A1").val()/<?php echo ($cfavalues->cfa_value);?>);
    if($(this).val() < 5000)
        $("#amount_less_error").text("Minimum amount should not less then 5000 in CFA");
    else
        $("#amount_less_error").text("");
});

$("#B1").keyup(function() {
    //$("#A1").val(<?php //echo $cfa;?>/$("#B1").val() );
    $("#A1").val($("#B1").val() / <?php echo $cfa;?>);
});
 </script>
 
 <!--- ============= Buy conversion ------->
 
 <script type="text/javascript">
 $("#A2").change(function() {
 $("#B2").val($("#A2").val()*<?php echo $cfa2;?>);
});

$("#B2").change(function() {
    $("#A2").val($("#B2").val() /<?php echo $cfa2;?> );
});

$("#A2").keyup(function() {
    $("#B2").val($("#A2").val()*<?php echo $cfa2;?>);
    $("#usdval2").val($("#A2").val()*<?php echo ($btc);?>);
});

$("#B2").keyup(function() {
    $("#A2").val($("#B2").val() / <?php echo $cfa2;?>);
});
 </script>


	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.fontEnd', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>