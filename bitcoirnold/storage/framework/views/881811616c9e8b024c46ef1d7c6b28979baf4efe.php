<?php $__env->startSection('content'); ?>
 
 <style>
        
.card {

    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0,0,0,.125);
    border-radius: .25rem;
    margin-bottom: 30px;

}

.float-shadow:hover {
    -webkit-transform: translateY(-4px) scale(1.02);
    -moz-transform: translateY(-4px) scale(1.02);
    -ms-transform: translateY(-4px) scale(1.02);
    -o-transform: translateY(-4px) scale(1.02);
    transform: translateY(-4px) scale(1.02);
    -webkit-box-shadow: 0px 14px 24px rgba(62, 57, 107, 0.2);
    box-shadow: 0px 14px 24px rgba(62, 57, 107, 0.2);
    z-index: 999;
}

.input-group-addon {
    padding: 10px !important;
}


.modal-body {
    padding: 2rem !important;
}


.float-shadow {

    box-shadow: 3px 17px 24px rgba(0, 0, 0, 0.33);
    border: 1px solid #f3f3f3;

}

.p-md-3 {
    padding: 3rem!important;
    font-size: 20px;

}


.span-size {

    font-size: 15px !important;

}

.big, .big-text {

    font-weight: bold;
    font-size: 30px;
    vertical-align: middle;

}

.big, .big-text {

    font-weight: bold;
    font-size: 30px;
    vertical-align: middle;

}

        .price-table {
            margin-bottom: 45px;
        }
        .modal {

    top: 86px !important;
        }
</style>

<?php

$url='https://bitpay.com/api/rates';
$json=json_decode( file_get_contents( $url ) );
$dollar=$btc=0;

foreach( $json as $obj ){
    if( $obj->code=='USD' )$btc=$obj->rate;
}
$dollar=1 / $btc;

//echo "dddd".$dollar;
//  
//$cfa = round($dollar * ((1/$cfavalues->cfa_value) /$basic_setting->btc_buy_commision),8);
//
//$cfa2 = round($dollar * ((1/$cfavalues->cfa_value) *$basic_setting->btc_sell_commision),8);

$cfa      =btcBuyValue();
$cfa2     =btcSellValue();
?>
<div class="row">
    <div class="col-md-12">
		<div class="row">
            <div class="col-md-12">
                <h3 class="page_title" style="text-align: -webkit-center;"><?php echo $page_title; ?></h3>
                <hr>
            </div>
        </div>
         <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12">
                     
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
                        
                        
                    </div>
                </div>
        </div>
    </div>
</div>
<!-- model section -->

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
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="float: right;">Close</button>
        
        <button type="button" class="btn btn-success" style="float: right;margin-right: 15px;"><a href="<?php echo e(url('user/wallet')); ?>">Buy BTC</a></button>
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
                                
                                <input id="B2" class="form-control nomargin text-right disableButton" data-currency-calc="true" type="text" value="<?php echo $cfa2;?> " placeholder="Enter amount" data-original-title="" title="">
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="float: right;">Close</button>
        
        <button type="button" class="btn btn-success" style="float: right;margin-right: 15px;"><a href="javascript:;" data-toggle="modal" data-target="#sellCoinModal">Sell BTC</a></button>
      </div>
    </div>
  
    </div>
  </div>
</div>
<!-- ============== Sell Model ============-->
<div class="modal fade" id="sellCoinModal" tabindex="-1" role="dialog" aria-labelledby="CurConversionModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <h5  style="margin-top:20%; margin-top: 3%; margin-left: 142px;"><span class="input-group-addon"><img width="20px" height="20px" src="https://assets.coinmama.com/bitcoin.png">&nbsp; Sell BitCoin</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        
      </div>
      <div class="modal-body">
            <form action="<?php echo e(url('user/sellbtc-request')); ?>" id="myFormSellcoin" role="form" data-toggle="validator" method="post" accept-charset="utf-8" style="width:100%;">
                    <?php echo e(csrf_field()); ?>

                    
         
                       <div class="form-group">
                                <label for="cfa">Current Bitcoin  Balance</label>
                                    <input type="text" class="form-control text-right" name="btc_balance" id="btc_balance_sell" value="<?php echo e(Auth::user()->bitcoin); ?>" readonly>
                                <div class="help-block with-errors"></div>
                        </div>
                        
                        <div class="form-group">
                            <label for="name">Please Enter BTC Amount that wants to Sell. </label>
                                <input type="text" class="form-control text-right" autocomplete="off" name="sendbtcamounts" id="sendbtcamounts" placeholder="0" required>
                            <div class="help-block with-errors"></div>
                        </div>
         
                        <div class="form-group">
                            <label for="cashout">Sell BTC Commission (in BTC)</label>
                                   <input type="text" class="form-control text-right" autocomplete="off" name="cash_in_commision" id="cash_in_commision" placeholder="0"  value="<?php echo e($dollar*$basic->btc_sell_commision); ?>" readonly>
                            <div class="help-block with-errors"></div>
                        </div>
         
                       
      </div>
 <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type='submit' id='final' class='btn btn-primary' value='Sell'>
        
      </div>
</form>
    </div>
  </div>
</div>
<script src="<?php echo e(asset('assets/dashboard/assets/js/jquery-1.12.4.min.js')); ?>"></script>
<?php if(session('success')): ?>
	<script type="text/javascript">
        $(document).ready(function(){

            swal("Success!", "<?php echo e(session('success')); ?>", "success");

        });
    </script>
<?php endif; ?>

<?php if(session('alert')): ?>
    <script type="text/javascript">
        $(document).ready(function(){
            swal("Sorry!", "<?php echo e(session('alert')); ?>", "error");
        });

    </script>
<?php endif; ?> 
<script type="text/javascript">
 $("#A1").change(function() {
     
     
 $("#B1").val($("#A1").val()*<?php echo $cfa;?>);
 console.log( $("#usdval1").val() );
 
  $("#usdval1").val($("#A1").val()/<?php echo ($cfavalues->cfa_value);?>);
});


$("#B1").change(function() {
    $("#A1").val(<?php echo $cfa;?>/$("#B1").val() );
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
    $("#A1").val($("#B1").val() / <?php echo $cfa;?>);
});
 </script>
 
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

<?php echo $__env->make('layouts.user-frontend.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>