<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php
$page = file_get_contents('https://bitpay.com/api/rates');
$blockchain = file_get_contents('https://blockchain.info/ticker');

$my_array = json_decode($page, true);
$btc_array = json_decode($blockchain, true);
//print_r($btc_array);
$usd_buy  = $btc_array['USD']['buy'];
$usd_sell = $btc_array['USD']['sell'];
$bit_coin = $my_array[0]["rate"];
$bit_code = $my_array[0]["code"];
$usd_code = $my_array[2]["code"];
$usd_rate = $my_array[2]["rate"];
?>


<?php
$url='https://bitpay.com/api/rates';
$json=json_decode( file_get_contents( $url ) );
$dollar=$btc=0;

foreach( $json as $obj ){
    if( $obj->code=='USD' )$btc=$obj->rate;
}
//echo "btc".$btc;
$dollar=1 / $btc;

//echo "dddd".$dollar*20;
  
//$cfa = round($dollar * ((1/$cfavalues->cfa_value) /$basic->btc_buy_commision),8);
//
//$cfa2 = round($dollar * ((1/$cfavalues->cfa_value) *$basic->btc_sell_commision),8);
$cfa      =btcBuyValue();
$cfa2     =btcSellValue();

?>
<?php $__env->startSection('content'); ?>
    
    <!--<div class="content-header row">
        <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
        	<h3 class="content-header-title mb-0 d-inline-block">Wallet</h3>
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('user-dashboard')); ?>">Dashboard</a></li>
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
                                <h3 class="text-center " id="changebitcoin"><?php echo e(round(Auth::user()->bitcoin,8)); ?></h3>
                                <h1 class="text-center" id="currency-value-btc">BTC</h1>
                                <h3 class="text-center " id="changebalance"><?php echo e(round(Auth::user()->balance,8)); ?> CFA</h3>
                                <h1 class="text-center" id="currency-value-cfa">CFA</h1>
                            </div>
                             <div class="table-responsive">
                                  <table border="0" class="table table-de mb-0">                    
                                    <tbody>
                                      <tr>
                                      <!-- <td><a href="javascript:;" class="text-center btn btn-default"><i class="fa fa-download"></i> Request</a></td>
                                        <td><a href="javascript:;" class="text-center btn btn-default"><i class="fa fa-paper-plane"></i> Send</a></td>  -->  
                                     <td id="showReceiveSect">
                                         <a href="javascript:;" class="text-center btn btn-default" style="font-size: 12px !important;" data-toggle="modal" data-target="#walletAddressModal">
                                            <i class="fa fa-money"></i> Receive
                                         </a>
                                     </td>
<!--                                     <td id="showReceiveSect"><a href="javascript:;" class="text-center btn btn-default" style="font-size: 12px !important;" data-toggle="modal" data-target="#sellCoinModal"><i class="fa fa-money"></i> Sell</a></td>-->
                                     <td id="showSendSect">
                                         <a href="javascript:;" class="text-center btn btn-default" style="font-size: 12px !important;"  data-toggle="modal" data-target="#exampleModal">
                                             <i class="fa fa-send-o"></i> Send 
                                         </a>
                                     </td>
                                     <td id="showcfaCashIn"><a href="<?php echo e(url('payment/dashboard')); ?>" class="text-center btn btn-default" style="font-size: 12px !important;"><i class="fa fa-money"></i> Cash In </a></td>
                                     <td id="showBuySect"><a href="javascript:;" class="text-center btn btn-default" style="font-size: 12px !important;"  data-toggle="modal" data-target="#buybtcModel" ><i class="fa fa-shopping-cart"></i> Buy Btc</a></td>
                                     
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
                                        <td><i class="fa fa-btc"></i> <?php echo e(round(Auth::user()->bitcoin,8)); ?></td>                        
                                      </tr>
                                      <tr>
                                        <td id="cfaidcfa" style="cursor: pointer;">CFA</td>
                                        <td> <?php echo e(round(Auth::user()->balance,8)); ?> CFA</td>                        
                                      </tr> 
                                      <tr>
<!--                                          <td align="center" colspan="2" ><a href="javascript:;" style="color:#000000;" data-toggle="modal" data-target="#CurConversionModal"><i class="fa fa-exchange"></i> Convert</a></td>-->
                                           <td align="center" colspan="2" ><a href="<?php echo e(url('user/conversion-chart')); ?>" style="color:#000000;" ><i class="fa fa-exchange"></i> Convert</a></td>
                                      </tr>                     
                                    </tbody>
                                  </table>
                            </div>
                         </div>
                    </div>
                    <div class="card">
                        <div class="card-content collapse show">
                        <a href="<?php echo e(url('/user/reference-user')); ?>" class="btn btn-default btn-block"><i class="fa fa-gift"></i> Earn Rewards</a>
                        </div>
                    </div>
                    
                    <div class="card">
                            <div class="card-content collapse show">
                                    <td class="text-center btn btn-default">Referal users : <?php echo e($refer); ?></td>
                                    <td class="text-center btn btn-default">Bonus Amount : <?php echo e(round($amountsum,8)); ?> CFA </td>
                              
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
                                            						                                                                    <li><a href="#0" data-date="20/10/2018"><i class="fa fa-money fa-lg"></i></a></li>
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
                                          <img src="<?php echo e(asset('assets/images/logo.png')); ?>" />
                                        </div>
                                        <div class="item">
                                          <img src="<?php echo e(asset('assets/images/logo.png')); ?>" />
                                        </div>
                                        <div class="item">
                                         <img src="<?php echo e(asset('assets/images/logo.png')); ?>" />
                                        </div>
                                        <div class="item">
                                          <img src="<?php echo e(asset('assets/images/logo.png')); ?>" />
                                        </div>
                                        <div class="item">
                                          <img src="<?php echo e(asset('assets/images/logo.png')); ?>" />
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
                    <?php $i=0;?>
                    <?php if(isset($log)): ?>
                    <?php $__currentLoopData = $log; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $i++;?>
                        <tr>
                            <td><?php echo e($i); ?></td>
                            <td><?php echo e(date('d-F-Y h:i A',strtotime($p->created_at))); ?></td>
                            <td><?php echo e($p->transaction_id); ?></td>
                            <td>
                                <?php if($p->amount_type == 1): ?>
                                    <span class="label bold label-primary"><i class="fa fa-cloud-download"></i> Deposit</span>
                                <?php elseif($p->amount_type == 2): ?>
                                    <span class="label bold label-danger"><i class="fa fa-minus"></i> Active</span>
                                <?php elseif($p->amount_type == 3): ?>
                                    <span class="label bold label-success"><i class="fa fa-plus"></i> Reference</span>
                                <?php elseif($p->amount_type == 4): ?>
                                    <span class="label bold label-success"><i class="fa fa-exchange"></i> Repeat</span>
                                <?php elseif($p->amount_type == 5): ?>
                                    <span class="label bold label-primary"><i class="fa fa-cloud-upload"></i> Withdraw</span>
                                <?php elseif($p->amount_type == 6): ?>
                                    <span class="label bold label-warning"><i class="fa fa-cloud-download"></i> Refund</span>
                                <?php elseif($p->amount_type == 8): ?>
                                    <span class="label bold label-success"><i class="fa fa-plus"></i> Add </span>
                                <?php elseif($p->amount_type == 9): ?>
                                    <span class="label bold label-danger"><i class="fa fa-minus"></i> Convert </span>
                                <?php elseif($p->amount_type == 10): ?>
                                    <span class="label bold label-danger"><i class="fa fa-bolt"></i> Charge </span>
                                <?php elseif($p->amount_type == 15): ?>
                                    <span class="label bold label-success"><i class="fa fa-recycle"></i> Cash-in </span>
                                <?php elseif($p->amount_type == 14): ?>
                                    <span class="label bold label-info"><i class="fa fa-cloud-upload"></i> Cash-out </span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php echo e($p->amount); ?> - <?php echo e($basic->symbol); ?>

                            </td>
                           <!-- <td>
                                <?php echo e($p->post_bal); ?> - <?php echo e($basic->symbol); ?>

                            </td>-->
                            <td width="30%">
                                <?php echo e($p->description); ?>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

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
                         <a href="<?php echo e(route('investment-verify-general')); ?>" class="btn btn-warning btn-sm bold uppercase">Continue<i class="fa fa-arrow-right"></i></a>
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
        
        <h5  style="margin-top:20%; margin-top: 3%; margin-left: 142px;">Send BitCoin </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        
      </div>
      <div class="modal-body">
       
            <form action="<?php echo e(route('cash-out')); ?>" id="myForm" role="form" data-toggle="validator" method="post" accept-charset="utf-8" style="width:100%;">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="from_wallet_address" id="from_wallet_address" value="<?php echo e(Auth::user()->wallet_address); ?>">
                   
                <div id="step-1" style="height:284px; width:100%;" class="">
                    <div id="form-step-0" role="form" data-toggle="validator">
                        <p>&nbsp;</p>
                        <div class="form-group">
                                <label for="name">BTC  Balance</label>
                                    <input type="text" class="form-control text-right" name="btc_amount" id="btc_amount" value="<?php echo e(Auth::user()->bitcoin); ?>" readonly>
                                <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="name">Send Btc </label>
                                <input type="text" class="form-control text-right" autocomplete="off" name="amount" id="amount" placeholder="0" required>
                            <div class="help-block with-errors"></div>
                        </div>
                        
                        <div class="form-group">
                            <label for="name">Wallet Balance</label>
                               <input type="text" class="form-control text-right" name="wallet_balance" id="wallet_balance" readonly>
                        </div>
                    </div> 
                </div>
               
                            <div class="form-group">
                                <label for="address">Recipient Name</label>
                                <input type="text" class="form-control" name="recipient_name" id="recipient_name" placeholder="Recipient name." required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label for="address">Recipient Wallet Address</label>
                                <input type="text" class="form-control" name="recipient_wallet_address" id="recipient_wallet_address" placeholder="Recipient wallet address..." required>
                                <div class="help-block with-errors"></div>
                            </div>
                      
                            <div class="form-group">
                                <label for="address">Message</label>
                                <textarea class="form-control" name="message" id="message" rows="3" placeholder="Write your message..." required></textarea>
                                <div class="help-block with-errors"></div>
                            </div>
                       
          
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type='submit' name='final' id='final' class='btn btn-primary' value='Send'>
        
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
        
        <h5  style="margin-top:20%; margin-top: 3%; margin-left: 142px;">Buy Bitcoin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        
      </div>
      <div class="modal-body">
       
            <form action="<?php echo e(url('user/bitcoin-request')); ?>" id="myFormbuycoin" role="form" data-toggle="validator" method="post" accept-charset="utf-8" style="width:100%;">
                    <?php echo e(csrf_field()); ?>

                    
                   
                <div id="step-1" style="height:284px; width:100%;" class="">
                    <div id="form-step-0" role="form" data-toggle="validator">
                        <p>&nbsp;</p>
                         <div class="row">
                        
                        <div class="col-sm-6">
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon" data-currency-symbol="true">CFA</span>
                                
                                <input id="A1" class="form-control nomargin text-right disableButton" data-currency-calc="true" type="text" value="1" placeholder="Enter amount" data-original-title="" title="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group input-group-lg">
                                <input  id="B1" class="form-control nomargin disableButton" type="text" value="<?php echo $cfa;?>" placeholder="Enter amount" data-original-title="" title="" >
                                <span class="input-group-addon"><img width="20px" height="20px" src="https://assets.coinmama.com/bitcoin.png">&nbsp;BTC</span>
                            </div>
                        </div>
                    </div>
                        <p>&nbsp;</p>
                        <div class="form-group">
                                <label for="cfa">CFA  Balance</label>
                                    <input type="text" class="form-control text-right" name="cfa_amount_bal" id="cfa_amount_bal" value="<?php echo e(Auth::user()->balance); ?>" readonly>
                                <div class="help-block with-errors"></div>
                        </div>
                        
                        <div class="form-group">
                            <label for="name">Send CFA </label>
                                <input type="text" class="form-control text-right" autocomplete="off" name="cfa_amounts" id="cfa_amounts" placeholder="0" required>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="cashout">Buy BTC Commission (in CFA)</label>
                                   <input type="text" class="form-control text-right" autocomplete="off" name="cash_out_commision" id="cash_out_commision" placeholder="0"  value="<?php echo e($basic->btc_buy_commision * $cfavalues->cfa_value); ?>" readonly>
                            <div class="help-block with-errors"></div>
                        </div>
                        
                            <input type="hidden" class="form-control text-right" autocomplete="off" name="btc_amounts" id="btc_amounts" placeholder="0" required>
                         
                            <input type="hidden" class="form-control text-right" name="wallet_balances" id="wallet_balance" readonly>
                       
                    </div> 
                </div>
           
      </div>
      <br/><br/>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type='submit' id='final' class='btn btn-primary' value='Buy'>
        
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
        
        
      </div>
  
    </div>
  </div>
</div>

<!-- ========= Wallet Address ================= -->

<div class="modal fade" id="walletAddressModal" tabindex="-1" role="dialog" aria-labelledby="CurConversionModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <h5  style="margin-top:20%; margin-top: 3%; margin-left: 142px;">Wallet Address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        
      </div>
      <div class="modal-body">
           <div class="form-group">
            <label for="name"> Wallet Address</label>
            
            <textarea type="text" class="form-control text-right" autocomplete="off" name="uwallet_address" id="uwallet_address" placeholder="0" required readonly=""><?php echo e(Auth::user()->wallet_address); ?></textarea>
              
             </div>
         
                       
      </div>
 <div class="modal-footer">
        <button class="btn btn-success" onclick="copytextFunc()">Copy text</button>              
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
        
      </div>
  
    </div>
  </div>
</div>

   <!-- ========= Sell  Bitcoin ================= -->

<div class="modal fade" id="sellCoinModal" tabindex="-1" role="dialog" aria-labelledby="CurConversionModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <h5  style="margin-top:20%; margin-top: 3%; margin-left: 142px;">Sell Coin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        
      </div>
      <div class="modal-body">
            <form action="<?php echo e(url('user/sellbtc-request')); ?>" id="myFormSellcoin" role="form" data-toggle="validator" method="post" accept-charset="utf-8" style="width:100%;">
                    <?php echo e(csrf_field()); ?>

                    
         
                       <div class="form-group">
                                <label for="cfa">Bitcoin  Balance</label>
                                    <input type="text" class="form-control text-right" name="btc_balance" id="btc_balance_sell" value="<?php echo e(Auth::user()->bitcoin); ?>" readonly>
                                <div class="help-block with-errors"></div>
                        </div>
                        
                        <div class="form-group">
                            <label for="name">Send Btc </label>
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
<script src="<?php echo e(asset('assets/dashboard/assets/js/jquery-1.12.4.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/dashboard/assets/js/highcharts.js')); ?>"></script>
<script src="<?php echo e(asset('assets/dashboard/assets/js/exporting.js')); ?>"></script>
<script src="<?php echo e(asset('assets/dashboard/assets/js/export-data.js')); ?>"></script>

<?php if((Auth::user()->phone_verify_status != 1 || Auth::user()->email_verify_status != 1 || Auth::user()->identity_verify_status != 1 || Auth::user()->selfie_verify_status != 1) && Auth::user()->idverify_skip == 1): ?>
<script type="text/javascript">
$(document).ready(function() {
    jQuery("#mySuccessModal").modal('show');
});
</script>
<?php endif; ?>

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
$(document).ready(function(e) {
     $(document).on('click','.model_ok_btn',function(){
		jQuery("#mySuccessModal").modal('hide');
		var skip = 0;
		$.ajax({
			method: 'POST',			
			url: "<?php echo e(url('/user/updateidverify')); ?>", 
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
				amount: {
					required: true,					
					max: mmval
				},
				recipient_name: {
					required: true,
				},
				recipient_wallet_address: {
					required: true,
				},
				message: {
					required: true,
				},
				
			},
			messages: {						
				amount: {
					required: "Please enter an amount",
				},
				recipient_name: {
					required: "Please provide a receipient name",
				},
				recipient_wallet_address: {
					required: "Please provide a receipient wallet address",
				},
				message: {
					required: "Please enter a your message",
				}
			}
		});
		
		$("#amount").keyup(function(){
			var amount = $(this).val();
			//alert(amount);
			
			var btc = $("#btc_amount").val();
			//alert(btc);
			if(amount > btc)
			{
				swal("Sorry!", "Your Request Amount is Larger Than Your Current Balance.", "error");
			}
			else
			{
				var due = parseFloat(btc) - parseFloat(amount);
				$("#wallet_balance").val(due);
			}
		
		});
        /*
        $(document).on('click','.sw-btn-next',function(){
			var pageURL = $(location).attr("href");
			var url_solit		= pageURL.split("#");
			var current_step	= url_solit[1];
			
			if(current_step == 'step-3'){
				//$(".sw-btn-next").removeAttr('disabled');
				$(".sw-btn-next").hide();
				var btn_field	= "<input type='submit' name='final' id='final' class='btn btn-success done-btn' value='Done'>";
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
<!--  Buy Bitcoin  Section -->

   <script type="text/javascript">
    $(document).ready(function(){
		var mmval = $("#cfa_amount_bal").val();
		
		$("#myFormbuycoin").validate({
			rules: {							
				cfa_amounts: {
					required: true,					
					max: mmval
				},
				
				
				
			},
			messages: {						
				cfa_amounts: {
					required: "Please enter an amount",
				}
				
			}
		});
		
		$("#cfa_amounts").keyup(function(){
			var amount = $(this).val();
			//alert(amount);
			
			var btc = $("#cfa_amount_bal").val();
			//alert(btc);
			if(amount > btc)
			{
				swal("Sorry!", "Your Request Amount is Larger Than Your Current Balance.", "error");
			}
			else
			{
				var due = parseFloat(btc) - parseFloat(amount);
				$("#wallet_balances").val(due);
			}
		
		});  
                  });
                   $("#cfa_amounts").change(function() {
 $("#btc_amounts").val($("#cfa_amounts").val()*<?php echo $cfa;?>);
});

$("#cfa_amounts").keyup(function() {
    $("#btc_amounts").val($("#cfa_amounts").val()*<?php echo $cfa;?>);
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>

<!--<script>
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



</script>-->

<script type="text/javascript">
 $("#A1").change(function() {
 $("#B1").val($("#A1").val()*<?php echo $cfa;?>);
});

$("#B1").change(function() {
    $("#A1").val($("#B1").val() /<?php echo $cfa;?> );
});

$("#A1").keyup(function() {
    $("#B1").val($("#A1").val()*<?php echo $cfa;?>);
});

$("#B1").keyup(function() {
    $("#A1").val($("#B1").val() / <?php echo $cfa;?>);
});
 </script>
	
 
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user-frontend.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>