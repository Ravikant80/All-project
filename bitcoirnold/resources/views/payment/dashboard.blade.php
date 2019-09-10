@extends('layouts.user-frontend.dashboard')
@section('style')


@endsection
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
@section('content')

<div class="card pull-up">
    <div class="card-content">
        <div class="card-body">
                <h1 style="color: white;margin-left: 20px;font-family: inherit;text-transform: capitalize;padding: 50px;text-align: center;font-size: 50px; background: #1a3c8b;"><i class="fa fa-check-circle" aria-hidden="true"></i> <i class="fa fa-mobile" aria-hidden="true"></i> Payment</h1>
        </div>
    </div>
</div>

<div class="card pull-up">
    <div class="card-content">
        <div class="card-body">
            <div class="col-md-12">
                <form class="form-horizontal" id='depositForm'>
                    {{ csrf_field() }}
                    <fieldset>

                        <!-- Form Name -->
                        <legend>Complete Your Payment</legend>

                        <!-- Text input-->



                        <div class="form-group">
                            <label class="col-md-8 col-md-offset-4 control-label" for="textinput">Amount (in CFA)</label>  
                            <div class="col-md-8 col-md-offset-4">
                                <input id="amount" name="amount" type="number" placeholder="please enter amount in CFA" class="form-control input-md">
                                <span id='amount_help' class="help-block text-danger"></span>  
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-8 col-md-offset-4 control-label" for="textinput">Phone</label>  
                            <div class="col-md-8 col-md-offset-4">
                                <input id="phone" name="phone" type="number" placeholder="Please enter MTN mobile number " class="form-control input-md">
                                <span id='phone_help' class="help-block text-danger"></span>  
                            </div>
                        </div>

                        <div class="col-md-8">
                            <span onclick="sendRequest('{{ url('payment/deposit') }}','depositForm',this)" id="button1id" name="" class="btn btn-success">Pay Securely</span>
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


@endsection

