
<?php $__env->startSection('content'); ?>
<style type="text/css">
.text-right { text-align:right; }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                
                <h3 class="page_title" style="text-align: -webkit-center;">
                    <img src="<?php echo e(asset('assets/img/mtnmoney.jpg')); ?>" height="40px" width="100px" alt="Mobile money Payment"/>
                    <?php echo $page_title; ?></h3>
                <hr>
            </div>
        </div>
        <div class="sidebar-detached sidebar-left">
            <div class="sidebar">
                <div id="wallet-sidebar" class="sidebar-content">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title text-center">All Wallet Balance</h6>            
                        </div>
                        <div class="card-content collapse show">
                            <div class="table-responsive">
                                  <table class="table table-de mb-0">                    
                                        <tbody>
                                              <tr>
                                                <td>BTC</td>
                                                <td><i class="fa fa-btc"></i> <?php echo e(round(Auth::user()->bitcoin,8)); ?></td>                   
                                              </tr>
                                              <tr>
                                                <td>CFA</td>
                                                <td><?php echo e(round(Auth::user()->balance,8)); ?>&nbsp;CFA</td>
                                                
                                              </tr> 
                                        </tbody>
                                  </table>
                            </div>
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
                            
                            <form action="<?php echo e(route('withdraw-submit')); ?>" class="form-horizontal" id="myForm" role="form" data-toggle="validator" method="post" accept-charset="utf-8" style="width:100%; margin-left:30px;">
                            	<p>&nbsp;</p>
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="usd_wallet" id="usd_wallet" value="<?php echo e(Auth::user()->balance); ?>">
                                <input type="hidden" name="btc_wallet" id="btc_wallet" value="<?php echo e(Auth::user()->bitcoin); ?>">
                                <input type="hidden" id="withdraw_commission1" name="withdraw_commission1" value="<?php echo e($basic->withdraw_commission); ?>" />
                            	
                                <div class="form-group row">
                                   <label class="col-md-4">Withdraw Mobile Number</label>
                                    <div class="col-md-6">
                                       	<input type="text" class="form-control text-right" name="phone" id="withdraw_phone" autocomplete="off" placeholder="0" value="<?php echo e(Auth::user()->phone); ?>">
                                        <p id='phone_help' class='text-danger help-block'></p>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                   <label class="col-md-4">Withdraw Amount</label>
                                    <div class="col-md-6">
                                       	<input type="text" class="form-control text-right" name="amount" id="withdraw_amount" autocomplete="off" placeholder="0" >
                                        <p id='amount_help' class='text-danger help-block'></p>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                	<label class="col-md-4">Withdraw Commission</label>
                                    <div class="col-md-6">
                                       	<input readonly="" type="text" class="form-control text-right" name="withdraw_commission" id="withdraw_commission" autocomplete="off" value="<?php echo e($basic->withdraw_commission); ?>">
                                        <p id='withdraw_commission_help' class='text-danger help-block'></p>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                	<label class="col-md-4">You Will Get</label>
                                    <div class="col-md-6">
                                       	<input type="text" class="form-control text-right" name="receive_amount" id="receive_amount" readonly="" autocomplete="off">
                                        <p id='receive_amount_help' class='text-danger help-block'></p>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                	<label class="col-md-4"></label>
                                    <div class="col-md-6">
                                       	<span onclick="sendRequest('<?php echo e(url('payment/withdraw')); ?>','depositForm',this)" class="btn btn-primary btn-block">Withdraw</span>
                                    </div>
                                </div>                               
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 	</div>
</div>
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


<script type="text/javascript">

    function sendRequest(link,formId,thisone ) {
        $(".help-block").html(""); 
        
        var check = true;
        
        if($("#withdraw_amount").val() == ""){
            $("#amount_help").text("The amount field is required.");
            check = false; 
        }
        
        if($("#withdraw_phone").val() == ""){
            $("#phone_help").text("The phone field is required.");
            check= false;
        }
        
        
        thisone.disabled = true;
        var bftext = $(thisone).text();
        $(thisone).text("wait...");
       
        var form = new FormData();
            form.append("amount", $("#withdraw_amount").val());
            form.append("phone", $("#withdraw_phone").val());
            form.append("withdraw_commission1", $("#withdraw_commission1").val());
        
        var settings = {
            "async": true,
            "crossDomain": true,
            "url": link,
            "method": "POST",
            "headers": {
                "Cache-Control": "no-cache",
                "Postman-Token": "5486823d-90c3-4c79-94b7-003c609ee2ff",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            "processData": false,
            "contentType": false,
            "mimeType": "multipart/form-data",
            "data": form,
            "error":function(e){
                document.write(e.responseText);
            }
        }

        if(check){

            $.ajax(settings).done(function (response1) {
            thisone.disabled = false;
            $(thisone).text(bftext);
            response = JSON.parse(response1);
            if(response.success == false){
               for(key in response.error){
                 $("#"+key+"_help").text(response.error[key][0]);
              }
           }else{
               if(response.status == 'success'){
                   var msg = response.message +"<br>"+
                             "amount : "+response.amount+"<br>"+
                             "phone  :"+response.phoneNumber+"<br>"+
                             "tranaction id :"+response.transactionId+"<br>"+
                             "transaction date :"+response.transactionDate+"<br>";
                   bootbox.alert(msg);
                   
                   setTimeout(function(){ location.assign(response.redirect); }, 3000);
                }else{
                   bootbox.alert(response.message);
               }
            }
        });
          
       }else{
           thisone.disabled = false;
           $(thisone).text(bftext);
       } 
    }

</script>

<script>
    
    
    
    
$(document).ready(function() {
	//alert('test');
	var mmval = $("#usd_wallet").val();
	
	$("#myForm").validate({
		rules: {							
			from_wallet: {
				required: true,
			},
			withdraw_amount: {
				required: true,
				number: true,
				max: mmval
			}
		},
		messages: {						
			from_wallet: {
				required: "Please select a withdraw wallet",
			},
			withdraw_amount: {
				required: "Please enter a withdraw amount",
			}
		}
	});
		
	$("#withdraw_amount").keyup(function(){
		var amount = $(this).val();
		//alert(amount);
		var usd = $("#usd_wallet").val();
		
		/*if(amount <= usd)
		{*/
			var ctpay = $("#withdraw_commission").val();
			var due = parseInt(amount) - parseInt(ctpay);
			$("#receive_amount").val(due);
		/*}
		else
		{
			swal("Sorry!", "Entered amount exceeds your wallet amount", "error");
		}*/
	});
});
</script>
<?php echo $__env->make('layouts.user-frontend.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>