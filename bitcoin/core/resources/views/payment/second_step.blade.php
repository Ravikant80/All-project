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


<style type="text/css">
    .modal.show .modal-dialog {
        -webkit-transform: translate(0,0);
        transform: translate(0,0);
        margin-top: 100px;
    }
     .portlet {
    background: #fff;
    transition: all 0.4s;
    -webkit-transition: all 220ms ease-in-out;
    -moz-transition: all 220ms ease-in-out;
    -o-transition: all 220ms ease-in-out;
    transition: all 220ms ease-in-out;
    border: 1px solid rgba(0,0,0,0.08);
    -webkit-box-shadow: 0px 1px 2px 0px rgba(0,0,0,0.1);
    -moz-box-shadow: 0px 1px 2px 0px rgba(0,0,0,0.1);
    box-shadow: 0px 1px 2px 0px rgba(0,0,0,0.1);
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    position: relative;
    display: inline-block;
    vertical-align: middle;
    width: 420px;
    max-height: 100%;
    background: #fff;
    text-align: left;
    white-space: normal;
    -webkit-transition: height .25s ease .1s;
    -moz-transition: height .25s ease .1s;
    -o-transition: height .25s ease .1s;
    -ms-transition: height .25s ease .1s;
    position: relative;
    left: 32%;
    transition: height .25s ease .1s;
}

.portlet .portlet-heading {
    padding: 12px 20px;
    line-height: 39px;
    min-height: 39px;
    border-radius: 3px;
    border-bottom: 1px solid #E8E8E8;
    color: #fff;
}

.logo {
    width: 100%;
    height: 39px;
    max-width: 160px;
    background-image: url(../img/monetbil_small.png);
    background-position: left center;
    background-repeat: no-repeat;
    background-size: contain;
    cursor: pointer;
    display: inline-block;
    float: left;
}

.portlet .portlet-heading a {
    color: #34495e;
    font-size: 23px;
}

.logo a {
    width: 100%;
    height: 100%;
    display: block;
}

.portlet .portlet-heading .portlet-widgets {
    position: relative;
    text-align: right;
    float: right;
    padding-left: 15px;
    display: inline-block;
    font-size: 15px;
    line-height: 39px;
}

.portlet .portlet-heading .portlet-widgets .divider {
    margin: 0 5px;
}

.portlet .portlet-heading .portlet-widgets a {
    color: #aaa;
    font-size: 15px;
}

.white-bg {
    background-color: #ffffff;
}

.m-b-5 {
    margin-bottom: 5px !important;
}

.m-0 {
    margin: 0px !important;
}

.wordbreak {
    word-wrap: break-word;
    word-break: normal;
}

.amount-cnt {
    max-width: 70px;
    float: right;
    text-align: right;
}

.amount {
    line-height: 14px;
    margin-top: 7px;
    margin-bottom: 7px;
}

.amount .price {
    font-weight: 900 !important;
    font-size: 16px;
    display: block;
}

.amount .currency {
    color: #aaaaaa;
    font-size: 12px;
    display: block;
    margin-top: 4px;
    line-height: normal;
}

.mno-illustrations img {
    display: inline-block;
    max-height: 64px;
    max-width: 64px;
    vertical-align: middle;
}

.mno-illustrations .mno-content > div {
    float: left;
    width: 64px;
    height: 64px;
    line-height: 64px;
    margin-right: 6px;
    text-align: center;
}

.portlet .portlet-body {
    background: #fff;
    padding: 12px 20px;
    -webkit-border-bottom-right-radius: 5px;
    -webkit-border-bottom-left-radius: 5px;
    -moz-border-radius-bottomright: 5px;
    -moz-border-radius-bottomleft: 5px;
    border-bottom-right-radius: 5px;
    border-bottom-left-radius: 5px;
}

.input-lg + .form-control-feedback, .control-feedback-lg {
    font-size: 18px;
    line-height: 40px;
    width: auto;
    height: 40px;
    padding-right: 15px;
}
.form-control-feedback-countryflag img {
    height: 100%;
}

.form-control-feedback {
    position: absolute;
    top: 152px;
    right: 16px;
    margin-top: 0px;
    line-height: 36px;
    font-size: 17px;
    color: #b2bcc5;
    background-color: transparent;
    padding: 0 12px 0 0;
    border-radius: 2px;
    pointer-events: none;
}

.form-control-feedback-countrycode {
    left: 20px;
    text-align: left;
    color: #34495e;
    font-size: 17px !important;
}

.pretty {
    position: relative;
    display: inline-block;
    margin-right: 1em;
    white-space: nowrap;
    line-height: 1;
}

#phoneNumberText {
    padding: 10px 15px 10px 70px !important;
    font-weight: 700;
}

.input-lg, .form-group-lg .form-control, .form-group-lg .select2-search input[type="text"] {
    height: 45px;
    padding: 10px 15px;
    font-size: 17px;
    line-height: 1.235;
    border-radius: 2px;
}


.form-control, .select2-search input[type="text"] {
    border: 3px solid #34495e;
    color: #34495e;
    font-family: "Lato", Helvetica, Arial, sans-serif;
    font-size: 15px;
    line-height: 1.467;
    padding: 8px 56px;
    height: 42px;
    border-radius: 2px;
    box-shadow: none;
    -webkit-transition: none;
    transition: none;
}

.text-xs {
    font-size: 12px;
}

.btn-info {
    color: #ffffff;
    background-color: #086fd1;
}

.btn {
    padding: 8px 60px;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-left: 5px;
}
.wrapper:before {
    content: '';
    display: inline-block;
    height: 100%;
    vertical-align: middle;
}

.p-r-5 {
    padding-right: 5px !important;
}

.btn-custom {
    background: transparent;
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    border-width: 1px;
    -webkit-transition: all 400ms ease-in-out;
    -moz-transition: all 400ms ease-in-out;
    -o-transition: all 400ms ease-in-out;
    transition: all 400ms ease-in-out;
}

.btn-inverse, .btn-inverse:hover, .btn-inverse:focus, .btn-inverse:active, .btn-inverse.active, .btn-inverse.focus, .btn-inverse:active, .btn-inverse:focus, .btn-inverse:hover, .open>.dropdown-toggle.btn-inverse {
    /* background-color: #14082d; */
    border: 1px solid #14082d;
    color: #14082d;
}

.btn-inverse:hover {
    background-color: #14082d;
    border: 1px solid #14082d;
    color: #FFFFFF;
}

.btn-info.active.focus, .btn-info.active:focus, .btn-info.active:hover, .btn-info:active.focus, .btn-info:active:focus, .btn-info:active:hover, .open>.dropdown-toggle.btn-info.focus, .open>.dropdown-toggle.btn-info:focus, .open>.dropdown-toggle.btn-info:hover {
    color: #fff;
    background-color: #269abc;
    border-color: #1b6d85;
}

.pretty.p-icon .state .icon {
    position: absolute;
    font-size: 1em;
    width: calc(1em + 2px);
    height: calc(1em + 2px);
    left: 0;
    z-index: 1;
    text-align: center;
    line-height: normal;
    top: calc((0% - (100% - 1em)) - 8%);
    border: 1px solid transparent;
    opacity: 0;
}

.pretty.p-round.p-icon .state .icon {
    border-radius: 100%;
    overflow: hidden;
}

.pretty .state label {
    position: initial;
    display: inline-block;
    font-weight: 400;
    margin: 0;
    text-indent: 1.5em;
    min-width: calc(1em + 2px);
}

.pretty.p-round .state label:after, .pretty.p-round .state label:before {
    border-radius: 100%;
}

.pretty .state label:after, .pretty .state label:before {
    width: calc(2em)!important;
    height: calc(2em)!important;
    border: 2px solid #086fd1!important;
}

.pretty .state label:after, .pretty .state label:before {
    content: '';
    width: calc(1em + 2px);
    height: calc(1em + 2px);
    display: block;
    box-sizing: border-box;
    border-radius: 0;
    border: 1px solid transparent;
    z-index: 0;
    position: absolute;
    left: 0;
    top: calc((0% - (100% - 1em)) - 8%);
    background-color: transparent;
}

.pretty .state label:after, .pretty .state label:before {
    content: '';
    width: calc(1em + 2px);
    height: calc(1em + 2px);
    display: block;
    box-sizing: border-box;
    border-radius: 0;
    border: 1px solid transparent;
    z-index: 0;
    position: absolute;
    left: 0;
    top: calc((0% - (100% - 1em)) - 8%);
    background-color: transparent;
}

.btn-block {
    display: block;
    width: 100%;
}

.form-control-feedback-countrycode {
    left: 20px;
    text-align: left;
    color: #34495e;
    font-size: 17px !important;
}

.country-codes1{
  position: relative;
  left: 5px;
  top: 2px;
}
.country-codes2{
  position: relative;
  left: 5px;
  top: 90px; 
}

.btn-group{
  display: none;
}

.sw-theme-arrows > ul.step-anchor > li.nav-item2 > a:after {
    /* border-left: 30px solid #5cb85c !important; */
    border-left: 30px solid #f5f5f5 !important;
}

.sw-theme-arrows > ul.step-anchor > li {
    width: 87px;
    padding-right: 27px;
    background-color: white;
}
.portlet {
    /* background: #fff; */
    /* transition: all 0.4s; */
    /* -webkit-transition: all 220ms ease-in-out; */
    -moz-transition: all 220ms ease-in-out;
    -o-transition: all 220ms ease-in-out;
    /* transition: all 220ms ease-in-out; */
    /* border: 1px solid rgba(0,0,0,0.08); */
    /* -webkit-box-shadow: 0px 1px 2px 0px rgba(0,0,0,0.1); */
    -moz-box-shadow: 0px 1px 2px 0px rgba(0,0,0,0.1);
    /* box-shadow: 0px 1px 2px 0px rgba(0,0,0,0.1); */
    /* -webkit-border-radius: 5px; */
    -moz-border-radius: 5px;
    /* border-radius: 5px; */
    /* position: relative; */
    /* display: inline-block; */
    vertical-align: middle;
    width: 100%;
    max-height: 100%;
    background: #fff;
    text-align: left;
    /* white-space: normal; */
    /* -webkit-transition: height .25s ease .1s; */
    -moz-transition: height .25s ease .1s;
    -o-transition: height .25s ease .1s;
    -ms-transition: height .25s ease .1s;
    position: relative;
     left: 0%; 
    transition: height .25s ease .1s;
    border: none;
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

.sw-theme-arrows {
    border-radius: 5px;
    border: 1px solid #ddd;
    margin-top: 30px;
}
.content-wrapper {
    padding: 2.2rem;
    margin-left: 15%;
}
</style>

<div class="container"> 
  <div class="wrapper"> 
    <div class="arrow-steps clearfix">
        <div class="step"> <span> Method</span> </div>
        <div class="step "> <span> Amount</span> </div>
        <div class="step current"> <span>Payment</span> </div>
    </div>
  </div>
</div>
<div class="row" style="width:100%;" align="center">
           
            
         
                <div id="smartwizard">
                    <ul style="display: none;">
                        <!-- <li class="nav-item2"><a href="#step-1" style="background-color: #f5f5f5 !important; color: #bbb  !important;">Method</a></li> -->
                        <li class="nav-item active"><a href="#step-3" style="    padding-left: 25px !important;">Payment</a></li>
                    </ul>

                    <div>
                        <div id="step-3" style="height:450px; width:100%;" class="">
                          <div class="">
         <div class="portlet">
            <div class="portlet-heading" id="layout-heading">
               <div class="logo"><a href="" target="_blank" title="CT Pay">pay</a>
                   
               </div>
               <div class="portlet-widgets">
                   <span class="divider"></span>
                   <a><span class="fui-cross"></span></a>
               </div>
               <div class="clearfix"></div>
            </div>
            <div class="portlet-body" id="layout-body">
               <div class="row m-0">
                  <div class="col-xs-7 p-0 white-bg">
                     <h5 class="m-0 m-b-5 wordbreak">Ct Pay</h5>
                     <h6 class="m-0 wordbreak">Payment for wallet</h6>
                  </div>
                  <div class="col-xs-3 p-0 amount-cnt">
                     <h6 class="amount">
                         <span class="price">Pay</span>
                         <small class="currency">XAF</small>
                     </h6>
                  </div>
               </div>
               <form action="" method="post" role="form" onsubmit="">
                  
                  <div class="form-group m-0">
                      <label for="phoneNumberText">Enter your phone number</label>
                  </div>
                  
                  <div class="form-group m-b-10">
                     <span class="form-control-feedback form-control-feedback-countrycode control-feedback-lg"><strong class="country-codes1">+237</strong></span>
                     <input id="phone" type="tel" name="phone" id="phoneNumberText" class="form-control input-lg" value="{{ $phone }}" autocomplete="off" spellcheck="false" dir="auto"><span class="form-control-feedback form-control-feedback-countryflag control-feedback-lg"><img src="https://api.monetbil.com/assets/img/drp/CM.png" alt="CM"></span>
                  </div>
                  
                  
                 <div class="form-group m-0">
                     <label for="phoneNumberText">Amount to Add</label>
                 </div> 
                  
                 <div class="form-group m-b-10">
                     <span class="form-control-feedback form-control-feedback-countrycode control-feedback-lg"><strong class="country-codes2">XAF</strong></span>
                     <input type="tel" name="amount" id="amount" class="form-control input-lg" value="" autocomplete="off" spellcheck="false" dir="auto"><span class="form-control-feedback form-control-feedback-countryflag control-feedback-lg">
                         <img src="{{ url('assets/images/cfa.png') }}" alt="CM"></span>
                  </div>
                  
                  
                  
                  <div class="load-bar" id="progressBar">
                     <div class="bar"></div>
                     <div class="bar"></div>
                     <div class="bar"></div>
                  </div>
                  <div class="row m-0">
                     <div class="col-xs-6 p-0 p-r-5"><a href="{{ url('payment/dashboard') }}"  class="btn btn-inverse btn-block btn-custom m-b-5">Back</a></div>
                     <div class="col-xs-6 p-0 p-l-5"><button onclick="sendRequest('{{ url('payment/deposit') }}','depositForm',this)" type="button" class="btn btn-info btn-block m-b-5">Next</button></div>
                  </div>
                <!--   <div class="mno-illustrations">
                     <div class="mno-content">
                        <div><img title="Mobile Telephone Network Cameroon Ltd" src="{{ url('assets/images/mtn_money.png') }}" alt=""></div>
                     </div>
                  </div> -->
               </form>
            </div>
         </div>
      </div>
                   
        </div>
      </div>
    </div>

</div>
<script type="text/javascript">

    function sendRequest(link,formId,thisone ) {
        $(".help-block").html(""); 
        
        var check = true;
        
        if($("#amount").val() == ""){
            bootbox.alert("Please enter valid amount in box");
            //$("#amount_help").text("The amount field is required.");
            check = false; 
        }
        
        if($("#phone").val() == ""){
            /*$("#phone_help").text("The phone field is required.");*/
            bootbox.alert("Please enter valid phone number in box");
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



