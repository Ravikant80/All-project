
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
<?php $__env->startSection('content'); ?>
	
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div class="row match-height">
                <div class="col-xl-12 col-12">
                    <div class="card card-transparent">
                        <div class="card-header card-header-transparent py-20">
                            <div class="btn-group dropdown">
                                <h6>Bitcoin Price Chart</h6>
                            </div>
                        </div>
                        <div id="container" style="min-width: 600px; height: 400px; margin: 0 auto; float:left;"></div>
                    </div>
                </div>   
                <div class="col-xl-2 col-12">
                	
                </div>             
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card pull-up">
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <form class="form-horizontal form-purchase-token row" action="">
                                    <div class="col-md-2 col-12">
                                        <fieldset class="form-label-group mb-0">
                                        <input name="qty" id="btc" class="form-control nomargin disableButton" type="text" value="1" placeholder="Enter amount" data-original-title="" title="" onkeyup="update_('btc', this)">
                                        <label for="ico-token"><?=$bit_code?></label>
                            
                                        </fieldset>
                                    </div>
                                    <div class="col-md-1 col-12 text-center">
                                        <span class="la la-arrow-right"></span>
                                    </div>
                                    <div class="col-md-2 col-12">
                                        <fieldset class="form-label-group mb-0">
                                        <label for="selected-crypto">CFA</label>
                                <input id="usdbtc" class="form-control nomargin text-right disableButton" data-currency-calc="true" type="text" value="6377.95" placeholder="Enter amount" data-original-title="" title="" onkeyup="update_('btc', this)">
                            </fieldset>
                                    </div>
                                    <!--<div class="col-md-1 col-12">
                                        <select class="custom-select">
                                            <option selected>ETH</option>
                                            <option value="1">BTC</option>
                                            <option value="2">LTC</option>
                                            <option value="3">USDT</option>
                                            <option value="3">Credit Card</option>
                                        </select>
                                    </div>-->
                                    <div class="col-md-4 col-12 mb-1">
                                        <fieldset class="form-label-group mb-0">
                                            <input type="text" class="form-control" id="wallet-address" value="<?php echo e(Auth::user()->wallet_address); ?>" readonly autofocus>
                                            <label for="wallet-address">Wallet address</label>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-2 col-12 text-center">
                                        <button type="button" class="btn btn-primary buynow">Buy now</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-6">
                    <h6 class="my-2">Bit Coin balance</h6>
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <p><strong>Your balance:</strong></p>
                                            <h1><i class="fa fa-btc"></i> <?php echo e(Auth::user()->bitcoin); ?> BTC</h1>
                                            <!--<p class="mb-0">Welcome bonus <strong>+30%</strong> expires in 21 days.</p>-->
                                        </div>
                                        <div class="col-md-6 col-12 text-center text-md-right">
                                            <button type="button" class="btn btn-primary mt-2 withdrawbtn">Sell<i class="la la-angle-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-6">
                    <h6 class="my-2">CFA balance</h6>
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <p><strong>Your balance:</strong></p>
                                            <h1><?php echo e(Auth::user()->balance); ?> CFA</h1>
                                            <!--<p class="mb-0">Welcome bonus <strong>+30%</strong> expires in 21 days.</p>-->
                                        </div>
                                        <div class="col-md-6 col-12 text-center text-md-right">
                                            <!--<a href="<?php echo e(asset('user/investment-new')); ?>"><button type="button" class="btn btn-primary mt-2">Deposit <i class="la la-angle-right"></i></button></a>-->
                                            <a href='<?php echo e(url('payment/dashboard')); ?>'><button type="button" class="btn btn-primary mt-2">Deposit <i class="la la-angle-right"></i></button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
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
            <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>
<script>
var ember = [];
var usdInput = document.getElementById("usdbtc");
var btcInput = document.getElementById("btc");

ember.btcPrice = 6377.95;
ember.socket = io.connect('https://socket.coincap.io');
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
    $("#usdbtc").attr("value", ember.usdCalc);
});



</script>
<?php $__env->stopSection(); ?>

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
<!--<script>
var myObj, x;
myObj = $.getJSON('https://api.blockchain.info/charts/transactions-per-second?timespan=5weeks&rollingAverage=8hours&format=json'
   );
 console.log(JSON.parse(myObj));
//x = myObj.name;
//document.getElementById("demo").innerHTML = x;
</script>-->
<script type="text/javascript">

$.getJSON(
    'https://cdn.rawgit.com/highcharts/highcharts/057b672172ccc6c08fe7dbb27fc17ebca3f5b770/samples/data/usdeur.json',
    function (data) {
        var detailChart;
		//alert(data);
        // create the detail chart
        function createDetail(masterChart) {

            // prepare the detail chart
            var detailData = [],
                detailStart = data[0][0];

            $.each(masterChart.series[0].data, function () {
                if (this.x >= detailStart) {
                    detailData.push(this.y);
                }
            });

            // create a detail chart referenced by a global variable
            detailChart = Highcharts.chart('detail-container', {
                chart: {
                    marginBottom: 120,
                    reflow: false,
                    marginLeft: 0,
                    marginRight: 20,
                    style: {
                        position: 'absolute'
                    }
                },
                credits: {
                    enabled: false
                },
                title: {
                    text: 'Transaction Rate'
                },
                subtitle: {
                    text: 'Transactions Per Second'
                },
                xAxis: {
                    type: 'minute'
                },
                yAxis: {
                    title: {
                        text: null
                    },
                    maxZoom: 0.1
                },
                tooltip: {
                    /*formatter: function () {
                        var point = this.points[0];
                        return '<b>' + point.series.name + '</b><br/>' + Highcharts.dateFormat('%A %B %e %Y', this.x) + ':<br/>' +
                            '1 USD = ' + Highcharts.numberFormat(point.y, 2) + ' EUR';
                    },*/
                    shared: true
                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        marker: {
                            enabled: false,
                            states: {
                                hover: {
                                    enabled: true,
                                    radius: 3
                                }
                            }
                        }
                    }
                },
                series: [{
                    name: 'USD to BTC',
                    pointStart: detailStart,
                    pointInterval: 24 * 3600 * 1000,
                    data: detailData
                }],

                exporting: {
                    enabled: false
                }

            }); // return chart
        }

        // create the master chart
        function createMaster() {
            Highcharts.chart('master-container', {
                chart: {
                    reflow: false,
                    borderWidth: 0,
                    backgroundColor: null,
                    marginLeft: 0,
                    marginRight: 20,
                    zoomType: 'x',
                    events: {

                        // listen to the selection event on the master chart to update the
                        // extremes of the detail chart
                        selection: function (event) {
                            var extremesObject = event.xAxis[0],
                                min = extremesObject.min,
                                max = extremesObject.max,
                                detailData = [],
                                xAxis = this.xAxis[0];

                            // reverse engineer the last part of the data
                            $.each(this.series[0].data, function () {
                                if (this.x > min && this.x < max) {
                                    detailData.push([this.x, this.y]);
                                }
                            });

                            // move the plot bands to reflect the new detail span
                            xAxis.removePlotBand('mask-before');
                            xAxis.addPlotBand({
                                id: 'mask-before',
                                from: data[0][0],
                                to: min,
                                color: 'rgba(0, 0, 0, 0.2)'
                            });

                            xAxis.removePlotBand('mask-after');
                            xAxis.addPlotBand({
                                id: 'mask-after',
                                from: max,
                                to: data[data.length - 1][0],
                                color: 'rgba(0, 0, 0, 0.2)'
                            });


                            detailChart.series[0].setData(detailData);

                            return false;
                        }
                    }
                },
                title: {
                    text: null
                },
                xAxis: {
                    type: 'datetime',
                    showLastTickLabel: true,
                    maxZoom: 14 * 24 * 3600000, // fourteen days
                    plotBands: [{
                        id: 'mask-before',
                        from: data[0][0],
                        to: data[data.length - 1][0],
                        color: 'rgba(0, 0, 0, 0.2)'
                    }],
                    title: {
                        text: null
                    }
                },
                yAxis: {
                    gridLineWidth: 0,
                    labels: {
                        enabled: false
                    },
                    title: {
                        text: null
                    },
                    min: 0.6,
                    showFirstLabel: false
                },
                tooltip: {
                    formatter: function () {
                        return false;
                    }
                },
                legend: {
                    enabled: false
                },
                credits: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        fillColor: {
                            linearGradient: [0, 0, 0, 70],
                            stops: [
                                [0, Highcharts.getOptions().colors[0]],
                                [1, 'rgba(255,255,255,0)']
                            ]
                        },
                        lineWidth: 1,
                        marker: {
                            enabled: false
                        },
                        shadow: false,
                        states: {
                            hover: {
                                lineWidth: 1
                            }
                        },
                        enableMouseTracking: false
                    }
                },

                series: [{
                    type: 'area',
                    name: 'USD to BTC',
                    pointInterval: 24 * 3600 * 1000,
                    pointStart: data[0][0],
                    data: data
                }],

                exporting: {
                    enabled: false
                }

            }, function (masterChart) {
                createDetail(masterChart);
            }); // return chart instance
        }

        // make the container smaller and add a second container for the master chart
        var $container = $('#container')
            .css('position', 'relative');

        $('<div id="detail-container">')
            .appendTo($container);

        $('<div id="master-container">')
            .css({
                position: 'absolute',
                top: 300,
                height: 100,
                width: '100%'
            })
                .appendTo($container);

        // create master and in its callback, create the detail chart
        createMaster();
    }
);

		</script>


<?php echo $__env->make('layouts.user-frontend.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>