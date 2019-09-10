

<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php
$page = file_get_contents('https://bitpay.com/api/rates');
$my_array = json_decode($page, true);
@$bit_coin = $my_array[0]["rate"];
@$bit_code = $my_array[0]["code"];
@$usd_code = $my_array[2]["code"];
@$usd_rate = $my_array[2]["rate"];
   $cfa      =btcBuyValue();
   $cfa2     =btcSellValue();

?>
<?php $__env->startSection('content'); ?>

	<div class="col-xl-4 col-lg-12">
    	&nbsp;
    </div>
    
    <div class="col-xl-8 col-lg-12" style="margin-left:200px;">
        <h6 class="my-2"><?php echo $page_title; ?></h6>
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="card-text">
                        <div class="row">
                        	<form class="form-horizontal form-purchase-token row" method="post" action="<?php echo e(route('exchange-fund')); ?>">
                            	<?php echo e(csrf_field()); ?>

                                <input type="hidden" name="usd_rate" id="usd_rate" value="<?=$usd_rate?>">
                                
                                <div class="col-md-12 col-12">
                                   <h6>You are converting from:</h6>
                                </div>

                                <div class="col-md-2 col-12 text-center" style="margin-top:20px;">
                                    <select name="from_wallet" id="from_wallet" class="custom-select">
                                        <option value="USD" selected>USD</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-10 col-12 text-center" style="margin-top:20px;">
                                   <label for="ico-token">Wallet Balance: 0 USD</label>
                                </div>
                                
                                <div class="col-md-2 col-12 text-center" style="margin-top:20px;">
                                   <button type="button" id="calculator-swap-button" class="btn-primary btn"><i class="fa fa-exchange"></i></button>
                                </div>
                                
                                <div class="col-md-8 col-12" style="margin-top:20px;">
                                    <fieldset class="form-label-group mb-0">
                                    <?php if(Auth::user()->balance != 0): ?>
                                        <input type="text" class="form-control" name="from_amount" id="from_amount" autocomplete="off" value="<?php echo e(Auth::user()->balance); ?>">
                                    <?php else: ?>
                                    	<input type="text" class="form-control" name="from_amount" id="from_amount" autocomplete="off" placeholder="0">
                                    <?php endif; ?>
                                    </fieldset>
                                </div>
                                

                                <div class="col-md-12 col-12" style="margin-top:50px;">
                                    <h6>You will receive:</h6>
                                </div>
                                
                                <div class="col-md-2 col-12" style="margin-top:20px;">
                                    <select name="to_wallet" class="custom-select">
                                        <option value="BTC" selected>BTC</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-10 col-12 text-center" style="margin-top:20px;">
                                   <label for="ico-token">Wallet Balance: 0 BTC</label>
                                </div>
                                
                                <div class="col-md-2 col-12 text-center" style="margin-top:30px;">
                                   &nbsp;
                                </div>
                                
                                <div class="col-md-8 col-12" style="margin-top:30px;">
                                    <fieldset class="form-label-group mb-0">
                                        <input type="text" class="form-control" name="to_amount" id="to_amount" autocomplete="off" readonly placeholder="0" required>
                                    </fieldset>
                                </div>
                                
                                <div class="col-md-12 col-12" style="margin-top:30px;">
                                    <h3 align="center">CURRENT RATE</h3>
    								<hr style="width:300px; background-color:#0BAA3B;">
                                    <p align="center">1 BTC <span>~</span> <span><?=$usd_rate?></span> USD</p>
                                </div>
                                
                                <div class="col-md-3 col-12 text-center">
                                	&nbsp;
                                </div>
                                
                                <div class="col-md-6 col-12 text-center" style="margin-top:30px;">
                                    <button type="submit" class="btn btn-primary btn-block">Convert</button>
                                </div>
                                
                                 <div class="col-md-3 col-12 text-center">
                                	&nbsp;
                                </div>
                                
                                <div class="col-md-12 col-12 text-center" style="margin-top:30px;">
                                   Please keep in mind that the prices of digital currencies are volatile. Prices may go up or down at any time.
                                </div>
                                
                                
                            </form>
            			</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!--<?php if(session('success')): ?>
    <div class="modal fade" id="mySuccessModal" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body">
              <div align="center"><i class="fa fa-check-circle" style="font-size:85px;color:green;margin-bottom:5%;"></i></div>
              <h5 align="center" style="margin-bottom:5%;">Success!</h5>
              <div style="width: 50%;margin: 2% 25%;text-align: -webkit-center;">
              <p style="margin-bottom:20%;">You have successfully exchanged and request is sent to admin. Kindly check corresponding wallet.</p>
              
              <button type="button" class="btn btn-primary model_ok_btn">OK!</button>
              </div>
            </div>
          </div>
        </div>
    </div>
    <?php endif; ?>
    
    <?php if(session('alert')): ?>
    <div class="modal fade" id="myErrorModal" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body">
              <div align="center"><i class="fa fa-check-circle" style="font-size:85px;color:green;margin-bottom:5%;"></i></div>
              <h5 align="center" style="margin-bottom:5%;">Error!</h5>
              <div style="width: 50%;margin: 2% 25%;text-align: -webkit-center;">
              <p style="margin-bottom:20%;">You have successfully exchanged and request is sent to admin. Kindly check corresponding wallet.</p>
              
              <button type="button" class="btn btn-primary model_ok_btn">OK!</button>
              </div>
            </div>
          </div>
        </div>
    </div>
   <?php endif; ?>-->
    
<?php $__env->stopSection(); ?>

   

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
<script>
$(document).ready(function() {
	
	var fwallet = $("#from_wallet").val();
    $(document).on('keyup','#from_amount',function(){
			var usd = $(this).val();	
		/*var usd_rate = $("#usd_rate").val();
		var bitrate = (usd_rate / 100000000);
		var exg = (usd) * bitrate;*/
			$.ajax({
				method: 'POST', // Type of response and matches what we said in the route
				//url: "http://localhost:8081/bitcoin/user/updateuserwallet", // This is the url we gave in the route
				url: "https://blockchain.info/tobtc?currency="+fwallet+"&value="+usd, // This is the url we gave in the route
				success: function(response){ // What to do if we succeed
					//alert(response);
					$("#to_amount").val(response);
				},
				error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
					console.log(JSON.stringify(jqXHR));
					console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
				}
			});
	});
	//$(document).on('load','#from_amount',function(){
		var usd = $("#from_amount").val();
		if(usd != 0)
		{
			$.ajax({
				method: 'POST',
				url: "https://blockchain.info/tobtc?currency="+fwallet+"&value="+usd,
				success: function(response){ 					
					$("#to_amount").val(response);
				},
				error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
					console.log(JSON.stringify(jqXHR));
					console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
				}
			});
		}
	//});
});
/*function calculate_bitcoin()
{
	var usd = $("#from_amount").val();
	var bitrate = 100000000;
	var exg = (usd/bitrate);
	$("#to_amount").val(exg);
}*/
</script>
<?php echo $__env->make('layouts.user-frontend.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>