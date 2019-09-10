@extends('layouts.user-frontend.dashboard')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="page_title" style="text-align: -webkit-center;color:#268cab;">Identity Verification</h3>
                    <hr>
                </div>
            </div>
            <div class="row" style="width:100%;" align="center">
            <form action="#" id="myForm" role="form" data-toggle="validator" method="post" accept-charset="utf-8" style="width:100%;">
            	<div>
                    <div>
                        <div style="min-height: 300px;width: 700px;background-color: white;padding-top: 5%;font-size: 21px;padding: 5%;border: 1px solid #eaeaea;" class="">
                            <div align="center" style="text-align: justify;">
							<p>Each Ct-pay user may only have one account. Before continuing, <br/>which of the folowing applies to you?</p>
								<input type="radio" name="user_account_type" id="user_account_type" class="user_account_type" value="1"> <span style="font-size: 16px;margin-left: 2%;">This is my only Ct-pay Account</span><br/>
								<input type="radio" name="user_account_type" id="user_account_type" class="user_account_type" value="2"> <span style="font-size: 16px;margin-left: 2%;">I already have a different Ct-pay account</span>
							</div>
                            <!--<div class="form-group">
                                <label for="email">Email address:</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Write your email address" required>
                                <div class="help-block with-errors"></div>
                            </div>-->
							
							<p style="margin-top: 10%;font-size: 17px;color: #4893f1;cursor: pointer;" id="whyCollect"><i class="fa fa-plus" aria-hidden="true"></i>Why we collect personal information</p>
							
							<div class="infoCollect" style="display:none;font-size: 16px;">Testing purpose................</div>
							
                        </div>
                        
                    </div>
        		</div>
                
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
		$(document).on('click','.user_account_type',function(){
			var user_account_type = $(this).val();
			if(user_account_type == 1){
				window.location.href="{{ asset('user/investment-verify-general') }}";
			} else {
				window.location.href="{{ asset('user/investment-payment-gateway') }}";
			}
        });
		
		$(document).on('click','#whyCollect',function(){
			$('.infoCollect').toggle();
        });
		
    });
</script>
