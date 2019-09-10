<?php $__env->startSection('style'); ?>


<?php $__env->stopSection(); ?>
<?php
$page = file_get_contents('https://bitpay.com/api/rates');
$blockchain = file_get_contents('https://blockchain.info/ticker');

$my_array = json_decode($page, true);
$btc_array = json_decode($blockchain, true);
//print_r($btc_array);
$usd_buy = $btc_array['USD']['buy'];
$usd_sell = $btc_array['USD']['sell'];
$bit_coin = $my_array[0]["rate"];
$bit_code = $my_array[0]["code"];
$usd_code = $my_array[2]["code"];
$usd_rate = $my_array[2]["rate"];
?>
<?php $__env->startSection('content'); ?>

<div class="card pull-up" style="background-color: #1B65D3 !important;">
    <div class="card-content">
        <div class="card-body">
            <h1 style="color: white;margin-left: 20px;font-family: inherit;text-transform: capitalize;padding: 50px;text-align: center;font-size: 50px;">
                <i class="fa fa-check-circle" aria-hidden="true"></i>
                <img src="<?php echo e(asset('assets/img/mtnmoney.jpg')); ?>" height="100px" width="300px" alt="Mobile money Payment"/>
                   Payment</h1>
                   </div>
    </div>
</div>

<div class="card pull-up">
    <div class="card-content">
        <div class="card-body">
            <div class="col-md-12">
                <form type="GET" class="form-horizontal" id='depositForm' action="<?php echo e(url('payment/second-step')); ?>">
                    
                    
                    
                    <fieldset>

                        <!-- Form Name -->
                        

                        <!-- Text input-->



                        <div class="form-group">
                            <label class="col-md-12 control-label" for="textinput" style="text-align: center;"><i>below enter a phone number which has a MTN Mobile Money account</i></label>  
                            <div class="col-md-6" style="margin:  0px auto;">
                                <input name="phone" type="number" placeholder="" class="form-control input-md" value="<?php echo e(Auth::user()->phone); ?>">
                                <?php if($errors->has("phone")): ?>
                                    <span class="help-block text-danger"><?php echo e($errors->first('phone')); ?></span>  
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-12" style="text-align: center;">
                            <input type="submit" value="Click to start Payment" class="btn btn-info" />
                        </div>

                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">

    function sendRequest(link,formId,thisone ) {
        $(".help-block").html(""); 
        
        var check = true;
        
        if($("#amount").val() == ""){
            $("#amount_help").text("The amount field is required.");
            check = false; 
        }
        
        if($("#phone").val() == ""){
            $("#phone_help").text("The phone field is required.");
            check= false;
        }
        
        
        thisone.disabled = true;
        var bftext = $(thisone).text();
        $(thisone).text("wait...");
       
        var form = new FormData();
            form.append("amount", $("#amount").val());
            form.append("phone", $("#phone").val());
        
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
        
            bootbox.alert("Hurry!! An approval link is sent to your phone please approve to complete the payment.");
       }else{
           thisone.disabled = false;
           $(thisone).text(bftext);
       } 
    }

</script>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.user-frontend.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>