@extends('layouts.user-frontend.dashboard')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="page_title" style="text-align: -webkit-center;">How would you like to Cash-In?</h3>
                    <hr>
                </div>
            </div>
            <div class="row" style="width:100%;" align="center">
            <form action="{{ route('cash-in') }}" id="myForm" role="form" data-toggle="validator" method="post" accept-charset="utf-8" style="width:100%;">
            	{{ csrf_field() }}
            	<div id="smartwizard">
                    <ul>
                        <li><a href="#step-1">Method</a></li>
                        <li><a href="#step-2">Amount</a></li>
                        <li><a href="#step-3">Payment</a></li>
                    </ul>

                    <div>
                        <div id="step-1" style="height:300px; width:100%;" class="">
                            <p>&nbsp;</p>
                            <div class="form-group">
                                <label for="name">Choose Payment Gateway</label>
                                <select name="payment_method" id="payment_method" class="custom-select">
                                	<option value="">----Select Payment Type----</option>
                                	@foreach($method as $p)
                                    	<option value="{{ $p->id }}">{{ $p->name }}</option>
                                	@endforeach
                                </select>
                            </div>
                        </div>
                        <div id="step-2" style="height:400px;" class="">
                            <div id="form-step-1" role="form" data-toggle="validator">
                            	<p>&nbsp;</p>
                                <div class="form-group">
                                    <label for="name">How much would you like to Cash In?</label>
                                    <input type="text" class="form-control" name="amount" id="amount" autocomplete="off" placeholder="0" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="table-responsive">
                                  <table class="table table-de mb-0">                    
                                    <tbody>
                                      <tr>
                                        <td>Payment method</td>
                                        <td></td>                        
                                      </tr>
                                      <tr>
                                        <td>Receiving wallet</td>
                                        <td><i class="fa fa-usd"></i> USD Wallet</td>                        
                                      </tr> 
                                      <tr>
                                        <td>You will receive</td>
                                        <td><i class="fa fa-usd"></i> <span id="will_receive">0</span></td>                        
                                      </tr> 
                                      <tr>
                                        <td>Ct-pay fee</td>
                                        <td><input type="hidden" name="charge" id="charge" value="{{ $basic_setting->cashin_commission }}"><i class="fa fa-usd"></i> <span id="ctpay_fee">{{ $basic_setting->cashin_commission }}</span></td>                        
                                      </tr> 
                                      <tr>
                                        <td>Payment method fee</td>
                                        <td><input type="hidden" name="payment_fee" id="payment_fee"><i class="fa fa-usd"></i> <span id="method_fee">1</span></td>                  
                                      </tr>
                                      <tr>
                                        <td>Amount Due</td>
                                        <td><i class="fa fa-usd"></i> <span id="amount_due">0</span></td>                        
                                      </tr>  
                                      <!--<tr>
                                      	<td align="center"><a href="javascript:;" style="color:#000000;"><i class="fa fa-exchange"></i> Convert</a></td>
                                      </tr>  -->                   
                                    </tbody>
                                  </table>
                            	</div>
                            </div>
                        </div>
                        <div id="step-3" style="height:300px;" class="">
                            <div id="form-step-2" role="form" data-toggle="validator">
                            	<p>&nbsp;</p>
                                <div class="form-group">
                                    <label for="address">Card No</label>
                                    <div style="padding-left:60px;" class="row">
                                    <input type="number" class="form-control col-md-8" name="card_no" id="card_no" autocomplete="off" placeholder="Card Number">
                                    </div>
                                </div>
                                <div class="form-group" style="padding-top:20px;">
                                    <label style="vertical-align:middle;" for="address">Expire Details</label>
                                    <div class="row" style="padding-left:30px;">
                                    	<input type="text" autocomplete="off" class="form-control col-md-2" name="card_month" id="card_month" placeholder="month">
                                    <span style="margin-left:10px; margin-right:10px;"> &nbsp; </span>
                                    	<input type="text" autocomplete="off" class="form-control col-md-2" name="card_year" id="card_year" placeholder="year">
                                        </div>
                                </div>
                                <div class="form-group">
                                    <label for="address">CVV / CVC</label>
                                    <div class="row" style="padding-left:45px;">                                    
                                    	<input type="text" autocomplete="off" class="form-control col-md-2" name="cvc" id="cvc" placeholder="CVV">
                                	</div>
                            	</div>
                       		</div>                        
                    	</div>
        			</div>
                </div>
              
             </form>
             
            </div>
        </div>
    </div>
@endsection

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
		$("#myForm").validate({
			rules: {							
				card_no: {
					required: true,
					maxlength: 30,
					number: true
				},
				card_month: {
					required: true,
					number: true,
					maxlength: 2,
				},
				card_year: {
					required: true,
					number: true,
					maxlength: 2,
				},
				cvc: {
					required: true,
					number: true,
					maxlength: 3,
				},
				
			},
			messages: {						
				card_no: {
					required: "Please enter a card number",
				},
				card_month: {
					required: "Please provide a card expiry month",
				},
				card_year: {
					required: "Please provide a card expiry year",
				},
				cvc: {
					required: "Please enter a 3-digit secret code behind your card",
				}
			}
		});
		
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
        });
    });
</script>

<script>
$(document).ready(function() {
	//alert('test');
	$("#amount").keyup(function(){
		var amount = $(this).val();
		//alert(amount);
		var ctpay = $("#charge").val();
		//alert(ctpay);
		var mfee = 1;
		var due = parseInt(amount)+parseInt(ctpay)+parseInt(mfee);
		
		$("#will_receive").html(amount);
		$("#method_fee").html(mfee);		
		$("#payment_fee").val(mfee);
		$("#charge").val(ctpay);
		$("#amount_due").html(due);
	});
});
</script>