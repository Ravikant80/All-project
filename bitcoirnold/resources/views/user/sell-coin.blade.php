
@extends('layouts.user-frontend.dashboard')

@section('style')

@endsection
@section('content')
<style type="text/css">
.modal-dialog {
  max-width: 540px;
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
?>
<div class="" id="sellCoinModal" tabindex="-1" role="dialog" aria-labelledby="CurConversionModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        {{-- <h5 class="modal-title" id="exampleModalLabel" align="center" style="margin-left: 37%;"><i class="fa fa-id-card" style="font-size:85px;color:green;margin-bottom:5%;"></i></h5> --}}
        <h5  style="margin-top:20%; margin-top: 3%; margin-left: 142px;"><span class="input-group-addon"><img width="20px" height="20px" src="https://assets.coinmama.com/bitcoin.png">&nbsp; Sell BitCoin</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <div class="modal-body">
        <form action="{{ url('user/sellbtc-request') }}" id="myFormSellcoin" role="form" data-toggle="validator" method="post" accept-charset="utf-8" style="width:100%;">
          {{ csrf_field() }}
          

          <div class="form-group">
            <label for="cfa">Current Bitcoin  Balance</label>
            <input type="text" class="form-control text-right" name="btc_balance" id="btc_balance" value="{{ Auth::user()->bitcoin }}" readonly>
            <div class="help-block with-errors"></div>
          </div>
          
          <div class="form-group">
            <label for="name">Please Enter BTC Amount that wants to Sell. </label>
            <input type="text" class="form-control text-right" autocomplete="off" name="btc_amount" id="btc_amount" placeholder="0" required>
            <div class="help-block with-errors"></div>
              <div>
                  <i class="text-danger" id="amount_less_error"></i>
              </div>
          </div>

          <div class="form-group">
            <label for="cashout">CFA Values</label>
            <input type="text" class="form-control text-right" autocomplete="off" name="cfa_amount" id="cfa_amount" placeholder="0"  value="" readonly>
            <div class="help-block with-errors"></div>
          </div>

          
        </div>
        <div class="modal-footer">
          <a href="{{url('user/exchange')}}"  type="button" class="btn btn-secondary" data-dismiss="modal">Back</a>
          <input type='submit' id='sellBtcSubmitId' class='btn btn-primary' value='Sell'>
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
<script type="text/javascript">
  
$(document).ready(function(){

    var mmval = $("#btc_balance").val();
    $('#sellBtcSubmitId').hide();
    
    $("#myFormSellcoin").validate({
        rules: {                            
            // btc_amount: {
            //     required: true,                 
            //     max: mmval
            // }
                     
        },
        messages: {                     
            btc_amount: {
                required: "Please enter an amount",
            }
            
        }
    });
    
    $("#btc_amount").keyup(function(){
        
        $('#sellBtcSubmitId').hide();
        // if($("#cfa_amount").val() <= 0){
        //  $('#sellBtcSubmitId').hide();

        // }
       
       $("#cfa_amount").val($("#btc_amount").val()*<?php echo $cfa;?>);
        if($(this).val() > <?=Auth::user()->bitcoin;?>  || $(this).val()  == 0)
        {
           // swal("Sorry!", "Your Request Amount is Larger Than Your Current Balance.", "error");
           $("#amount_less_error").text("Please enter an amount within your current wallet balance of <?=Auth::user()->bitcoin;?>  BTC");

            $('#sellBtcSubmitId').hide();
        }
        else
        {   
          $('#sellBtcSubmitId').show();
          $("#amount_less_error").text("");

            // var due = parseFloat(btc) - parseFloat(amount);
            // $("#wallet_balances").val(due);
        }
    
    });  
 });

</script>
@endsection
