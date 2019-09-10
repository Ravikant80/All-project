
@extends('layouts.user-frontend.dashboard')

@section('style')

@endsection
@section('content')
<style type="text/css">
.modal-dialog {
  max-width: 630px;
  margin: 0px auto;
  padding-right: 50px;
}

.close{
  display: none;
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

$cfa      =btcBuyValue();
$cfa2     =btcSellValue();
$cfavalue =getCfaValues();

?>








<div class="" id="buybtcModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content" style="border-radius: 1rem;">
  <div class="modal-header">
    {{-- <h5 class="modal-title" id="exampleModalLabel" align="center" style="margin-left: 37%;"><i class="fa fa-id-card" style="font-size:85px;color:green;margin-bottom:5%;"></i></h5> --}}
  
    <h5  style="margin-top:20%; margin-top: 3%; margin-left: 187px;"><span class="input-group-addon" style="background-color: snow;"><img width="20px" height="20px" src="https://assets.coinmama.com/bitcoin.png">&nbsp; Buy BitCoin</span></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    
  </div>
  <div class="modal-body">
   
        <form action="{{ url('user/bitcoin-request') }}" id="myFormbuycoin" role="form" data-toggle="validator" method="post" accept-charset="utf-8" style="width:100%;">
                {{ csrf_field() }}
                
               
            <div id="step-1" style="height:284px; width:100%;" class="">
                <div id="form-step-0" role="form" data-toggle="validator" style="padding: 0 25px;">
                    <p>&nbsp;</p>
                    
                    <div class="form-group">
                            <label for="cfa">CFA  Balance</label>
                                <input type="text" class="form-control text-right" name="cfa_amount_bal" id="cfa_amount_bal" value="{{ Auth::user()->balance }}" readonly>
                            <div class="help-block with-errors"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="name"> Please Enter CFA Amount  to Buy Btc.</label>
                            <input type="text" class="form-control text-right" autocomplete="off" name="cfa_amounts" id="cfa_amounts" placeholder="0" required>
                            <div class="help-block with-errors"></div>
                            <div>
                             <i class="text-danger" id="amount_less_error"></i>
                              </div>
                    </div>
                    <div class="form-group">
                        <label for="cashout">BTC Value</label>
                               <input type="hidden" class="form-control text-right" autocomplete="off" name="cash_out_commision" id="cash_out_commision" placeholder="0"  value="{{ $basic->btc_buy_commision * $cfavalue}}" readonly>

                              <input type="text" class="form-control text-right" autocomplete="off" name="btc_amounts" id="btc_amounts" placeholder="0" readonly >

                        <div class="help-block with-errors"></div>
                    </div>
                    
                        
                     
                        <input type="hidden" class="form-control text-right" name="wallet_balances" id="wallet_balance" readonly>
                   
                </div> 
            </div>
       
  </div>
  
  <div class="modal-footer">
    <a href="{{url('user/exchange')}}"  type="" class="btn btn-secondary" data-dismiss="modal">Back</a>
    <input type='submit' id='buyBtcConfModelId' class='btn btn-primary' value='Buy'>
    {{-- <button type="button" class="btn btn-primary">Continue</button> --}}
  </div>
</form>
</div>
</div>
</div>


<script src="{{ asset('assets/dashboard/assets/js/jquery-1.12.4.min.js') }}"></script>
@if (session('success'))
<script type="text/javascript">
  $(document).ready(function(){

    swal("Success!", "{{ session('success') }}", "success");

  });
</script>
@endif

@if (session('alert'))
<script type="text/javascript">
  $(document).ready(function(){
    swal("Sorry!", "{{ session('alert') }}", "error");
  });

</script>
@endif 

<!--===============  Buy Bitcoin  Section ======================-->

<script type="text/javascript">
$(document).ready(function(){
    var mmval = $("#cfa_amount_bal").val();
    $('#buyBtcConfModelId').hide();
    
    $("#myFormbuycoin").validate({
        rules: {                            
            // cfa_amounts: {
            //     required: true,                 
            //     max: mmval
            // }
                     
        },
        messages: {                     
            cfa_amounts: {
                required: "Please enter an amount",
            }
            
        }
    });
    
    $("#cfa_amounts").keyup(function(){
      
        $('#buyBtcConfModelId').hide();
       $("#btc_amounts").val($("#cfa_amounts").val()/<?php echo $cfa;?>);
        
        if($(this).val() > <?=Auth::user()->balance;?> || $(this).val()  == 0)
        {
            //swal("Sorry!", "Your Request Amount is Larger Than Your Current Balance.", "error");
            $("#amount_less_error").text("Please enter an amount within your current wallet balance of <?=Auth::user()->balance;?>  BTC");
            $('#buyBtcConfModelId').hide();
        }
        else
        {   
          $('#buyBtcConfModelId').show();
          $("#amount_less_error").text("");

            // var due = parseFloat(btc) - parseFloat(amount);
            // $("#wallet_balances").val(due);
        }
    
    });  
 });

// $("#cfa_amounts").change(function() {
// $("#btc_amounts").val($("#cfa_amounts").val()/<?php echo $cfa;?>);
// });

// $("#cfa_amounts").keyup(function() {
// $("#btc_amounts").val($("#cfa_amounts").val()/<?php echo $cfa;?>);
// });

// --------     buy  currency conversion Section ------- //

$("#A1").change(function() {
$("#B1").val($("#A1").val()/<?php echo $cfa;?>);
});

$("#B1").change(function() {
$("#A1").val($("#B1").val() *<?php echo $cfa;?> );
});

$("#A1").keyup(function() {
$("#B1").val($("#A1").val()/<?php echo $cfa;?>);
$("#usdval1").text($("#A1").val()*<?php echo (1/$cfavalue);?>); 
 if($(this).val() < 5000)
        $("#amount_less_error").text("Minimum amount should not less then 5000 in CFA");
    else
        $("#amount_less_error").text("");
});

$("#B1").keyup(function() {
$("#A1").val($("#B1").val() * <?php echo $cfa;?>);
$("#usdval1").text($("#B1").val()*<?php echo ($btc);?>); 

});

</script>

<!--===============  END Buy Bitcoin  Section ======================-->

@endsection
