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
            <form action="{{ route('deposit-fund') }}" id="myForm" role="form" method="post" style="width:100%;">
            	 {{ csrf_field() }}
            	<div id="smartwizard">
                    <ul>
                        <!--<li><a href="#step-1">Method</a></li>-->
                        <li><a href="#step-2">Amount</a></li>
                        <li><a href="#step-3">Payment</a></li>
                    </ul>

                    <div>
                        <div id="step-1" style="height:300px; width:100%;" class="">
                            <p>&nbsp;</p>
                            <!--<div class="form-group">
                                <label for="email">Email address:</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Write your email address" required>
                                <div class="help-block with-errors"></div>
                            </div>-->                               
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
                                        <td><input type="hidden" name="charge" id="charge"><i class="fa fa-usd"></i> <span id="ctpay_fee">10</span></td>                        
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
                        <div id="step-3" style="height:400px;" class="">
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
                
             </form>
                <!--@foreach($method as $p)

                <div class="col-sm-4 text-center">
                    <div class="panel panel-primary panel-pricing">
                        <div class="panel-heading">
                            <h3 style="font-size: 28px; color:#FFFFFF;"><b>{{ $p->name }}</b></h3>
                        </div>
                        <div style="font-size: 18px;padding: 18px;" class="panel-body text-center">
                            <img class="" style="width: 35%;border-radius: 5px" src="{{ asset('assets/images') }}/{{ $p->image }}" alt="">
                        </div>
                        <ul style='font-size: 15px;' class="list-group text-center bold">
                            
                            <li class="list-group-item">Processing Time - {!! $p->duration !!} Days </li>
                        </ul>
                        <div class="panel-footer" style="overflow: hidden">
                            <div class="col-sm-12">
                                <a href="javascript:;" @if($basic->withdraw_status == 0) disabled @else onclick="jQuery('#modal-{{ $p->id }}').modal('show');" @endif class="btn btn-danger btn-block btn-icon btn-lg bold icon-left"><i class="fa fa-cloud-upload"></i> Buy Now</a>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach-->
            </div>
        </div>
    </div><!---ROW-->
@endsection

<script src="{{ asset('assets/dashboard/assets/js/jquery-1.12.4.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
		/*var pageURL1 		= $(location).attr("href");
		var url_solit1		= pageURL1.split("#");
		var current_step1	= url_solit1[1];
		
		if(current_step1 == 'step-3'){
			$(".sw-btn-next").hide();
			$(".sw-btn-prev").hide();
		} else {
			$(".sw-btn-next").show();
			$(".sw-btn-prev").show();
			$(".done-btn").hide();
		}*/
		
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
			
			$("#myForm").validate({
					rules: {
						amount: {
							required: true,
							number: true
						}
					},
					messages: {						
						amount: {
							required: "Please enter an amount too continue",
						},
					}
				});
			//alert(amount);
			
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
			
			
			
			/*if(current_step == 'step-3'){
				
				$.ajax({
					method: 'POST', // Type of response and matches what we said in the route
					//url: "http://localhost:8081/bitcoin/user/updateuserwallet", // This is the url we gave in the route
					url: "{{ url('/user/updateuserwallet') }}", // This is the url we gave in the route
					data: 'amount='+amount, // a JSON object to send back
					headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') },
					success: function(response){ // What to do if we succeed
						//console.log(response); 
						//alert(response);
						window.location.href="{{ asset('user/investment-verify-info') }}";
					},
					error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
						console.log(JSON.stringify(jqXHR));
						console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
						alert(JSON.stringify(jqXHR));
						alert("AJAX error: " + textStatus + ' : ' + errorThrown);
					}
				});
				
				//window.location.href="{{ asset('user/investment-verify-info') }}";
			}*/
        });
		$(document).on('click','.sw-btn-prev, .nav-link',function(){
			$(".sw-btn-next").show();
			$(".done-btn").hide();
        });
    });
</script>
