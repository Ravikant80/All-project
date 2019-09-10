@extends('layouts.user-frontend.dashboard')
@section('content')

	
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="page_title" style="text-align: -webkit-center;">How much bitcoin you want to send?</h3>
                    <hr>
                </div>
            </div>
            <div class="row" style="width:100%;" align="center">
            <form action="{{ route('cash-out') }}" id="myForm" role="form" data-toggle="validator" method="post" accept-charset="utf-8" style="width:100%;">
            	{{ csrf_field() }}
                <input type="hidden" name="from_wallet_address" id="from_wallet_address" value="{{ Auth::user()->wallet_address }}">
            	<div id="smartwizard">
                    <ul>
                        <li><a href="#step-1">Amount</a></li>
                        <li><a href="#step-2">Recipient</a></li>
                        <li><a href="#step-3">Payment</a></li>
                    </ul>

                    <div>
                        <div id="step-1" style="height:400px; width:100%;" class="">
                            <div id="form-step-0" role="form" data-toggle="validator">
                            	<p>&nbsp;</p>
                                <div class="form-group">
                                    <label for="name">How much bitcoin you want to send?</label>
                                    	<input type="text" class="form-control text-right" autocomplete="off" name="amount" id="amount" placeholder="0" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                    <label for="name">BTC Wallet Balance</label>
                                    	<input type="text" class="form-control text-right" name="btc_amount" id="btc_amount" value="{{ Auth::user()->bitcoin }}" readonly>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                	<label for="name">Wallet Balance</label>
                                       <input type="text" class="form-control text-right" name="wallet_balance" id="wallet_balance" readonly>
                                </div>
                            </div>                                                      
                        </div>
                        <div id="step-2" style="height:300px;" class="">
                            <div id="form-step-1" role="form" data-toggle="validator">
                            	<p>&nbsp;</p>
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
                            </div>
                        </div>
                        <div id="step-3" style="height:300px;" class="">
                            <div id="form-step-2" role="form" data-toggle="validator">
                            	<p>&nbsp;</p>
                                <div class="form-group">
                                    <label for="address">Message</label>
                                    <textarea class="form-control" name="message" id="message" rows="3" placeholder="Write your message..." required></textarea>
                                    <div class="help-block with-errors"></div>
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

<script type="text/javascript">
    $(document).ready(function(){
		
		/*$(document).on('click','.sw-btn-next',function(){
			var pageURL = $(location).attr("href");
            //alert(pageURL);
			var url_solit		= pageURL.split("#");
			var current_step	= url_solit[1];
			//alert(current_step);
			var amount			= $('#amount').val();
			
			if(current_step == 'step-3'){
				
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
			}
        });*/
    });
</script>
