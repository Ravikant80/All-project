<?php $__env->startSection('style'); ?>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<style type="text/css">
  .featured-outlets__outlet {
    background: #fff;
    border-radius: 4px;
    border: 1px solid transparent;
    padding: 10px;
    margin: 5px;
    width: 180px;
    height: auto;
    min-height: 90px;
    color: #888;
    -webkit-transition: color .15s ease-in-out,border-color .15s ease-in-out;
    transition: color .15s ease-in-out,border-color .15s ease-in-out;
    box-shadow: 0 2px 1px 0 rgba(0,0,0,.05), 0 0 2px 0 rgba(0,0,0,.22);
    text-align: center;
    margin-left: 38%;
    margin-bottom: 7%;
}

.featured-outlets__logo {
    max-width: 100%;
    max-height: 40px;
}

.featured-outlets__name {
    line-height: 18px;
    margin-top: 15px;
}

.btn-group{
  display: none;
}

.sw-theme-arrows > ul.step-anchor > li {
    width: 130px;
    padding-right: 61px;
}
.content-wrapper {
    padding: 2.2rem;
    margin-left: 18%;
}





.clearfix:after {
    clear: both;
    content: "";
    display: block;
    height: 0;
}

.container {
  font-family: 'Lato', sans-serif;
  width: 1000px;
  margin: 0 auto;
}

.wrapper {
  display: table-cell;
  height: 100px;
  vertical-align: middle;
}

.nav {
  margin-top: 40px;
}

.pull-right {
  float: right;
}

a, a:active {
  color: #333;
  text-decoration: none;
}

a:hover {
  color: #999;
}

/* Breadcrups CSS */

.arrow-steps .step {
  font-size: 18px;
  text-align: center;
  color: #666;
  cursor: default;
    margin: 0 2px;
    padding: 10px 10px 10px 30px;
    min-width: 205px;
  float: left;
  position: relative;
  background-color: #d9e3f7;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none; 
  transition: background-color 0.2s ease;
}

.arrow-steps .step:after, .arrow-steps .step:before {
    content: " ";
    position: absolute;
    top: 0;
    right: -17px;
    width: 0;
    height: 0;
    border-top: 23px solid transparent;
    border-bottom: 23px solid transparent;
    border-left: 17px solid #d9e3f7;
    z-index: 2;
    transition: border-color 0.2s ease;
}

.arrow-steps .step:before {
  right: auto;
  left: 0;
  border-left: 17px solid #fff; 
  z-index: 0;
}

.arrow-steps .step:first-child:before {
  border: none;
}

.arrow-steps .step:first-child {
  border-top-left-radius: 4px;
  border-bottom-left-radius: 4px;
}

.arrow-steps .step span {
  position: relative;
}

.arrow-steps .step span:before {
  opacity: 0;
  content: "✔";
  position: absolute;
  top: -2px;
  left: -20px;
}

.arrow-steps .step.done span:before {
  opacity: 1;
  -webkit-transition: opacity 0.3s ease 0.5s;
  -moz-transition: opacity 0.3s ease 0.5s;
  -ms-transition: opacity 0.3s ease 0.5s;
  transition: opacity 0.3s ease 0.5s;
}

.arrow-steps .step.current {
  color: #fff;
  background-color: #39a8df;
}

.arrow-steps .step.current:after {
  border-left: 17px solid #39a8df;  
}

.content-wrapper {
    padding: 2.2rem;
    margin-left: 15%;
}
.sw-theme-arrows .step-content {
  
    background-color: #f4f5fa !important; 
 
}
.sw-theme-arrows {
    border-radius: 5px;
    border: none!important;
}
.bootbox .modal .fade .bootbox-alert .show{
  margin-top: 85px !important;
}
</style>

<div class="container"> 
  <div class="wrapper"> 
    <div class="arrow-steps clearfix">
        <div class="step "> <a href="<?php echo e(url('user/withdraw-request')); ?>" style="color: #6d6262 !important;text-decoration: none !important;"><span> Method</span></a> </div>
        <!-- <div class="step current"> <span> Amount</span> </div> -->
        <div class="step current"> <span>Payment</span> </div>
    </div>
  </div>
</div>
<div class="row" style="width:100%;" align="center">
           
            
         
                <div id="smartwizard">
                    <ul style="display: none;">
                        <li><a href="#step-2">Method</a></li>
                        <li><a href="#step-3">Payment</a></li>
                    </ul>

                    <div>
                        <div id="step-2" style="height:400px; width:100%;     background-color: #fff !important;" class="">
                          <div id="form-step-1" role="form" data-toggle="validator">
                                <p>&nbsp;</p>
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
                                   <div class="col-md-2 col-md-offset-6" style="margin-right: -40px; margin-left: 180px;">
                                 <a href="<?php echo e(url('withdraw/request')); ?>" class="btn btn-primery" style="border: 1px solid;">
                             Back</a>
                                 </div>
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




<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.user-frontend.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>